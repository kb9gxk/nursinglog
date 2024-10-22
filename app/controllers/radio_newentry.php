<?php
include "iNotes.php";

switch ( core_session::getSession( 'entRadio' ) ) {
    case '10':
        $r10 = 'selected';
        break;
    case '2':
        $r2 = 'selected';
        break;
    case '3':
        $r3 = 'selected';
        break;
    case '4':
        $r4 = 'selected';
        break;
    case '5':
        $r5 = 'selected';
        break;
    case '6':
        $r6 = 'selected';
        break;
    case '7':
        $r7 = 'selected';
        break;
    case '8':
        $r8 = 'selected';
        break;
    case '9':
        $r9 = 'selected';
        break;
    case '1':
        $r1 = 'selected';
        break;
    case 'Multi':
        $rMulti = 'selected';
        break;
}

switch ( core_session::getSession( 'entType' ) ) {
    case 'Check In':
        $ci = 'selected';
        break;
    case 'Check Out':
        $co = 'selected';
        break;
    case 'Condition Update':
        $cu = 'selected';
        break;
    case 'Dead Battery':
        $dba = 'selected';
        break;
    case 'Radio Interference':
        $ri = 'selected';
        break;
    case 'Other':
        $othe = 'selected';
        break;
}

$radio = "       <option value=\"\">--Select Radio--</option>\r\n";
$radio .= "      <option value=\"1\" " . $r1 . ">1</option>\r\n";
$radio .= "      <option value=\"2\" " . $r2 . ">2</option>\r\n";
$radio .= "      <option value=\"3\" " . $r3 . ">3</option>\r\n";
$radio .= "      <option value=\"4\" " . $r4 . ">4</option>\r\n";
$radio .= "      <option value=\"5\" " . $r5 . ">5</option>\r\n";
$radio .= "      <option value=\"6\" " . $r6 . ">6</option>\r\n";
$radio .= "      <option value=\"7\" " . $r7 . ">7</option>\r\n";
$radio .= "      <option value=\"8\" " . $r8 . ">8</option>\r\n";
$radio .= "      <option value=\"9\" " . $r9 . ">9</option>\r\n";
$radio .= "      <option value=\"10\" " . $r10 . ">10</option>\r\n";

if ( $level >= 2 ) {$radio .= "      <option value=\"Multi\" " . $rMulti .
        ">Multiple Radios</option>\r\n";}

$type = "       <option value=\"\">--Select Type--</option>\r\n";
$type .= "      <option value=\"Check Out\" " . $co .
    ">I have Radio</option>\r\n";
$type .= "      <option value=\"Check In\" " . $ci .
    ">I do not have radio anymore</option>\r\n";
$type .= "      <option value=\"Condition Update\" " . $cu .
    ">Update Radio Condition</option>\r\n";
$type .= "      <option value=\"Dead Battery\" " . $dba .
    ">Dead Battery</option>\r\n";
$type .= "      <option value=\"Radio Interference\" " . $ri .
    ">Radio Interference</option>\r\n";
$type .= "      <option value=\"Other\" " . $othe . ">Other</option>\r\n";
$myreturn = [ "radio" => $radio, "type" => $type, "description" =>
    core_session::getSession( 'entDesc' ) ];
return ( $myreturn );
