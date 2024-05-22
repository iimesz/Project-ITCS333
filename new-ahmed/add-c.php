<?php 
try{
    require('connection.php');
    $image=trim($_POST['cat-image']);
    $name=trim($_POST['am']);
      
    // Validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Category name is required.";
    }
    if (empty($image)) {
        $errors[] = "Category image is required.";
    }
  
    if (!empty($errors)) {
        foreach ($errors as $error_message){
        echo "<script type='text/javascript'>alert('$error_message'); window.location.href = 'add-category.php';</script>";
      }
        exit;
    }
    $sql="insert into category values (null,'$name' , '$image')";
    $pd= $db->exec($sql);
    $db = null;
    echo "<script type='text/javascript'>alert('Category Added successfully'); window.location.href = 'edit-inventory.php';</script>";}
catch(PDOException $e){
    die($e->getMessage());
  }
?>