<?php
	include ( "iNotes.php" );
    $id = $_POST['did'];

	if ( notes::remove($id) ) {
		core_message::setMessage( "The entry has been removed." );
	} else {
		core_error::setError( "Error removing selected entry." );
		header( "Location:" . base_url . "log/" );
		exit;
	}
header ( "Location:" . base_url . "log/" );
exit;
?>