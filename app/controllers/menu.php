<?php
include "iNotes.php";
$name = "$cfname ($cdept)";

if ($cprint == 1) {
    $print =

        '<li><div class="buttonbg gradient_button gradient50" style="width: 68px;"><div class="icon_4 with_img_24"><a href="javascript:print();">Print</a></div></div></li>';
} else {
    $print = "";
}

if ($caccess == 1) {
    $admin =

        '  <li><div class="buttonbg gradient_button gradient48" style="width: 127px;"><div class="arrow"><div class="icon_6 with_img_24"><a class="button_6">Admin Items</a></div></div></div>
    <ul class="img_32">
    <li class="gradient_menuitem gradient34"><a href="/admin" class="with_img_24" title=""><img src="/theme/menu/mbico_mbmcp_1.png" alt="" />User List</a></li>
    <li class="gradient_menuitem gradient34"><a href="/admin/user/add" class="with_img_24" title=""><img src="/theme/menu/mbico_mbmcp_2.png" alt="" />Create New User</a></li>
    <li class="separator"><div></div></li>
    <li class="gradient_menuitem gradient42 last_item"><a href="/admin/categories" class="with_img_32" title=""><img src="/theme/menu/mbico_mbmcp_3.png" alt="" />Add/Edit Categories</a></li>
    </ul></li>
';
    $rLog = 1;
} else {
    $admin = "";
    $rLog = 0;
}

$lrtype = '';
$where = $GLOBALS['args'][0];

switch ($where) {
    case 'log':
        $ltype = 'load';

        $flog = <<<EOF
                         <li>
                            <a onclick="loadlog(0)" class="btn btn-default">Full Log</a>
                        </li>
EOF;
        break;

    default:
        $ltype = 'go';
        $flog = "";
        break;
}

$where1 = $GLOBALS['args'][1];

switch ($where1) {
    case 'log':

    default:


        break;
}

if (PREFIX == 'bst') {
    $policy =

        '<li><div class="buttonbg gradient_button gradient50" style="width: 101px;"><div class="icon_7 with_img_32"><a href="https://baysideterracellc-my.sharepoint.com/:b:/g/personal/jparrish_btwaukegan_com/ESMeIbnXXE5hFRKRocqZ0aYB3BxokkNKKufQo3AW_BFfFw?e=KUDMf4" target="_blank" class="button_7">Log Policy</a></div></div></li>';
}

$mymenu = ['flog' => $flog, 'lrtype' => $lrtype,
    'ltype' => $ltype, 'name' => $name, 'print' => $print, 'admin' =>
        $admin,
    'policy' => $policy, "errors" => core_error::outputErrors(),
    "messages" =>
        core_message::outputMessages()];
return ($mymenu);
