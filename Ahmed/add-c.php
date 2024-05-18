<?php 
try{
    require('connection.php');
    $image=$_POST['cat-image'];
    $name=$_POST['am'];
    $sql="insert into category values (null,'$name' , '$image')";
    $pd= $db->exec($sql);
    $db = null;
}
catch(PDOException $e){
    die($e->getMessage());
  }
?>