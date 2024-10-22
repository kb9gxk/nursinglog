<?php
$action = $GLOBALS['args'][1];
if ($action == "") {
    include (base_path . 'app/SystemMessage.php');
    $date = time();
    $theend = strtotime($enddate);
    if ($date < $theend) {core_sysmsg::setSysmsg($themessage);}
    $action = "login";
}
$view = core_template::checkFile($action . ".tpl");
$controller = core_template::checkFile($action . ".php");
$layout = core_render::render($view, $controller);
return (["content" => $layout]);

?>

