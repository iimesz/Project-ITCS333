<?php

$products['A1'] = array('name' => 'banana' , 'price' => 3,"qty"=>8,"picture"=>'banana.jpg','category'=>'Fruits');
$products['A2'] = array('name' => 'apple' , 'price' => 2,"qty"=>5,"picture"=>'apple.jpg','category'=>'Fruits');
$products['A3'] = array('name' => 'mango' , 'price' => 4,"qty"=>10,"picture"=>'mango.jpg','category'=>'Fruits');
$products['A4'] = array('name' => 'orange' , 'price' => 3,"qty"=>11,"picture"=>'orange.jpg','category'=>'Fruits');

session_start();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="ttttr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<header>
    <div class="detail">
        <h1>Your Shopping Cart</h1>
        <nav>
            <a href="mainpage.php"><i class="fas fa-home"></i> Home</a>
            <a href="products.php">Products</a>
            <a href="#"><i class="fas fa-shopping-cart"></i>Cart</a>
            <a href="#">Contact</a>
        </nav>
    </div>
</header>

<div class="fruit"></div>

<main>
  <div class="cart-products"> 
  <?php
  if (!isset($_SESSION['mycart']) || empty($_SESSION['mycart'])){
    echo "<img class='empty' src='empty-cart.png' alt='no' /></br>";    
    echo "<h1>Your cart is empty</h1></br>";
    echo "<a href='products.php'><button class='continue-shopping-button'>Continue Shopping</button></a>";
  }

  else {
    ?>
    <form method='post' action='updatecart.php'>
    <?php
    $cart = $_SESSION['mycart'];
    foreach($cart as $pid=>$qty)
    { 
        $product = $products[$pid];
        echo "<div class='product'>";
        echo "<img src='images/".$product['picture']." '/>";
        echo "<h3>".$product['name']."</h3>";
        echo "<p>Price: ".$product['price']." BD</p>"; 
            echo "<select name='qty[]'>";
            for($i=1;$i<=$product['qty'];++$i){
            echo "<option ";
            if ($i==$qty) echo "selected ";
            echo ">$i</option>";
            }
            echo "</select>";
        echo "<input type='hidden' name='pid[]' value='$pid' />";
        echo "<a href='remove.php?pid=$pid'><i class='fa-solid fa-trash-can'></i>Remove</a>";
        echo "</div>";
        
     }
  ?>
  </br>
  <input type='submit' value='Update All' />
  <input type='submit' name='remove_all' formaction='remove_all.php' value='Remove All' />
  
</form>
</table>
<?php }?>
</div>
</main>

<footer>
    <p>&copy; 2024 Supermarket Website</p>
</footer>

</body>
</html>
