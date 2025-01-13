<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = 'register';
include('inc/head.php');
include('inc/nav.php');
include('controller/register_controller.php')

?>

<body>
    <div class="container">
        <div class="row">
            <div class='col-8 mx-auto m-5'>
                <h2 style="text-align:center; color:#8CCEF9; font-size:100px;">register</h2>
                <form class="row g-3 needs-validation" action='' method="POST">
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
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control" name="email">
                        <?php if (!empty($errors['email'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="phone" class="form-label">phone</label>
                        <input type="text" class="form-control" name="phone">
                        <?php if (!empty($errors['phone'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['phone']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control" name="password">
                        <?php if (!empty($errors['password'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['password']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group p-2 m-1">
                        <label for="confirm_password" class="form-label">confirm password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        <?php if (!empty($errors['confirm_password'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['confirm_password']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-12">


                        <button class="btn btn-primary" type="submit">register</button>
                    </div>
            </div>
        </div>
    </div>
    </form>

    <?php include('inc/footer.php') ?>