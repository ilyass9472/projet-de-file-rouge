<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RSA;



class RsaController extends Controller
{
    public function run()
    {
        $rsa = new RSA();
list($e, $n) = $rsa->getPublicKey();
list($d, $n) = $rsa->getPrivateKey();
$c = $rsa->getChiffrement();


echo "Clé publique (e, n) : ($e, $n)\n";
echo "\n";
echo "Clé privée (d, n) : ($d, $n)\n";
echo "\n";
echo "Valeur ASCII de '{$rsa->m}': {$rsa->asciiString}\n";
echo "Message chiffré : $c\n";
    }
}
