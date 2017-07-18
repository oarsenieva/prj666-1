<?php
//include 'conf.ini';

include 'csql.php';
    $isValid = true; 
	$proceed = 0;
  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

     

        if(empty($_POST["name"])){

       
            $nameErr = "Please enter your name";
			$isValid=false;
        } else {
            
          //  echo "good_name is not empty, processing...<br/>";
            $name = validate($_POST["name"]);
            if(strlen($name) > 100){
				$isValid=false;
                $nameErr = "Name must be less that 100 characters, contains ".strlen($name);
            } else {
                $nameErr = "";
            }
        
		}
      //  echo "checking good_image<br/>";
		
        if(!empty($_POST["address"])){

         //   echo "good_image is not empty, processing...<br/>";
            $address = validate($_POST["address"]);
            if(strlen($address) > 300){
				$isValid=false;
                $addressErr = "Address must be under 300 characters ";
            } else {
				$addressErr = "";
                
            }
        }
		else{
			$addressErr = "Please enter an address";
		}		

      //  echo "checking description<br/>";
        if(!empty($_POST["number"])){

        //    echo "description is not empty, processing...<br/>";
            $phone = validate($_POST["number"]);
            if(strlen($phone) > 14){
                $phoneErr = "Phone number can't exceed 14 numbers ".strlen($phone);
				$isValid=false;
            } else if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
				$phoneErr = "Phone number must follow this format 000-000-0000";
				$isValid=false;
			} 
			else{
                $phoneErr = "";
            }
        }else{
			$phoneErr = "Please enter an phone number";
		}

     //   echo "checking good_price<br/>";
        if(empty($_POST["city"])){

       //     echo "good_price is empty<br/>";
            $cityErr = "Please enter a city";
			$isValid=false;
        }else if(strlen($_POST["city"])>100){
			$cityErr = "City name must be under 100 characters";
			$isValid=false;
		}
		else {
                $cityErr = "";
            
        }
		
		if(empty($_POST["state"])){

       //     echo "good_price is empty<br/>";
            $stateErr = "Please enter a state";
			$isValid=false;
        }else if(strlen($_POST["state"])>100){
			$cityErr = "State name must be under 100 characters";
			$isValid=false;
		}
		else {
                $stateErr = "";
            
        }
		
		if(empty($_POST["country"])){

       //     echo "good_price is empty<br/>";
            $countryErr = "Please enter a country";
			$isValid=false;
        }else if(strlen($_POST["country"])>100){
			$cityErr = "country name must be under 100 characters";
			$isValid=false;
		}
		else {
                $countryErr = "";
            
        }
		
		if(empty($_POST["email"])){

       //     echo "good_price is empty<br/>";
            $emailErr = "Please enter your email";
			$isValid=false;
        }else if(strlen($_POST["email"])>100){
			$cityErr = "email name must be under 150 characters";
			$isValid=false;
		}
		else {
                $emailErr = "";
            
        }
   
    }

   // echo "setting client_id ...";
    //$clientid=file_get_contents("conf.ini");
	//echo $clientid;
    //$clientVer = true; 
 //   echo " to ".$clientid." and clientVer = ".$clientVer."<br/>";

  //  echo "calling uploadImage script<br/>";
    //include 'uploadImage.php';
  
 //   echo "goodValidate getting ready to insert into db<br/>";
  //  echo "$nameVer, $imageVer, $descVer, $priceVer, $qtyVer, $weightVer, $catVer, $clientVer Calling DB<br/>";

    if($isValid){

        //$cart = new Cart();
		
        $name = $_POST["name"];
		$address = $_POST["address"];  
		$number = $_POST["number"];  
		$city = $_POST["city"];  
		$state = $_POST["state"];  
		$country = $_POST["country"];  
		$email = $_POST["email"];  		
		
		
        //echo "adding new customer ".$name.",".$number.",".$address.",".$city.",".$state.",".$country.",".$email."<br/>";
		$test = $dbc->query("INSERT INTO customer(customer_name, customer_number, customer_street_address, customer_city, customer_state, customer_country, customer_email) 
                      VALUES ('".$name."','".$number."', '".$address."','".$city ."', '".$state."', '".$country."', '".$email."')");
					  
		$confirm ="Successfully Added";			  
					  
        if($test){
           
            $confirm ="Successfully Added";
			$proceed = 1;
			$proc=1;
          

        } else {
            echo "error received adding new customer ".$name.",".$number.",".$address.",".$city.",".$state.",".$country.",".$email."<br/>";

        }
    }
    

    function validate($data){
    //    echo "--function validate(".$data.") called<br/>";
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

?>