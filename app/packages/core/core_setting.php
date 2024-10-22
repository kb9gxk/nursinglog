<?php

class core_setting{
	
	public function __construct($id, $key, $value, $status){
		
		$this->id 		= $id;
		$this->key 		= $key;
		$this->value 	= $value;
		$this->status 	= $status;
		if(!defined($this->key)){
			define($this->key, $this->value);
		}
	}
	
	function getId(){
		return($this->id);
	}
	
	function getKey(){
		return($this->key);
	}
	
	function getValue(){
		return($this->value);
	}
	
	static function loadSettings(){
		$db = getDB();
        $db->where('status',true);
        $settings = $db->get('core_settings',null,'id');

		$settings_array = array();

		for($i=0; $i<sizeof($settings); $i++){
			$settings_array []= core_setting::loadSetting($settings[$i]["id"]);
		}

		return($settings_array);
	}

	static function loadSetting($id){
		
		$db = getDB();
        $db->where('id',$id);
        $s = $db->get('core_settings');

		if($s){
			return(
				new core_setting(
					$s[0]["id"],
					$s[0]["key"], 
					$s[0]["value"], 
					$s[0]["status"]
				)
			);
		}
	}

	static function loadCustSettings($PREFIX){
		$db = getDB();
        $db->where('status',true);
        $settings = $db->get($PREFIX . '_settings',null,'id');

		$settings_array = array();

		for($i=0; $i<sizeof($settings); $i++){
			$settings_array []= core_setting::loadCustSetting($PREFIX, $settings[$i]["id"]);
		}

		return($settings_array);
	}

	static function loadCustSetting($PREFIX, $id){

		$db = getDB();
        $db->where('id',$id);
        $s = $db->get($PREFIX.'_settings');

		if($s){
			return(
				new core_setting(
					$s[0]["id"],
					$s[0]["key"],
					$s[0]["value"],
					$s[0]["status"]
				)
			);
		}
	}

}

?>