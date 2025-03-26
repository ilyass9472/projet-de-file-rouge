<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RSA;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HmacSha256;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;

class RsaController extends Controller
{
    public function run()
    {
        try {
            $rsa = new RSA();
            list($e, $n) = $rsa->getPublicKey();
            list($d, $n) = $rsa->getPrivateKey();
            $message_dechiffre = $rsa->deChiffrement();
            $c = $rsa->getChiffrement();

            $privateKeyPem = $rsa->getPrivateKeyPem();


            $config = Configuration::forAsymmetricSigner(
                new RsaSha256(),
                InMemory::plainText($privateKeyPem),
                InMemory::plainText($rsa->getPublicKeyPem())
            );
            
            
            $now = new \DateTimeImmutable();
            $token = $config->builder()
                ->issuedBy('https://your-app.com')
                ->permittedFor('https://your-client.com')
                ->identifiedBy('4f1g23a12aa', true)
                ->issuedAt($now)
                ->expiresAt($now->modify('+1 hour'))
                ->withClaim('uid', 123)
                ->getToken($config->signer(), $config->signingKey());
            
                
            $output = [
                "rsa_keys" => [
                    "public_key" => "($e, $n)",
                    "private_key" => "($d, $n)"
                ],
                "message" => [
                    "original" => $rsa->m,
                    "ascii" => $rsa->asciiString,
                    "encrypted" => $c,
                    "decrypted" => $message_dechiffre
                ],
                "jwt" => [
                    "token" => $token->toString()
                ]
            ];
            
            
            if (php_sapi_name() === 'cli') {
                echo "Clé publique (e, n) : ($e, $n)\n";
                echo "\n";
                echo "Clé privée (d, n) : ($d, $n)\n";
                echo "\n";
                echo "Valeur ASCII de '{$rsa->m}': {$rsa->asciiString}\n";
                echo "Message chiffré : $c\n";
                echo "Message déchiffré : $message_dechiffre\n";
                echo "JWT Token : " . $token->toString() . "\n";
                return;
            }
            
            return response()->json($output);
            
        } catch (\Exception $e) {
            $errorResponse = [
                "error" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine()
            ];
            
            if (php_sapi_name() === 'cli') {
                echo "Error: " . $e->getMessage() . "\n";
                echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
                echo "Trace: " . $e->getTraceAsString() . "\n";
                return;
            }
            
            return response()->json($errorResponse, 500);
        }
    }
    
    
    public function encrypt(Request $request)
    {
        try {
            $message = $request->input('message', 'hello world!');
            
            $rsa = new RSA($message);
            
            list($e, $n) = $rsa->getPublicKey();
            $c = $rsa->getChiffrement();
            
            return response()->json([
                "message" => $message,
                "public_key" => "($e, $n)",
                "encrypted" => $c
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
    
    public function decrypt(Request $request)
    {
        try {
            $message = $request->input('message', 'hello world!');
            
            $rsa = new RSA($message);
            $encrypted = $rsa->getChiffrement();
            $decrypted = $rsa->deChiffrement();
            
            return response()->json([
                "original" => $message,
                "encrypted" => $encrypted,
                "decrypted" => $decrypted
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}