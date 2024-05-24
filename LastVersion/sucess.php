<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'customer') {
    header("Location: login.php");
}
?>


<html>
<head>
    <link rel="stylesheet" href="suc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <form method='post' action='search.php' class="search-form">
                <input id='se' type="text" placeholder="Search for an item" name="search">
                <button type="submit" name='sb'><i class="fas fa-search"></i></button>
            </form>
            <nav>
                <a href="mainpage.php"><i class="fas fa-home"></i> Home</a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart</a>
                <a href="Track.php"><i class="fa-solid fa-car-side"></i> Track</a>
                <?php 
                if(isset($_SESSION['username'])) 
                    echo"<a href='outmain.php'><i class='fa-solid fa-user'></i> Logout</a>";
                else 
                    echo"<a href='login.php'><i class='fa-solid fa-user'></i> Login</a>";
                ?>       
            </nav>
        </div>
</header>
<section class="fruit"></section>

<main>
    <img class='done' src='images/correct.png' alt='no' /></br>
    <h1 style='color:blue'>Thank You!</h1></br>
    <h2>Purshased was sucessful</h2>
    <a href="Track.php"><button class='continue-shopping-button'>Trace Order</button></a>
    <a href='mainpage.php'><button class='continue-shopping-button'>Main page</button></a>
</main>

<footer>
    <p>&copy; 2024 Supermarket. All rights reserved.</p>
</footer>
</body>
</html>
