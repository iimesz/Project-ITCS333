<?php
session_start();
unset($_SESSION['mycart']);
header('location: cart.php');
?>