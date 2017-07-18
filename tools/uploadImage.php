<?php

    
     $target_dir = "/data/www/default/wecreu/images/";
     $target_file = $target_dir . $_FILES["good_image"]["name"];//"101.jpg";//basename($_FILES["good_image"]["name"]);
     $uploadOk = 1;

    echo "uploadImage.php runs, files [name]".$_FILES["good_image"]["name"].", [type]".$_FILES["good_image"]["type"].", [size]".$_FILES["good_image"]["size"]." [tmp name]".$_FILES["good_image"]["tmp_name"]." [error]".$_FILES["good_image"]["error"];
   

    if(isset($_POST["submit"])) { //from https://www.w3schools.com/php/php_file_upload.asp
        //$check = getimagesize($_FILES["good_image"]["name"]);
        $check = $FILES['good_image']['size'];
        if($check != 0) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
         // if the logo exists, delete it.
        unlink($target_file);
        $uploadOk = 0;
       // $image = $target_file;
        echo "File already exists";
    }

    if($_FILES["good_image"]["size"] > 500000){
        echo "file is too large";
        $uploadOK = 0;
    }

     // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
    } else {
         if (move_uploaded_file($_FILES["good_image"]["tmp_name"], $target_file)) {
             echo "The file <b>" . $target_file . "</b> has been uploaded";//basename($_FILES["fileToUpload"]["name"]) . "</b> has been uploaded.";
             echo "image ".$image;
             $image = "../../../images/".$_FILES["good_image"]["name"];//$target_file;
             $imageVer=true;
             echo " is set to ".$image." $imageVer= ".$imageVer."<br/>";
             echo "FILES is ".$_FILES["good_image"]["tmp_name"]."<br/>";
        } else {
             echo "Sorry, there was an error uploading your file.";
        }
    }
    

    function removeImage($image){
        $filename = preg_split("/^.+\.\w{3}$/", $image, PREG_SPLIT_NO_EMPTY);
        echo "<br/>got filename ".$filename." size<br/>";
        if (file_exists($target_file."/".$filename)) {
            echo "<br/> found file ".$target_file."/".$filename." deleting!  <br/>";
           // fclose($target_file);
            //unlink($target_file);
        }
    }

?>