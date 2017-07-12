<?php

    include '/data/www/default/wecreu/tools/good.php';

    //echo "file found<br/>";
    $db = Database::getInstance();
    //echo "get database<br/>";
    $good = new Good($db);
    //echo "deleting good ".$_GET["gid"]."<br/>";
    /*if(*/ $good->deleteGood($_GET["gid"]);//){
        //echo "successfully deleted good <br/>";
    //} else {
      //  echo "failed to delete good <br/>";
    //}
    header('Location: manage-good.php');
    exit();
?>