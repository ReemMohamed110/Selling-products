<?php

$title = 'delete product';
include('inc/head.php');
include('inc/nav.php');
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = trim($_GET['code']);

    $file = fopen('data/product.csv', 'r');
    $lines = [];
    while ($line = fgets($file)) {
        $result = trim($line);
        $row = explode(',', $result);

        if ($row[0] == $code) {
        } else {
            $lines[] = $line;
        }
    }
    fclose($file);
    $file = fopen('data/product.csv', 'w');

    foreach ($lines as $line) {
        fwrite($file, $line);
    }
    fclose($file);
    $success['delete'] = "employee deleted successfully";

    header("location:index.php");
    return true;
}
?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>

<body>

    <?php if (isset($success['delete'])) { ?>
        <div class="alert alert-success" role="alert">
        <?php echo $success['delete'];
    } ?>

        </div>

        <div class="container">
            <div class="row">
                <div class='col-8 mx-auto m-5'>
                    <h2 style="text-align:center; color:#8CCEF9; font-size:80px;">delete product</h2>
                    <form class="row g-3 needs-validation" action='' method="POST">
                        <button class="btn btn-primary" type="submit">delete </button>
                    </form>
                </div>
            </div>
        </div>
        </div>