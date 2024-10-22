<?php

	class risk {

		public function __construct($id, $initEntry, $entBy, $Resident, $RA1, $RA2, $RA3, $RA4, $RA5, $RL1, $RL2, $RL3, $RL4, $RL5, $RL5Desc, $RiskDesc, $RiskPlan, $Triggers, $OL1, $OL2, $OL3, $OL4, $OL5, $OL6, $OL6Desc, $Assigned, $Date, $Reassess, $Completed, $CompletedOn, $PDF, $PDFName) {
			$this->id = $id;
			$this->initEntry = $initEntry;
			$this->entBy = $entBy;
			$this->Resident = $Resident;
			$this->RA1 = $RA1;
			$this->RA2 = $RA2;
			$this->RA3 = $RA3;
			$this->RA4 = $RA4;
			$this->RA5 = $RA5;
			$this->RL1 = $RL1;
			$this->RL2 = $RL2;
			$this->RL3 = $RL3;
			$this->RL4 = $RL4;
			$this->RL5 = $RL5;
			$this->RL5Desc = $RLDesc;
			$this->RiskDesc = $RiskDesc;
			$this->RiskPlan = $RiskPlan;
			$this->Triggers = $Triggers;
			$this->OL1 = $OL1;
			$this->OL2 = $OL2;
			$this->OL3 = $OL3;
			$this->OL4 = $OL4;
			$this->OL5 = $OL5;
			$this->OL6 = $OL6;
			$this->OL6Desc = $OL6Desc;
			$this->Assigned = $Assigned;
			$this->Date = $Date;
			$this->Reassess = $Reassess;
			$this->Completed = $Completed;
			$this->CompletedOn = $CompletedOn;
			$this->PDF = $PDF;
			$this->PDFName = $PDFName;
		}

		function getId() {
			return ($this->id);
		}

		function getinitEntry() {
			return ($this->initEntry);
		}

		function getentBy() {
			return (users::load($this->entBy)->getFullName());
		}

		function getResident() {
			return ($this->Resident);
		}

		function getRA1() {
			return ($this->RA1);
		}

		function getRA2() {
			return ($this->RA2);
		}

		function getRA3() {
			return ($this->RA3);
		}

		function getRA4() {
			return ($this->RA4);
		}

		function getRA5() {
			return ($this->RA5);
		}

		function getRL1() {
			return ($this->RL1);
		}

		function getRL2() {
			return ($this->RL2);
		}

		function getRL3() {
			return ($this->RL3);
		}

		function getRL4() {
			return ($this->RL4);
		}

		function getRL5() {
			return ($this->RL5);
		}

		function getRL5Desc() {
			return ($this->RL5Desc);
		}

		function getRiskDesc() {
			return ($this->RiskDesc);
		}

		function getRiskPlan() {
			return ($this->RiskPlan);
		}

		function getTriggers() {
			return ($this->Triggers);
		}

		function getOL1() {
			return ($this->OL1);
		}

		function getOL2() {
			return ($this->OL2);
		}

		function getOL3() {
			return ($this->OL3);
		}

		function getOL4() {
			return ($this->OL4);
		}

		function getOL5() {
			return ($this->OL5);
		}

		function getOL6() {
			return ($this->OL6);
		}

		function getOL6Desc() {
			return ($this->OL6Desc);
		}

		function getAssigned() {
			return ($this->Assigned);
		}

		function getDate() {
			return ($this->Date);
		}

		function getReassess() {
			return ($this->Reassess);
		}

		function getCompleted() {
			return ($this->Completed);
		}

		function getCompletedOn() {
			return ($this->CompletedOn);
		}

		function getPDF() {
			return ($this->PDF);
		}

		function getPDFName() {
			return ($this->PDFName);
		}

		static function create($initEntry, $entBy, $Resident, $RA1, $RA2, $RA3, $RA4, $RA5, $RL1, $RL2, $RL3, $RL4, $RL5, $RL5Desc, $RiskDesc, $RiskPlan, $Triggers, $OL1, $OL2, $OL3, $OL4, $OL5, $OL6, $OL6Desc, $Assigned, $Date, $Reassess, $PDFName) {
		$db = getDB();
			$data = array('initEntry' => $initEntry, 'entBy' => $entBy, 'Resident' => $db->escape($Resident), 'RA1' => $db->escape($RA1), 'RA2' => $db->escape($RA2), 'RA3' => $db->escape($RA3), 'RA4' => $db->escape($RA4), 'RA5' => $db->escape($RA5), 'RL1' => $db->escape($RL1), 'RL2' => $db->escape($RL2), 'RL3' => $db->escape($RL3), 'RL4' => $db->escape($RL4), 'RL5' => $db->escape($RL5), 'RL5Desc' => $db->escape($RL5Desc), 'RiskDesc' => $db->escape($RiskDesc), 'RiskPlan' => $db->escape($RiskPlan), 'Triggers' => $db->escape($Triggers), 'OL1' => $db->escape($OL1), 'OL2' => $db->escape($OL2), 'OL3' => $db->escape($OL3), 'OL4' => $db->escape($OL4), 'OL5' => $db->escape($OL5), 'OL6' => $db->escape($OL6), 'OL6Desc' => $db->escape($OL6Desc), 'Assigned' => $db->escape($Assigned), 'Date' => $db->escape($Date), 'Reassess' => $db->escape($Reassess), 'PDFName' => $db->escape($PDFName));
 			$id = $db->insert(PREFIX . '_risk', $data);
 		if ($id > 0) {
			    notes::updateRisk($initEntry);
				return (risk::load($id));
			}
			return null;
		}

		static function remove($nid) {
			$db = getDB();
			$db->where('id', $nid);
			if ($db->delete(PREFIX . '_risk')) {
				return true;
			}
			return null;
		}

		static function update($nid, $initEntry, $entBy, $Resident, $RA1, $RA2, $RA3, $RA4, $RA5, $RL1, $RL2, $RL3, $RL4, $RL5, $RL5Desc, $RiskDesc, $RiskPlan, $Triggers, $OL1, $OL2, $OL3, $OL4, $OL5, $OL6, $OL6Desc, $Assigned, $Date, $Reassess, $Completed, $CompletedOn, $PDFName) {
			$db = getDB();
			$data = array('initEntry' => $initEntry, 'entBy' => $entBy, 'Resident' => $db->escape($Resident), 'RA1' => $db->escape($RA1), 'RA2' => $db->escape($RA2), 'RA3' => $db->escape($RA3), 'RA4' => $db->escape($RA4), 'RA5' => $db->escape($RA5), 'RL1' => $db->escape($RL1), 'RL2' => $db->escape($RL2), 'RL3' => $db->escape($RL3), 'RL4' => $db->escape($RL4), 'RL5' => $db->escape($RL5), 'RL5Desc' => $db->escape($RL5Desc), 'RiskDesc' => $db->escape($RiskDesc), 'RiskPlan' => $db->escape($RiskPlan), 'Triggers' => $db->escape($Triggers), 'OL1' => $db->escape($OL1), 'OL2' => $db->escape($OL2), 'OL3' => $db->escape($OL3), 'OL4' => $db->escape($OL4), 'OL5' => $db->escape($OL5), 'OL6' => $db->escape($OL6), 'OL6Desc' => $db->escape($OL6Desc), 'Assigned' => $db->escape($Assigned), 'Date' => $db->escape($Date), 'Reassess' => $db->escape($Reassess), 'Completed' => $db->escape($Completed), 'CompletedOn' => $db->escape($CompletedOn), 'PDFName' => $db->escape($PDFName));
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_risk', $data);
			if ($id > 0) {
				return (risk::load($id));
			}
			return null;
		}

		static function loadAllEntries() {
			$db = getDB();
			$db->orderBy('id', 'desc');
			$exs = $db->get(PREFIX . '_risk', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = risk::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function loadx($initEntry) {
			$db = getDB();
			$db->where('initEntry', $initEntry);
			$u = $db->get(PREFIX . '_risk');
			if ($u) {
				return (new risk($u[0]["id"], $u[0]["initEntry"], $u[0]["entBy"], $u[0]['Resident'], $u[0]["RA1"], $u[0]["RA2"], $u[0]["RA3"], $u[0]["RA4"], $u[0]["RA5"], $u[0]["RL1"], $u[0]["RL2"], $u[0]["RL3"], $u[0]["RL4"], $u[0]["RL5"], $u[0]["RL5Desc"], $u[0]["RiskDesc"], $u[0]["RiskPlan"], $u[0]["Triggers"], $u[0]["OL1"], $u[0]["OL2"], $u[0]["OL3"], $u[0]["OL4"], $u[0]["OL5"], $u[0]["OL6"], $u[0]["OL6Desc"], $u[0]["Assigned"], $u[0]["Date"], $u[0]["Reassess"], $u[0]["Completed"], $u[0]["CompletedOn"], $u[0]["PDF"], $u[0]["PDFName"]));
			}
		}

		static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get(PREFIX . '_risk');
			if ($u) {
				return (new risk($u[0]["id"], $u[0]["initEntry"], $u[0]["entBy"], $u[0]['Resident'], $u[0]["RA1"], $u[0]["RA2"], $u[0]["RA3"], $u[0]["RA4"], $u[0]["RA5"], $u[0]["RL1"], $u[0]["RL2"], $u[0]["RL3"], $u[0]["RL4"], $u[0]["RL5"], $u[0]["RL5Desc"], $u[0]["RiskDesc"], $u[0]["RiskPlan"], $u[0]["Triggers"], $u[0]["OL1"], $u[0]["OL2"], $u[0]["OL3"], $u[0]["OL4"], $u[0]["OL5"], $u[0]["OL6"], $u[0]["OL6Desc"], $u[0]["Assigned"], $u[0]["Date"], $u[0]["Reassess"], $u[0]["Completed"], $u[0]["CompletedOn"], $u[0]["PDF"], $u[0]["PDFName"]));
			}
		}

	}

?>
