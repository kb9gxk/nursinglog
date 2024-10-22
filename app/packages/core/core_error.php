<?php

class core_error{
	
	function __construct(){}
	
	static function setError($error){
		
		$errors = core_session::getSession("errors");
		$errors[] = $error;
		core_session::addSession("errors", $errors);
	}
	
	static function getErrors(){
		return(core_session::getSession("errors"));
	}
	
	static function removeErrors(){
		core_session::removeSession("errors");
	}
	
	static function outputErrors(){
		
		$errors = core_error::getErrors();
		
		if($errors){
			
			$string = "<div class=\"alert alert-danger fade in\" role=\"alert\">\n";
				$string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>\n";
			
				for($i=0; $i<sizeof($errors); $i++){
								
					if($i == 0){
						$string .= $errors[$i];
					}else{
						$string .= $errors[$i];
					}
					
				}
				
			$string .= "</div>\n";

			// Clear the error list...
			core_error::removeErrors();
			
			return($string);
		} 
		else if($_REQUEST["errorMessage"] != ""){
			
			$string = "<div class=\"alert alert-danger fade in\">\n";
				$string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>\n";
				$string .= $_REQUEST["errorMessage"];
			$string .= "</div>\n";
			
			return($string);
		}
	}
}

?>