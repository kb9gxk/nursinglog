<?php
    include "iAdmin.php";
    $ps = users::loadStatusEntries();
    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . PREFIX . '_users.csv');
    header('Pragma: no-cache');
    header('Expires: 0');
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    // output the column headings
    fputcsv($output, array('Full Name', 'Username', 'Password', 'Last Login', 'Status'));
    foreach ($ps as $p) {
        $lastlog = date('g:ia m/d/Y', $p->GetLastLog());
        if ($lastlog == "6:00pm 12/31/1969") {$lastlog = '';}
        if ($p->getUsername() == 'jparrish') {continue;}
        fputcsv($output, array($p->getFullName(), $p->getUsername(), core_crypto::decrypt( $p->getPass() ), $lastlog, $p->getStatus()));
    }
    fclose($output);
    die();
?>