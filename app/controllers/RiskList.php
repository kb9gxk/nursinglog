<?php
include 'iNotes.php';
$path  = 'RiskMit/' . PREFIX . '/';
$dir   = opendir( base_path . $path );
$files = [];
asort( $files );

while (  ( $file = readdir( $dir ) ) !== false ) {
    if ( $file != "." and $file != ".." and $file != ".htaccess" and $file !=
        'index.php' ) {
        array_push( $files, $file );
    }
}

closedir( $dir );
sort( $files );
$theList = "<table class=\"table table-striped\">\n";
$theList .= "   <tbody>\n";

foreach ( $files as $file ) {
    $file = htmlentities( $file );
    $theList .= "       <tr>
            <td style=\"text-align:left;\" >
                <a href='/$path$file' target='_blank'>
                    <div style=\"text-align:left; color:black;\">
                        $file
                    </div>
                </a>
            </td>
       </tr>\n";
}

$theList .= "   </tbody>\n";
$theList .= "</table>\n";
return ( [ 'myaction' => 'Risk Mitigation Files', 'content' =>
    $theList ] );
