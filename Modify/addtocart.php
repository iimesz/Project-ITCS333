<?php
session_start();
$pid=$_POST['pid'];
$qty=$_POST['qty'];
$cid =$_POST['cid'];
$_SESSION['mycart'][$pid]=$qty;
header("location:products.php?Cid=$cid");

if(!$_SESSION['mycart']){
    echo"no such";
}
?>
