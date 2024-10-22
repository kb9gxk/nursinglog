<?php
    include "iNotes.php";
    $Scategory = '0';

    if ( isset( $_POST['category'] ) ) {
        $Scategory = strval( $_POST['category'] );
    }

    $type = "\t\t\t<option value=\"0\">--Select Category--</option>\r\n";

    foreach ( $categorys as $key => $val ) {
        $sel = "";

        if ( $key == $the_key ) {
            $sel = " selected=\"selected\"";
        }

        $type .= "\t\t\t<option value=\"" . $key . "\"" . $sel . ">" . $val .
            "</option>\r\n";
    }

    $myreturn = [ 'category' => $Scategory, 'type' => $type ];

return ( $myreturn );
