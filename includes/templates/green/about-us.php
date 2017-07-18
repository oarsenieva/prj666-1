<!doctype html>
<html>
<head>
</head>
<body>
<div class="clearfix borderbox" id="page"><!-- column -->
<?php include("metadata.php");?>
<?php include("header.inc");?>
<?php
$url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
if (file_exists($url)) {
  $content = file_get_contents($url);
  echo $content;
}
?>
<?php include("footer.php");?>
 </div>
</body>
</html>
