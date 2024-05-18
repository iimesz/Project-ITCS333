<?php 
try{
    require('connection.php');
    $pr_name=$_POST['pr_name'];
    $pro_description=$_POST['pro_description'];
    $pro_price=$_POST['pro_price'];
    $pro_quantity=$_POST['pro_quantity'];
    $pr_id=$_POST['pid'];

    $sql="UPDATE products SET Name='$pr_name' , Price='$pro_price' , Description='$pro_description', Quantity='$pro_quantity' Where Pid=$pr_id";
    $pd= $db->exec($sql);
    $db = null;
}
catch(PDOException $e){
    die($e->getMessage());
  }
?>