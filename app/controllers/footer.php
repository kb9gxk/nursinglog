<?php
	if (!($GLOBALS["args"][0] == 'index') && !($GLOBALS["args"][0] == 'maint') && !($GLOBALS["args"][0] == 'login')) {
		$myfoot = '    <script src="[::asset::]footer.js?random=' . SessRnd .'"></script>';
		$showip = "";
	}
	else {
		$myfoot = "";
		$showip = "<br><br>\nServer IP: " .
        getExternalIpAddress() .
        " &mdash; Your IP: " .
        getRealIpAddr() .
        "\n";
	}
	$date = date('m/d/Y');
	$time = date('g:i a');
	$foot = "     <script nonce='IyMzQab2zT8E9bC8'>\r\n";
	$foot .= "      $('#entDate').datetimepicker({\r\n";
	$foot .= "          inline: true,\r\n";
	$foot .= "          lang: 'en',\r\n";
	$foot .= "          timepicker: true,\r\n";
	$foot .= "          format: 'm/d/Y g:i a',\r\n";
	$foot .= "          formatDate: 'm/d/Y',\r\n";
	$foot .= "          formatTime: 'g:i a',\r\n";
	$foot .= "          step: 5,\r\n";
	$foot .= "          maxDate: '0',\r\n"; 	// Show only today and past dates
	$foot .= "          defaultDate: '" . $date . "',\r\n";
	$foot .= "          defaultTime: '" . $time . "',\r\n";
	$foot .= "          defaultSelect: true\r\n";
	$foot .= "      });\r\n";
	$foot .= "    </script>\r\n";
	$copy = date('Y');
	return (array('foot' => $foot, 'myfoot' => $myfoot, 'revised'=>version(), 'copy' => $copy, 'ip' => $showip));
?>