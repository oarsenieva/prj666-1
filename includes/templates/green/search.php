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
        $active="";
        if(!isset($_GET['cid'])){
            $active = 'active';
        }
        echo "<a class='nav-item nav-link text-white $active' href='products.php'>All categpries</a>";
        while ($row = mysqli_fetch_assoc($alldata)) {
            if (isset($_GET['cid']) && $row['category_id'] == $_GET['cid']){
                $active = 'active';
            }else{
                $active = '';
            }
            echo "<a class='nav-item nav-link text-white $active' href='products.php?cid=$row[category_id]'>$row[category_name]</a>";
        }
        ?>
    </nav>
</div>
<div class="container mb-5">
    <div class="form-inline mb-5">
        <form action="search.php" method="GET">
            <input type="text" name="keyword" class="form-control" placeholder="Search for">
            <input type="submit" class="btn btn-secondary" value="Search!">
        </form>
    </div>

    <div class="row text-center">
    <?php
        $limit=8;
        if(isset($_GET['offSet'])){
          $offSet=$_GET['offSet'];
        }else{
          $offSet=0;
        }

        if(!isset($_GET['keyword'])){
          $alldata = $search->getAll($limit,$offSet);
          $num=$limit+$offSet;
          $last="?offSet=$num";
          $num=$offSet-$limit;
          $pre="?offSet=$num";

          // count number of items on next page
          $nextAlldata = $search->getAll($limit,$offSet+$limit);
          $nextTotal=mysqli_num_rows($nextAlldata);
        } else{
          $keyword=$_GET['keyword'];
          $alldata = $search->searchGood($keyword,$limit,$offSet);
          $num=$limit+$offSet;
          $last="?keyword=$keyword&offSet=$num";
          $num=$offSet-$limit;
          $pre="?keyword=$keyword&offSet=$num";

          // count number of items on next page
          $nextAlldata = $search->searchGood($keyword,$limit,$offSet+$limit);
          $nextTotal=mysqli_num_rows($nextAlldata);
        }
        $total=mysqli_num_rows($alldata);
        if($total == 0){
          echo "Sorry, we can't find any record.";
        }
        while ($row = mysqli_fetch_assoc($alldata)) {
          ?>
          <section class="col-md-3">
              <p class="text-center">
                  <?php
                  $name = $row['good_name'];
                  $length = strlen($name);
                  if ($length > 16){
                    $name = substr($name, 1 ,16)."...";
                  }
                  echo $name;
                  ?>
              </p>
              <a href="detail.php?id=<?php echo $row['good_id'];?>"><img class="img-thumbnail" src="<?php echo $row['good_image'];?>" alt="cow"> </a>
              <p class="text-center">Price: $<?php echo $row['good_price'];?></p>
          </section>
        <?php
        }

        ?>
    </div>

    <div class="row">
        <?php
        if($offSet!=0){
          echo '<a href="'.$pre.'" class="btn btn-warning">Previous Page</a>';
        }
        if($total == $limit){
          if($nextTotal != 0) {
            echo '<a href="'.$last.'" class="btn btn-warning">Next Page</a>';
          }
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
