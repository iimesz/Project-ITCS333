<?php

session_start();

if (isset($_POST['addtocart'])) {
    $pid = $_POST['pid'];
    $qty = $_POST['qty'];
    $cid = $_POST['cid'];
    $_SESSION['mycart'][$pid] = $qty;
}

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

    <section class="fruit"></section>
    
    <main>
        <section class="category-products">
            <?php
                if($details=$pd->fetch(PDO::FETCH_ASSOC)){
                    extract($details);
                    echo "<div class='product'>";
                    echo"<img src='images/$Picture' alt='Fruit 1'></a>";
                    echo "<div class='info'>";
                    echo "<h3>$Name</h3></br>";
                    echo "<p><b>Product Desciption:</b></br>$Description</p>";
                    echo "<p><b>Price:</b></br>$Price BD</p></br>";
                    if ($Quantity==0)
                        echo "<h3 style='color:red'>Out of Stock</h3>";
                    else{
                ?>
                    <form method='post'>
                    <select class='q' name='qty'>
                    <?php
                        for($i=1;$i<=$Quantity;++$i)
                        echo "<option>$i</option>\n";
                    ?>
                    </select>
                    <input class='add' name='addtocart' type='submit' value='Add to Cart' />
                    </div>
                    <input type='hidden' name='pid' value='<?php echo $Pid; ?>' />
                    <input type="hidden" name='cid' value='<?php echo $Cid;?>'/>
                    </form>
                <?php
                }
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
