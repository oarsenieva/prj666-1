<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">

<?php
$clientId = file_get_contents('conf.ini');
include_once('/data/www/default/wecreu/tools/category.php');
include_once("/data/www/default/wecreu/tools/sql.php");
include_once("/data/www/default/wecreu/tools/client.php");
include_once("/data/www/default/wecreu/tools/search.php");
$db = Database::getInstance();
$client = new Client($db, $clientId);
$category = new Category($db, $clientId);
$search = new Search($db, $clientId);
?>
