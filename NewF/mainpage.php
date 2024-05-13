<?php

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
    <link rel="stylesheet" href="color.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <form method='post' action='search.php' class="search-form">
                <input id='se' type="text" value='Search for an Item' name="search">
                <button type="submit" name='sb'><i class="fas fa-search"></i></button>
            </form>
            <nav>
                <a href="https://localhost/project/mainpag.php"><i class="fas fa-home"></i> Home</a>
                <a href="#">Products</a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart</a>
                <a href="#">Contact</a>
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
                echo "<a href='products.php'>";
                echo"<img src='images/$image' alt='Product 1'>";
                echo"</a>";
                echo"<h3>$Name</h3>";
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


