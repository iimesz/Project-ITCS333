<?php

try{
    require('connection.php');
    $Pid = $_GET['Pid'];
    $sql= "select * from products where Pid = ?";
    $pd= $db->prepare($sql);
    $pd->execute(array($Pid));
    $db=null;
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
    <link rel="stylesheet" href="d.css">
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
                <a href='mainpage.php'><i class="fas fa-home"></i> Home</a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart</a>
                <a href="#">Contact</a>
            </nav>
        </div>
    </header>

    <section class="fruit"></section>

    <main>
        <section class="category-products">
            <?php
                if($details=$pd->fetch(PDO::FETCH_ASSOC)){
                    extract($details);
                    echo "<div class='product'>";
                    echo"<img src='images/$Picture' alt='Fruit 1'></a>";
                    echo "<div class='info'>";
                    echo "<form method='post'action='edit-product.php'>";
                    echo "<input type='text' name='pr_name' value='$Name' style='width:400px'>";
                    echo "<p><b>Product Desciption:</b></p></br>";
                    echo "<textarea name='pro_description' rows='8' cols='80'>$Description</textarea>";
                    echo "<p><b>Price:</b></p>";
                    echo "<input type='text' name='pro_price' value='$Price'> BD";
                    echo "<p><b>Quantity:</b></p>";
                    echo "<input type='text' name='pro_quantity' value='$Quantity'>";


                ?>
                    <input class='add' type='submit' value='Confirm' />
                    </div>
                    <input type='hidden' name='pid' value='<?php echo $Pid; ?>' />
                    <input type="hidden" name='cid' value='<?php echo $Cid;?>'/>
                    </form>
                <?php
                echo "</form>";
                echo "</div>";
                }
            ?>
        </section>
        </div>
    </main>
    <footer>
            <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
