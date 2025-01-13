<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = 'home';
include('inc/head.php');
include('inc/nav.php');

?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h class="display-4 fw-bolder">Smartphones That Offer You an Unmatched Experience!</h>
            <p class="lead fw-normal text-white-50 mb-0">Don’t miss out! Shop now and be one of the first!</p>
        </div>
    </div>
</header>
<!-- section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php

            $file = fopen('data/product.csv', 'r');
            while ($res = fgets($file)) {
                $row = trim($res);
                $product = explode(',', $row);



            ?>

                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= $product[5] ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">

                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $product[1]; ?></h5>
                                <!-- Product brand-->
                                <h5 class="fw-bolder">Brand: <?= $product[4] ?></h5>
                                <h5 class="fw-bolder">code: <?= $product[0]; ?></h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through"><?= $product[2] . "$"; ?> </span>
                                <?= $product[3] . " $"; ?>
                                <!-- Product actions-->
                                <?php if (!empty($_SESSION['user'])): ?>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><form action="cart.php?code=<?= $product[0]?>&name=<?= $product[1]?>&price=<?= $product[3]?>&brand=<?= $product[4]?>" method="POST">
                                            <button class="btn btn-outline-dark mt-auto" type="submit" name="addCart">Add to cart</button></form>
                                        </div>
                                        <a href="delete.php?code=<?= $product[0] ?>" class="btn btn-danger" method="POST">Delete</a>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php  }
            fclose($file); ?>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>