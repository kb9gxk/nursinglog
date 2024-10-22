<?php

/**
 * init.php
 *
 * @author Miguel Garcia
 * @since  02/01/2014
 * @version 4.0
 *
 * The start of everything.  Gets the core and framework up and running.
 */

/**
 * Enable maintenance Mode.
 */
#$maint = true;
$maint = false;

/**
 * Pull database settings and setup database object
 */
require "settings.php";
require "common.php";
require_once base_path . "vendor/autoload.php";
require_once "packages/core/core_mysqli.php";
$GLOBALS["db"] = new core_mysqli([
	"host" => DB_HOST,
	"username" => DB_USER,
	"password" => DB_PASS,
	"db" => DB_NAME,
	"port" => DB_PORT,
	"charset" => "utf8mb4",
]);

/**
 * Pull setting keys from the database and define global keys
 */
require_once "packages/core/core_setting.php";
$settings = core_setting::loadSettings();
$csettings = core_setting::loadCustSettings(PREFIX);
define("ALLOWEDIPS", ips);
$StartDate = new DateTime(startdate);
$CurDate = new DateTime("now");
$interval = $CurDate->diff($StartDate);
define("DATE_TO", $interval->format("%a"));
define("SessRnd", uniqid());

/**
 * Extra Packages - This allows us to add application packages at will like the CMS...
 */
require_once "packages/core/core_package.php";
$packages = core_package::loadActivePackages();
$inc_path = "";
// The delimiter: Windows should be ; and *nix will be :
$d = path_delim;
if ($d == ";") {
	$p = "\\";
} else {
	$p = "/";
}
for ($i = 0; $i < sizeof($packages); $i++) {
	$inc_path .=
		$d . base_path . app_dir . package_dir . $packages[$i]->getPath() . $p;
	//$inc_path .= $d . base_path . app_dir . package_dir . $packages[$i]->getPath() . $p . 'bundle' . $p;
	//$inc_path .= $d . base_path . app_dir . package_dir . $packages[$i]->getPath() . $p . 'bundle' . $p . 'interfaces' . $p;
	//$inc_path .= $d . base_path . app_dir . package_dir . $packages[$i]->getPath() . $p . 'bundle' . $p . 'modules' . $p;
	//$inc_path .= $d . base_path . app_dir . package_dir . $packages[$i]->getPath() . $p . 'bundle' . $p . 'objects' . $p;
}
/**
 * Include Path
 */
ini_set(
	"include_path",
	ini_get("include_path") .
	$d .
	base_path .
	app_dir .
	package_dir .
	"core" .
	$p .
	$d .
	// base_path . app_dir . package_dir . 'Base/Framework' . $p . $d .
	base_path .
	app_dir .
	"controllers" .
	$p .
	$d .
	base_path .
	app_dir .
	"views" .
	$p .
	$inc_path
);
ini_set("session.gc_maxlifetime", 3600);
//	print $inc_path;
//	die();

/**
 * Administration Defaults
 *
 * @param applicationid	- The id for the current running application defaults to 1
 * @param moduleid - The id for the current application module
 * @param action - The action for the current module
 *
 */
$applicationid = isset($_REQUEST["applicationid"])
	? $_REQUEST["applicationid"]
	: 1;
$moduleid = isset($_REQUEST["moduleid"]) ? $_REQUEST["moduleid"] : 0;
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
if (!$applicationid) {
	$applicationid = 1;
}
if (!$action && !$moduleid) {
	$action = "OpenApplication";
} elseif (!$action) {
	$action = "OpenModule";
}

/**
 * __autoload
 *
 * @param string $class - The class file from the core to load
 *
 * This makes it so that if PHP encounters a request for a class or one of its functions, it will load it at runtime
 * from the include path we set above.
 *
 */
function customNLAutoload($class)
{
	include "$class.php";
}
spl_autoload_register("customNLAutoload");

/**
 * getDB - A handy utility function that will allow us to easily grab the global database object we created earlier.
 *
 * @return BF_Database Object
 */
function getDB()
{
	return $GLOBALS["db"];
}

?>