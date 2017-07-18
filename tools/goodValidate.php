<?php
    echo "goodValidate starts<br/>";

  //  $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = $clientVer = false; 
  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        echo "got POST data<br/>";
     //   echo "checking good_name<br/>";

        if(empty($_POST["good_name"])){

        //    echo "good_name is empty<br/>";
            $nameErr = "Please enter a good name";

        } else {
            
          //  echo "good_name is not empty, processing...<br/>";
            $name = validate($_POST["good_name"]);
            if(strlen($name) > 100){
                $nameErr = "Name must be less that 100 characters, contains ".strlen($name);
            } else {
                $nameVer = true;
            }
        }

      /*   echo "<br/>received ".$_POST['good_image']."<br/>";
       if(!empty($_FILES["good_image"]['name'])){
            
            $imagelength = validate($_FILES["good_image"]['name']));
            if(strlen($image) > 256){
                $imageErr = "image file path must be less that 256 characters ".strlen($image);
            } else {
                echo "good_image is not empty, processing...image=".$image.", imageVer=".$imageVer."<br/>";
            */    
                echo "calling uploadImage script<br/>";
                include '/data/www/default/wecreu/tools/uploadImage.php';
         //   }
      /*  } else {
            echo "no image uploaded <br/>";
            $imageVer = true;
        }*/

      //  echo "checking description<br/>";
        if(!empty($_POST["description"])){

        //    echo "description is not empty, processing...<br/>";
            $description = validate($_POST["description"]);
            if(strlen($description) > 300){
                $descriptionErr = "Description must be less that 300 characters ".strlen($description);
            } else {
                $descVer = true;
            }
        }

     //   echo "checking good_price<br/>";
        if(empty($_POST["good_price"])){

       //     echo "good_price is empty<br/>";
            $priceErr = "Please enter a price";

        } else {

      //      echo "good_price is not empty, processing...<br/>";
            $price = validate($_POST["good_price"]);
            if(!preg_match("/^\d{1,8}\.\d{2}$/", $price)){
                $priceErr = "Price must be 8 digits, 2 decimals at most";
            } else {
                $priceVer = true;
            }
        }

   //     echo "checking good_quantiy<br/>";
        if(!empty($_POST["good_quantity"])){

       //     echo "good_quantity is not empty, processing...<br/>";
            $quantity = validate($_POST["good_quantity"]);
            if(!preg_match("/^\d{1,6}$/", $quantity)){
                $quantityErr = "Quantity must be 6 digits at most";
            } else {
                $qtyVer = true;
            }
        }

  //      echo "checking good_weight<br/>";
        if(!empty($_POST["good_weight"])){

      //      echo "good_weight is not empty, processing...<br/>";
            $weight = validate($_POST["good_weight"]);
            if(!preg_match("/^\d{1,6}\.\d{2}$/", $weight)){
                $weightErr = "Weight must be 6 digits, 2 decimals at most";
            } else {
                $weightVer = true;
            }
        }

    //    echo "checking taxable<br/>";
        if(empty($_POST["taxable"])){
            $taxable = 0;
       //     echo "<br/> taxable is empty, is set to ".$_POST['taxable']." and ".$taxable."<br/>";
        } else {
            $taxable = 1;
      //      echo "<br/> taxable is not empty, is set to ".$_POST['taxable']." and ".$taxable."<br/>";
        }

    //    echo "checking visible<br/>";
        if(empty($_POST["visible"])){
            $visible = 0;
     //       echo "<br/> visible is empty, is set to ".$_POST['visible']." and ".$visible."<br/>";
        } else {
            $visible = 1;
      //      echo "<br/> visible is not empty, is set to ".$_POST['visible']." and ".$visible."<br/>";
        }

     //   echo "checking category_id<br/>";
        if(empty($_POST["category_id"])){

        //    echo "category_id is empty<br/>";
            $categoryErr = "Please choose a category";

        } else {

         //   echo "category_id is not empty, processing...<br/>";
            $category = validate($_POST["category_id"]);
            $catVer = true;
        }
    }

   // echo "setting client_id ...";
    $clientid=1;
    $clientVer = true; 
 //   echo " to ".$clientid." and clientVer = ".$clientVer."<br/>";

 
    function validate($data){
     //   echo "--function validate(".$data.") called<br/>";
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

?>