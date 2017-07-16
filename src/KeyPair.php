<?php

namespace WebWeave\StorjPHP;

use BitcoinPHP\BitcoinECDSA\BitcoinECDSA;

class KeyPair
{

    private $KeyPair;

    public function __construct()
    {
        $bitcoinECDSA = new BitcoinECDSA();
        $bitcoinECDSA->generateRandomPrivateKey();

        return $this->KeyPair = array(
            'PublicKey' => $bitcoinECDSA->getPubKey(),
            'PrivateKey' => $bitcoinECDSA->getPrivateKey()
        );
    }

    public function getPublicKey()
    {
        return $this->KeyPair['PublicKey'];
    }

    public function getPrivateKey()
    {
        return $this->KeyPair['PrivateKey'];
    }

}