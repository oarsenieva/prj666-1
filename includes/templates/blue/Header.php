<header>
	<?php
        include '/data/www/default/wecreu/tools/good.php';
        include '/data/www/default/wecreu/tools/category.php';

        $db = Database::getInstance();
        $category = new Category($db,1);
        $allcategory = $category->getAll();
    ?>
	<img src="../../images/logo.jpg" alt="logo" height="130" width="140" />
			
	<form>
		<input type="text" name="keyword" /> Search
	</form>
	<h1>Slideshow Template</h1>
			
</header>