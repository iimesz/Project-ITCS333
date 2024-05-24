<?php
session_start();

try{
    require('connection.php');
    $sql= "select * from category";
    $pd= $db->query($sql);
    $db = null;
}
catch(PDOException $e){
    die($e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="main.css">
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
                <a href="previous.php"><i class="fa-solid fa-clipboard"></i> Previous</a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
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

    <section class="hero"></section>

    <div class="container">

    <section class="category-products">
        <?php
            while($details=$pd->fetch(PDO::FETCH_ASSOC)){
                extract($details);
                echo "<div class='product'>";
                echo "<a href='products.php?Cid=$Cid'>";
                echo"<img src='images/$image' alt='Product 1'>";
                echo"</a>";
                echo"<h3>$Cname</h3>";
                echo"</div>";
            }
            ?>
            

    </section>
    </div>

    <footer>
            <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>


