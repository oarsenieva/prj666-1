<?php
require_once 'core/init.php';

$user = new User();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue</title>
</head>
<body>
<header class="clearfix " style="height: 30vh; background: url(images/cover.jpg) no-repeat center center; background-size: cover;">
    <div class="container pt-3">
        <img src="images/logo.png" alt="Wecreu Logo" class="rounded-circle" style="width: 100px; display: block;">
    </div>
</header>

<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link active" href="index.php">Home</a>
                <?php

                if($user->isLoggedIn()) {
                ?>
                <a class="nav-item nav-link" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="profileDropdown"
                    >Account</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="edit-com.php">Update account</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="categoryDropdown"
                    >Category</a>

                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="#">View categories</a>
                        <a class="dropdown-item" href="addCategoryForm.php">Create category</a>
                        <a class="dropdown-item" href="#">Edit category</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="goodDropdown"
                    >Good</a>

                    <div class="dropdown-menu" aria-labelledby="goodDropdown">
                        <a class="dropdown-item" href="#">View goods</a>
                        <a class="dropdown-item" href="create-good.php">Create good</a>
                        <a class="dropdown-item" href="edit-good.php">Edit good</a>
                    </div>
                </div>

                <a class="nav-item nav-link" href="createsale.php">Create Sale</a>
                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>

        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>

        <?php
        } else{
        ?>
        <a class="nav-item nav-link" href="aboutus.php">About us</a>
        <a class="nav-item nav-link" href="login.php">Log in</a>
        <a class="nav-item nav-link" href="register.php">Register</a>
    </div>
    </div>

    <h1 class="navbar-brand mb-0 mr-3">Hi there!</h1>

    <?php
    }
    ?>

    </div>
</nav>

<div class="container bg-faded py-5" style="min-height: 65vh">
    <h2 class="mb-4 text-center">Templates</h2>
    <div class="row">
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/green/index.php">
                <img src="images/t-green.png" alt="Green Template" class="img-thumbnail">
                <h5 class="pt-1 mb-4 text-center">Green</h5>
            </a>
            <p>A very simple site to display all your products. It has responsive display feature. It is green.</p>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/red/index.php">
                <img src="images/t-red.png" alt="Red Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Red</h5>
            </a>
            <p>A standard site for unlimited categories or goods. It shows the top sales items on the index page.</p>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/blue/index.php">
                <img src="images/t-blue.png" alt="Blue Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Blue</h5>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 pb-3">
            <a href="includes/templates/grey/index.php">
                <img src="images/t-grey.png" alt="Grey Template" class="img-thumbnail" style="display: block">
                <h5 class="pt-1 mb-4 text-center">Grey</h5>
            </a>
            <p>This template is designed for limited goods and categories. It doesn't support search function. When customers move to another page( from good list to good detail), it will not refresh the whole page. At the bottom of the template, it allows customers connect quickly with client. It is good for selling services.</p>
        </div>
    </div>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



