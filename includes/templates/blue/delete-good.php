<?php
/*
require_once '/data/www/default/wecreu/core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}*/


    include '/data/www/default/wecreu/tools/good.php';
    include_once '/data/www/default/wecreu/tools/sql.php';

    //echo "file found<br/>";
    $db = Database::getInstance();
    $good = new Good($db);

    $alldata = $good->getGoodDetail($_GET["gid"]);
    $row = mysqli_fetch_assoc($alldata);

    $filename = pathinfo($row['good_image'], PATHINFO_BASENAME);

    $deletepath = "/data/www/default/wecreu/images/".$filename;

 //   echo "deleting good ".$_GET["gid"]." , ".$row['good_name']." and file ".$deletepath."<br/>";

    if (is_file($deletepath)) {
      //  echo "<br/> found file ".$deletepath." deleting!  <br/>";
          //  fclose($deletepath);
            unlink($deletepath);
    }

    if( $good->deleteGood($_GET["gid"])){
        echo "<script type='text/javascript'>alert('successfully deleted good') </script>";
    } else {
        echo "<script type='text/javascript'>alert('failed to delete good') </script>";
    }
    header('Location: manage-good.php');
    exit();
?>