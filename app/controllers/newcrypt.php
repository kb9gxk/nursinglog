<?php

$rsa = new phpseclib\Crypt\RSA();
$rsa->setHash( 'sha256WithRSAEncryption' );
$rsa->setMGFHash( 'sha256WithRSAEncryption' );

//$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
//$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);

//define('CRYPT_RSA_EXPONENT', 65537);
//define('CRYPT_RSA_SMALLEST_PRIME', 64); // makes it so multi-prime RSA is used
extract( $rsa->createKey( 4096 ) ); // == $rsa->createKey(1024) where 1024 is the key size
return ( ["private" => $privatekey, "public" => $publickey] );
