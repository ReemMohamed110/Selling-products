<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$file = fopen('data/cart.csv', 'w');
fclose($file);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $password = !empty($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : null;
    $errors = [];

    if (empty($email)) {
        $errors['email'] = "email is required to login";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email is invalid";
        }
    }

    if (empty($password)) {
        $errors['password'] = "password is required to login";
    } else {
        if (strlen($password) < 2 || strlen($password) > 20) {
            $errors['password'] = "password must be greater than 2 char";
        }
    }

    if (empty($errors)) {
        $file = fopen("data/users.csv", "r");
        while ($res = fgets($file)) {
            $row = trim($res);
            $result = explode(",", $row);

            if ($result[1] == $email && password_verify($password, $result[3])) {
                $_SESSION['user'] = [
                    'name' => $result[0],
                    'email' => $result[1],
                ];
                fclose($file);
                header("location:index.php");

                die;
            }
        }
        fclose($file);
        $errors['login'] = 'invalid email or password';
    }
}
