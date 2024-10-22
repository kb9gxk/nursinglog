<?php

	//var_dump($_POST);
	$initEntry = $_REQUEST['initEntry'];
	$entBy = $_REQUEST["entBy"];
	$RA1 = $_REQUEST["RA1"];
	$RA2 = $_REQUEST["RA2"];
	$RA3 = $_REQUEST["RA3"];
	$RA4 = $_REQUEST["RA4"];
	$RA5 = $_REQUEST["RA5"];
	$RL1 = $_REQUEST["RL1"];
	$RL2 = $_REQUEST["RL2"];
	$RL3 = $_REQUEST["RL3"];
	$RL4 = $_REQUEST["RL4"];
	$RL5 = $_REQUEST["RL5"];
	$RL5Desc = $_REQUEST["RL5Desc"];
	$OL1 = $_REQUEST["OL1"];
	$OL2 = $_REQUEST["OL2"];
	$OL3 = $_REQUEST["OL3"];
	$OL4 = $_REQUEST["OL4"];
	$OL5 = $_REQUEST["OL5"];
	$OL6 = $_REQUEST["OL6"];
	$OL6Desc = $_REQUEST["OL6Desc"];
	$RiskDesc = $_REQUEST["RiskDesc"];
	$RiskPlan = $_REQUEST["RiskPlan"];
	$Triggers = $_REQUEST["Triggers"];
	$Assigned = $_REQUEST["Assigned"];
	$Date = $_REQUEST["Date"];
	$Reassess = $_REQUEST["Reassess"];
	$Completed = $_REQUEST["Completed"];
	$CompletedOn = $_REQUEST["CompletedOn"];
	$Resident = trim($_REQUEST["Lname"]) . ', ' . trim($_REQUEST["Fname"]);
	$PDFName = $Resident . ' - ' . $_REQUEST['Date2'] . ' - ' . $_REQUEST['Time'] . '.pdf';
	// FDF header section
	$fdf_header = <<<FDF
%FDF-1.2
%����
1 0 obj
<<
/FDF
<<
/Fields
[

FDF;

// FDF footer section
			$fdf_footer = <<<FDF
]
>>
>>
endobj
trailer
<<
/Root 1 0 R
>>
%%EOF

FDF;

// FDF content section
			$fdf_content = "<</T(Resident)/V({$Resident})>>\n";
	$fdf_content .= "<</T(RA1)/V({$RA1})>>\n";
	$fdf_content .= "<</T(RA2)/V({$RA2})>>\n";
	$fdf_content .= "<</T(RA3)/V({$RA3})>>\n";
	$fdf_content .= "<</T(RA4)/V({$RA4})>>\n";
	$fdf_content .= "<</T(RA5)/V({$RA5})>>\n";
	$fdf_content .= "<</T(RL1)/V({$RL1})>>\n";
	$fdf_content .= "<</T(RL2)/V({$RL2})>>\n";
	$fdf_content .= "<</T(RL3)/V({$RL3})>>\n";
	$fdf_content .= "<</T(RL4)/V({$RL4})>>\n";
	$fdf_content .= "<</T(RL5)/V({$RL5})>>\n";
	$fdf_content .= "<</T(RL5Desc)/V({$RL5Desc})>>\n";
	$fdf_content .= "<</T(OL1)/V({$OL1})>>\n";
	$fdf_content .= "<</T(OL2)/V({$OL2})>>\n";
	$fdf_content .= "<</T(OL3)/V({$OL3})>>\n";
	$fdf_content .= "<</T(OL4)/V({$OL4})>>\n";
	$fdf_content .= "<</T(OL5)/V({$OL5})>>\n";
	$fdf_content .= "<</T(OL6)/V({$OL6})>>\n";
	$fdf_content .= "<</T(OL6Desc)/V({$OL6Desc})>>\n";
	$fdf_content .= "<</T(RiskDesc)/V({$RiskDesc})>>\n";
	$fdf_content .= "<</T(RiskPlan)/V({$RiskPlan})>>\n";
	$fdf_content .= "<</T(Trigger)/V({$Triggers})>>\n";
	$fdf_content .= "<</T(Assigned)/V({$Assigned})>>\n";
	$fdf_content .= "<</T(Date)/V({$Date})>>\n";
	$fdf_content .= "<</T(entBy)/V({$entBy})>>\n";
	$fdf_content .= "<</T(Reassess)/V({$Reassess})>>\n";
	$fdf_content .= "<</T(Completed)/V({$Completed})>>\n";
	$fdf_content .= "<</T(CompletedOn)/V({$CompletedOn})>>\n";
	$content = $fdf_header . $fdf_content . $fdf_footer;
	// Creating a temporary file for our FDF file.
	//die($content);
	$file = tmpfile();
	$FDFfile = stream_get_meta_data($file) ['uri'];
	//die($FDFfile);
	fwrite($file, $content);
	fseek($file, 0);
	//file_put_contents($FDFfile, $content);
	//die(readfile($FDFfile));
	// Merging the FDF file with the raw PDF form
	shell_exec("pdftk RiskMit.pdf fill_form $FDFfile output 'RiskMit/" . PREFIX . "/$PDFName' flatten owner_pw bt6pine6 allow Printing drop_xmp drop_xfa");
	//die($result);
	// Removing the FDF file as we d'On''t need it anymore
	//unlink($FDFfile);
	core_error::removeErrors();
	$Resident = trim($_REQUEST["Lname"]) . ', ' . trim($_REQUEST["Fname"]);
	$p = risk::create($initEntry, $entBy, $Resident, $RA1, $RA2, $RA3, $RA4, $RA5, $RL1, $RL2, $RL3, $RL4, $RL5, $RL5Desc, $RiskDesc, $RiskPlan, $Triggers, $OL1, $OL2, $OL3, $OL4, $OL5, $OL6, $OL6Desc, $Assigned, $Date, $Reassess, $PDFName);
	if ($p === null) {
		core_error::setError("An error occurred creating that entry.  Please try again.");
		header("Location:" . base_url . "log");
		exit;
	}
	else {
		core_error::setError("Everything was successful.");
		header("Location:" . base_url . "log?risk=".$PDFName);
		exit;
	}
	ob_end_clean();
	ob_end_flush();
	//header('Content-Description: File Transfer');
	header('Content-Type: application/pdf');
	//header('Content-Disposition: attachment; filename="' . $Resident . ' ' . $_REQUEST["Date2"] . '.pdf"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize('RiskMit/' . PREFIX . '/' . $PDFName));
	readfile('RiskMit/' . PREFIX . '/' . $PDFName);
	//unlink($PDFName);
	fclose($file);
	die();
?>