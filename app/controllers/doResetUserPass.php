<?php

    $id = $_POST['id'];

    $p = users::load( $id );

    //print ($id);

    //die;

    if ( !$p ) {
        core_error::setError( "Unable to locate the specified account." );
        header( "Location:" . base_url . admin_url );
        exit;
    }

    $password = ( secureRandomPassword() );
    $u = users::resetPassword( $id, $password );
    if ( $u === null ) {
        core_error::setError( "Error resetting password, try again..." );
        header( "Location:" . base_url . "admin" );
        exit;
    }

    echo "Password Reset Complete:\n\n";
    echo 'User: ' . $p->getFullName();
    echo "\n";
    echo 'Username: ' . $p->GetUsername();
    echo "\n";
    echo 'New Password: ' . $password;
    echo "\n\nUser will need to change Password\nupon login.";
    exit;

    function split_name( $name )
    {
        $name      = trim( $name );
        $last_name = ( strpos( $name, ' ' ) === false ) ? '' :
        preg_replace( '#.*\s([\w-]*)$#', '$1', $name );
        $first_name = trim( preg_replace( '#' . $last_name . '#', '', $name )
        );
        return [$first_name, $last_name];
    }


    
    function origRandomPassword() {
        $a     = new phpseclib\Math\BigInteger( 1000 );
        $b     = new phpseclib\Math\BigInteger( 9999 );
        $rand  = new phpseclib\Math\BigInteger();
        $name  = $p->getFullName();
        $parts = split_name( $name );
        $fname = $parts[0];
        $lname = $parts[1];
        $pwd   = strtolower( substr( $fname, 0, 1 ) ) . substr( $lname, 0, 1 ) . $rand->random( $a, $b );
        return $pwd;
    }
?>


