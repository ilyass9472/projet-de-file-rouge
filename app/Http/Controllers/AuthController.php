<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RSAService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $rsa;

    public function __construct(RSAService $rsaService)
    {
        $this->rsa = $rsaService;
    }
    public function generateExposantPublic()
    {
        [$e, $n] = $this->rsa->getPublicKey();
        return response()->json(['e' => $e, 'n' => $n]);
    }

    public function showLoginForm(RSAService $rsaService)   
    {
        [$e, $n] = $rsaService->getPublicKey();
        
        return view('login', [
            'e' => $e,
            'n' => $n,
            'getPublicKey' => ['e' => $e, 'n' => $n]
        ]);
    }

    public function register(Request $request)
{
    try {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password_encrypted' => 'required|string'
        ]);
        
        try {
            $password = $this->decryptPassword($request->password_encrypted);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Password encryption error. Please try again.']);
        }
        
        if (strlen($password) < 8) {
            return back()->withErrors(['error' => 'Password must be at least 8 characters long']);
        }
        
        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($password)
        ]);
        
        $token = $this->generateJwtToken($user);
        
        Session::put('auth_token', $token);
        
        return redirect('/dashboard')->with('success', 'Registration successful!');
        
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password_encrypted' => 'required|string'
            ]);
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors(['error' => 'User not found']);
            }
            
            
            $password = $this->decryptPassword($request->password_encrypted);
            
            
            if (!Hash::check($password, $user->password)) {
                return back()->withErrors(['error' => 'Invalid credentials']);
            }
            
            $token = $this->generateJwtToken($user);
            
            Session::put('auth_token', $token);
            
            return redirect('/dashboard')->with('success', 'Login successful!');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    private function decryptPassword($encryptedPassword)
    {
        try {
            $values = explode(" ", $encryptedPassword);
            
            
            $this->rsa->setC($values);
            
            
            return $this->rsa->deChiffrement();
            
        } catch (\Exception $e) {
            throw new \Exception('Failed to decrypt password: ' . $e->getMessage());
        }
    }
    
    private function generateJwtToken($user)
    {
        $config = Configuration::forAsymmetricSigner(
            new RsaSha256(),
            InMemory::plainText($this->rsa->getPrivateKeyPem()),
            InMemory::plainText($this->rsa->getPublicKeyPem())
        );
        
        $now = new \DateTimeImmutable();
        $token = $config->builder()
            ->issuedBy('https://your-app.com')
            ->permittedFor('https://your-client.com')
            ->identifiedBy(bin2hex(random_bytes(16)), true)
            ->issuedAt($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', $user->id)
            ->getToken($config->signer(), $config->signingKey());
            
        return $token->toString();
    }
    
    public function logout(Request $request)
    {
        Session::forget('auth_token');
        
        return redirect('/login')->with('success', 'Successfully logged out');
    }
    
    public function checkAuth()
    {
        $token = Session::get('auth_token');
        
        if (!$token) {
            return redirect('/login');
        }
        
        try {
            $config = Configuration::forAsymmetricSigner(
                new RsaSha256(),
                InMemory::plainText($this->rsa->getPrivateKeyPem()),
                InMemory::plainText($this->rsa->getPublicKeyPem())
            );
            
            $parsedToken = $config->parser()->parse($token);
            
            $constraints = $config->validationConstraints();
            
            if (!$config->validator()->validate($parsedToken, ...$constraints)) {
                Session::forget('auth_token');
                return redirect('/login')->withErrors(['error' => 'Session expired, please login again']);
            }
            
            $uid = $parsedToken->claims()->get('uid');
            
            $user = User::find($uid);
            
            if (!$user) {
                Session::forget('auth_token');
                return redirect('/login')->withErrors(['error' => 'User not found']);
            }
            
            Session::put('user', $user);
            
            return true;
            
        } catch (\Exception $e) {
            Session::forget('auth_token');
            return redirect('/login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}