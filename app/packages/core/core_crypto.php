<?php

class core_crypto{

	static function aencrypt($string, $publickey){
		$enc = new phpseclib\Crypt\RSA;
                //extract($enc->createKey(4096));
                $enc->loadKey($publickey); // public key
                $ciphertext = bin2hex($enc->encrypt($string));
            	return($ciphertext);
	}

    static function encrypt($string){

		$enc = new phpseclib\Crypt\RSA;
        //extract($enc->createKey(4096));
        $publickey = pub_key;
        $enc->loadKey($publickey); // public key
        $ciphertext = bin2hex($enc->encrypt($string));
      	return($ciphertext);
	}

	static function decrypt($s_string){
		$string = core_crypto::undo_hex($s_string);
        $dec = new phpseclib\Crypt\RSA;
        $dec->loadKey(pri_key);
        $decrypted = $dec->decrypt($string);
        if (strlen($decrypted) == 0 ) {
                $dec->setPassword(key_salt);
                $dec->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
                $dec->loadKey(file_get_contents(private_key_file));
                $decrypted = $dec->decrypt($string);
        }
      	return($decrypted);
	}

	static function undo_hex($data){
		$len = strlen($data);
   		return pack("H" . $len, $data);
	}
}

?>