<?php
include "iNotes.php";

//include ("iCommon.php");
if ( !core_session::getSession( 'entDate' ) ) {
    core_session::addSession( 'entDate', downTo5() );
}

$the_key = core_session::getSession( 'entType' );
$type    = "\t\t\t<option value=\"\">--Select Classification--</option>\r\n";
foreach ( $category as $key => $val ) {
    $sel = "";
    if ( $key == $the_key ) {
        $sel = " selected=\"selected\"";
    }

    $type .= "\t\t\t<option value=\"" . $key . "\"" . $sel . ">" . $val .
        "</option>\r\n";
}

$myreturn = [ "type" => $type, "date" =>
    core_session::getSession( 'entDate' ), "description" => core_session::getSession( 'entDesc' ), 'tinymce' =>
    $tinymce ];
return ( $myreturn );

function downTo5()
{
    //Convert your time to unixtimestamp
    $time = strtotime( 'now' );
    //Calculate by 5mins round down
    $time = intval( $time / 300 ) * 300;
    return ( date( 'm/d/Y g:i a', $time ) );
}
