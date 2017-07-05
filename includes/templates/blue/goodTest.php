<?php
include_once("../../production/tools/good.php");
include_once("../../production/tools/sql.php");


    $db = Database::getInstance();

    //create an object
    $good = new Good($db);
    
    //get all  
    echo "get all test<br>";
    $alldata = $good->getAllGoods(4);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] $row[category_id] $row[category_description]<br />";
    }    
   
    //get one
    echo "<br/>get one test<br>";
    $alldata = $good->getGoodDetail(6);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] $row[sale_name]<br />";
    }    

    echo "<br/>get row test 3 variables<br>";
    $alldata = $good->getGoodRows(4, 2, 3);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] $row[category_id] $row[category_description]<br />";
    }  
  
    echo "<br/>get row test 2 category 4, limit 3<br>";
    $alldata = $good->getGoodRows(4, 3);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] $row[category_id] $row[category_description]<br />";
    }    
    //add one
    echo "<br/>add new test<br>";

    if($good->addGood("Doe", "a female deer", "test good table 1", 40.50, 100,5,1,1,4)){
        echo "add good #1 success<br/>";
    }else{
        echo "add good #1 fail, <br/>";
    }
 
    if($good->addGood("yodle", "images/fish.png", "the yodeling fish", 40.50, 100,5,1,1,4)){
        echo "add good #2 success<br/>";
    }else{
        echo "add good #2 fail<br/>";
    } 
 
    //edit one
    echo "<br/>edit existing test<br>";
    if($good->editGood(7, "test", "images/fish.png", "test description edit", 40.50, 100,5,1,1,4, 1)){
        echo "edit good #7 success<br/>";
    }else{
        echo "edit good #7 fail<br/>";
    }

    echo 1;

    //delete one
    echo "<br>delete existing test<br>";
    if($good->deleteGood(65)){
        echo "delete good #8 success<br/>";
    }else{
        echo "delete good #8 fail<br/>";
    }

    //get all  

    echo "<br>listing goods again<br>";
    $alldata = $good->getAllGoods(4);
    while($row = mysqli_fetch_assoc($alldata)){
        echo "$row[good_id] $row[good_name] $row[good_description] <br />";
    }    

?>
