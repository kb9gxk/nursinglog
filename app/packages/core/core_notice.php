<?php

class core_notice{
	
	function __construct(){}
	
	static function setNotice($notice){
		
		$notices = core_session::getSession("notices");
		
		$notices[] = $notice;
		
		core_session::addSession("notices", $notices);
		
		
	}
	
	static function getNotices(){
		
		return(core_session::getSession("notices"));
		
	}
	
	static function removeNotices(){
		core_session::removeSession("notices");
	}
	
	static function outputNotices(){
		
		$notices = core_notice::getNotices();
		
		if($notices){
			
			$string = "<div class=\"alert alert-secondary fade in\" role=\"alert\">\n";
				$string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>\n";

				for($i=0; $i<sizeof($notices); $i++){
								
					if($i == 0){
						$string .= $notices[$i];
					}else{
						$string .= $notices[$i];
					}
					
				}
				
			$string .= "</div>\n";

			// Clear the error list...
			core_notice::removeNotices();
			
			return($string);
		} 
	}
	
}


?>