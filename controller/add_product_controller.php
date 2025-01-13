<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $old_price= !empty($_POST['old_price']) ? htmlspecialchars(trim($_POST['old_price'])) : null;
    $new_price= !empty($_POST['new_price']) ? htmlspecialchars(trim($_POST['new_price'])) : null;
    $brand = !empty($_POST['brand']) ? htmlspecialchars(trim($_POST['brand'])) : null;
    $image=!empty($_POST['image']) ? $_FILES['image'] : null;
    $errors = [];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK ) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $destination = 'uploads/' . $imageName;
        if (move_uploaded_file($imageTmpPath, $destination)) {
            $success= "Image uploaded successfully.";
        
        } else {
            $errors['upload']= "Error uploading the image.";
        }
    } else {
        
        $errors['image'] = "Please upload an image.";
    }
    
   
    //name validation
    if (empty($name)) {
        $errors['name'] = "name of product is required";
    } else {
        if (strlen($name) < 2 || strlen($name) > 40) {
            $errors['name'] = "the number of char must be between 5 and 40 char";
        }
    }
    //old price validation
    if (empty($old_price)) {
        $errors['old_price'] = "old price is required";
    } else {
        if (!is_numeric($old_price)) {
            $errors['old_price'] = "old price must be numbers";
        }
    }
    //price validation
    if (empty($new_price)) {
        $errors['new_price'] = "new price is required";
    } else {
        if (!is_numeric($new_price)) {
            $errors['new_price'] = "new price must be numbers";
        }
    }
    //brand validation
    if (empty($brand)) {
        $errors['brand'] = "brand product is required";
    }
    
   
    
    if (empty($errors)) {
        $code=rand(1000,9999);
        $file = fopen('data/product.csv', 'a');
        fwrite($file, "$code,$name,$old_price,$new_price,$brand,$destination\n");
        $_SESSION['product'] = ["code"=>$code, "name" => $name, "old_price" => $old_price,
         "new_price" => $new_price,"brand" => $brand,"image" => $destination];
       
        fclose($file);
         
        header('location:index.php');
        
        die;
        
    }
} 
