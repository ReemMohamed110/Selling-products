<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">EraaSoft PMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="add_product.php">add product</a></li>
                <?php endif; ?>
            </ul>
            <?php if (!empty($_SESSION['user'])): ?>
                <form class="d-flex" action="cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php if(isset($_SESSION['cart'])){echo $_SESSION['cart']; }?></span>
                    </button>
                </form>
                <div class="d-flex" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="controller/logout_controller.php">logout</a></li>
                        <li class="nav-item" style="padding-top: 9px;"><?= $_SESSION['user']['name'] ?></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="d-flex" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="login.php">login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">register</a></li>

                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>