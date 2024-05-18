<?php
try {
    require('connection.php');
    $Cid = $_GET['Cid'];
    $sql = "SELECT * FROM products WHERE Cid = ?";
    $pd = $db->prepare($sql);
    $pd->execute([$Cid]);
    $db = null;
} catch(PDOException $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fruit Category</title>
  <link rel="stylesheet" href="ses.css">
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
                <a href="#">Contact</a>
            </nav>
        </div>
</header>

<div class="fruit"></div>

<main>
  <div class="category-products">
        <?php
        while($details=$pd->fetch(PDO::FETCH_ASSOC)){
            extract($details);
            echo "<div class='product'>";
            echo "<a href='dl.php?Pid=$Pid'>";
            echo"<img src='images/$Picture' alt='Fruit 1'></a>";
            echo "<h3 style='text-align:left'>$Name</h3></br>";
            echo "</div>";
        }
        ?>
            <div class='product'>
            <a href="add-product.php?Cid=<?php echo $Cid ?>">
            <i class="fa-solid fa-plus" style='font-size: 150px;'></i>
            </a>
            <h3>Add Product</h3>
            </div>

    </div>

</main>

<footer>
  <p>&copy; 2024 Supermarket Website</p>
</footer>

</body>
</html>
