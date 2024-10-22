<?php
include "iNotes.php";
$action = $GLOBALS['args'][1];

if ( $action == "" ) {
    $action = "log";
}

$view       = core_template::checkFile( "radio_" . $action . ".tpl" );
$controller = core_template::checkFile( "radio_" . $action . ".php" );
$layout     = core_render::render( $view, $controller );
return ( [ "content" => $layout, "foot" => $foot ] );
