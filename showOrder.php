<!-- echo "your order is on your way ...stay tuned"; -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = 'show order';
include('inc/head.php');
include('inc/nav.php');
if (!isset($_SESSION['user'])) {

    header("location:index.php");
}
?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">ORDER</h1>
            <p class="lead fw-normal text-white-50 mb-0">Join our family! Follow us on social media for the latest offers.</p>
        </div>
    </div>
</header>


<div class="alert alert-success" role="alert">
    Your order has been successfully processed and will be shipped soon. ^_- .
</div>
<div class="row">

    <div class="col-4">
        <div class="border p-2">
            <div class="products">
                <ul class="list-unstyled">
                    <?php $file = fopen('data/cart.csv', 'r');
                    $total = 0;
                    while ($res = fgets($file)) {
                        $row = explode(",", $res); ?>
                        <li class="border p-2 my-1"> <?= $row[1] ?>
                            <span class="text-success mx-2 mr-auto bold"><?= $row[2] ?> $</span>
                        </li>
                    <?php
                        $total = $total + $row[2];
                    }
                    fclose($file);
                    ?>


                </ul>
            </div>
            <h3>Total : <?= $total ?> $</h3>
        </div>
    </div>
</div>