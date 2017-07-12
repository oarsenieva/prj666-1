<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="list of goods in a category" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Manage Goods</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
         //   include '../../tools/good.php';
           // include '../../tools/category.php';
            //   echo "Found file";
            $db = Database::getInstance();
            $category = new Category($db,1);
		?>
		
		<div class="middle">
		
			<div class="content">
                <a href="create-good.php" class="button">Add new good</a><br/>
				<!--<h3>Goods in Category:<?php /*$selectcategory;
                                            if(isset( $_GET["cid"])){
                                                $selectcategory = $_GET["cid"];
                                                $alldata = $category->getOne($selectcategory);
                                                $row = mysqli_fetch_assoc($alldata);
                                                echo "$selectcategory $row[category_name]"; 
                                            }else{
                                                $selectcategory = "*";
                                                echo "All"; 
                                            }*/?> </h3>-->
				
                <table>
                <?php
                   
                    $good = new Good($db);
                  //  echo "getting good object";
                    $alldata = $good->getAllGoods("*");
                 //   echo "getting goods list";
                   
                    while ($row = mysqli_fetch_assoc($alldata)){
                     //   echo "$row[good_name]<br/>";
                    ?>
                    <tr style="border-bottom:1px solid black;">
                        <td><a href="GoodDetail.php?gid=<?php echo "$row[good_id]";?>"><?php echo "$row[good_name]";  ?></a></td>
                        <td><img src=<?php echo "$row[good_image]"; ?> alt="good image" height="70" width="70" style="padding:20px 40px;"/></td>
                        <td>$<?php echo "$row[good_price]";  ?></td>
                        <td><a href="edit-good.php?gid=<?php echo "$row[good_id]";?>">Edit</a>|<a href="delete-good.php?gid=<?php echo "$row[good_id]";?>">Delete</a></td>
                    </tr>
                 <?php
                    }
                ?>
                </table>
				
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
			

	
	</body>
</html>