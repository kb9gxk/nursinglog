<?php

class core_session{

	static function startSession(){
		if(!headers_sent() && session_id() == ""){
			session_start();
		}	
	}
	
	static function addSession($key, $value){
		core_session::startSession();
		$_SESSION[$key] = $value;	
	}
	
	static function getSession($key){
		core_session::startSession();
		if(array_key_exists($key, $_SESSION)){
			return($_SESSION[$key]);
		}
	}
	
	static function destroySession(){
		core_session::startSession();
		session_unset();
		session_destroy();
	}
	
	static function removeSession($key){
		core_session::startSession();
		unset($_SESSION[$key]);
	}
	
}

?>