<?php
/*require_once '/data/www/default/wecreu/core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Wecreu</title>
</head>
<body>
        <!--used tutorial https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_escapechar 
            and https://www.w3schools.com/php/php_form_required.asp -->
		<?php
			include 'Header.php';
            

           // $db = Database::getInstance();
           // $category = new Category($db,1);
          //  $allcategory = $category->getAll();
            
            $id =  $_GET["gid"];
            $good = new Good($db);
            $alldata = $good->getGoodDetail($id);
            $row = mysqli_fetch_assoc($alldata);     
                                        
            $name = $row['good_name'];
            $image = $row['good_image'];
            $description = $row['good_description'];
            $price = $row['good_price'];
            $quantity = $row['good_in_stock'];
            $weight = $row['good_weight'];
            $taxable = $row['good_taxable'];
            $visible = $row['good_visible'];
            $category = $row['category_id'];

            $sale = $row['sale_id'];
            $nameErr = $imageErr = $descriptionErr = $priceErr = $quantityErr = $weightErr = $taxableErr = $visibleErr = $categoryErr = "";
            $taxable = $visible = 0;
            $nameVer = $imageVer = $descVer = $priceVer = $qtyVer = $weightVer = $catVer = false; 
            
            if($_POST){
                include '/data/www/default/wecreu/tools/goodValidate.php';


           //     echo "<br/>edit-good.php is getting ready to edit good ".$id." in db<br/>";
             //   echo "$nameVer, $imageVer, $descVer, $priceVer, $qtyVer, $weightVer, $catVer Calling DB<br/>";

                if($nameVer == true && $imageVer == true && $descVer == true && 
                   $priceVer == true && $qtyVer == true && $weightVer == true && 
                   $catVer == true){

                      
                //    echo "editing new good ".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category."<br/>";

                    if($good->editGood($id, $name, $image, $description, $price, $quantity, $weight, $taxable, $visible, $category, $sale)){
                        echo "<script type='text/javascript'>alert('Good has been updated') </script>";                             
                      //  echo "updated successfully good ".$id.",".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category.",".$sale."<br/>";
                    } else {
                        echo "<script type='text/javascript'>alert('Database error received while updating good') </script>";
                      //  echo "error received updating good ".$id.",".$name.",".$image.",".$description.",".$price.",".$quantity.",".$weight.",".$taxable.",".$visible.",".$category.",".$sale."<br/>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Failed to update good') </script>";

                }

            }

        ?>

		<div class="middle">
		
			<div class="content">

    <h2>Edit good information</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?gid=".$id;?>" style="" method="post" enctype="multipart/form-data" >
        <fieldset>
        <legend></legend>
            <table>
                <tr>
                    <td><label for="good_name"><span>*</span> Name</label></td>
                    <td><input type="text" name="good_name" id="good_name" placeholder="Name of good" value="<?php echo $name;?>" readonly/></td>
                    <td style="color:#ff0000;"><?php echo $nameErr;?></td>
                </tr>
                <tr >
                    <td><label  for="good_image"><span >*</span> Image</label></td>
                    <td><input  type="file" name="good_image" id="good_image" accept="image/x-png,image/jpeg" placeholder="Enter filepath of good image" value="<?php echo $image;?>" /></td>
                    <td style="color:#ff0000;"><?php echo $imageErr;?></td>
                </tr>
                <tr>
                    <td><label for="description"><span>*</span> Description</label></td>
                    <td><textarea rows="3" name="description" id="description" placeholder="Enter description"><?php echo $description;/*echo escape(Input::get('client_info'))*/?></textarea></td>
                    <td style="color:#ff0000;"><?php echo $descriptionErr;?></td>
                </tr>
                <tr>
                    <td><label for="good_price"><span>*</span>&nbspPrice ($)</label></td>
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
            </table>
        </fieldset>
        <div >
            <input type="hidden" name="token" value="">
            <input class="submit" type="submit" value="Submit" />
        </div>
    </form>
                <?php 
                  /*  echo "Input: <br/>";
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
                    echo $category;*/
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
<?php /*include('includes/footer.inc');*/ ?>


</body>
</html>
