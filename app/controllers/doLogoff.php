<?php
	core_session::destroySession();
    core_session::addSession('id',null);
    core_cookie::removeall();
	ob_start( );
	core_message::setMessage( "You have been Successfully Logged Out" );
	header( "Location:" . base_url );
	ob_end_flush( );
	session_destroy();
	exit ( );
?>
