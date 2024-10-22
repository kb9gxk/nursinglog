<?php

	include ("iAdmin.php");
	include ("iAccess.php");
	$action = $GLOBALS['args'][2];
	switch ($action) {

		case "edit" :
			$eid = $GLOBALS['args'][3];
			$p = users::load($eid);
			if (!$p) {
				core_error::setError("Unable to locate the specified account.");
				header("Location:" . base_url . admin_url);
				exit;
			}
			$content = '    <input type="hidden" name="username"/>' . "\r\n";
			$content .= '    <label>Full Name <input type="text" name="fullname" class="form-control center" style="width:310px;" placeholder="Users Full Name"  value="' . $p->getFullName() . '" required/></label><br />' . "\r\n";
			$content .= '    <label>Department: <select name="department" class="form-control center" style="width:310px;">' . "\r\n";
			$content .= "\t\t\t<option value=\"\">--Select Department--</option>\r\n";
			$the_key = $p->getDept();
			foreach ($iAccess as $key => $val) {
				$sel = "";
				if ($key == $the_key)
					$sel = " selected=\"selected\"";
			    if ($key != 2 && $key != 5 && $key != 6 && $key != 23) {
				    $content .= "\t\t\t<option" . $sel . " value=\"" . $key . "\">" . $val . "</option>\r\n";
                }
			}
			$content .= '   </select></label><br />';
			if ($p->getStatus())
				$cb1 = "checked";
			$content .= '   <input type="checkbox" id="cb1" name="status" value="1" ' . $cb1 . '> <label for="cb1">Access Allowed</label><br />' . "\r\n";
			if ($p->getRemote())
				$cb2 = "checked";
			$content .= '   <input type="checkbox" id="cb2" name="remote" value="1" ' . $cb2 . '> <label for="cb2">Remote Access</label><br />' . "\r\n";
			if ($p->getPrint())
				$cb3 = "checked";
			$content .= '   <input type="checkbox" id="cb3" name="print" value="1" ' . $cb3 . '> <label for="cb3">Print Notes</label><br />' . "\r\n";
			if ($p->getIDT())
				$cb7 = "checked";
			$content .= '   <input type="checkbox" id="cb7" name="idt" value="1" ' . $cb7 . '> <label for="cb7">Allow to create/edit Risks</label><br />' . "\r\n";
			if ($p->getPOCT())
				$cb8 = "checked";
			$content .= '   <input type="checkbox" id="cb8" name="poct" value="1" ' . $cb8 . '> <label for="cb8">Allow to create/edit Comments</label><br />' . "\r\n";
			if ($cadmin === 1) {
				if ($p->getANON())
					$cb9 = "checked";
				$content .= '   <input type="checkbox" id="cb9" name="anon" value="1" ' . $cb9 . '> <label for="cb9">Deanonymized Abuse Notes</label><br />' . "\r\n";
				if ($p->getStrikeOut())
					$cb4 = "checked";
				$content .= '   <input type="checkbox" id="cb4" name="strike" value="1" ' . $cb4 . '> <label for="cb4">Delete Notes (Use Caution)</label><br />' . "\r\n";
				if ($p->getAdmin())
					$cb5 = "checked";
				$content .= '   <input type="checkbox" id="cb5" name="admin" value="1" ' . $cb5 . '> <label for="cb5">Admin (Can Create Users, Remove Access, Give Remote Access and Allow Users to Print)</label><br />' . "\r\n";
				if ($p->getSadmin())
					$cb6 = "checked";
				$content .= '   <input type="checkbox" id="cb6" name="sadmin" value="1" ' . $cb6 . '> <label for="cb6">Super Admin (Full Account Creation Access)</label><br />' . "\r\n";
			}
			else {
				$content .= '   <input type="hidden" id="cb4" name="strike" value="' . $p->getStrikeOut() . '" />' . "\r\n";
				$content .= '   <input type="hidden" id="cb5" name="admin" value="' . $p->getAdmin() . '" />' . "\r\n";
				$content .= '   <input type="hidden" id="cb6" name="sadmin" value="' . $p->getSadmin() . '" />' . "\r\n";
                $content .= '   <input type="hidden" id="cb9" name="anon" value="' . $p->getANON() . '" />' . "\r\n";
			}
			$content .= '    <input type="hidden" name="eid" value="' . $eid . '" />' . "\r\n";
			return (array('content' => $content, 'action' => 'EditUser', 'myaction' => 'Update'));

		case "add" :
			$content = '    <input type="text" name="fname" class="form-control center" style="width:310px;" placeholder="New User First Name" required autofocus/>';
			$content .= '    <input type="text" name="lname" class="form-control center" style="width:310px;" placeholder="New User Last Name" required/>';
			$content .= '    <select name="department" class="form-control center" style="width:310px;">';
			$content .= "\t\t\t<option value=\"\">--Select Department--</option>\r\n";
			foreach ($iAccess as $key => $val) {
			    if (($key <> 2) and ($key <> 5) and ($key <> 6) and ($key <> 23)) {
				    $content .= "\t\t\t<option value=\"" . $key . "\">" . $val . "</option>\r\n";
                }
			}
			$content .= '   </select>';
			$content .= '   <input type="checkbox" id="cb1" name="status" value="1" checked' . $cb1 . '> <label for="cb1">Access Allowed</label><br />' . "\r\n";
			$content .= '   <input type="checkbox" id="cb2" name="remote" value="1" ' . $cb2 . '> <label for="cb2">Remote Access</label><br />' . "\r\n";
			$content .= '   <input type="checkbox" id="cb3" name="print" value="1" ' . $cb3 . '> <label for="cb3">Print Notes</label><br />' . "\r\n";
			$content .= '   <input type="checkbox" id="cb7" name="idt" value="1" ' . $cb7 . '> <label for="cb7">Allow to create/edit Risks</label><br />' . "\r\n";
			$content .= '   <input type="checkbox" id="cb8" name="poct" value="1" checked' . $cb8 . '> <label for="cb8">Allow to create/edit Comments</label><br />' . "\r\n";
			if ($cadmin === 1) {
			    $content .= '   <input type="checkbox" id="cb9" name="anon" value="1" ' . $cb9 . '> <label for="cb9">Deanonymize Abuse Notes</label><br />' . "\r\n";
				$content .= '   <input type="checkbox" id="cb4" name="strike" value="1" ' . $cb4 . '> <label for="cb4">Delete Notes (Use Caution)</label><br />' . "\r\n";
				$content .= '   <input type="checkbox" id="cb5" name="admin" value="1" ' . $cb5 . '> <label for="cb5">Admin (Can Create Users, Remove Access, Give Remote Access and Allow Users to Print)</label><br />' . "\r\n";
				$content .= '   <input type="checkbox" id="cb6" name="sadmin" value="1" ' . $cb6 . '> <label for="cb6">Super Admin (Full Account Creation Access)</label><br />' . "\r\n";
			}
			return (array('content' => $content, 'action' => 'AddUser', 'myaction' => 'Add New User',));

		default :
			header("Location:" . base_url . admin_url);
			exit;
	}

?>
