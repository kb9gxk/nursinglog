<?php

class bst_radio{

	public function __construct($id, $entMade, $entRadio, $entType, $entDesc, $entBy, $entEdited, $entPages){

		$this->id = $id;
		$this->entMade = $entMade;
		$this->entRadio = $entRadio;
		$this->entType = $entType;
		$this->entDesc = $entDesc;
		$this->entBy = $entBy;
        $this->entEdited = $entEdited;
        $this->entPages = $entPages;
	}

	function getId(){
		return($this->id);
	}

	function getentMade(){
		return($this->entMade);
	}

	function getentRadio(){
		return($this->entRadio);
	}

	function getentType(){
		return($this->entType);
	}

	function getentDesc(){
		return(core_crypto::decrypt($this->entDesc));
	}

	function getentBy(){
		return(bst_users::load($this->entBy)->getFullName());
	}

	function getentEdited(){
		return($this->entEdited);
	}

	function getentPages(){
		return($this->entPages);
	}

	static function create($entMade,$entRadio,$entType,$entDesc,$entBy){

		$db = getDB();
        $data = Array(
            'entMade' => $entMade,
            'entRadio' => $entRadio,
            'entType' => $entType,
            'entDesc' => rn2br($entDesc),
            'entBy' => $entBy,
            'entEdited' => false
        );
		$id = $db->insert('radio',$data);

		if($id > 0){
			return(bst_radio::load($id));
		}

		return null;
	}

    static function remove($nid){
      $db = getDB();
      $db->where('id',$nid);
        if($db->delete('radio')) {
          return true;
        }
      return null;
    }

	static function update($nid,$entRadio,$entType,$entDesc){

		$db = getDB();
        $data = Array(
            'entWhen' => $entRadio,
            'entType' => $entType,
            'entDesc' => rn2br($entDesc),
            'entEdited' => true
        );
        $db->where('id',$nid);
		$id = $db->update('radio',$data);

		if($id > 0){
			return(bst_radio::load($id));
		}

		return null;
	}

	static function loadAllEntries(){
		$db = getDB();

        $db->orderBy('id','desc');
        $exs = $db->get('radio',null,'id');

		if($exs){
			$us = array();

			for($i=0; $i<sizeof($exs); $i++){
				$us []= bst_radio::load($exs[$i]["id"]);
			}

			return($us);
		}

		return null;
	}

	static function loadx($numdays){
		$db = getDB();
        if ($numdays == '0') { $numdays = intval(DATE_TO); }
        if (!$numdays) { $numdays = 3; }
        $when= strtotime(date("Y-m-d", time()-(86400*$numdays)." 00:00:00"));
        $db->where('entMade', $when, '>=');
        $db->orderBy('id', 'desc');
        $exs = $db->get('radio',null,'id');

		if($exs){
			$us = array();

			for($i=0; $i<sizeof($exs); $i++){
				$us []= bst_radio::load($exs[$i]["id"]);
			}
			return($us);
		}

		return null;
	}


	static function load($id){
		$db = getDB();

        $db->where('id',$id);
        $u = $db->get('radio');

		if($u){
			return(
				new bst_radio(
					$u[0]["id"],
					$u[0]["entMade"],
					$u[0]["entRadio"],
					$u[0]["entType"],
					$u[0]["entDesc"],
					$u[0]["entBy"],
                    $u[0]["entEdited"]
				)
			);
		}
	}
}

?>
