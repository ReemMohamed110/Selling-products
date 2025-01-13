<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = 'login';
include('inc/head.php');
include('inc/nav.php');
include('controller/login_controller.php');
?>

<body>


    <body>
        <div class="container">
            <div class="row">
                <div class='col-8 mx-auto m-5'>
                    <h2 style="text-align:center; color:#8CCEF9; font-size:100px;">login </h2>
                    <form class="row g-3 needs-validation" action='' method="POST">
                        <?php if (!empty($errors['login'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?php echo $errors['login']; ?>
                            </div>
                        <?php } ?>

                        <div class="form-group p-2 m-1">


                            <div class="form-group p-2 m-1">
                                <label for="email" class="form-label" name='email' ">email</label>
                                <input type=" text" class="form-control" name="email">
                                    <?php if (!empty($errors['email'])) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <?php echo $errors['email']; ?>
                                        </div>
                                    <?php } ?>

                            </div>

                            <div class="form-group p-2 m-1">
                                <label for="password" class="form-label" name='password'>password</label>
                                <input type="password" class="form-control" name="password">
                                <?php if (!empty($errors['password'])) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <?php echo $errors['password']; ?>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">login</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>