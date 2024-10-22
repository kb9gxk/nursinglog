<?php

    $myIP  = getRealIpAddr();
    $isLAN = substr( $myIP, 0, 3 );

    if ( $isLAN == "10." ) {
        $myIP = "164.153.243.98";
    }

    // This creates the Reader object, which should be reused across
    // lookups.
    $reader = new GeoIp2\Database\Reader( '/var/lib/GeoIP/GeoLite2-City.mmdb' );

    // Replace "city" with the appropriate method for your database, e.g.,
    // "country".
    $record = $reader->city( $myIP );

    $isoCode      = ( $record->country->isoCode ); // 'US'
    $country_name = ( $record->country->name ); // 'United States'

    $state  = ( $record->mostSpecificSubdivision->name ); // 'Minnesota'
    $state2 = ( $record->mostSpecificSubdivision->isoCode ); // 'MN'

    $city = ( $record->city->name ); // 'Minneapolis'

    $zip = ( $record->postal->code ); // '55455'

    $lat = ( $record->location->latitude ); // 44.9733
    $lon = ( $record->location->longitude ); // -93.2323
    $myreturn = [ "ip" => $myIP, "isoCode" => $isoCode, "country_name" =>
        $country_name, "state" => $state, "state2" => $state2, "city" => $city, "zip" => $zip, "lat" => $lat, "lon" => $lon ];
return ( $myreturn );
