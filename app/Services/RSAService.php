<?php
namespace App\Services;

class RSAService {
    protected $p;
    protected $q;
    protected $n;
    protected $f;
    protected $e;
    protected $d;
    protected $c;
    public $m = "";
    public $asciiString = "";
    protected $privateKeyPem;
    protected $publicKeyPem;
    
    public function __construct($message = null) {
        if ($message !== null) {
            $this->m = $message;
        }
        
        $this->loadOrGenerateKeys();
        
        if ($message !== null) {
            $this->convertirLesLettreEnValeurASCII();
            $this->chiffrement();
        }
    }
    
    protected function loadOrGenerateKeys() {
        if (file_exists(storage_path('app/rsa_keys.json'))) {
            $keys = json_decode(file_get_contents(storage_path('app/rsa_keys.json')), true);
            $this->p = $keys['p'];
            $this->q = $keys['q'];
            $this->e = $keys['e'];
            $this->d = $keys['d'];
            
            $this->n = $this->p * $this->q;
            $this->f = ($this->p - 1) * ($this->q - 1);
        } else {
            $this->p = 15485863;
            $this->q = 15485867;
            
            $this->n = $this->p * $this->q;
            $this->f = ($this->p - 1) * ($this->q - 1);
            
            $this->generateExposantPublic();
            $this->generateExposantPrive();
            
            $keys = [
                'p' => $this->p,
                'q' => $this->q,
                'e' => $this->e,
                'd' => $this->d
            ];
            file_put_contents(storage_path('app/rsa_keys.json'), json_encode($keys));
        }
        $this->generatePemKeys();
    }
  
