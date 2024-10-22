<?php

$db       = getDB();
$username = $db->escape( strtolower( $_REQUEST["username"] ) );
$password = $db->escape( $_REQUEST["password"] );
$lat      = substr( $_REQUEST["lat"], 0, 6 );
$lon      = substr( $_REQUEST["lon"], 0, 7 );
$atCLIENT = false;
$myIP     = getRealIpAddr();

function testRange( $int, $min, $max )
{
    return ( $min < $int && $int < $max );
}

// Validate Latatude & Longitude

if ( defined( 'latlon' ) ) {
    $latlon = explode( ',', latlon );
    if ( testRange( $lat, $latlon[0], $latlon[1] ) and testRange( $lon,
        $latlon[2], $latlon[3] ) ) {
        $atCLIENT = true;
    }
} else {
    $atCLIENT = true;
}

// they have to enter something to validate
if ( !$username || !$password ) {
    core_error::setError( "You must enter a Username and Password" );
    header( "Location:" . base_url );
    exit;
}

// is this an active user who exists in the system
$u = users::loadUsername( $username );

if ( $u === null ) {
    core_error::setError(
        "The username and password you entered does not match our records." );
    header( "Location:" . base_url );
    exit;
}

if ( $u->getStatus === 0 ) {
    core_error::setError( "The username '" . $username .
        "' has been disabled." );
    header( "Location:" . base_url );
    exit;
}

// Do the passwords match?
$dec = core_crypto::decrypt( $u->getPass() );
if ( $dec != $password ) {
    core_error::setError(
        "The password you entered does not match our records." );
    header( "Location:" . base_url );
    exit;
}

//Validate Login Location
$notallowed = false;
if ( defined( 'ips' ) ) {
    $ips   = explode( ', ', ips );
    foreach ($ips as $IP) {
        if (core_cidr::match( getRealIpAddr(), $IP)) {
            $notallowed = false;
            break;
        } else {
            $notallowed = true;
        }
    }
    $isLAN = substr( $myIP, 0, 3 );
    /*
    if ( in_array( $myIP, $ips ) ) {
        $notallowed = false;
    } else {
        $notallowed = true;
    }  */
    if ( $isLAN == "10." ) {
        $notallowed = false;
    }
} else {
    $notallowed = false;
}

//die ($notallowed . "**". $atCLIENT . "**" . $u->getRemote());
if (  (  ( $notallowed ) && ( !$u->getRemote() == 1 ) ) and !$atCLIENT ) {
    core_error::setError( "You can only log in from the " . client .
        " network." );
    header( "Location:" . base_url );
    exit;
}

$p = users::UpdateLastlog( $username );
// Set a Session
$now = time();
core_session::startSession();
core_cookie::create( 'id', $u->getID() );
//$_COOKIE['id'] = $u->getID();
core_cookie::create( 'discard_after', $now + 500 );

//$_COOKIE['discard_after'] = $now + 500;
if ( $u->getDefault() ) {
    core_session::addSession( "id", $u->getId() );
    header( "Location:" . base_url . "changepass" );
    exit;
} else {
    core_session::addSession( "id", $u->getId() );
    header( "Location:" . base_url . "log" );
    exit;
}
