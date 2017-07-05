<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta name="description" content="home page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<title>Home Page</title>
		<link rel="stylesheet" href="stylesheet.css" />
		
		

	</head>
	<body>
		
		<?php
			include 'Header.php';
		?>
		
		<div class="middle">
		
			<div class="content">
				
				<div class="slideshow" style="float:left">
					<img class="slides" src="Fish.PNG" alt="fish" height="536" width="559"/>
					<img class="slides" src="Logo.PNG" alt="logo" height="536" width="559" />
				</div>
			
				<div class="info">
					<p>Product Name</p>
					<p>Product Price</p>
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
		
		
		<script>
			var index = 0;
			carousel();

			function carousel() {
				var i;
				var x = document.getElementsByClassName("slides");
				for (i = 0; i < x.length; i++) {
				   x[i].style.display = "none";  
				}
				index++;
				if (index > x.length) {index = 1}    
				x[index-1].style.display = "block";  
				setTimeout(carousel, 2000); // Change image every 2 seconds
			}//used tutorial at https://www.w3schools.com/w3css/w3css_slideshow.asp
		</script>		
		
		
	</body>
</html>