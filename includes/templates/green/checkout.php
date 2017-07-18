<?php
// include database configuration file
include 'sql.php';


$proceed=0;
//include validation file
if($_POST){
   include 'cartValidate.php';
   echo $proceed;
}

// initializ shopping cart class
include 'cartSession.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 4;



//$nameErr = $addressErr = $phoneErr = $cityErr = $stateErr = $countryErr = $emailErr = "";

// get customer details by session customer ID
$query = $dbc->query("SELECT * FROM customer WHERE customer_id = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
	.spaceOne{margin-left: 61px}
	.spaceTwo{margin-left: 43px}
	.spaceThree{margin-left: 20px}
	.spaceFour{margin-left: 70px}
	.spaceFive{margin-left: 62px}
	.spaceSix{margin-left: 45px}
	.spaceSeven{margin-left: 59px}
	
    </style>
</head>
<body>
<div class="container">
    <h1>Order Preview</h1>
	<p>Step 1: Fill out shipping detail fields and click submit</p>
	<p>Step 2: Once you recieve confirmation please press the place order button</p>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
			/*
			<p><?php echo $custRow['customer_name']; ?></p>
			<p><?php echo $custRow['customer_email']; ?></p>
			<p><?php echo $custRow['customer_city']; ?></p>
			<p><?php echo $custRow['customer_street_address']; ?></p>

		<form>
			Customer ID:<input type="text" name="custID" class="spaceThree" autofocus><br>
			Name:<input type="text" name="name" class="spaceOne"><br>
			Address:      <input type="text" name="address" class="spaceTwo"><br>
			Phone Number: <input type="text" name="number"><br>
			City: <input type="text" name="city" class="spaceFour"><br>
			State: <input type="text" name="state" class="spaceFive"><br>
			Country: <input type="text" name="country" class="spaceSix"><br>
			Email: <input type="text" name="email" class="spaceSeven"><br>
			
		cartAction.php?action=placeOrder
		</form>			
			*/
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].' CAD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' CAD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.round($cart->total()*1.13, 2) .' CAD'; ?></strong></td>
            <?php } ?>
        </tr>
		
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Shipping Details</h4>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="" method="post" enctype="multipart/form-data">
						
		
			Name:<input type="text" name="name" class="spaceOne" autofocus placeholder="Enter name"><br>
			<p style="color:#ff0000;"><?php echo $nameErr; ?></p>
			Address:      <input type="text" name="address" class="spaceTwo" placeholder="Enter address"><br>
			<p style="color:#ff0000;"><?php echo $addressErr; ?></p>
			Phone Number: <input type="text" name="number" placeholder="Enter phone number"><br>
			<p style="color:#ff0000;"><?php echo $phoneErr; ?></p>
			City: <input type="text" name="city" class="spaceFour" placeholder="Enter city"><br>
			<p style="color:#ff0000;"><?php echo $cityErr; ?></p>
			State: <input type="text" name="state" class="spaceFive" placeholder="Enter state"><br>
			<p style="color:#ff0000;"><?php echo $stateErr; ?></p>
			Country: <input type="text" name="country" class="spaceSix" placeholder="Enter country"><br>
			<p style="color:#ff0000;"><?php echo $countryErr; ?></p>
			Email: <input type="text" name="email" class="spaceSeven" placeholder="Enter email"><br>
			<p style="color:#ff0000;"><?php echo $emailErr; ?></p>
			
			<input class="submit" type="submit" value="Submit"/>
			</br>
			</br>
			<?php
				if($proceed==1){
			?>
			<p style="color:#1dff00;"><?php echo $confirm; ?></p>
			<?php
				}
			?>
		</form>
    </div>

    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
		<?php
		if($proceed){
		?>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
		<?php
		}
		?>
    </div>
</div>
</body>
</html>