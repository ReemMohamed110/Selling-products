<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$file = fopen('data/cart.csv', 'w');
fclose($file);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $phone = !empty($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
    $password = !empty($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : null;
    $confirm_password = !empty($_POST['confirm_password']) ? htmlspecialchars(trim($_POST['confirm_password'])) : null;
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
    //phone validation
    if (empty($phone)) {
        $errors['phone'] = "phone is required";
    } else {
        if (!is_numeric($phone)) {
            $errors['phone'] = "invalid phone";
        }
    }
    //password validation
    if (empty($password)) {
        $errors['password'] = "password is required";
    } else {
        if (strlen($password) < 2 || strlen($password) > 20) {
            $errors['password'] = "password must be greater than 2 char";
        }
    }
    //
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "confirm_password is required";
    } else {
        if ($confirm_password !== $password) {
            $errors['confirm_password'] = "password can't match";
        }
    }
    if (empty($errors)) {
        $file = fopen('data/users.csv', 'a');
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        fwrite($file, "$name,$email,$phone,$hash_password\n");
        $_SESSION['user'] = ["name" => $name, "email" => $email, "password" => $password];
        fclose($file);
        header('location:index.php');
        die;
    }
}
