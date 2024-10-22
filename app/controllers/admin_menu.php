<?php

	include ("iAdmin.php");
	//include ( "iAccess.php" );
	$ps = users::loadStatusEntries();
	$users_table .= "       <table class=\"table table-striped\">\n";
	$users_table .= "           <thead>\n";
	$users_table .= "               <tr>";
	$users_table .= "                   <th style=\"text-align:center;\">Username</th>\n";
	$users_table .= "                   <th style=\"text-align:center;\">Full Name</th>\n";
	$users_table .= "                   <th style=\"text-align:center;\">Last Login</th>\n";
	$users_table .= "                   <th style=\"text-align:center;\">Department</th>\n";
	$users_table .= "                   <th>&nbsp;</th>\n";
	$users_table .= "                   <th>&nbsp;</th>\n";
	$users_table .= "                   <th>&nbsp;</th>\n";
	$users_table .= "                   <th>&nbsp;</th>\n";
	$users_table .= "               </tr>";
	$users_table .= "           </thead>\n";
	if ($ps) {
		$users_table .= "           <tbody>\n";
		foreach ($ps as $p) {
			$Dept = $iAccess[$p->getDept()];
			$lastlog = date('g:ia m/d/Y', $p->GetLastLog());
			if ($p->getLastLog() == 0) {
				$lastlog = "";
			}
			if ($p->getStatus() == 1) {
				$users_table .= "           <tr>\n";
			}
			else {
				$users_table .= "           <tr style=\"text-decoration:line-through\">\n";
			}
            if ($p->getRemote() == 1 ) {
                $color = '#5900ff;';
            } else {
                $color = '#1f1f1f;';
            }
			// $users_table .= "<td style=\"color:#1f1f1f;\">" . $p->getId() . "</td>\n";
			$users_table .= "               <td style=\"color:$color\">" . $p->getUsername() . "</td>\n";
			$users_table .= "               <td style=\"color:$color\">" . $p->getFullName() . "</td>\n";
			$users_table .= "               <td style=\"color:$color\">" . $lastlog . "</td>\n";
			$users_table .= "               <td style=\"color:$color\">" . $Dept . "</td>\n";
			$users_table .= "               <td style=\"color:$color\"><a class=\"btn btn-primary btn-xs dontprint\" href=\"" . admin_url . "user/edit/" . $p->getId() . "\"><i class=\"fas fa-user-edit\"></i> Edit User</a></td>\n";
			$users_table .= "               <td style=\"color:$color\"><a class=\"btn btn-primary btn-xs dontprint\" onclick=\"ShowPass(" . $p->getId() . ")\"><i class=\"fas fa-key\"></i> Get Password</a></td>\n";
  			$users_table .= "               <td style=\"color:$color\"><a class=\"btn btn-primary btn-xs dontprint\" onclick=\"ResetPass(" . $p->getId() . ")\"><i class=\"fas fa-unlock-alt\"></i> Reset Password</a></td>\n";
  			$users_table .= "               <td style=\"color:$color\"><a class=\"btn btn-primary btn-xs dontprint\" href=\"" . admin_url . "history/" . $p->getId() . "\"><i class=\"fas fa-history\"></i> Login History</a></td>\n";

		$users_table .= "           </tr>\n";
		}
		$users_table .= "           </tbody>\n";
		$users_table .= "       </table>\n";
	}
	return (array("users" => $users_table));

?>