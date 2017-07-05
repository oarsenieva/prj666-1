<div class="categories">
	<ul>
        <?php
     //   include '../../tools/category.php';
     //   echo "Found file";

        $db = Database::getInstance();
     //   $category = new Category($db,1);
      //  echo "getting good object";
        $alldata = $category->getAll();
      //  echo "getting goods list";
       
        while ($row = mysqli_fetch_assoc($alldata)){
        ?>
		<li><a href="GoodList.php?cid=<?php echo "$row[category_id]";?>"><?php echo "$row[category_name]";  ?></a></li>
        <?php
        }
        ?>	
	</ul>
</div>