<?php
    include "iNotes.php";
    $level = core_session::getSession( "bstlevel" );

    if ( isset( $_POST['days'] ) ) {
        $days = strval( $_POST['days'] );
    } else {
        $days = strval( 3 );
    }

    $myreturn = [ "days" => $days ];
    core_session::removeSession( 'entDate' );
    core_session::removeSession( 'entType' );
    core_session::removeSession( 'entDesc' );

return ( $myreturn );
