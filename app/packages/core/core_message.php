<?php

class core_message{
	
	function __construct(){}
	
	static function setMessage($message){
		
		$messages = core_session::getSession("messages");
		
		$messages[] = $message;
		
		core_session::addSession("messages", $messages);
		
		
	}
	
	static function getMessages(){
		
		return(core_session::getSession("messages"));
		
	}
	
	static function removeMessages(){
		core_session::removeSession("messages");
	}
	
	static function outputMessages(){
		
		$messages = core_message::getMessages();
		
		if($messages){
			
			$string = "<div class=\"alert alert-info fade in\" role=\"alert\">\n";
				$string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>\n";

				for($i=0; $i<sizeof($messages); $i++){
								
					if($i == 0){
						$string .= $messages[$i];
					}else{
						$string .= $messages[$i];
					}
					
				}
				
			$string .= "</div>\n";

			// Clear the error list...
			core_message::removeMessages();
			
			return($string);
		} 
	}
	
}


?>