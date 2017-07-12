<div class="categories">
	<ul>
        <?php

       // $db = Database::getInstance();
    
      //  $alldata = $category->getAll();
        mysqli_data_seek($allcategory, 0);
        while ($row = mysqli_fetch_assoc($allcategory /*$alldata*/)){
        ?>
		<li><a href="GoodList.php?cid=<?php echo "$row[category_id]";?>"><?php echo "$row[category_name]";  ?></a></li>
        <?php
        }
        ?>
	</ul>
</div>