<?php 
try{
    require('connection.php');
    $name=$_POST['pn'];
    $price=$_POST['pp'];
    $description=$_POST['pd'];
    $quantity=$_POST['pq'];
    $category=$_POST['pc'];
    $image=$_POST['pi'];

    $sql="insert into products values (null,'$name' , $price , '$description' , $quantity , $category , '$image')";
    $pd= $db->exec($sql);
    $db = null;
}
catch(PDOException $e){
    die($e->getMessage());
  }
?>