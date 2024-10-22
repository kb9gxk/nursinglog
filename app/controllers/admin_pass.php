<?php
	include ( "iAdmin.php" );

    $id = $GLOBALS['args'][2];

    $p = users::load($id);
    //print ($id);
    //die;

    if ( !$p ) {
        core_error::setError( "Unable to locate the specified account." );
        header( "Location:" . base_url . admin_url );
            exit;
			}
			return ( array( 'muser' => $p->getFullName( ), 'pass' => core_crypto::decrypt( $p->getPass()), ) + $myreturn );
			exit;

?>
