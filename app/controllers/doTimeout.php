<?php
	core_session::destroySession();
    core_cookie::removeall();
	ob_start( );
	core_error::setError( "You session has expired, please log in again" );
	header( 'Location:' . base_url );
	ob_end_flush( );
	exit ( );
?>