<?php
	include ( "iNotes.php" );
    $db = getDB();
	$u = bst_users::loadUsername( $username );
	$mypass = core_crypto::decrypt($u->getPass());
	$entRadio = $_REQUEST["entRadio"];
	$entType = $_REQUEST["entType"];
	$entDesc = $_REQUEST["entDesc"];
	$entBy = $db->escape( strtolower( $_REQUEST["entBy"] ));
	core_session::addSession('entRadio', $_REQUEST['entRadio']);
	core_session::addSession('entType', $_REQUEST['entType']);
	core_session::addSession('entDesc', $_REQUEST['entDesc']);
	$now = strtotime( "now" );

    /*echo $mypass;
    echo "<br><br>";
    echo $entBy;
    die; */
// they have to enter something to validate
	if ( $entRadio == "" ) {
		core_error::setError( "Please select a radio and try again." );
		header( "Location:" . base_url . "radio/newentry" );
		exit;
	}
	if ( $entType == "" ) {
		core_error::setError( "Please select an entry type and try again." );
		header( "Location:" . base_url . "radio/newentry" );
		exit;
	}
	if ( $entDesc == "" ) {
		core_error::setError( "Please enter the radio's condition and try again." );
		header( "Location:" . base_url . "radio/newentry" );
		exit;
	}
	else {
		$theUser = $u->getId();
	}
    $entDesc = trim(core_crypto::encrypt($entDesc) );
	$p = bst_radio::create( $now, $entRadio, $entType, $entDesc, $theUser );
	if ( $p === null ) {
		core_error::setError( "An error occurred creating that entry.  Please try again." );
		header( "Location:" . base_url . "radio/newentry" );
		exit;
	}
	core_message::setMessage( "Your entry was added successfully." );
    core_session::removeSession('entRadio');
    core_session::removeSession('entType');
    core_session::removeSession('entDesc');
   	header( "Location:" . base_url . "radio/log" );
	exit;
?>