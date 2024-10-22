<?php

class core_package{
	
	function __construct($id, $name, $path, $status){
		$this->id 		= $id;
		$this->name 	= $name;
		$this->path 	= $path;
		$this->status 	= $status;
	}

	function getId(){
		return($this->id);
	}

	function getName(){
		return($this->name);
	}

	function getPath(){
		return($this->path);
	}

	function getStatus(){
		return($this->status);
	}
	
	static function loadInstalledPackages(){
		
		$db = getDB();
		
		$ps = $db->rawQuery("SELECT `id` FROM `core_packages`");
		
		$ps_array = array();
		
		for($i=0; $i<sizeof($ps); $i++){
			$ps_array []= core_package::loadPackage($ps[$i]["id"]);
		}

		return($ps_array);
	}
	
	static function loadActivePackages(){
		$db = getDB();
        $db->where('status',true);
        $ps = $db->get('core_packages',null,'id');

		$ps_array = array();
		
		for($i=0; $i<sizeof($ps); $i++){
			$ps_array []= core_package::loadPackage($ps[$i]["id"]);
		}
		return($ps_array);
	}
	
	static function loadPackage($id){
		
		$db = getDB();
        $db->where('id',$id);
        $p = $db->get('core_packages');

		if($p){
			return(new core_package($p[0]["id"], $p[0]["name"], $p[0]["path"], $p[0]["status"]));
		}
	}
}

?>