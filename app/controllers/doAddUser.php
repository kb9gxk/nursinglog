<?php

	include ("iCommon.php");
	if (!$caccess == 1) {
		header("Location:" . base_url . "/log");
		exit;
	}
	$fname = trim(ucwords(strtolower($_REQUEST["fname"])));
	$lname = trim(ucwords(strtolower($_REQUEST["lname"])));
	$fullname = ($fname . ' ' . $lname);
	$username = (strtolower(substr($fname, 0, 1) . $lname));
	$password = ( secureRandomPassword() );
	$department = $_REQUEST["department"];
	$remote = $_REQUEST["remote"];
	if (!$remote == 1)
		$remote = 0;
	$strike = $_REQUEST["strike"];
	if (!$strike == 1)
		$strike = 0;
	$admin = $_REQUEST["admin"];
	if (!$admin == 1)
		$admin = 0;
	$status = $_REQUEST["status"];
	if (!$status == 1)
		$status = 0;
	$sadmin = $_REQUEST["sadmin"];
	if (!$sadmin == 1)
		$sadmin = 0;
	$print = $_REQUEST["print"];
	if (!$print == 1)
		$print = 0;
	$idt = $_REQUEST["idt"];
	if (!$idt == 1)
		$idt = 0;
	$poct = $_REQUEST["poct"];
	if (!$poct == 1)
		$poct = 0;
	$anon = $_REQUEST["anon"];
	if (!$anon == 1)
		$anon = 0;

	$muser = generateUsername($username);
	// they have to enter something to validate
	$u = users::create($muser, $password, $fullname, $department, $strike, $remote, $admin, $status, $sadmin, $print, $idt, $poct, $anon);
	if ($u === null) {
		core_error::setError("User Not Created");
		header("Location:" . base_url . admin_url);
		exit;
	}
	core_message::setMessage("User '$muser' created with password '$password'");
	header("Location:" . base_url . admin_url);
	exit;

	function generateUsername($username, $iteration = 0) {
		$generated = $iteration > 0 ? ($username . $iteration) : $username; 		//Increment username
		//print $generated ."\r\n";
		$u = users::loadUsername($generated);
		if ($u != null) {
			return generateUsername($username, $iteration + 1);
		}
		return $generated;
	}

    function origRandomPassword() {
        $a     = new phpseclib\Math\BigInteger( 1000 );
        $b     = new phpseclib\Math\BigInteger( 9999 );
        $rand  = new phpseclib\Math\BigInteger();
        $name  = $p->getFullName();
        $parts = split_name( $name );
        $fname = $parts[0];
        $lname = $parts[1];
        $pwd   = strtolower( substr( $fname, 0, 1 ) ) . substr( $lname, 0, 1 ) . $rand->random( $a, $b );
        return $pwd;
    }

?>
