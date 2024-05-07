<?php

$products['A1'] = array('name' => 'banana' , 'price' => 1,"qty"=>8,"picture"=>'banana.jpg','category'=>'Fruits');
$products['A2'] = array('name' => 'apple' , 'price' => 2,"qty"=>5,"picture"=>'apple.jpg','category'=>'Fruits');
$products['A3'] = array('name' => 'mango' , 'price' => 4,"qty"=>10,"picture"=>'mango.jpg','category'=>'Fruits');
$products['A4'] = array('name' => 'orange' , 'price' => 3,"qty"=>11,"picture"=>'orange.jpg','category'=>'Fruits');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="pr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
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
            foreach($products as $info){
                extract($info);
                echo "<div class='product'>";
                echo "<a href='products.php'>";
                echo"<img src='image.png' alt='Product 1'>";
                echo"</a>";
                echo"<h3>$category</h3>";
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


