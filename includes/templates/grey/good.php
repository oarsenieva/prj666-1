<!DOCTYPE html>
<html class="no-js">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/table.css">

  <style>
   .container-m {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: 10px;
        margin-left: 10px;
    }

  </style>
  </head>
  <body>


  <div class="container-m bg-faded pt-5 goodlist cf col-md-9 col-sm-12 col-xs-12">
  <?php
  $clientId = file_get_contents('conf.ini');
  include_once("/data/www/default/wecreu/tools/sql.php");
  require_once("/data/www/default/wecreu/tools/search.php");
  $limit=12;
  $offSet=0;
  $db = Database::getInstance();
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
    <div class="row col-md-9 col-sm-9 col-xs-9">
      <div class="btn-group" role="group" aria-label="...">
        <a href="#" class="btn" role="button">First page</a>
        <a href="#" class="btn" role="button">Last page</a>
      </div>
    </div>
  </div>
  </body>
</html>
