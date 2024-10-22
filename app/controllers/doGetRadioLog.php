<?php
include ( "iNotes.php" );
$days = $_POST['days'];
$level = core_session::getSession("bstlevel");

// Grab The Notes
	$ps = bst_radio::loadx($days);
	if ( $ps ) {
		$radio_table .= "<table class=\"table table-striped page-break\">\n";
		$radio_table .= "<thead>\n";
// $radio_table .= "<th style=\"text-align:center;\">ID</th>\n";
		$radio_table .= "<th style=\"text-align:center; width:20px;\">Date/Time</th>\n";
		$radio_table .= "<th style=\"text-align:center; width:20px;\">Radio</th>\n";
		$radio_table .= "<th style=\"text-align:center; width:20px;\">Type</th>\n";
		$radio_table .= "<th style=\"text-align:center; width:300px;\">Condition</th>\n";
		$radio_table .= "<th style=\"text-align:center; width:150px;\">By</th>\n";
//$radio_table .= "<th>&nbsp;</th>\n";
		$radio_table .= "</thead>\n";
		$radio_table .= "<tbody>\n";
		foreach ( $ps as $p ) {
		  $logDesc = str_replace('\r\n','<br>', $p->getentDesc());
          $logDesc = str_replace('\n\r','<br>', $logDesc);
          $logDesc = str_replace('\n','<br>', $logDesc);
          $logDesc = nl2br($logDesc,false);
          $logDesc = htmlwrap($logDesc, 40, '<br>');
			$mdate = date( 'm/d/Y \<\b\r\> l', $p->getentMade( ));
			$mtime = date( 'g:i a', $p->getentMade( ));
            $canedit = '';
            $edited = '';
			$radio_table .= "<tr class=\"page-break\">\n";
// $radio_table .= "<td style=\"color:#1f1f1f;\">" . $p->getId() . "</td>\n";
                if ($p->getentBy() == core_session::getSession("bstname") || $level == 3) {
                  if ($p->getentMade() >= strtotime(date('Y-m-d H:m:s',strtotime('last day'))) || $level == 3){
                    #$canedit = "<br><a onclick=\"editlog(" . $p->getId() .")\" class=\"btn btn-link dontprint\"><i class=\"fa fa-pencil-square-o\"></i></a>";
                    if ($level == 3) {
                      #$canedit .= " <a onclick=\"dellog(" . $p->getId() .")\" class=\"btn btn-link dontprint\"><i class=\"fa fa-trash-o\"></i></a>";
                    }
                  }
                }
                if ($p->getentEdited()) { $edited = '<div style="text-align:right;"><sup style="color:red;">modified</sup></div>'; }
			$radio_table .= "<td style=\"color:#1f1f1f;\">" . $mdate ."<br/>". $mtime . "</td>\n";
			$radio_table .= "<td style=\"color:#1f1f1f;\">" .  $p->getentRadio() . "</td>\n";
			$radio_table .= "<td style=\"color:#1f1f1f;\">" . $p->getentType( ) . "</td>\n";
			$radio_table .= "<td style=\"color:#1f1f1f; text-align:left;\">" . $logDesc  . $edited . "</td>\n";
			$radio_table .= "<td style=\"color:#1f1f1f;\">" . $p->getentBy() . $canedit . "</td>\n";
//$radio_table .= "<td style=\"color:#1f1f1f;\"><a class=\"btn btn-primary btn-xs\" href=\"/" . app_dir . "user/reset/" . $p->getId() . "\">reset</a></td>\n";
			$radio_table .= "</tr>\n";
		}
		$radio_table .= "</tbody>\n";
		$radio_table .= "</table>\n";
	}

    echo $radio_table;
    $forms = <<<EOF
                <form method="post" action="DelEntry.do" id="delid" name="delid"><input type="hidden" id="did" name="did" value=""></form>
                <form method="post" action="editentry/" id="editid" name="editid"><input type="hidden" id="myeid" name="myeid" value="0"></form>
EOF;
    #echo $forms;
    exit;
?>
