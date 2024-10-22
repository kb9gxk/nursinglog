<?php
	include ("iNotes.php");
    if (empty($_POST['myeid'])) {
      $id = core_session::getSession('entID');
    } else {
    $id = $_POST['myeid'];
    }

    if (empty($id)){
      core_error::setError( "You must select a log entry first..." );
      header("Location: " . base_url . "/log");
    }


    $ps = notes::load($id);

	if ( $ps ) {
	  core_session::addSession('entDate', date("m/d/Y g:i a", $ps->entWhen));
	  core_session::addSession('entType', $ps->entType);
	  core_session::addSession('entDesc', $ps->getentDesc());
    }
    $the_key = core_session::getSession('entType');
	$type = "\t\t\t<option value=\"\">--Select Classification--</option>\r\n";
    foreach($category as $key => $val) {
        $sel = "";
        if($key==$the_key) $sel=" selected=\"selected\"";
        $type .= "\t\t\t<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\r\n";
    }
    $myreturn = array( "id" => $id, "type" => $type, "date" => core_session::getSession('entDate'), "description" => core_session::getSession('entDesc'),  'tinymce' => $tinymce);
	return ( $myreturn );
    ?>