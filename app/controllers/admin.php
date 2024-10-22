<?php
	include ( "iAdmin.php" );
	$action = $GLOBALS['args'][1];
	if ( $action == "" ) {
		$action = "menu";
	}
	$view = core_template::checkFile( "admin_" . $action . ".tpl" );
	$controller = core_template::checkFile( "admin_" . $action . ".php" );
	$layout = core_render::render( $view, $controller );
	return ( array( "content" => $layout, "foot" => $foot ));
?>