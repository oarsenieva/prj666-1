<!DOCTYPE html>
<html lang="en">
 <style>
    .fhead {
      text-align: center;
      justify-content: center
    }

    .centeredImage {
      position: absolute;
      left: 40%;
      text-align:center;
    }

    .left{
      text-align:right;
    }

  </style>
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->

  <!-- items -->
 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
       <!-- info -->
      <div>
        <?php
              $url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
              if (file_exists($url)) {
                $content = file_get_contents($url);
                echo $content;
              }
              ?>
      </div>
    </div>
        </div>
  </div>

  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>
