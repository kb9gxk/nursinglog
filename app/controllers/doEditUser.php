<?php

	include ("iAdmin.php");
	$username = strtolower($_REQUEST["username"]);
	$eid = $_REQUEST["eid"];
	$department = $_REQUEST["department"];
	$fullname = $_REQUEST["fullname"];
	$remote = $_REQUEST["remote"];
	if (!$remote == 1)
		$remote = 0;
	$strike = $_REQUEST["strike"];
	if (!$strike == 1)
		$strike = 0;
	$admin = $_REQUEST["admin"];
	if (!$admin == 1)
		$admin = 0;
	$status = $_REQUEST["status"];
	if (!$status == 1)
		$status = 0;
	$sadmin = $_REQUEST["sadmin"];
	if (!$sadmin == 1)
		$sadmin = 0;
	$print = $_REQUEST["print"];
	if (!$print == 1)
		$print = 0;
	$idt = $_REQUEST["idt"];
	if (!$idt == 1)
		$idt = 0;
	$poct = $_REQUEST["poct"];
	if (!$poct == 1)
		$poct = 0;
	$anon = $_REQUEST["anon"];
	if (!$anon == 1)
		$anon = 0;

	// they have to enter something to validate
	if ($eid == "") {
		core_error::setError("You muse select a valid user.");
		header("Location:" . base_url . admin_url);
		exit;
	}
	$u = users::editUser($eid, $fullname, $department, $remote, $strike, $admin, $status, $sadmin, $print, $idt, $poct, $anon);
	if ($u === null) {
		core_error::setError("User $fullname Not Updated");
		header("Location:" . base_url . admin_url);
		exit;
	}
	core_message::setMessage("User $fullname updated");
	header("Location:" . base_url . admin_url);

?>
