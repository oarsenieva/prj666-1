<?php


     $target_dir = "/data/www/default/prj/template/blue2/images/";
     $target_file = $target_dir . "101.jpg";//basename($_FILES["good_image"]["name"]);
     $uploadOk = 1;
  
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
  /*   if (file_exists($target_file)) {
         // if the logo exists, delete it.
        // unlink($target_file);
        $uploadOk = 0;
        $image = $target_file;
        echo "File already exists";
     }*/
     
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
     } else {
         if (move_uploaded_file($_FILES["good_image"]["tmp_name"], $target_file)) {
             echo "The file <b>" . $target_file . "</b> has been uploaded";//basename($_FILES["fileToUpload"]["name"]) . "</b> has been uploaded.";
             $image = $target_file;
             echo $image;
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     }
     echo '<p><p><a href="index.php">Back</a></p></p>';

?>