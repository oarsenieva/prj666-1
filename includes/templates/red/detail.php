<!DOCTYPE html>
<html lang="en">
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");?>

  <!-- items -->

    <div class="col-md-9 col-sm-9 col-xs-9">
      <div class="row">
        <div class="col-xs-4"></div>
        <div class="nnn col-lg-3 col-md-4 col-sm-4 col-xs-3 img-circle float-right clearfix">
          <img src="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" class="img-responsive" alt="Cinque Terre" >
          </div>
      </div>
      <br>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix ">
            <table class="table-bordered" width="100%" height="100px">
                <tr>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Quantity</th>
                </tr>
              <tbody>
                <tr height="50px">
                  <td>Lion</td>
                  <td>Animal</td>
                  <td>6</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <th>Weight</th>
                  <th>Price</th>
                </tr>
                <tr height="50px">
                  <td>Very Friendly</td>
                  <td>50 lbs</td>
                  <td>$100.00</td>
                </tr>
              </tbody>
            </table>
          <br>
          <div class="clearfix centeredImage">
            <button class="btn btn-danger btn-lg btn-block">Add To Cart</button>
          </div>
          <a class="pull-left" href="good.php" ">Back</a>
          </div>
        </div>


  </div>
</div>
  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>
