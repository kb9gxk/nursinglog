<?php

	class plans {

		public function __construct($id, $initEntry, $Plan, $Responsible, $Followup, $Resolved, $ResDate) {
			$this->id = $id;
			$this->initEntry = $initEntry;
			$this->Plan = $Plan;
			$this->Responsible = $Responsible;
			$this->Followup = $Followup;
			$this->Resolved = $Resolved;
			$this->ResDate = $ResDate;
		}

		function getId() {
			return ($this->id);
		}

		function getinitEntry() {
			return ($this->initEntry);
		}

		function getPlan() {
			return (removeslashes(rn2br(($this->Plan))));
		}

		function getResponsible() {
			return ($this->Responsible);
		}

		function getFollowup() {
			return ($this->Followup);
		}

		function getResolved() {
			return ($this->Resolved);
		}

		function getResDate() {
			return ($this->ResDate);
		}

		static function create($initEntry, $Plan, $Responsible, $Followup, $Resolved, $ResDate) {
		$db = getDB();
			$data = array('initEntry' => $initEntry, 'Plan' => $db->escape($Plan), 'Responsible' => $db->escape($Responsible), 'Followup' => $db->escape($Followup), 'Resolved' => $db->escape($Resolved), 'ResDate' => $db->escape($ResDate));
            //prd($data);
 			$id = $db->insert(PREFIX . '_poc', $data);
 		if ($id > 0) {
			    notes::updatePOC($initEntry);
				return (plans::load($id));
			}
			return null;
		}

		static function update($nid, $initEntry, $Plan, $Responsible, $Followup, $Resolved, $ResDate) {
			$db = getDB();
			$data = array('initEntry' => $initEntry, 'Plan' => $db->escape($Plan), 'Responsible' => $db->escape($Responsible), 'Followup' => $db->escape($Followup), 'Resolved' => $db->escape($Resolved), 'ResDate' => $db->escape($ResDate));
			//die(var_dump($data));
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_poc', $data);
			if ($id > 0) {
				return (plans::load($id));
			}
			return null;
		}

		static function loadAllEntries() {
			$db = getDB();
			$db->orderBy('id', 'desc');
			$exs = $db->get(PREFIX . '_poc', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = plans::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function loadx($initEntry) {
			$db = getDB();
			$db->where('initEntry', $initEntry);
			$u = $db->get(PREFIX . '_poc');
			if ($u) {
				return (new plans($u[0]["id"], $u[0]["initEntry"], $u[0]["Plan"], $u[0]["Responsible"], $u[0]["Followup"], $u[0]["Resolved"], $u[0]["ResDate"]));
			}
		}

		static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get(PREFIX . '_poc');
			if ($u) {
				return (new plans($u[0]["id"], $u[0]["initEntry"], $u[0]["Plan"], $u[0]["Responsible"], $u[0]["Followup"], $u[0]["Resolved"], $u[0]["ResDate"]));
			}
		}

	}
?>
