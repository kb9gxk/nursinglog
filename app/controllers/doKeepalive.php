<?php
	$now = time( );
	core_cookie::create('discard_after', $now + 500, $now + 500);
	exit();
?>

