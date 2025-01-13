<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
$title = 'check out';
include('inc/head.php');
include('inc/nav.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $address = !empty($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : null;
    $phone = !empty($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
    $notes = !empty($_POST['notes']) ? htmlspecialchars(trim($_POST['notes'])) : null;

    $errors = [];
    //name validation
    if (empty($name)) {
        $errors['name'] = "name is required";
    } else {
        if (strlen($name) < 2 || strlen($name) > 40) {
            $errors['name'] = "the number of name must be between 5 and 40 char";
        }
    }
    //email validation
    if (empty($email)) {
        $errors['email'] = "email is required";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email is invalid";
        }
    }

    if (empty($address)) {
        $errors['address'] = "address is required";
    } else {
        if (strlen($address) < 2 || strlen($address) > 40) {
            $errors['address'] = "the number of address must be between 5 and 40 char";
        }
    }
    //phone validation
    if (empty($phone)) {
        $errors['phone'] = "phone is required";
    } else {
        if (!is_numeric($phone)) {
            $errors['phone'] = "invalid phone";
        }
    }

    if (empty($errors)) {
        $file = fopen('data/orders.csv', 'a');
        fwrite($file, "$name,$email,$address,$phone,$notes\n");
        fclose($file);
        header('location:showOrder.php');
        die;
    }
}


?>

<!-- Section-->

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
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
            <div class="col-8">
                <form action="" class="form border my-2 p-3" method="POST">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                            <?php if (!empty($errors['name'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?php echo $errors['name']; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="" class="form-control">
                            <?php if (!empty($errors['email'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?php echo $errors['email']; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="">Address</label>
                            <input type="text" name="address" id="" class="form-control">
                            <?php if (!empty($errors['address'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?php echo $errors['address']; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="" class="form-control">
                            <?php if (!empty($errors['phone'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?php echo $errors['phone']; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="">Notes</label>
                            <input type="text" name="notes" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Send" id="" class="btn btn-success" method="POST" action=" ">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>