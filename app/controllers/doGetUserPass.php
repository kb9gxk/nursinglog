<?php

    $id = $_POST['id'];

    $p = users::load($id);
    //print ($id);
    //die;

    if ( !$p ) {
        core_error::setError( "Unable to locate the specified account." );
        header( "Location:" . base_url . admin_url );
            exit;
			}
            echo 'User: ' .$p->getFullName();
            echo "\n";
            echo 'Username: '.$p->GetUsername();
            echo "\n";
			echo 'Password: '.core_crypto::decrypt( $p->getPass());
			exit;

?>
