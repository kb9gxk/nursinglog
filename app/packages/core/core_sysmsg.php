<?php

class core_sysmsg{
	
	function __construct(){}
	
	static function setSysmsg($sysmsg){
		
		$sysmsgs = core_session::getSession("sysmsgs");
		
		$sysmsgs[] = $sysmsg;
		
		core_session::addSession("sysmsgs", $sysmsgs);
		
		
	}
	
	static function getSysmsg(){
		
		return(core_session::getSession("sysmsgs"));
		
	}
	
	static function removeSysmsg(){
		core_session::removeSession("sysmsgs");
	}
	
	static function outputSysmsg(){
		
		$sysmsgs = core_sysmsg::getSysmsg();
		
		if($sysmsgs){
			
			$string = "<div class=\"alert alert-warning fade in\" role=\"alert\">\n";
				$string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>\n";

				for($i=0; $i<sizeof($sysmsgs); $i++){

					if($i == 0){
						$string .= $sysmsgs[$i];
					}else{
						$string .= $sysmsgs[$i];
					}

				}

			$string .= "</div>\n";

			// Clear the error list...
			core_sysmsg::removeSysmsg();
			
			return($string);
		} 
	}
	
}


?>