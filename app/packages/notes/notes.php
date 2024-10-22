<?php

	class notes {

		public function __construct($id, $entMade, $entWhen, $entType, $entDesc, $entBy, $entEdited, $hasRisk, $RiskDone, $hasPOC, $POCdone) {
			$this->id = $id;
			$this->entMade = $entMade;
			$this->entWhen = $entWhen;
			$this->entType = $entType;
			$this->entDesc = $entDesc;
			$this->entBy = $entBy;
			$this->entEdited = $entEdited;
            $this->hasRisk = $hasRisk;
            $this->RiskDone = $RiskDone;
            $this->hasPOC = $hasPOC;
            $this->POCdone = $POCdone;
		}

		function getId() {
			return ($this->id);
		}

		function getentMade() {
			return ($this->entMade);
		}

		function getentWhen() {
			return ($this->entWhen);
		}

		function getentType() {
			return ($this->entType);
		}

		function getentDesc() {
			return (core_crypto::decrypt($this->entDesc));
		}

		function getentBy() {
			return (users::load($this->entBy)->getFullName());
		}

		function getentById() {
			return ($this->entBy);
		}


		function getentEdited() {
			return ($this->entEdited);
		}

		function getHasRisk() {
			return ($this->hasRisk);
		}

		function getRiskDone() {
			return ($this->RiskDone);
		}
		function getHasPOC() {
			return ($this->hasPOC);
		}

		function getPOCdone() {
			return ($this->POCdone);
		}

		static function create($entMade, $entWhen, $entType, $entDesc, $entBy) {
			$db = getDB();
			$data = array('entMade' => $entMade, 'entWhen' => $entWhen, 'entType' => $entType, 'entDesc' => rn2br($entDesc), 'entBy' => $entBy, 'entEdited' => false, 'hasPOC' =>false);
			$id = $db->insert(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

		static function remove($nid) {
			$db = getDB();
			$db->where('id', $nid);
			if ($db->delete(PREFIX . '_notes')) {
				return true;
			}
			return null;
		}

		static function update($nid, $entWhen, $entType, $entDesc) {
			$db = getDB();
			$data = array('entWhen' => $entWhen, 'entType' => $entType, 'entDesc' => rn2br($entDesc), 'entEdited' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

		static function updatecat($nid, $entType) {
			$db = getDB();
			$data = array('entType' => $entType);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}


        static function updatePOC($nid) {
			$db = getDB();
			$data = array('hasPOC' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

        static function updateRisk($nid) {
			$db = getDB();
			$data = array('hasRisk' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

        static function POCdone($nid) {
			$db = getDB();
			$data = array('POCdone' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

		static function MassPOC($sstart, $eend) {
			$db = getDB();
			$db->orderBy('id', 'desc');
			$db->where('HasPOC', true);
			$db->where('POCdone', false);
			$db->where('entMade', Array ($sstart, $eend), 'BETWEEN');
			$exs = $db->get(PREFIX.'_notes');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = notes::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

        static function RiskDone($nid) {
			$db = getDB();
			$data = array('RiskDone' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_notes', $data);
			if ($id > 0) {
				return (notes::load($id));
			}
			return null;
		}

		static function loadAllEntries() {
			$db = getDB();
			$db->orderBy('id', 'desc');
			$exs = $db->get(PREFIX.'_notes', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = notes::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function searchByCategory($category) {
			$db = getDB();
			$db->orderBy('id', 'desc');
            $db->where('entType', $category);
			$exs = $db->get(PREFIX.'_notes', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = notes::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function loadx($numdays) {
			$db = getDB();
			if ($numdays == '0') {
				$numdays = intval(DATE_TO);
			}
			if (!$numdays) {
				$numdays = 3;
			}
            $timestamp=time() - (86400 * $numdays) . " 00:00:00";
            $when = strtotime(date("Y-m-d", (int)$timestamp));
			//$db->where("'hasRisk' = true and 'RiskDone' = false");
            //$db->where('RiskDone', false);
            //$db->OrWhere("'hasPOC' = true and 'RiskDone' = false");
            //$db->where('POCDone', false);
            //$db->orWhere('entMade', $when, '>=');
            $exs = $db->rawQuery("SELECT * FROM `". PREFIX . "_notes` WHERE (`hasRisk` = true and `RiskDone` = false) or (`hasPOC` = true and `POCdone` = false) or (`entMade` >= $when) ORDER BY id DESC");
			//$db->orderBy('id', 'desc');
			//$exs = $db->get(PREFIX . '_notes', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = notes::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get(PREFIX . '_notes');
			if ($u) {
				return (new notes($u[0]["id"], $u[0]["entMade"], $u[0]["entWhen"], $u[0]["entType"], $u[0]["entDesc"], $u[0]["entBy"], $u[0]["entEdited"], $u[0]["hasRisk"], $u[0]["RiskDone"], $u[0]['hasPOC'], $u[0]['POCdone']));
			}
		}

	}

?>
