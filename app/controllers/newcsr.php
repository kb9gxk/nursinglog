<?php

$privKey = new phpseclib\Crypt\RSA();
extract( $privKey->createKey( 4096 ) );
$privKey->loadKey( $privatekey );

$x509 = new phpseclib\File\X509();
$x509->setPrivateKey( $privKey );
$x509->setDNProp( '*.btwaukegan.com', 'Secure Communication Logs' );

$csr = $x509->signCSR();

return ( [ "private" => $privatekey, "public" => $x509
        ->saveCSR( $csr ) ] );
