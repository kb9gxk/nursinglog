<?php
function strafter($string, $substring)
{
    $pos = strpos($string, $substring);

    if ($pos === false) {
        return $string;
    } else {
        return substr($string, $pos + strlen($substring));
    }
}

function strbefore($string, $substring)
{
    $pos = strpos($string, $substring);

    if ($pos === false) {
        return $string;
    } else {
        return substr($string, 0, $pos);
    }
}
require "app/urls.php";
define("ENVIRON", parseUrl(get_current_url()));

$domain = strafter($_SERVER["HTTP_HOST"], ".");

if ($domain !== "nursinglog.click" && $domain !== "nursinglog.space") {
    //echo $domain;
    header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden", true, 403);
    exit();
}

if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] == "off") {
    $redirect = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $redirect);
    exit();
}

$myhost = strbefore($_SERVER["HTTP_HOST"], ".");

if ($myhost === "www" || $myhost === "nursinglog") {
    header("Location: https://demo.nursinglog.space");
    //$myhost = "demo";
}

//die ('test');
define("PREFIX", $myhost);
define("SUFFIX", implode(getTld($domain)));
//print(SUFFIX);
//die();

include "app/init.php";

if (!isset($_REQUEST) || $_REQUEST["page"] == "") {
    $theRequest = maintCheck($maint);
} else {
    $theRequest = $_REQUEST["page"];
}

$theRequest = $_REQUEST["page"];

if ($theRequest == "") {
    $theRequest = maintCheck($maint);
}

$GLOBALS["args"] = explode("/", $theRequest);
echo core_template::render($GLOBALS["args"][0]);
//prd($GLOBALS["args"][0]);

function getTld($domain1)
{
    $tld = substr($domain1, strpos($domain1, ".") + 1);
    return explode(".", $tld);
}

function maintCheck($maint1)
{
    if ($maint1 === true) {
        $index = "maint";
    } else {
        $index = "index";
    }
    return $index;
}

?>