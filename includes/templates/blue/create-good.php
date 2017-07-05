<?php
/*require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Wecreu</title>
</head>
<body>
        <!--used tutorial https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_escapechar 
            and https://www.w3schools.com/php/php_form_required.asp -->
		<?php
			include 'Header.php';
            

            $db = Database::getInstance();
            $category = new Category($db,1);
            $allcategory = $category->getAll();
            
      
                                        
            $name = $image = $description = $price = $quantity = $weight = $taxable = $visible = $category = "";
            
            $nameErr = $imageErr = $descriptionErr = $priceErr = $quantityErr = $weightErr = $taxableErr = $visibleErr = $categoryErr = "";

            if($_POST){
                include 'goodValidate.php';
            }
        //    include 'uploadImage.php';
            
		?>
<!--
<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php /*echo escape($user->data()->username); */?>">Profile</a>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php /*echo escape($user->data()->username); */?>"><?php /*echo escape($user->data()->username);*/ ?></a>!</h1>
</nav>-->

		<div class="middle">
		
			<div class="content">

                <h2 >Fill out form to add a new good to inventory</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="" method="post" enctype="multipart/form-data" >
                    <fieldset >
                    <legend></legend>
                        <table>
                            <tr >   
                                <td><label  for="good_name"><span >*</span> Name</label></td>
                                <td><input  type="text" name="good_name" id="good_name" placeholder="Enter name for good" value="<?php echo $name;?>" ></td>
                                <td style="color:#ff0000;"><?php echo $nameErr;?></td>
                            </tr>
                            <tr >
                                <td><label  for="good_image"><span >*</span> Image</label></td>
                                <td><input  type="file" name="good_image" id="good_image" accept="image/x-png,image/jpeg" placeholder="Enter filepath of good image" value="<?php echo $image;?>" /></td>
                                <td style="color:#ff0000;"><?php echo $imageErr;?></td>
                           </tr>
                            <tr>
                                <td><label for="description"><span >*</span> Description</label></td>
                                <td><textarea rows="3" name="description" id="description" placeholder="Enter description" ><?php echo $description;/*echo escape(Input::get('client_info'))*/?></textarea></td>
                                <td style="color:#ff0000;"><?php echo $descriptionErr;?></td>
                           </tr>
                            <tr>
                                <td><label for="good_price"><span >*</span>&nbspPrice ($)</label></td>
                                <td><input type="number" min="0.01" step="0.01" name="good_price" id="good_price" style="width: 90px;" value="<?php echo $price;?>" /></td>
                                <td style="color:#ff0000;"><?php echo $priceErr;?></td>
                            </tr>
                            <tr>
                                <td><label for="good_quantity"><span >*</span>&nbspQuantity
                                    </label></td>
                                <td><input type="number" min="0" step="1" name="good_quantity" id="good_quantity" style="width: 90px;" value="<?php echo $quantity;?>" /></td>
                                <td style="color:#ff0000;"><?php echo $quantityErr;?></td>
                            </tr>
                            <tr>  
                                <td><label for="good_weight"><span >*</span>&nbspWeight (pounds)</label></td>
                                <td><input type="number" min="0.01" step="0.01" name="good_weight" id="good_weight" style="width: 90px;" value="<?php echo $weight;?>" /></td>
                                <td style="color:#ff0000;"><?php echo $weightErr;?></td>
                            </tr>
                            <tr>
                                <td><label  for="taxable">Taxable</label></td>
                                <td><input style="margin-left: 10px;" type="checkbox" name="taxable" id="taxable"  value="tax" <?php if(isset($taxable) && $taxable==true) echo "checked";?>/></td>
                                <td style="color:#ff0000;"><?php echo $taxableErr;?></td>
                            </tr>
                            <tr>
                                <td><label  for="visible">Visible</label></td>
                                <td><input style="margin-left: 10px;" type="checkbox" name="visible" id="visible" value="visible" <?php if(isset($visible) && $visible==true) echo "checked";?>/></td>
                                <td style="color:#ff0000;"><?php echo $visibleErr;?></td>
                            </tr>
                            <tr>
                                <td><label  for="category_id">Category</label></td>
                                <td><select name="category_id" id="category_id" >
                                        <?php 
                                        while($row = mysqli_fetch_assoc($allcategory)){
                                            echo "<option value='$row[category_id]'>$row[category_name]</option>";
                                        }
                                        ?>
                                    </select>

                                </td>
                                <td style="color:#ff0000;"><?php echo $categoryErr;?></td>
                            </tr>

                        </table>


                    </fieldset>
                    <div >
                        <input type="hidden" name="token" value="">
                        <input class="submit" type="submit" value="Submit" />
                    </div>
                </form>

                <?php 
                    echo "Input: <br/>";
                    echo $name;
                    echo "<br/>";
                    echo $image; 
                    echo "<br/>";
                    echo $description;
                    echo "<br/>";
                    echo $price;
                    echo "<br/>";
                    echo $quantity;
                    echo "<br/>";
                    echo $weight;
                    echo "<br/>";
                    echo $taxable;
                    echo "<br/>";
                    echo $visible;
                    echo "<br/>";
                    echo $category;
                ?>

			</div>
			
			<?php
				include 'Categories.php';
			?>
		
		</div>
		
		<?php
			include 'Menu.php';
		?>
		
		<?php
			include 'Footer.php';
		?>

<?php /*include('includes/footer.inc'); */?>

</body>
</html>
