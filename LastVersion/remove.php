<?php
session_start();
unset($_SESSION['mycart'][$_GET['pid']]);
header('location:cart.php');
?>
