<?php
require_once 'core/init.php';
ini_set('display_errors', 'On');
$user = new User();
$validate = new Validate();


if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if ($_FILES['client_logo']['size'] == 0)
    {
        $validate->addError('Logo is required');
        //echo "No logo uploaded";
    }
    else{
        $client_name = $user->data()->username;
        $com_title = $user->data()->client_site_title;
        $target_dir = '/data/www/default/' . $client_name . '/images/';
        $target_file = $target_dir . "/logo.jpg";
        $uploadOk = 1;
// Desired folder structure
        $destination = '/data/www/default/' . $client_name;
        $destination2 = '/data/www/default/' . $client_name . '/images';
        $destination3 = '/data/www/default/' . $client_name . '/css';
        $check=0;
// To create the nested structure, the $recursive parameter
// to mkdir() must be specified.

        if (file_exists($destination)){
            /*echo "directory already existed";
            $check=1;*/
            deleteDir($destination2);
            deleteDir($destination3);
            deleteDir($destination);
            //exec('cd '.$destination2);

        }
        if($check == 0){
            if (!file_exists($destination)){
                if (!mkdir($destination, 0770, true)) {
                    die('Failed to create folders...');
                }
            }
            if (!file_exists($destination2)){
                if (!mkdir($destination2, 0770, true)) {
                    die('Failed to create folders...');
                }
            }

            if (!file_exists($destination3)){
                if (!mkdir($destination3, 0770, true)) {
                    die('Failed to create folders...');
                }
            }

        }
        //echo "create";

        if (file_exists($target_file)){
            unlink($target_file);
        }
        if ($uploadOk == 0){
            //echo "Sorry, your file was not uploaded";
        }
        else {
            if(move_uploaded_file($_FILES["client_logo"]["tmp_name"], $target_file)){
                //echo "uploaded";
            }
            else{
                //echo "Sorry";
            }
        }
        if ($check != 1 && $_POST['template'] == 2){
            $source = '/data/www/default/prj/template/blue';
            $source2 = '/data/www/default/prj/template/blue/images';
            $source3 = '/data/www/default/prj/template/blue/css';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
            }
            ob_start();
            include('../template/blue/index.php');
            $forIndex = ob_get_contents();
            ob_end_clean();

            ob_start();
            include('../template/blue/Header.php');
            $forHeader = ob_get_contents();
            ob_end_clean();

            $indexFile = fopen("/data/www/default/" . $client_name . "/index.php", "w") or die("Unable to open file!");
            $headerFile = fopen("/data/www/default/" . $client_name . "/Header.php", "w") or die("Unable to open file!");

            fwrite($indexFile, $forIndex);
            fclose($indexFile);

            fwrite($headerFile, $forHeader);
            fclose($headerFile);

            //echo "Done writing";

        }
        else if ($check != 1 && $_POST['template'] == 1){
            $source = '/data/www/default/prj/template/green';
            $source2 = '/data/www/default/prj/template/green/images';
            $source3 = '/data/www/default/prj/template/green/css';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
            }
            ob_start();
            include('../template/green/index-metadata.php');
            $forIndex = ob_get_contents();
            ob_end_clean();

            ob_start();
            include('../template/green/header-nav.php');
            $forHeader = ob_get_contents();
            ob_end_clean();

            $indexFile = fopen("/data/www/default/". $client_name . "/index-metadata.php", "w") or die("Unable to open file!");
            $headerFile = fopen("/data/www/default/". $client_name ."/header-nav.php", "w") or die("Unable to open file!");

            fwrite($indexFile, $forIndex);
            fclose($indexFile);

            fwrite($headerFile, $forHeader);
            fclose($headerFile);

            Session::flash('generate', 'Your site has been generated successfully');
            ?> <script type="text/javascript" language="Javascript">window.open('http://myvmlab.senecacollege.ca:5726/<?php echo $user->data()->username; ?>');</script> <?php

        }
        else if ($check != 1 && $_POST['template'] == 3){
            $source = '/data/www/default/prj/template/red';
            $source2 = '/data/www/default/prj/template/red/images';
            $source3 = '/data/www/default/prj/template/red/css';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
            }
            /*ob_start();
            include('../../template/red/');
            $forIndex = ob_get_contents();
            ob_end_clean();*/

            ob_start();
            include('../template/red/header.php');
            $forHeader = ob_get_contents();
            ob_end_clean();

            //$indexFile = fopen("/data/www/default/testing2/index-metadata.php", "w") or die("Unable to open file!");
            $headerFile = fopen("/data/www/default/". $client_name ."/header.php", "w") or die("Unable to open file!");

            //fwrite($indexFile, $forIndex);
            //fclose($indexFile);

            fwrite($headerFile, $forHeader);
            fclose($headerFile);

            //echo "Done writing";
        }
    }
}



function recurse_copy($src,$dst) {
    $dir = opendir($src);
    //@mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    //echo "Copied";
    closedir($dir);
}
function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Generate Site</title>
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
                <a class="nav-item nav-link active" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="profileDropdown"
                    >Account</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="edit-com.php">Update account</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                        <a class="dropdown-item" href="editCover.php">Edit cover</a>
                        <a class="dropdown-item" href="editFooter.php">Edit footer</a>
                        <a class="dropdown-item" href="editAboutUs.php">Edit about us</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="categoryDropdown"
                    >Category</a>

                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="category.php">View categories</a>
                        <a class="dropdown-item" href="addCategoryForm.php">Create category</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="goodDropdown"
                    >Good</a>

                    <div class="dropdown-menu" aria-labelledby="goodDropdown">
                        <a class="dropdown-item" href="good.php">View goods</a>
                        <a class="dropdown-item" href="create-good.php">Create good</a>
                        <a class="dropdown-item" href="edit-good.php">Edit good</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Sale</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="sale.php">View sales</a>
                        <a class="dropdown-item" href="onsale.php">Goods on sale</a>
                        <a class="dropdown-item" href="createsale.php">Create Sale</a>
                    </div>
                </div>

                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
    </div>
</nav>
<div class="container bg-faded py-5" style="min-height: 100vh" >
    <h2 class="mb-4">Generate template</h2>
    <?php
    if(Session::exists('generate')) {
        echo '<p class="text-success">' . Session::flash('generate') . '</p>';
        echo '<p class="text-info"><a href="http://myvmlab.senecacollege.ca:5726/' .  $user->data()->username . '">Go to your website</a></p>';
    }

    if($validate->errors()) {
        foreach ($validate->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post"  enctype="multipart/form-data" >
        <fieldset class="form-group">
            <legend>Template</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_logo"><span class="text-danger">*</span> Choose your company logo: </label>
                <input type="file" name="client_logo" id="client_logo" accept="image/x-png,image/jpeg"/>
            </div>

            <div class="form-check">
                <p style=" margin-left:15px;"><span class="text-danger">*</span> Choose your template:</p>
                <label class="form-check-label" for="template">

                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="template" value="1" checked>
                    Green</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="template">
                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="template" value="2">
                    Blue</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="template">

                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="template"value="3" />
                    Red</label>
            </div>

        </fieldset>
        <div class="form-group pt-5">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="submit" />
        </div>
    </form>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>