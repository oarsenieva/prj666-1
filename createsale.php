<?php
require_once 'core/init.php';

$user = new User();
$sale = new Sale();
$validate = new Validate();
$category = new Category();
$good = new Good();
$action = Input::get('action');
$itemId = Input::get('item_id');

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if($action === 'delete'){
    $good->setGood(array(
        'sale_id' => null
    ), $itemId);
}

if(Input::exists()){
    $validation = $validate->check($_POST, array(
        'sale_name' => array(
            'name' => 'Name',
            'required' => true,
            'unique' => 'sale',
            'min' => 2,
            'max' => 30
        ),
        'description' => array(
            'name' => 'Description',
            'required' => true,
            'max' => 255
        ),
        'discount' => array(
            'name' => 'Discount',
            'required' => true,
        ),
        'start_date' => array(
            'name' => 'Start date',
            'required' => true,
            'futureDate' => true,
        ),
        'end_date' => array(
            'name' => 'End date',
            'required' => true,
            'futureDate' => true,
            'notMatches' => 'start_date',
            'notMatchesTo' => 'Start Date'
        )
    ));

    if ($validation->passed()) {

        try {
            $sale->create(array(
                'sale_name' => Input::get('sale_name'),
                'sale_description' => Input::get('description'),
                'discount' => Input::get('discount'),
                'end_date' => date('Y-m-d', strtotime(Input::get('end_date'))),
                'start_date' => date('Y-m-d', strtotime(Input::get('start_date')))
            ));
            $isFound = $sale->findSale(array('sale_name', '=', Input::get('sale_name')));
            if(Input::get('good')){
                if($isFound) {
                    $good->setGood(array(
                        'sale_id' => $sale->data()->sale_id
                    ), Input::get('good'));
                }
            } else if (Input::get('category')){
                if($isFound) {
                    $good->setOnSale(array(
                        'sale_id' => $sale->data()->sale_id
                    ), Input::get('category'));
                }
            }

            Session::flash('createS', 'New sale has been added!');
            //Redirect::to('index.php');

        } catch (Exception $e) {
            die($e->getMessage()); //or you can redirect to other page.
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Wecrue - Add Sale</title>
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
                    <a class="nav-item nav-link dropdown-toggle active" href="#"
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

<div class="container bg-faded py-5">
    <h2 class="mb-4">Create sale form</h2>
    <?php
    if(Session::exists('createS')) {
        echo '<p class="text-success">' . Session::flash('createS') . '</p>';
    }

    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post">
        <fieldset class="form-group">
            <legend></legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="sale_name"><span class="text-danger">*</span> Name</label>
                <input class="form-control" type="text" name="sale_name" id="sale_name" placeholder="Enter name for sale" value="" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="description"><span class="text-danger">*</span> Description</label>
                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description"><?php echo escape(Input::get('client_info'))?></textarea>
            </div>
            <div class="form-group form-inline">
                <label class="form-control-label mr-2 ml-3" for="discount"><span class="text-danger">*</span>&nbspDiscount</label>
                <input class="form-control" type="number" min="0.01" step="0.01" name="discount" id="discount" style="width: 90px;" value="" />
                <span class="input-group-addon">%</span>
            </div>
            <div class="form-group col-md-6" >
                <label class="form-control-label" for="start_date"><span class="text-danger">*</span> Start date</label>
                <input class="form-control" type="date" name="start_date" id="start_date" placeholder="Format: YYYY-MM-DD" />
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="end_date"><span class="text-danger">*</span> End date</label>
                <input class="form-control" type="date" name="end_date" id="end_date" placeholder="Format: YYYY-MM-DD" />
            </div>
            <div class="form-control-label">
                <p class="text-info"><span class="text-danger">*</span>Select product or category</p>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="category">Product category</label>
                <select class="form-control" onchange="if(document.getElementById('category').value) document.getElementById('good').disabled = true; else document.getElementById('good').disabled = false; " name="category" id="category">
                    <option value="">Select category</option>
                    <?php
                    $category->getCategory($user->data()->client_id);
                    if($category->exists()) {
                        $categoryItems = $category->data();

                        foreach ($categoryItems as $categoryItem) {
                            echo '<option value="' . $categoryItem->category_id . '">' . $categoryItem->category_name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="good">Product good</label>
                <select class="form-control" onchange="if(document.getElementById('good').value) document.getElementById('category').disabled = true; else document.getElementById('category').disabled = false;" type="text" name="good" id="good">
                    <option value="">Select good</option>
                    <?php
                    //$category->getCategory($user->data()->client_id);
                    if($category->exists()) {
                        $categoryItems = $category->data();

                        foreach ($categoryItems as $categoryItem) {
                            $good->getGood(array('category_id', '=', $categoryItem->category_id));
                            if($good->exists()){
                                $goodItems = $good->data();

                                foreach ($goodItems as $goodItem){
                                    if (!$goodItem->sale_id) echo '<option value="' . $goodItem->good_id . '">' . $goodItem->good_name . '</option>';
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <fieldset class="form-group">
                <legend>Item currently selected for sale</legend>
                <div class="form-group col-md-6">
                    <?php
                    if($category->exists()) {
                        $categoryItems = $category->data();

                        foreach ($categoryItems as $categoryItem) {
                            $good->getGood(array('category_id', '=', $categoryItem->category_id));
                            if($good->exists()){
                                $goodItems = $good->data();

                                foreach ($goodItems as $goodItem){
                                    if ($goodItem->sale_id) echo 'On sale: ' . escape($goodItem->good_name) . ' <a href="createsale.php?action=delete&item_id='. escape($goodItem->good_id) .'">(delete)</a><br>';
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="form-group col-md-6">
<!--                    <p>Item: Red bow tie <a href="#">(delete)</a></p>-->
                </div>
            </fieldset>
        </fieldset>
        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" type="submit" value="Submit" />
        </div>
    </form>
</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
