<?php
	include ( "iNotes.php" );
	core_session::addSession('initEntry', $_REQUEST['initEntry']);
	core_session::addSession('Plan', $_REQUEST['Plan']);
	core_session::addSession('Responsible', $_REQUEST['Responsible']);
	core_session::addSession('Followup', $_REQUEST['Followup']);
	core_session::addSession('Resolved', $_REQUEST['Resolved']);
	core_session::addSession('ResDate', $_REQUEST['ResDate']);
	$initEntry = $_REQUEST['initEntry'];
	$Plan = $_REQUEST['Plan'];
	$Responsible = $_REQUEST['Responsible'];
	$Followup = $_REQUEST['Followup'];
	$Resolved = $_REQUEST['Resolved'];
	$ResDate = $_REQUEST['ResDate'];


	$now = strtotime( "now" );

    /*echo $mypass;
    echo "<br><br>";
    echo $entBy;
    die; */
	// they have to enter something to validate
	if ( $Plan == "" ) {
		core_error::setError( "Please enter your comment." );
		header( "Location:" . base_url . "plan" );
		exit;
	}
	// Did they enter their password in the Responsible Field?
	$dec = core_crypto::decrypt( $cu->getPass() );
	if ( $dec === $Responsible ) {
    core_error::setError(
        "Please do not put your password in the Responsible Field" );
    	header( "Location:" . base_url . "plan" );
    	exit;
	}
	$p = plans::create( $initEntry, $Plan, $Responsible, $Followup, $Resolved, $ResDate);
	if ( $p === null ) {
		core_error::setError( "An error occurred creating that entry.  Please try again." );
		header( "Location:" . base_url . "comment" );
		exit;
	}
	core_message::setMessage( "Your entry was added successfully." );
    core_session::removeSession('initEntry');
    core_session::removeSession('Plan');
    core_session::removeSession('Responsible');
    core_session::removeSession('Followup');
    core_session::removeSession('Resolved');
    core_session::removeSession('ResDate');
   	header( "Location:" . base_url . "log" );
	exit;
?>