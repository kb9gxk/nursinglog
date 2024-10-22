<?php
$db = getDB();
	$username = $db->escape( strtolower( $_REQUEST["username"] ));
// they have to enter something to validate
	if ( $username == "") {
		core_error::setError( "You must specify a username to get the reminder." );
		header( "Location: " . base_url );
		exit;
	}
// is this an active user who exists in the system
	$u = users::loadUsername( $username );
	if ( $u === null ) {
		core_error::setError( "The username you specified do not exist." );
		header( "Location: " . base_url );
		exit;
	}

    $dec = core_crypto::decrypt($u->getPass());
    $mylen = strlen($dec);
    $msg = "Your password is \"" . $mylen. "\" characters long, starts with \"";
    $msg .= $dec[0]. "\" and ends with \"";
    $msg .= $dec[$mylen-1] . "\"";
    core_message::setMessage($msg);
    header("Location: " .base_url);

?>
