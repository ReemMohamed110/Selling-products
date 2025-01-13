<?php
session_start();
session_unset();
session_destroy();
$file=fopen('../data/cart.csv','w');
fclose($file);
header('location:../index.php');
?>