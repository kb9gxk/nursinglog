<?php

    $myIP    = $_SERVER['REMOTE_ADDR'];
    //$bgcolor = "#C5F2BD";
    $gcolor = "#000";
    $mytitle = title;
    $logo    = '<img src="' . base_url . theme_url .

        'app/images/icons/icon-72x72.png" width="72" height="72" style="border: 0" alt="Logo">';
    $myhost = explode( ".", $_SERVER['HTTP_HOST'] );

    /*header( "Cache-Control: no-cache, no-store, must-revalidate" ); // HTTP 1.1.
    header( "Pragma: no-cache" ); // HTTP 1.0.
    header( "Expires: 0" ); // Proxies.
    header( "X-Robots-Tag: noindex, nofollow", true );
    header( "Referrer-Policy: no-referrer" );
    header( "Permissions-Policy: interest-cohort=()" );
    */
    header($headerCSP);
    /*
    header(
        "Strict-Transport-Security: max-age=63072000; includeSubDomains; preload" );
    */
    if ( isset( $_GET['risk'] ) ) {
        $risk = "onload='window.open(\"/RiskMit/" . PREFIX . "/" .
            $_GET['risk'] .
            "\");'";
    }

    $mobileCode = <<<EOF
    <script nonce='129ivKotJKPJM9Ga'>

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
try{
    document.getElementById("lat").value = position.coords.latitude;
    document.getElementById("lon").value = position.coords.longitude;
} catch (err) { }
}
</script>
EOF;

    $ismobile = check_user_agent( 'mobile' );
    $allowedip = true;
    if ( defined( 'ips' ) ) {
        $ips   = explode( ', ', ips );
        foreach ($ips as $IP) {
            if (core_cidr::match( getRealIpAddr(), $IP)) {
                $allowedip = true;
                break;
            } else {
                $allowedip = false;
            }
        }
    }

    if ( $ismobile ) {
        if ( $allowedip ) {
            $ismobile1 = '';
            $ismobile2 = '';
        } else {
            $ismobile2 = $mobileCode;
            $ismobile1 = ' onload="getLocation();"';
        }
    } else {
        $ismobile1 = '';
    }

    if ( $GLOBALS["args"][0] == 'log' ) {
        $PrintType = 'portrait';
    } else {
        $PrintType = 'portrait';
    }

    return ( ["base_url" => base_url, "bgcolor" => $bgcolor, "logo" => $logo,
        "mytitle" => $mytitle, "asset" => base_url . asset_url, "theme" =>
        base_url .
        theme_url, "load" => $ismobile1, 'printtype' => $PrintType, 'mobile' =>
    $ismobile2, 'random' => SessRnd, 'risk' => $risk] );
