<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RSA;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password_encrypted' => 'required|string'
            ]);
            
            // Decrypt the password
            $password = $this->decryptPassword($request->password_encrypted);
            
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password) // Hash the decrypted password
            ]);
            
            // Create RSA instance for JWT generation
            $rsa = new RSA();
            
            // Generate JWT token
            $config = Configuration::forAsymmetricSigner(
                new RsaSha256(),
                InMemory::plainText($rsa->getPrivateKeyPem()),
                InMemory::plainText($rsa->getPublicKeyPem())
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
            
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token->toString()
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'email' => 'required|string|email',
                'password_encrypted' => 'required|string'
            ]);
            
            // Find user by email
            $user = User::where('email', $request->email)->first();
            
            // Check if user exists
            if (!$user) {
                return response()->json([
                    'error' => 'User not found'
                ], 404);
            }
            
            // Decrypt the password
            $password = $this->decryptPassword($request->password_encrypted);
            
            // Check password
            if (!Hash::check($password, $user->password)) {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }
            
            // Create RSA instance for JWT generation
            $rsa = new RSA();
            
            // Generate JWT token
            $config = Configuration::forAsymmetricSigner(
                new RsaSha256(),
                InMemory::plainText($rsa->getPrivateKeyPem()),
                InMemory::plainText($rsa->getPublicKeyPem())
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
            
            return response()->json([
                'user' => $user,
                'token' => $token->toString()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Decrypt the password that was encrypted with RSA public key
     */
    private function decryptPassword($encryptedPassword)
    {
        try {
            // Parse the encrypted password
            $values = explode(" ", $encryptedPassword);
            
            // Create a new RSA instance
            $rsa = new RSA("dummy"); // Just to initialize the RSA object
            
            // Set the encrypted message manually
            $rsa->c = $values;
            
            // Decrypt the password
            return $rsa->deChiffrement();
            
        } catch (\Exception $e) {
            throw new \Exception('Failed to decrypt password: ' . $e->getMessage());
        }
    }
    
    /**
     * Validate a token
     */
    public function validateToken(Request $request)
    {
        try {
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json([
                    'error' => 'Token not provided'
                ], 401);
            }
            
            // Create RSA instance for JWT validation
            $rsa = new RSA();
            
            // Configure JWT parser
            $config = Configuration::forAsymmetricSigner(
                new RsaSha256(),
                InMemory::plainText($rsa->getPrivateKeyPem()),
                InMemory::plainText($rsa->getPublicKeyPem())
            );
            
            // Parse and validate token
            $parsedToken = $config->parser()->parse($token);
            
            // Validate token claims
            $constraints = $config->validationConstraints();
            
            // Check if the token is still valid
            if (!$config->validator()->validate($parsedToken, ...$constraints)) {
                return response()->json([
                    'error' => 'Invalid or expired token'
                ], 401);
            }
            
            // Extract user ID from token
            $uid = $parsedToken->claims()->get('uid');
            
            // Get user from database
            $user = User::find($uid);
            
            if (!$user) {
                return response()->json([
                    'error' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'valid' => true,
                'user' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Logout user (invalidate token)
     */
    public function logout(Request $request)
    {
        // In a real application, you might want to add the token to a blacklist
        // or implement a token revocation mechanism
        
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}