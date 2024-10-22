<?php

    include "iNotes.php";

 
    $start = strtotime( "2015-01-01 00:00:00" );
    $end = strtotime( "2022-07-06 00:00:00" );

    echo $start . ' - ' . $end . '<br>';
    $ps = notes::MassPOC( $start, $end );
    //$ps = notes::loadx(60);
    if ( $ps ) {
        //prd($ps);
        foreach ( $ps as $p ) {
            notes::POCdone( $p->getId() );
            echo "POC Done: " . $p->getId() . "<br>";
        }
    } else {
             "No POC Done<br>";
    }
    exit;



