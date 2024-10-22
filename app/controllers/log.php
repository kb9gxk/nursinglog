<?php
include "iNotes.php";

if ( isset( $_POST['days'] ) ) {
    $days = strval( $_POST['days'] );
} else {
    $days = strval( 7 );
}

$myreturn = ["days" => $days];
core_session::removeSession( 'entDate' );
core_session::removeSession( 'entType' );
core_session::removeSession( 'entDesc' );

return ( $myreturn );
