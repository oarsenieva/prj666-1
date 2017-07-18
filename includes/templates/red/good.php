<!DOCTYPE html>
<html lang="en">
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");
  require_once("/data/www/default/wecreu/tools/search.php");
  ?>
  <div class="col-md-9 col-sm-9 col-xs-9 goodlist cf">
  <?php
  $limit=12;
  $offSet=0;
  $search = new Search($db,$clientId);
  $alldata = $search->getAll($limit,$offSet);
  while ($row = mysqli_fetch_assoc($alldata)) {
    ?>
    <div class="item col-md-12 col-sm-4 col-xs-4">
      <a href='detail.php?id=<?php echo $row['good_id'];?>'>
         <img src="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" class="img-responsive" alt="Cinque Terre">
        <p>
          <?php
          $name = $row['good_name'];
          $length = strlen($name);
          if ($length > 16){
            $name = substr($name, 1 ,16)."...";
          }
          echo $name;
          ?>
        </p> <p>$<?php echo $row['good_price'];?></p>
      </a>
  </div>
  <?php
  }
  ?>
  </div>
    <div class="row">
      <div class="btn-group pull-right" role="group" aria-label="...">
        <a href="#" class="btn" role="button">First page</a>
        <a href="#" class="btn" role="button">Last page</a>
      </div>
    </div>
  </div>
</div>
  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>
