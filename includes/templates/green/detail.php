<?php
include '/data/www/default/wecreu/tools/sql.php';
include '/data/www/default/wecreu/tools/good.php';
include '/data/www/default/wecreu/tools/csql.php';

//get rows query
$query = $dbc->query("SELECT * FROM good ORDER BY good_id");
$cc = $query->fetch_assoc();

$db = Database::getInstance();
$good = new Good($db);
//    echo "getting good object";
$alldata = $good->getGoodDetail($_GET["gid"]);

$row = mysqli_fetch_assoc($alldata);
$imagepath = $row['good_image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title>Green Template</title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
    <?php include("header.inc") ?>
</header>
<div class="container mb-2">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link text-white" href="index.php">Home</a>
        <a class="nav-item nav-link active" href="products.php">Products</a>
        <a class="nav-item nav-link text-white" href="cart.php">Cart</a>
        <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
    </nav>
</div>
<div class="container mb-5">
    <nav class="nav nav-pills nav-fill">
      <?php
          $alldata = $category->getAllAvaliable();
          echo "<a class='nav-item nav-link text-white' href='products.php'>All categpries</a>";
          while ($row = mysqli_fetch_assoc($alldata)) {
              echo "<a class='nav-item nav-link text-white' href='products.php?cid=$row[category_id]'>$row[category_name]</a>";
          }
          ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="text-center mb-5">
        <img src="images/cow.jpg" alt="cow" class="rounded">
    </div>
    <div class="container text-center mb-5">
        <div class="container row">
        <section class="col-sm-6"><button type="button" class="btn btn-primary" style="width: 150px">
                <a class="text-white" href="cartAction.php?action=addToCart&id=<?php echo $cc["good_id"]; ?>">Add to cart</a>
            </button></section>
        <section class="col-sm-6"><button type="button" class="btn btn-default" style="width: 150px">Back</button></section>
        </div>
    </div>
    <div class="container text-center">
        <div class="container row">
            <section class="col-md-6"><p>Product Name: <?php echo "$row[good_name]";  ?></p></section>
            <section class="col-md-6"><p>Quantity: <?php echo "$row[good_in_stock]";  ?></p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Category: <?php echo "$row[category_name]";  ?></p></section>
            <section class="col-md-6"><p>Weight: <?php echo "$row[good_weight]";  ?> lbs</p></section>
        </div>
        <div class="container row">
            <section class="col-md-6"><p>Description: <?php echo "$row[good_description]";  ?></p></section>
            <section class="col-md-6"><p></p></section>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
