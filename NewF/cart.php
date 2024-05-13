<?php
session_start();
try{
    require('connection.php');
}
catch(PDOException $e){
    die($e->getMessage());
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="ttttr.css">

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
    $total =0;
    foreach($cart as $pid=>$qty)
    { 
        try{
            $sql= "select * from products where Pid=$pid";
            $pd= $db->query($sql);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        if ($details=$pd->fetch(PDO::FETCH_ASSOC)){
            extract($details);
            echo "<div class='product'>";
            echo "<img src='images/$Picture '/>";
            echo "<h3 style = 'width:30%'>$Name</h3>";
            echo "<p>Price:$Price BD</p>"; 
                echo "<select name='qty[]'>";
                for($i=1;$i<=$Quantity;++$i){
                echo "<option ";
                if ($i==$qty) echo "selected ";
                echo ">$i</option>";
                }
                echo "</select>";
            $total += ($qty*$Price);
            echo "<input type='hidden' name='pid[]' value='$Pid' />";
            echo "<a href='remove.php?pid=$Pid'><i class='fa-solid fa-trash-can'></i>Remove</a>";
            
            echo "</div>";
        }
        
    }
  ?>
  </br>
  <input type='submit' name='up' value='Update All' />
  <input type='submit' name='remove_all' formaction='remove_all.php' value='Remove All' />
<div class='sales'>
<table>
    <tr>
    <th><h2>Total sales</h2></th></tr>
    <tr>
    <td><h3>Total<h3></td>
    <td><h3><?php echo $total?>BD</h3></td></tr>
    <?php $total+=0.7; ?>
    <tr><td><h3>Delivery fees<h3></td>
    <td><h3>0.7 BD<h3></td></tr>
    <tr><td><h2 style='color:red'>All amount</h2></td>
    <td><h2 style='color:red'><?php echo $total?> BD</h2></td></tr>
</table>
</div>

<input type='submit' name='po' value='Place Order' />

</form>
<?php
}
?>

</div>
</main>


<footer>
    <p>&copy; 2024 Supermarket Website</p>
</footer>

</body>
</html>
