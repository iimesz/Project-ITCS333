<?php
session_start();
$pid=$_POST['pid'];
$qty=$_POST['qty'];
$_SESSION['mycart'][$pid]=$qty;
header('location:products.php');

if(!$_SESSION['mycart']){
    echo"no such";
}
?>
