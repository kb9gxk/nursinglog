<?php
$db = getDB();
//core_session::sessionStart();
    
	$now = time();
    $discard = core_session::getSession('discard_after') ;
	/*if ( (isset($discard) && $now > $discard) or !isset($discard)) {
// this session has worn out its welcome; kill it and start a brand new one
	   header('Location: ' . base_url. 'Timeout.do');
	  exit ();
	}*/
// either new or old, it should live at most for another hour
	core_session::addSession('discard_after', $now + 600);
	$username = core_session::getSession("bstuser");
	$name = core_session::getSession("bstname");
	$level = core_session::getSession("bstlevel");
   	$base_url = core_session::getSession( "base_url" );
   /*	if ( $username === "" ) {
		header( "Location:" . base_url );
		exit;
	}*/
    	$ps = bst_notes::loadx(7);
        $json = array();
        $key = str_replace(array(' ', "\n", "\t", "\r"), '', base64_decode($_REQUEST['pkey']));
        $pkey = '-----BEGIN PUBLIC KEY-----' . $key . '----END PUBLIC KEY-----';

	if ( $ps ) {
	  foreach ( $ps as $p ) {
		  $lDate = date( 'm-d-Y l', $p->getentWhen());
		  $lTime = date( 'g:i a', $p->getentWhen());
          $lType = $p->getentType();
          $lDesc = core_crypto::aencrypt($p->getentDesc(),$pkey);
          $lEdited = $p->getentEdited();
          $lBy = $p->getentBy();
          $json[] = array('Date' => $lDate, 'Time' => $lTime, 'Desc' => $lDesc, 'Edited' => $lEdited, 'By' => $lBy);
          }
        //echo $pkey;
        echo json_encode($json);
        //echo json_encode($ps);
        die;
	  }
?>