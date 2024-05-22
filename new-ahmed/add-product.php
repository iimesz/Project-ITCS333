<?php

try {
    $category_id = $_GET['Cid'];
    require('connection.php');
    $sql = "SELECT * FROM category";
    $pd = $db->query($sql);
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
    <title>Supermarket</title>
    <link rel="stylesheet" href="color.css">
    <link rel="stylesheet" href="c.css">
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
        <h1>Edit Inventory</h1>
        <h3>add category</h3>
        <section class="category-products">
            <div class='product'>
                <form method="post" action='add-p.php'>
                    Enter Product Name <br><br>
                    <input type="text" name='pn'> <br><hr><br>
                    Enter Product Price <br><br>
                    <input type="text" name='pp' ><br><hr><br>
                    Enter Product Discribtion <br><br>
                    <textarea name='pd' rows='8' cols='80'></textarea><br><hr><br>
                    Enter Product Quantity <br><br>
                    <input type="text" name='pq' ><br><hr><br>
                    Enter Product Category <br><br>
                    <select name='pc'>
                        <?php
                        while ($details = $pd->fetch(PDO::FETCH_ASSOC)) {
                        extract($details);
                        if ($Cid==$category_id)
                            echo "<option value='$Cid' selected>$Cname</option>";
                        else
                            echo "<option value='$Cid'>$Cname</option>";
                        }
                        ?>
                    </select><br><hr><br>
                    Select an Image <br><br>
                    <input type="file" name="pi"><br><hr><br>
                    <input type="submit" style='font-size:20px'><br><br>
                </form>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
