<?php
include "iAdmin.php";
$ps = notes::loadAllEntries();
// output headers so that the file is downloaded rather than displayed
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=" . PREFIX . "_log.csv");
header("Pragma: no-cache");
header("Expires: 0");

// create a file pointer connected to the output stream
$output = fopen("php://output", "w");
// output the column headings
fputcsv($output, ["When", "Type", "Description", "Who"]);
foreach ($ps as $p) {
    // Increase PHP Execution time
    set_time_limit(60);
    $when = date("g:ia m/d/Y", $p->getentWhen());
    $logDesc = $p->getentDesc();
    $logDesc = strip_tags($logDesc);
    $logDesc = str_replace(["\r", "\n", "\t", "&nbsp"], " ", $logDesc);
    $thePOC = "";
    $haspoc = "";
    if ($p->getHasPOC()) {
        $q = plans::loadx($p->getId());
        $thePOC = stripslashes(str_replace('\n', "<br>", $q->getPlan()));
        $thePOC = str_replace(["\r", "\n", "\t", "&nbsp"], " ", $thePOC);
        $thePOC = str_replace(["<br>", "<br/>", "<br />"], '\r\n', $thePOC);
        $theResponsible = $q->getResponsible();
        $haspoc = "\r\n----------------\r\n$thePOC";
    }
    fputcsv($output, [
        $when,
        $categorys[$p->getentType()],
        $logDesc . $haspoc,
        $p->getentBy(),
    ]);
}
fclose($output);
// Reset PHP Excention Time
set_time_limit(300);
die();
?>