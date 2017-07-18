<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="good detail page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Good Detail</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				
                <?php
                   // include '../../tools/good.php';
               //     echo "Found file";
                    $db = Database::getInstance();
                    $good = new Good($db);
                //    echo "getting good object";
                    $alldata = $good->getGoodDetail($_GET["gid"]);
                    $row = mysqli_fetch_assoc($alldata);
                    $imagepath = $row['good_image'];
                ?>
                
				<div class="goodimage" >     
					<img src='<?php echo $imagepath;  ?>' alt="good image" height="200" width="200" />
				</div>
				<div class="goodinfo">

                    <table style="width:100%">
						<tr>
							<td>Product Name: <?php echo "$row[good_name]";  ?></td>                            
							<td>Quantity: <?php echo "$row[good_in_stock]";  ?></td>
						</tr>
						<tr>
							<td>Category: <?php echo "$row[category_name]";  ?></td>                        
							<td>Weight: <?php echo "$row[good_weight]";  ?></td>
						</tr>
						<tr>
							<td>Price: <?php echo "$row[good_price]";  ?></td>                           
							<td>Taxable: <?php if(isset($row['good_taxable'])){
                                                    if($row['good_taxable']==1){
                                                        echo "Taxable $row[good_taxable]";
                                                    }else {
                                                        echo "Not Taxable $row[good_taxable]";
                                                    }
                                                }else{
                                                    echo "No information";
                                                }  ?></td>
						</tr>
                        <tr>
                            <td>Sales Applicable: <?php if(isset($row['sale_id'])){
                                                            echo "$row[sale_name]"; 
                                                        }else{
                                                            echo "Not on Sale";
                                                        }?></td>     
                            <td></td>
                        </tr>
					</table>
                    <table style="width:100%">
						<tr >
							<td> Description:<?php echo "$row[good_description]";  ?></td>
						</tr>
						<tr>
							<td><a class="button" href="cartAction.php?action=addToCart&id=<?php echo $row["good_id"]; ?>">Add to cart</a></td>
						</tr>
					</table>
				</div>
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
