<?php

	//include ("iCommon.php");
    $db  = getDB();
    $cid = core_session::getSession( 'id' ); 
    $cu  = users::load( $cid );
	$admin = "";
	if ($cu) { $cfname  = $cu->getFullName(); }
	//$username = $db->escape( strtolower( $_REQUEST["username"] ));
	$old = ($_REQUEST["old"]);
	$new1 = ($_REQUEST["new1"]);
	$new2 = ($_REQUEST["new2"]);
    //prd($new1 . ' ... ' . $new2);
	// they have to enter something to validate
	if (core_crypto::decrypt($cu->getPass()) != $old) {
		core_error::setError("You must enter your current password.");
		header("Location:" . base_url . "changepass");
		exit;
	}
	if ($new1 != $new2) {
		core_error::setError("Your new passwords do not match.");
		header("Location:" . base_url . "changepass");
		exit;
	}
	else {
		$password = $new1;
	}
	$u = users::updatePassword($cid, $password);
	if ($u === null) {
		core_error::setError("Error updating password, try again...");
		header("Location:" . base_url . "changepass");
		exit;
	}
    core_session::addSession("id", $cid);
	core_message::setMessage("Your password has been updated");
	header("Location:" . base_url . "log");

?>
