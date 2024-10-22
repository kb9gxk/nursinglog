<?php

	include ("iAdmin.php");
	//include ( "iAccess.php" );
    $uid = $GLOBALS['args'][2];
	$ps = history::loadHist($uid);
    $user = users::load($uid)->getFullName();
    //prd($ps);
	$users_table .= "       <table class=\"table table-striped\">\n";
	$users_table .= "           <thead>\n";
	$users_table .= "               <tr>";
	$users_table .= "                   <th style=\"text-align:center;\">Date</th>\n";
	$users_table .= "               </tr>";
	$users_table .= "           </thead>\n";
	if ($ps) {
		$users_table .= "           <tbody>\n";
		foreach ($ps as $p) {
			$loghist = date('g:ia m/d/Y', $p->getHdate());
			$users_table .= "               <td style=\"color:#1f1f1f;\">" . $loghist . "</td>\n";
			$users_table .= "           </tr>\n";
		}
		$users_table .= "           </tbody>\n";
		$users_table .= "       </table>\n";
	}
	return (array("history" => $users_table, "user" => $user));

?>