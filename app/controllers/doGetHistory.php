<?php
	//	include ( "iAdmin.php" );
	$id = $_REQUEST['uid'];
	$ps = users::loadHist($id);
	if ($ps) {
		$users_table .= "       <table class=\"table table-striped\">\n";
		$users_table .= "           <thead>\n";
		// $users_table .= "<th style=\"text-align:center;\">ID</th>\n";
		$users_table .= "                   <th style=\"text-align:center;\">Login Date/Time</th>\n";
		$users_table .= "           </thead>\n";
		$users_table .= "           <tbody>\n";
		foreach ($ps as $p) {
			$lastlog = date('g:ia m/d/Y', $p->getHdate());
			$users_table .= "           <tr>\n";
			// $users_table .= "<td style=\"color:#1f1f1f;\">" . $p->getId() . "</td>\n";
			$users_table .= "               <td style=\"color:#1f1f1f;\">" . $lastlog . "</td>\n";
			$users_table .= "           </tr>\n";
		}
		$users_table .= "           </tbody>\n";
		$users_table .= "       </table>\n";
	}
	else {
		echo "Error retrieving user $id";
	}
	echo $users_table;
	exit;
	return (array("history" => $users_table, "errors" => core_error::outputErrors(), "messages" => core_message::outputMessages()) + $myreturn);
?>