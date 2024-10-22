<?php


function secureRandomPassword() {
    // Define characterset for the Password Creation.
$upper_letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
$lower_letters = 'abcdefghijkmnopqrstuvwxyz';
$digits = '1234567890';
$specialChar = '!@#$%^&*()+-=[]{}<>?';

    // Initialize password
    $password = '';

    // Generate 1 uppercase letter, 1 lowercase letter, and 1 number
    $password .= $upper_letters[random_int(0, strlen($upper_letters) - 1)];
    $password .= $lower_letters[random_int(0, strlen($lower_letters) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];

    // Generate remaining 4 characters randomly
    $remaining_chars = $upper_letters . $lower_letters . $digits;
    for ($i = 0; $i < 4; $i++) {
        $n = random_int(0, strlen($remaining_chars) - 1);
        $password .= $remaining_chars[$n];
        $remaining_chars = substr_replace($remaining_chars, '', $n, 1);
    }

    // Add a special character at the end
    $password .= $specialChar[random_int(0, strlen($specialChar) - 1)];

    return $password;
}

function rn2br($string)
{
    $newstr = str_replace(
        [
            '\r\n',
            '\n\r',
            '\r',
            '\n',
            '\\r\\n',
            '\\n\\r',
            '\\r',
            '\\n',
            "&#13;&#10;",
        ],
        "<br>",
        $string
    );
    return $newstr;
}

function br2rn($string)
{
    $newstr = str_replace("<br>", "&#13;&#10;", $string);
    return $newstr;
}

function mres($value)
{
    $search = ["\\", "\x00", "'", '"', "\x1a"];
    $replace = ["\\\\", "\\0", "\'", '\"', "\\Z"];
    return str_replace($search, $replace, $value);
}

function version()
{
    $last_revised = filemtime(base_path . "/app/changelog.md");
    $current_version = date('\vY.m.d\rHi', $last_revised);
    return $current_version;
}

function cleanout($string)
{
    $newstring = rn2br($string);
    $newstring = str_replace("\'", "'", $newstring);
    $newstring = str_replace('\"', '"', $newstring);
    $newstring = str_replace('\t', "   ", $newstring);
    $newstring = str_replace("\\\'", "'", $newstring);
    return $newstring;
}

function htmlwrap(&$str, $maxLength, $char = "<br>")
{
    $count = 0;
    $newStr = "";
    $openTag = false;
    $lenstr = strlen($str);

    for ($i = 0; $i < $lenstr; $i++) {
        $newStr .= $str[$i];

        if ($str[$i] == "<") {
            $openTag = true;
            continue;
        }

        if ($openTag && $str[$i] == ">") {
            $openTag = false;
            continue;
        }

        if (!$openTag) {
            if ($str[$i] == " ") {
                if ($count == 0) {
                    $newStr = substr($newStr, 0, -1);
                    continue;
                } else {
                    $lastspace = $count + 1;
                }
            }

            $count++;

            if ($count == $maxLength) {
                if ($str[$i + 1] != " " && $lastspace && $lastspace < $count) {
                    $tmp = ($count - $lastspace) * -1;
                    $newStr =
                        substr($newStr, 0, $tmp) .
                        $char .
                        substr($newStr, $tmp);
                    $count = $tmp * -1;
                } else {
                    $newStr .= $char;
                    $count = 0;
                }

                $lastspace = 0;
            }
        }
    }

    return $newStr;
}

/* USER-AGENTS
 ================================================== */
function check_user_agent($type = null)
{
    $user_agent = strtolower($_SERVER["HTTP_USER_AGENT"]);

    if ($type == "bot") {
        // matches popular bots
        if (
            preg_match(
                "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\\.com|feedfetcher-google/",
                $user_agent
            )
        ) {
            return true;
            // watchmouse|pingdom\.com are "uptime services"
        }
    } else {
        if ($type == "browser") {
            // matches core browser types
            if (preg_match("/mozilla\\/|opera\\//", $user_agent)) {
                return true;
            }
        } else {
            if ($type == "mobile") {
                // matches popular mobile devices that have small screens and/or touch inputs

                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America

                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
                if (
                    preg_match(
                        "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\\/|samsung|sonyericsson|^sie-|nintendo/",
                        $user_agent
                    )
                ) {
                    // these are the most common
                    return true;
                } else {
                    if (
                        preg_match(
                            "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /",
                            $user_agent
                        )
                    ) {
                        // these are less common, and might not be worth checking
                        return true;
                    }
                }
            }
        }
    }

    return false;
}

function removeslashes($string)
{
    $string = implode("", explode("\\", $string));
    return stripslashes(trim($string));
}

function pr($var)
{
    print "<pre>";
    print_r($var);
    print "</pre>";
}

function prd($var)
{
    print "<pre>";
    print_r($var);
    print "</pre>";
    die();
}

function tksort(&$array)
{
    ksort($array);

    foreach (array_keys($array) as $k) {
        if (gettype($array[$k]) == "array") {
            tksort($array[$k]);
        }
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        //check ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        //to check ip is pass from proxy
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

    return $ip;
}

function getExternalIpAddress()
{
    $externalIP = "INTERNET OFFLINE";
    try {
        $externalContent = file_get_contents("http://checkip.dyndns.com/");
        preg_match("/\b(?:\d{1,3}\.){3}\d{1,3}\b/", $externalContent, $m);
        $externalIP = $m[0];
    } catch (Exception $e) {
        echo "<html><head></head><body>\n";
        echo "Caught exception: ", $e->getMessage(), "\n";
        echo "</body></html>\n";
    }

    return $externalIP;
}

function getIpStatus()
{
    echo "Server IP: " .
        getExternalIpAddress() .
        " &mdash; Your IP: " .
        getRealIpAddr() .
        "\n";
}

set_exception_handler( function ( $e ) {
    $eMsg   = $e->getMessage();
    $eFile  = $e->getFile();
    $eLine  = $e->getLine();
    $eCode  = $e->getCode();
    $eTrace = $e->getTraceAsString();
    if ($cfname) { $eUser = "Username: " . $cfname . '\n\n'; } else { $eUser = ""; }
    echo "<b>Error:</b> Error: $eMsg<br>";
    echo "Webmaster has been notified";
    error_log( "$euser Error: $eMsg\n\nTrace: $eTrace\n\nFile: $eFile\nLine: $eLine\nCode: $eCode", 1,
        "it@btwaukegan.com", "From: " . PREFIX . "@nursinglog" . SUFFIX );
    die();
} );

function exceptions_error_handler($severity, $message, $filename, $lineno)
{
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

/*
set_exception_handler("exceptionHandler");

function exceptionHandler($exception)
{
    // these are our templates
    $traceline = "#%s %s(%s): %s(%s)";
    $msg =
        "PHP Fatal error:  Uncaught exception '%s' with message '%s' in %s:%s\nStack trace:\n%s\n  thrown in %s on line %s";

    // alter your trace as you please, here
    $trace = $exception->getTrace();
    foreach ($trace as $key => $stackPoint) {
        // I'm converting arguments to their type
        // (prevents passwords from ever getting logged as anything other than 'string')
        //$trace[$key]["args"] = array_map("gettype", $trace[$key]["args"]);
    }

    // build your tracelines
    $result = [];
    foreach ($trace as $key => $stackPoint) {
        $result[] = sprintf(
            $traceline,
            $key,
            $stackPoint["file"],
            $stackPoint["line"],
            $stackPoint["function"],
            $stackPoint["args"]
        );
    }
    // trace always ends with {main}
    $result[] = "#" . ++$key . " {main}";

    // write tracelines into main template
    $msg = sprintf(
        $msg,
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        implode("\n", $result),
        $exception->getFile(),
        $exception->getLine()
    );

    // log or echo as you please
    if ($cfname) {
        $eUser = "Username: " . $cfname . '\n\n';
    } else {
        $eUser = "";
    }
    $eMsg = $exception->getMessage();
    echo "<b>Error:</b> $eMsg<br>";
    echo "Webmaster has been notified";
    error_log(
        "$eUser\n\n$msg",
        1,
        "it@btwaukegan.com",
        "From: " . PREFIX . "@nursinglog" . SUFFIX
    );
    die();
}
*/