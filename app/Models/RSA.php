<?php
namespace App\Models;
class RSA {
    protected $p = 104729;
    protected $q = 104723;
    protected $n;
    protected $f;
    protected $e;
    protected $d;
    protected $c;
    public $m="hello world";
    public $asciiString ="";
    
    public function __construct() {
        $this->n = $this->p * $this->q;
        $this->f = ($this->p - 1) * ($this->q - 1);
        $this->generateExposantPublic();
        $this->generateExposantPrive();
        $this->convertirLesLettreEnValeurASCII();
        $this->chiffrement();
    }

    protected function pgcd($a, $b) {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    protected function generateExposantPublic() {
        do {
            $this->e = random_int(2, $this->f - 1);
        } while ($this->pgcd($this->e, $this->f) != 1);
    }

    protected function modInverse($a, $c) {
        $c0 = $c;
        $y = 0;
        $x = 1;
    
        while ($a > 1) {
            $q = intdiv($a, $c);
            $t = $c;
            $c = $a % $c;
            $a = $t;
            $t = $y;
            $y = $x - $q * $y;
            $x = $t;
        }
    
        if ($x < 0) {
            $x += $c0;
        }
    
        return $x;
    }

    protected function generateExposantPrive() {
        $this->d = $this->modInverse($this->e, $this->f);
    }

    public function getPublicKey() {
        return [$this->e, $this->n];
    }

    public function getPrivateKey() {
        return [$this->d, $this->n];
    }
    public function convertirLesLettreEnValeurASCII(){
        $this->asciiString="";
        for($i=0;$i<strlen($this->m);$i++){
            $this->asciiString .=ord($this->m[$i])." ";
        }
    }
    public function chiffrement() {
        $this->c = [];
        for ($i = 0; $i < strlen($this->m); $i++) {
            $m_ascii = ord($this->m[$i]);
            $this->c[] = bcpowmod($m_ascii, $this->e, $this->n);
        }
    }
    
    public function getChiffrement() {
        return implode(" ", $this->c);
    }
    
}


?>
