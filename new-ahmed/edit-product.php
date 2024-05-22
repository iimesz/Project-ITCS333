<?php 
try{
    require('connection.php');
    $pr_name=trim($_POST['pr_name']);
    $pro_description=trim($_POST['pro_description']);
    $pro_price=trim($_POST['pro_price']);
    $pro_quantity=trim($_POST['pro_quantity']);
    $pr_id=$_POST['pid'];
    $errors = [];

    if (empty($pr_name)) {
      $errors[] = "Name is required.";
    }
    if (empty($pro_description)) {
      $errors[] = "Description is required.";
    }
    if (preg_match("/^\d+(\.\d{1,3})?$/",$pro_price)==0) {
      $errors[] = "Price is required.";
    }
    if (preg_match("/^[0-9]+$/",$pro_quantity)==0) {
      $errors[] = "Quantity is required.";
    }

    if (!empty($errors)) {
      $error_messages = '';
      foreach ($errors as $em) {
          $error_messages .= $em . '\\n';
      }
      echo "<script type='text/javascript'>alert('$error_messages'); window.location.href = 'dl.php?Pid=$pr_id';</script>";
      exit;
  }

    $sql="UPDATE products SET Name='$pr_name' , Price='$pro_price' , Description='$pro_description', Quantity='$pro_quantity' Where Pid=$pr_id";
    $pd= $db->exec($sql);
    $db = null;
    echo "<script type='text/javascript'>alert('Product Updated successfully'); window.location.href = 'edit-inventory.php';</script>";
}
catch(PDOException $e){
    die($e->getMessage());
  }
?>