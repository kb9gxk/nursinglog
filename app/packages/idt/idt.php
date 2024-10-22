<?php

	class idt {

		public function __construct($id, $entMade, $entWhen, $entType, $entDesc, $entBy, $entEdited, $entPages) {
			$this->id = $id;
			$this->entMade = $entMade;
			$this->entWhen = $entWhen;
			$this->entType = $entType;
			$this->entDesc = $entDesc;
			$this->entBy = $entBy;
			$this->entEdited = $entEdited;
			$this->entPages = $entPages;
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

		function getentEdited() {
			return ($this->entEdited);
		}

		function getentPages() {
			return ($this->entPages);
		}

		static function create($entMade, $entWhen, $entType, $entDesc, $entBy) {
			$db = getDB();
			$data = array('entMade' => $entMade, 'entWhen' => $entWhen, 'entType' => $entType, 'entDesc' => rn2br($entDesc), 'entBy' => $entBy, 'entEdited' => false);
			$id = $db->insert(PREFIX . '_idt', $data);
			if ($id > 0) {
				return (idt::load($id));
			}
			return null;
		}

		static function remove($nid) {
			$db = getDB();
			$db->where('id', $nid);
			if ($db->delete(PREFIX . '_idt')) {
				return true;
			}
			return null;
		}

		static function update($nid, $entWhen, $entType, $entDesc) {
			$db = getDB();
			$data = array('entWhen' => $entWhen, 'entType' => $entType, 'entDesc' => rn2br($entDesc), 'entEdited' => true);
			$db->where('id', $nid);
			$id = $db->update(PREFIX . '_idt', $data);
			if ($id > 0) {
				return (idt::load($id));
			}
			return null;
		}

		static function loadAllEntries() {
			$db = getDB();
			$db->orderBy('id', 'desc');
			$exs = $db->get(PREFIX.'_idt', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = idt::load($exs[$i]["id"]);
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
			$when = strtotime(date("Y-m-d", time() - (86400 * $numdays) . " 00:00:00"));
			$db->where('entMade', $when, '>=');
			$db->orderBy('id', 'desc');
			$exs = $db->get(PREFIX . '_idt', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = idt::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get(PREFIX . '_idt');
			if ($u) {
				return (new notes($u[0]["id"], $u[0]["entMade"], $u[0]["entWhen"], $u[0]["entType"], $u[0]["entDesc"], $u[0]["entBy"], $u[0]["entEdited"]));
			}
		}

	}

?>
