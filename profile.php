<?php
require_once 'core/init.php';

$user = new User();

if($user->data()->username !== Input::get('user')){
    Redirect::to(404);
}

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(!$username = Input::get('user')){
    Redirect::to('index.php');
} else{
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    } else{
        $data = $user->data();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Wecrue - Profile</title>
    </head>
    <body>

    <nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuContent">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link" href="index.php">Home</a>
                    <a class="nav-item nav-link" href="generateTemplate.php">Generate site</a>
                    <a class="nav-item nav-link active" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

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
        </div>
    </nav>

    <div class="container bg-faded py-5" style="min-height: 100vh">
        <h2 class="mb-4">Profile</h2>
        <?php
        //        if(Session::exists('profile')) {
        //            echo '<p class="text-success">' . Session::flash('profile') . '</p>';
        //        }
        //
        //        if($validate->errors()) {
        //            foreach ($validation->errors() as $error) {
        //                echo '<small class="text-warning">' . $error . '</small><br />';
        //            }
        //        }
        ?>

    </div>

    <?php include('includes/footer.inc'); ?>

    <script src="js/jquery-3.1.1.slim.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>



    <?php
}