<?php
try{
    require('connection.php');
    $sql= "select * from products";
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
  <title>Fruit Category</title>
  <link rel="stylesheet" href="se.css">
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

    <div class="fruit"></div>

<main>
    <h1>Fruit Category</h1>
  <div class="category-products">
        <?php
        while($details=$pd->fetch(PDO::FETCH_ASSOC)){
            extract($details);
            echo "<div class='product'>";
            echo"<img src='images/$Picture' alt='Fruit 1'>";
            echo "<h3 style='text-align:left'>$Name</h3></br>";
            echo "<p >Price:$Price BD</p></br>";
            if ($Quantity==0)
                echo "<h3 style='color:red'>Out of Stock</h3>";
            else{
            ?>
            <form method='post' action='addtocart.php'>
                <select name='qty'>
                <?php
                    for($i=1;$i<=$Quantity;++$i)
                    echo "<option>$i</option>\n";
                ?>
                </select><br />
                <input type='hidden' name='pid' value='<?php echo $Pid; ?>' />
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
