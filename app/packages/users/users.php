<?php
	class users {

		public function __construct($id, $username, $password, $fullname, $department, $strikeout, $remote, $admin, $created, $lastlogin, $defpass, $status, $sadmin, $print, $idt, $poct, $anon) {
			$this->id = $id;
			$this->username = $username;
			$this->password = $password;
			$this->fullname = $fullname;
			$this->department = $department;
			$this->strikeout = $strikeout;
			$this->remote = $remote;
			$this->admin = $admin;
			$this->created = $created;
			$this->lastlogin = $lastlogin;
			$this->defpass = $defpass;
			$this->status = $status;
            $this->sadmin = $sadmin;
            $this->sprint = $print;
			$this->uid = $uid;
			$this->hdate = $hdate;
            $this->idt = $idt;
            $this->poct = $poct;
            $this->anon = $anon;
		}

		function getUid() {
			return ($this->uid);
		}

		function getHdate() {
			return ($this->hdate);
		}

		function getId() {
			return ($this->id);
		}

		function getUsername() {
			return ($this->username);
		}

		function getPass() {
			return ($this->password);
		}

		function getFullName() {
			return ($this->fullname);
		}

		function getDept() {
			return ($this->department);
		}

		function getStrikeout() {
			return ($this->strikeout);
		}

		function getRemote() {
			return ($this->remote);
		}

		function getAdmin() {
			return ($this->admin);
		}

		function getLastLog() {
			return ($this->lastlogin);
		}

		function getDefault() {
			return ($this->defpass);
		}

		function getStatus() {
			return ($this->status);
		}

		function getSadmin() {
			return ($this->sadmin);
		}

		function getPrint() {
			return ($this->sprint);
		}

		function getIDT() {
			return ($this->idt);
		}

		function getPOCT() {
			return ($this->poct);
		}

        function getANON() {
			return ($this->anon);
		}


		public static function resetPassword($id, $password) {
			$encpasswd = core_crypto::encrypt($password);
			$db = getDB();
			$query = array('password' => $encpasswd, 'defpass' => true);
			$db->where("id", $id);
			if ($db->update(PREFIX . '_users', $query)) {
				return (true);
			}
			else {
				return (false);
			}
		}

        public static function updatePassword($id, $password) {
			$encpasswd = core_crypto::encrypt($password);
			$db = getDB();
			$query = array('password' => $encpasswd, 'defpass' => false);
			$db->where("id", $id);
			if ($db->update(PREFIX . '_users', $query)) {
				return (true);
			}
			else {
				return (false);
			}
		}


		public static function UpdateStrikeout($id, $strikeout) {
			$db = getDB();
            $db->where('id', $id);
            $query = array('strikeout' => $strikeout);
			$success = $db->update(PREFIX . '_users', $query);
			if (success > - 1) {
				return (true);
			}
			return false;
		}

		public static function UpdateRemote($id, $remote) {
			$db = getDB();
            $db->where('id', $id);
            $query = array('remote' => $remote);
			$success = $db->update(PREFIX . '_users', $query);
			if (success > - 1) {
				return (true);
			}
			return false;
		}

		public static function UpdateLastlog($username) {
			$now = strtotime("now");
			$p = users::loadUserName($username);
			//print($p->getId());
			//die;
			$uid = $p->getId();
			$data = array('lastlogin' => $now);
			$db = getDB();
			$db->where('username', $username);
			if ($db->update(PREFIX . '_users', $data)) {
				$addhist = $db->insert(PREFIX . '_userhist', array('uid' => $uid, 'hdate' => $now));
				if ($addhist) {
					return (true);
				}
				return (false);
			}
		}

		public static function create($username, $password, $fullname, $department, $strikeout = 0, $remote = 0, $admin = 0, $status = 1, $sadmin = 0, $print = 0, $idt = 0, $poct = 0, $anon = 0) {
			$created = strtotime("now");
			$lastlogin = null;
			$encpasswd = core_crypto::encrypt($password);
			$db = getDB();
			$data = array('username' => $username, 'password' => $encpasswd, 'fullname' => $fullname, 'department' => $department, 'strikeout' => $strikeout, 'remote' => $remote, 'admin' => $admin, 'created' => strtotime("now"), 'defpass' => true, 'status' => $status, 'sadmin' => $sadmin, 'print' => $print, 'isIDT' => $idt, 'isPOCT' => $poct, 'anon' => $anon);
			//print_r($data);
			$id = $db->insert(PREFIX . '_users', $data);
			//print $id;
			//die();
			if ($id > 0) {
				return (users::load($id));
			}
			return null;
		}

		public static function editUser($id, $fullname, $department = 0, $remote = 0, $strike = 0, $admin = 0, $status = 1, $sadmin = 0, $print = 0, $idt = 0, $poct = 0, $anon = 0) {
			$db = getDB();
            if (empty($department) || is_null($department)) {
                $department = 0;
            }
			$query = array('fullname' => $fullname, 'department' => $department, 'strikeout' => $strike, 'remote' => $remote, 'admin' => $admin, 'status' => $status, 'sadmin' => $sadmin, 'print' => $print, 'isIDT'=> $idt, 'isPOCT' => $poct, 'anon' => $anon);
			$db->where("id", $id);
			if ($db->update(PREFIX . '_users', $query)) {
				return (true);
			}
			else {
				return null;
			}
		}

		public static function loadUsername($username) {
			$db = getDB();
			$db->setTrace(true);
			$u = $db->where('username', $username)->where('status', true)->get(PREFIX . '_users', null, "id");
			if ($u) {
				return (users::load($u[0]["id"]));
			}
			return null;
		}

		public static function loadFullName($fname) {
			$db = getDB();
			$db->setTrace(true);
			$u = $db->where('fullname', $fname)->where('status', true)->get(PREFIX . 'users', null, "id");
			if ($u) {
				return (users::load($u[0]["id"]));
			}
			return null;
		}

	   public static function loadStatusEntries() {
			$db = getDB();
			// 03/20/2014jp -- Added sorting to show list with newest create date first
			$db->where('id != 0');
			$db->orderBy('status', 'desc');
			$db->orderBy('lastlogin', 'desc');
			$exs = $db->get(PREFIX . '_users', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = users::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		public static function loadAllEntries() {
			$db = getDB();
			// 03/20/2014jp -- Added sorting to show list with newest create date first
			$db->orderBy('lastlogin', 'desc');
			$exs = $db->get(PREFIX . '_users', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = users::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}

		public static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get(PREFIX . '_users');
			if ($u) {
				return (new users($u[0]["id"], $u[0]["username"], $u[0]["password"], $u[0]["fullname"], $u[0]["department"], $u[0]["strikeout"], $u[0]["remote"], $u[0]["admin"], $u[0]["created"], $u[0]["lastlogin"], $u[0]["defpass"], $u[0]["status"], $u[0]["sadmin"], $u[0]['print'], $u[0]["isIDT"], $u[0]["isPOCT"], $u[0]["anon"]));
			}
		}

	}

?>