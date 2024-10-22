<?php
	include ("iCommon.php");
	$username = $db->escape(strtolower($_REQUEST["username"]));
	$password = $db->escape(strtolower($_REQUEST["password"]));
	$id = $db->escape($_REQUEST["id"]);
	$level = $db->escape($_REQUEST["level"]);
	$fullname = $db->escape($_REQUEST["fullname"]);
	// they have to enter something to validate
	if ($id == "" || $password == "") {
		core_error::setError("You muse select a valid user.");
		header("Location:" . base_url . admin_url);
		exit;
	}
	$u = users::updatePassword($id, $password);
	if ($u === null) {
		core_error::setError("User Not Updated");
		header("Location:" . base_url . admin_url);
		exit;
	}
	core_message::setMessage("Users password updated");
	header("Location:" . base_url . admin_url);
?>