    protected function pgcd($a, $b) {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    protected function modInverse($a, $m) {
        $a = $a % $m;
        if ($a < 0) {
            $a += $m;
        }
        
        $s = 0;
        $old_s = 1;
        $t = 1;
        $old_t = 0;
        $r = $m;
        $old_r = $a;
        
        while ($r != 0) {
            $quotient = intdiv($old_r, $r);
            
            $temp = $r;
            $r = $old_r - $quotient * $r;
            $old_r = $temp;
            
            $temp = $s;
            $s = $old_s - $quotient * $s;
            $old_s = $temp;
            
            $temp = $t;
            $t = $old_t - $quotient * $t;
            $old_t = $temp;
        }
        
        if ($old_r != 1) {
            throw new \Exception("Modular inverse does not exist");
        }
        
        if ($old_s < 0) {
            $old_s += $m;
        }
        
        return $old_s;
    }
    
    protected function generateExposantPublic() {
        $startValue = 65537;
        echo "Starting with e = $startValue\n";
        
        if ($this->pgcd($startValue, $this->f) == 1) {
            echo "65537 is coprime with f(n), using it.\n";
            $this->e = $startValue;
            return $this->e;
        }
        
        echo "65537 is NOT coprime with f(n), trying alternatives.\n";
        $candidates = [257, 17, 5, 3];
        
        foreach ($candidates as $candidate) {
            echo "Testing e = $candidate\n";
            if ($this->pgcd($candidate, $this->f) == 1) {
                echo "Found suitable e = $candidate\n";
                $this->e = $candidate;
                return $this->e;
            }
        }
        
        throw new \Exception("Could not find suitable public exponent");
    }

    protected function generateExposantPrive() {
        $this->d = $this->modInverse($this->e, $this->f);
    }

    protected function generatePemKeys() {
        $this->privateKeyPem = "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAvipQjrkMpCc8yQVxbk5XUqxN+qELNvjJ1ISnrgpwpLfN6MlN
aHIGvLI8+DbfMBkJuVk89h09p0Y5SxIYZzuFqaP0EHt4BouMqA7vHg94JrKLFOGr
X3kGAB9wPSL0xX7p79I0wOgz0E3Ka2O0l16BBBu+jYYBPQFZKtMXUYB5tTPmMhio
AQxBMrshIiJ+GXlj2oZHJgJVjnRQtMXcgcHKJ2BGEfHQxHNgOFLM9+RvP/tz1G4S
YglyWnV7WjjYVCvwZ7tn3Z3dGyhD3TQsBKsYI56t4yUmCQaG2XxzvJggfMfyLbmu
zVzR4r8vok8mHzKjy3YyNPZDxfRCKeNndMSuHQIDAQABAoIBAGP9k0SzRnrpl9Qy
LnY8jx9XtBkP64oLnoGiPJgKPJCaH1aZtPPqQwH3cF10mHAH0PrTU0yhLm9JLJdY
qNlfqQxwEYfdUj1AfsXwWQHk7yLJWSoNeRJaEWrMCvGTqCDcFn8zqFDy1JfprfVl
NTmf2fX4XRgT8F3qoaGbqlVUbzQ0hYBtDYM68f+lfGQsIJxl0gEMzJfEN3ZJ2o0L
qJfK9KTuinQ1SG6KGY6K2oZOYZqPFTS+QfR5OUx6FXQYCoZnmQQ6yPFAxbUUOjhA
jzZSDZ8h8dUwlL8ZTA6OXjYVPgmXwZz3N+nVvlYPPUW11lgbGcbLay5J56oijMQ5
c+OnXUECgYEA5DcLgXwZ54wPr6xRuVa25F8dLHJKwtYPjTl59eZ8S7JFxrAYcIBK
MSA9p1kfBezHfETgWv6sqFd7fUtAaYJJTVm0+3WqtkXQyMRNgdOiz/7k1C1qUHZt
6+mzK1QkW0X+QveC0A3b2ovw6rTKa8pHvCcVyHnSuL0etfm/kk9WaT0CgYEA1ahA
xauNFJdVjKZnXtGQ+Sy3lV31NQBxR0X2Y8ssMTt4cQysGgg3GYwG0H0ZmG0UNb9s
xhsxFFJDX5gnJxBV9y7bvRbT9/CpYw58+ULf8B5p7T5HNgKfJG3d3hmCvG8JM06A
eEd3jx41Vz7Z5hDEQ1j8hF0zkveH9X0L0xBU9nECgYBLhMg1EZuZ82QaOUqkP7ZM
gcUjG4wauTQnNJrHZHgGCi81XIxQnIvnpVInPAfajnM1MZsdfoQMxSWjb5X7pmy6
iYlMxnXzc5a+FcxHzDYcFVB6ZHLbC2oXBmDXbdHW2RLcik9zA4nrUkgFcDNx9DkN
QBAaSLK6gzL0lQtzNH05SQKBgHKRMydYyzgkLZF9FwO3c4e0QZUm7Umu0uVgGLlR
KNnQJ5ciW5w5GQi31dBRgVeR3eB+MfpHGYwjC0KgPiNDYumYG0XOvD0wxcLqxP5P
JKtj9T0/VO1af29fA71Lm0Fn2vP1SiRIQobx2cXyYMQeItSmZYlmBpJVIPQNszjb
hDvxAoGBAI99a4Of9lXCgODgaUrFLZ8PvsvDvK9Q2dHlPQhlu9D5yN3PbBHrDZKb
wEyrCLEyC39oY0PvxMzmZYtXyU8r0x3PkrLHDTb1vQ+1V19lk8ogePZZ7/BWdMKQ
YS3cap/JRrJjG2fOC3SpCfnsYfVkAJHrMA2RuHgTUhaSaAZR1E+e
-----END RSA PRIVATE KEY-----";

        $this->publicKeyPem = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvipQjrkMpCc8yQVxbk5X
UqxN+qELNvjJ1ISnrgpwpLfN6MlNaHIGvLI8+DbfMBkJuVk89h09p0Y5SxIYZzuF
qaP0EHt4BouMqA7vHg94JrKLFOGrX3kGAB9wPSL0xX7p79I0wOgz0E3Ka2O0l16B
BBu+jYYBPQFZKtMXUYB5tTPmMhioAQxBMrshIiJ+GXlj2oZHJgJVjnRQtMXcgcHK
J2BGEfHQxHNgOFLM9+RvP/tz1G4SYglyWnV7WjjYVCvwZ7tn3Z3dGyhD3TQsBKsY
I56t4yUmCQaG2XxzvJggfMfyLbmuzVzR4r8vok8mHzKjy3YyNPZDxfRCKeNndMSu
HQIDAQAB
-----END PUBLIC KEY-----";
    }

    public function getPublicKey() {
        $this->e = 65537;
        return [$this->e, $this->n];
    }

    public function getPrivateKey() {
        return [$this->d, $this->n];
    }
    
    public function convertirLesLettreEnValeurASCII() {
        $this->asciiString = "";
        for ($i = 0; $i < strlen($this->m); $i++) {
            $this->asciiString .= ord($this->m[$i]) . " ";
        }
    }
    
    public function chiffrement() {
        $this->c = [];
        for ($i = 0; $i < strlen($this->m); $i++) {
            $m_ascii = ord($this->m[$i]);
            $this->c[] = bcpowmod($m_ascii, $this->e, $this->n);
        }
    }
    
    public function deChiffrement() {
        $message_dechiffre = "";
        foreach ($this->c as $chiffre) {
            $m_ascii = bcpowmod($chiffre, $this->d, $this->n);
            $message_dechiffre .= chr($m_ascii);
        }
        return $message_dechiffre;
    }
    
    public function getChiffrement() {
        return implode(" ", $this->c);
    }
    
    public function getPrivateKeyPem() {
        return $this->privateKeyPem;
    }
    
    public function getPublicKeyPem() {
        return $this->publicKeyPem;
    }

    public function setC($encryptedData) {
        $this->c = $encryptedData;
    }
}