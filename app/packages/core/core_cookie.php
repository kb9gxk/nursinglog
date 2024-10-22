<?php

class core_cookie{

	static function create($name, $value, $expires = 0) {
	    $options['expires'] = $expires;
	    $options['domain'] = PREFIX.'.nursinglog.click';
	    $options['httpOnly'] = 1;
	    $options['secure'] = 1;
	    $options['path'] = '/';
	    $options['samesite'] = 'Strict';
        $_COOKIE[$name] = $value;
        setcookie($name, $value, $options);
        //prd($options);
		//setcookie($name, $value, $expire, '/', PREFIX.'.nursinglog.click', 1, 1);
	}

	static function retrieve($name){
		return($_COOKIE[$name]);
	}

	static function remove($name){
	    $options['expires'] = -1;
	    $options['domain'] = PREFIX.'.nursinglog.click';
	    $options['httpOnly'] = 1;
	    $options['secure'] = 1;
	    $options['path'] = '/';
	    $options['samesite'] = 'Strict';
        unset($_COOKIE[$name]);
        setcookie($name, NULL, $options);
	}

	static function createAndStoreUserToken($name, $value, $expire = 0){
		core_cookie::create($name, $value, $expire);
	}

    static function removeall() {
	    $options['expires'] = -1;
	    $options['domain'] = PREFIX.'.nursinglog.click';
	    $options['httpOnly'] = 1;
	    $options['secure'] = 1;
	    $options['path'] = '/';
	    $options['samesite'] = 'Strict';
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                unset($_COOKIE[$name]);
                setcookie($name, null, -1);
                setcookie($name, null, -1, '/');
                setcookie($name, null, $options);
            }
        }
    }
}

?>