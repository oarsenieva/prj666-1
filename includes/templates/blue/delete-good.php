<?php

    include '../../tools/good.php';

    $db = Database::getInstance();
    
    $good = new Good($db);

    if($good->deleteGood($_GET["gid"])){
        echo "successfully deleted good <br/>";
    } else {
        echo "failed to delete good <br/>";
    }
    
?>