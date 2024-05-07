<?php

$products['A1'] = array('name' => 'banana' , 'price' => 1,"qty"=>8,"picture"=>'banana.jpg');
$products['A2'] = array('name' => 'apple' , 'price' => 2,"qty"=>5,"picture"=>'apple.jpg');
$products['A3'] = array('name' => 'mango' , 'price' => 4,"qty"=>10,"picture"=>'mango.jpg');
$products['A4'] = array('name' => 'orange' , 'price' => 3,"qty"=>11,"picture"=>'orange.jpg');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fruit Category</title>
  <link rel="stylesheet" href="se.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <nav>
                <a href="mainpage.php"><i class="fas fa-home"></i> Home</a>
                <a href="#">Products</a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart</a>
                <a href="#">Contact</a>
            </nav>
        </div>
    </header>

    <div class="fruit"></div>

<main>
    <h1>Fruit Category</h1>
  <div class="category-products">
        <?php
        foreach($products as $pid => $details){
            extract($details);
            echo "<div class='product'>";
            echo"<img src='images/$picture' alt='Fruit 1'>";
            echo "<h2>$name</h2>";
            echo "<p>Description of Fruit 1</p>";
            if ($qty==0)
                echo "<h3 style='color:red'>Out of Stock</h3>";
            else{
            ?>
            <form method='post' action='addtocart.php'>
                <select name='qty'>
                <?php
                    for($i=1;$i<=$qty;++$i)
                    echo "<option>$i</option>\n";
                ?>
                </select><br />
                <input type='hidden' name='pid' value='<?php echo $pid; ?>' />
                <input type='submit' value='Add to Cart' />
            </form>
            <?php
             }
             echo "</div>";
            }
            ?>
    </div>

</main>

<footer>
  <p>&copy; 2024 Supermarket Website</p>
</footer>

</body>
</html>
