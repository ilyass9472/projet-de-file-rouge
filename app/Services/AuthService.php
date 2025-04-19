<?php
namespace App\Services;

use App\Models\User;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsaSha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AuthService
{
    protected $rsa;

    public function __construct(RSAService $rsaService)
    {
        $this->rsa = $rsaService;
    }

    public function decryptPassword(string $encryptedPassword): string
{
    $values = explode(" ", $encryptedPassword);

    if (empty($values)) {
        throw new \Exception('Encrypted password format invalid');
    }

    $this->rsa->setC($values);
    return $this->rsa->deChiffrement();
}


    public function generateJwtToken(User $user): string
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
            ->identifiedBy(bin2hex(random_bytes(16)))
            ->issuedAt($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', $user->id)
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
    }

    public function validateToken(string $token): ?User
{
    try {
        $config = Configuration::forAsymmetricSigner(
            new RsaSha256(),
            InMemory::plainText($this->rsa->getPrivateKeyPem()),
            InMemory::plainText($this->rsa->getPublicKeyPem())
        );

        $parsedToken = $config->parser()->parse($token);
        $constraints = $config->validationConstraints();

        if (!$config->validator()->validate($parsedToken, ...$constraints)) {
            return null;
        }

        return User::find($parsedToken->claims()->get('uid'));
    } catch (\Exception $e) {
        Log::error('JWT validation failed: ' . $e->getMessage());
        return null;
    }
}
}