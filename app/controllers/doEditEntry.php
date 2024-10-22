<?php
	include ( "iNotes.php" );
	$mypass = core_crypto::decrypt($cu->getPass());
	$entDate = $db->escape( strtotime( $_REQUEST["entDate"] ));
	$entType = $db->escape( $_REQUEST["entType"] );
	$entDesc = $_REQUEST["entDesc"];
	$entBy = $db->escape( $_REQUEST["entBy"] );
    $id = $db->escape( strtolower( $_REQUEST["eid"] ));
	core_session::addSession('entID', $_REQUEST['entId']);
	core_session::addSession('entDate', $_REQUEST['entDate']);
	core_session::addSession('entType', $_REQUEST['entType']);
	core_session::addSession('entDesc', $_REQUEST['entDesc']);

    /*echo $mypass;
    echo "<br><br>";
    echo $entBy;
    die; */
// they have to enter something to validate
	if ( $entDate > $now ) {
		core_error::setError( "Event can not be in the future, please correct and try again." );
		header( "Location:" . base_url . "newentry" );
		exit;
	}
	if ( $entDate == "" ) {
		core_error::setError( "Please enter the event date and try again." );
		header( "Location:" . base_url . "editentry" );
		exit;
	}
	if ( $entType == "" ) {
		core_error::setError( "Please select an event type and try again." );
		header( "Location:" . base_url . "editentry" );
		exit;
	}
	if ( $entDesc == "" ) {
		core_error::setError( "Please enter the event description and try again." );
		header( "Location:" . base_url . "editentry" );
		exit;
	}
	if ( $entBy == "" ) {
		core_error::setError( "Please enter your password and try again." );
		header( "Location:" . base_url . "editentry/" );
		exit;
	}
	if ( $entBy != $mypass ) {
		core_error::setError( "Please enter the correct password for '$name' and try again." );
		header( "Location:" . base_url . "editentry" );
        exit;
	}
    $entDesc = trim(core_crypto::encrypt($entDesc) );
	$p = notes::update( $id, $entDate, $entType, $entDesc );
	if ( $p === null ) {
		core_error::setError( "An error occurred updating that entry.  Please try again." );
		header( "Location:" . base_url . "editentry" );
		exit;
	}
	core_message::setMessage( "Your entry was updated successfully." );
    core_session::removeSession('entId');
    core_session::removeSession('entDate');
    core_session::removeSession('entType');
    core_session::removeSession('entDesc');
   	header( "Location:" . base_url . "log" );
	exit;
?>