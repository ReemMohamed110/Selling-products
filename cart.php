<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
$title = 'cart';
include('inc/head.php');
include('inc/nav.php');

?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">MY CART</h1>
            <p class="lead fw-normal text-white-50 mb-0">Your perfect choice is waiting for you! Don’t wait any longer!</p>
        </div>
    </div>
</header>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }
    if (isset($_POST["addCart"])) {
        $code = $_GET['code'];
        $name = $_GET['name'];
        $price = $_GET['price'];
        $brand = $_GET['brand'];
        $file = fopen('data/cart.csv', 'a');
        fwrite($file, "$code,$name,$price,$brand\n");
        fclose($file);
        $_SESSION['cart']++;
        header("location:index.php");
    }
}


?>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">code</th>
                            <th scope="col">Product name</th>
                            <th scope="col">price</th>
                            <th scope="col">brand</th>
                            <th scope="col">action</th>
                            <!-- <th scope="col">Total</th> -->
                            <!-- <th scope="col">Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $file = fopen('data/cart.csv', 'r');
                        while ($res = fgets($file)) {
                            $res = trim($res);
                            $row = explode(',', $res); ?>
                            <tr>
                                <th scope="row"><?= $row[0] ?></th>
                                <td><?= $row[1] ?></td>
                                <td><?= $row[2] ?></td>
                                <td><?= $row[3] ?></td>
                                <td>
                                    <a href="deleteCart.php?code=<?= $row[0] ?>" class="btn btn-danger" method="POST" name="deleteCart">Delete</a>
                                </td>
                            </tr>
                        <?php }
                        fclose($file); ?>

                        <tr>
                            <td colspan="2">
                                total price
                            </td>
                            <td colspan="2">
                                <h3><?php
                                    $sum = 0;
                                    $file = fopen('data/cart.csv', 'r');
                                    while ($res = fgets($file)) {
                                        $res = trim($res);
                                        $row = explode(',', $res);
                                        $sum = $sum + $row[2];
                                    }
                                    echo $sum . "$";
                                    fclose($file); ?></h3>
                            </td>
                            <td>
                                <a href="checkout.php" class="btn btn-primary" method="POST">Checkout</a>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>