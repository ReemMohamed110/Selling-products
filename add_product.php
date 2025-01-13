<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['user'])){
    header("location:index.php");
}
$title = 'add product';
include('inc/head.php');
include('inc/nav.php');
include('controller/add_product_controller.php');

?>

<body>
    <div class="container">
        <div class="row">
            <div class='col-8 mx-auto m-5'>
                <h2 style="text-align:center; color:#8CCEF9; font-size:100px;">Add New Product</h2>
                <form class="row g-3 needs-validation" action='' method="POST" enctype="multipart/form-data">
                    <div class="form-group p-2 m-1">
                        <label for="name" class="form-label">name</label>
                        <input type="text" class="form-control" name="name">
                        <?php if (!empty($errors['name'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['name']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="old_price" class="form-label">old price</label>
                        <input type="text" class="form-control" name="old_price">
                        <?php if (!empty($errors['old_price'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['old_price']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group p-2 m-1">
                        <label for="new_price" class="form-label">new price</label>
                        <input type="text" class="form-control" name="new_price">
                        <?php if (!empty($errors['new_price'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['new_price']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="phone" class="form-label">brand</label>
                        <input type="text" class="form-control" name="brand">
                        <?php if (!empty($errors['brand'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['brand']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="image" class="form-label">image</label>
                        <input type="file" class="form-control" name="image">
                        
                        <?php if (!empty($errors['image'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['image']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-12">

                        <button class="btn btn-primary" type="submit">add product</button>
                    </div>
            </div>
        </div>
    </div>
    </form>

    <?php include('inc/footer.php') ?>