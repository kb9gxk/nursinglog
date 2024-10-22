<?php
/*
$myIP     = getRealIpAddr();
if ( defined( 'ips' ) ) {
    $ips   = explode( ', ', ips );
    $isLAN = substr( $myIP, 0, 3 );
    if ( in_array( $myIP, $ips ) ) {
        $notallowed = false;
        echo "EXISTS";
    } else {
        echo "NO EXIST1";
        $notallowed = true;
    }

    if ( $isLAN == "10." ) {
        $notallowed = false;
    }
} else {
    $notallowed = false;
    echo "NO EXIST2";
}
echo $myIP . ' -> ' . $notallowed;
prd($ips);
*/
prd (ENVIRON);
exit();
?>
