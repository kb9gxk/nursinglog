<?php
require_once base_path . '/vendor/autoload.php';

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header("X-Robots-Tag: noindex, nofollow", true);
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
$head = <<<MYHEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Release Notes</title>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secured Nursing Communication Log.  Do away with the paper.">
    <meta name="author" content="Jeff Parrish">
    <meta name="robots" content="noindex" />
    <base href="[::base_url::]"/>
    <!-- Bootstrap core CSS -->
    <link href="[::asset::]bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="[::asset::]bootstrap-dialog/dist/css/bootstrap-dialog.min.css" rel="stylesheet" />
    <link href="[::asset::]msgbox/themes/bootstrap/css/jquery.msgbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--<link href="[::asset::]font-awesome/css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="[::asset::]bootstrap-wysiwyg/bootstrap-wysiwyg.css" rel="stylesheet" />-->
    <link href="[::asset::]datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/1aca08576d.js"></script>
    </head>
    <body>
        <button type="button" onclick="window.open('', '_self', ''); window.close(); history.back(-1);">Close Window</button>
MYHEAD;
echo $head;
$fileContent = file_get_contents(base_path . "/app/changelog.md");
//$Parsedown = new Parsedown();

//echo $Parsedown->text($fileContent);
$parser = new \cebe\markdown\GithubMarkdown();
$parser->html5 = true;
echo $parser->parse($fileContent);
$foot = <<<MYFOOT
  <button type="button" onclick="window.open('', '_self', ''); window.close(); history.back(-1);">Close Window</button>
    </body>
</html>
MYFOOT;
echo $foot;
die();
?>