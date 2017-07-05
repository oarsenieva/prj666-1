<?php

    $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = $clientVer = false; 

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["good_name"])){
            $nameErr = "Please enter a good name";
        } else {
            $name = validate($_POST["good_name"]);
            if(strlen($name) > 100){
                $nameErr = "Name must be less that 100 characters, contains ".strlen($name);
            } else {
                $nameVer = true;
            }
        }

        if(!empty($_POST["good_image"])){
            $image = validate($_POST["good_image"]);
            if(strlen($image) > 256){
                $imageErr = "image file path must be less that 256 characters ".strlen($image);
            } else {
                $imageVer = true;
            }
        } 

        if(!empty($_POST["description"])){
            $description = validate($_POST["description"]);
            if(strlen($description) > 300){
                $descriptionErr = "Description must be less that 300 characters ".strlen($description);
            } else {
                $descVer = true;
            }
        }

        if(empty($_POST["good_price"])){
            $priceErr = "Please enter a price";
        } else {
            $price = validate($_POST["good_price"]);
            if(!preg_match("/^\d{1,8}\.\d{2}$/", $price)){
                $priceErr = "Price must be 8 digits, 2 decimals at most";
            } else {
                $priceVer = true;
            }
        }

        if(!empty($_POST["good_quantity"])){
            $quantity = validate($_POST["good_quantity"]);
            if(!preg_match("/^\d{1,6}$/", $quantity)){
                $quantityErr = "Quantity must be 6 digits at most";
            } else {
                $qtyVer = true;
            }
        }

        if(!empty($_POST["good_weight"])){
            $weight = validate($_POST["good_weight"]);
            if(!preg_match("/^\d{1,6}\.\d{2}$/", $weight)){
                $weightErr = "Weight must be 6 digits, 2 decimals at most";
            } else {
                $weightVer = true;
            }
        }

        if(empty($_POST["taxable"])){
            $taxable = false;
        } else {
            $taxable = true;
        }
        if(empty($_POST["visible"])){
            $visible = false;
        } else {
            $visible = true;
        }
        if(empty($_POST["category_id"])){
            $categoryErr = "Please choose a category";
        } else {
            $category = validate($_POST["category_id"]);
            $catVer = true;
        }
    }

    $clientid=1;
    $clientVer = true; 

    include 'uploadImage.php';
  
    if($nameVer == true && $imageVer == true && $descVer == true && 
       $priceVer == true && $qtyVer == true && $weightVer == true && 
       $catVer == true && $clientVer == true){
        echo "$nameVer, $imageVer, $descVer, $priceVer, $qtyVer, $weightVer, $catVer, $clientVer Calling DB";
        $good = new Good($db);
          
        if($good->addGood($name, $image, $description, $price, $quantity, $weight, $taxable, $visible, $category)){
            echo "good added successfully";
          
            //$good->editGood();

            echo "upload file now in theory";


        } else {
            echo "error received";
        }
    }
    

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

?>