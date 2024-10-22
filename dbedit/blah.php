<?php /*
Copyright (c) 2007, Gur� Sistemas and/or Gustavo Adolfo Arcila Trujillo
All rights reserved.
www.gurusistemas.com

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer
      in the documentation and/or other materials provided with the distribution.
    * Neither the name of the Gur� Sistemas Intl nor Gustavo Adolfo Arcila Trujillo nor the names of its contributors may be used to
      endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS  "AS IS"  AND ANY EXPRESS  OR  IMPLIED WARRANTIES, INCLUDING,
BUT NOT LIMITED TO,  THE IMPLIED WARRANTIES  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,  INDIRECT,  INCIDENTAL, SPECIAL, EXEMPLARY,  OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF  USE, DATA, OR PROFITS;  OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

Please remember donating is one way to show your support, copy and paste in your internet browser the following link to make your donation
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=tavoarcila%40gmail%2ecom&item_name=phpMyDataGrid%202007&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8

For more info, samples, tips, screenshots, help, contact, forum, please visit phpMyDataGrid site
http://www.gurusistemas.com/indexdatagrid.php

For contact author: tavoarcila at gmail dot com or info at gurusistemas dot com
*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
    include ("phpmydatagrid.class.php");

    $objGrid = new datagrid;

    //$objGrid -> friendlyHTML();

    $objGrid -> closeTags(true);

    $objGrid -> poweredby = false;

    $objGrid -> form('abh_categories', true);

    $objGrid -> methodForm("post");

    $objGrid -> searchby("description");

    $objGrid -> strSearchInline = true;

    $objGrid -> toolbar = true;

    //$objGrid -> linkparam("sess=".$_REQUEST["sess"]."&username=".$_REQUEST["username"]);

    $objGrid -> decimalDigits(2);

    $objGrid -> decimalPoint(",");

    $objGrid -> conectadb("127.0.0.1", "bst", "bt6pine6", "bst");

    $objGrid -> tabla ("abh_categories");

    $objGrid -> buttons(true,true,false,false);

    $objGrid -> keyfield("id");

    //$objGrid -> salt("Some Code4Stronger(Protection)");

    //$objGrid -> TituloGrid("Editor");

    $objGrid -> FooterGrid("");

    $objGrid -> datarows(89);

    $objGrid -> paginationmode('mixed');

    $objGrid -> orderby("description", "ASC");

    $objGrid -> noorderarrows();

    //$objGrid -> FormatColumn("id", "ID", 5, 5, 1, "50", "center", "integer");
    $objGrid -> FormatColumn("first", "First Cat", 90, 90, 0, "90", "left");
    $objGrid -> FormatColumn("second", "Second Cat", 50, 50, 0, "90", "left");
    $objGrid -> FormatColumn("third", "Third Cat", 150, 150, 0, "150", "left");
    $objGrid -> FormatColumn("description", "Original Description", 500, 500, 1, "500", "left");

    $objGrid -> setHeader("blah.php");
?>
</head>

<body>
<?php
    /* AJAX inline edition comes in two flawors */
    /*	silent: To save record, just enter or double click */
    /*	default: To save record, must click icon */
    /* try yourself and see which one likes more (My preferred is silent) */
    $objGrid -> ajax("silent");

    $objGrid -> grid();

    $objGrid -> desconectar();
?>
</body>
</html>