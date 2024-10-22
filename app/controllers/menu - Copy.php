<?php
include "iNotes.php";
$name = "$cfname ($cdept)";

if ( $cprint == 1 ) {
    $print =

        ' <button class="btn btn-default" onclick="javascript:print();"><i class="fas fa-print"></i></button>';
} else {
    $print = "";
}

if ( $caccess == 1 ) {
    $admin =

        ' <a href="admin" class="btn btn-default"><i class="fas fa-tools"></i> Admin Menu</a>';
    $rLog = 1;
} else {
    $admin = "";
    $rLog  = 0;
}

$rLog1 = <<<EOF
           <li>
            <a onclick="gorlog(1)" class="btn btn-default">Last 24 Hours</a>
          </li>
           <li>
            <a onclick="gorlog(3)" class="btn btn-default">Last 3 Days</a>
          </li>
          <li>
            <a onclick="gorlog(7)" class="btn btn-default">Last 7 Days</a>
          </li>
          <li>
            <a onclick="gorlog(30)" class="btn btn-default">Last 30 Days</a>
          </li>
          <li>
            <a onclick="gorlog(60)" class="btn btn-default">Last 60 Days</a>
          </li>
          <li>
            <a onclick="gorlog(90)" class="btn btn-default">Last 90 Days</a>
          </li>
EOF;
$rLog2 = <<<EOF
           <li>
            <a onclick="loadrlog(1)" class="btn btn-default">Last 24 Hours</a>
          </li>
           <li>
            <a onclick="loadrlog(3)" class="btn btn-default">Last 3 Days</a>
          </li>
          <li>
            <a onclick="loadrlog(7)" class="btn btn-default">Last 7 Days</a>
          </li>
          <li>
            <a onclick="loadrlog(30)" class="btn btn-default">Last 30 Days</a>
          </li>
          <li>
            <a onclick="loadrlog(60)" class="btn btn-default">Last 60 Days</a>
          </li>
          <li>
            <a onclick="loadrlog(90)" class="btn btn-default">Last 90 Days</a>
          </li>
EOF;
$lrtype = '';
$where  = $GLOBALS['args'][0];

switch ( $where ) {
    case 'log':
        $ltype = 'load';

        if ( $rLog ) {
            $lrtype = $rLog1;
        }

        $flog = <<<EOF
                         <li>
                            <a onclick="loadlog(0)" class="btn btn-default">Full Log</a>
                        </li>
EOF;
        break;

    case 'radio':
        $where1 = $GLOBALS['args'][1];

        switch ( $where1 ) {
            case 'log':
                if ( $rLog ) {
                    $lrtype = $rLog2;
                }

                break;

            default:

                if ( $rLog ) {
                    $lrtype = $rLog1;
                }

                break;
        }

    default:
        $ltype = 'go';

        if ( $rLog ) {
            $lrtype = $rLog1;
        }

        $flog = "";
        break;
}

$where1 = $GLOBALS['args'][1];

switch ( $where1 ) {
    case 'log':
        if ( $rLog ) {
            $lrtype = $rLog2;
        }

        break;

    default:

        if ( $rLog ) {
            $lrtype = $rLog1;
        }

        break;
}

if ( PREFIX == 'bst' ) {$policy =

        '<a href="https://docs.btwaukegan.us/viewer#/policies/Original%20Policies/Communication%20Log.pdf" target="_blank" class="btn btn-default"><i class="fas fa-book-open"></i> Log Policy</a>';}

if ( is_null( core_session::getSession( 'id' ) ) ) {$fullIn =
        'style="display:none"';}

if ( core_session::getSession( 'id' ) == 0 ) {$fullIn = '';}

$mymenu = ['fullIn' => $fullIn, 'flog' => $flog, 'lrtype' => $lrtype,
    'ltype' => $ltype, 'name' => $name, 'print' => $print, 'admin' =>
    $admin,
    'policy' => $policy, "errors" => core_error::outputErrors(),
    "messages" =>
    core_message::outputMessages()];
return ( $mymenu );
