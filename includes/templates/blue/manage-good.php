<?php
/*require_once '/data/www/default/wecreu/core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}*/

?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="list of goods in all category for management" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Manage Goods</title>
		<link rel="stylesheet" href="css/stylesheet.css" />
		
	</head>
	<body>
		
		<?php
			include 'Header.php';
 
		?>
		
		<div class="middle">
		
			<div class="content">
                <a href="create-good.php" class="button">Add new good</a><br/>
				
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