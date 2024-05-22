<?php 
try{
  require('connection.php');
  $name = trim($_POST['pn']);
  $price = trim($_POST['pp']);
  $description = trim($_POST['pd']);
  $quantity = trim($_POST['pq']);
  $category = trim($_POST['pc']);
  $image = trim($_POST['pi']);
  $errors = [];
  
  if (empty($name)) {
      $errors[] = "Name is required.";
  }
  if (preg_match("/^\d+(\.\d{1,3})?$/",$price)==0) {
      $errors[] = "Price is required.";
  }
  if (empty($description)) {
      $errors[] = "Description is required.";
  }
  if (preg_match("/^[0-9]+$/",$quantity)==0) {
      $errors[] = "Quantity is required.";
  }
  if (empty($category)) {
      $errors[] = "Category is required.";
  }
  if (empty($image)) {
      $errors[] = "Image is required.";
  }
  
  if (!empty($errors)) {
      $error_messages = '';
      foreach ($errors as $em) {
          $error_messages .= $em . '\\n';
      }
      echo "<script type='text/javascript'>alert('$error_messages'); window.location.href = 'add-product.php?Cid=$category';</script>";
      exit;
  }
  

    

    $sql="insert into products values (null,'$name' , $price , '$description' , $quantity , $category , '$image')";
    $pd= $db->exec($sql);
    $db = null;
    echo "<script type='text/javascript'>alert('Product Added successfully'); window.location.href = 'edit-inventory.php';</script>";
}
catch(PDOException $e){
    die($e->getMessage());
  }
?>