<?php
include "iNotes.php";
$action = $GLOBALS['args'][1];

if ( $action == "" ) {
    $action = "new";
}

$view       = core_template::checkFile( "notes_" . $action . ".tpl" );
$controller = core_template::checkFile( "notes_" . $action . ".php" );
$layout     = core_render::render( $view, $controller );
return ( ["content" => $layout] + $myreturn );
