<?php

session_start();

if(!isset($_SESSION['username']))
    header("location:login.php");

$user = $_SESSION['username'];
try{
    require('connection.php');
    $sql = "SELECT o.* , oi.orderid,oi.pid,oi.quantity FROM orders AS o 
    JOIN order_items AS oi 
    ON o.Order_id=oi.orderid Where o.Username = ? AND o.Status != 'Completed'";
    $pd= $db->prepare($sql);
    $pd->execute(array($user));
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
    <link rel="stylesheet" href="customer-track.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <form method="post" action="search.php" class="search-form">
                <input id="se" type="text" placeholder="Search for an Item" name="search">
                <button type="submit" name="sb"><i class="fas fa-search"></i></button>
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
        <div class="category-products">
            <?php
            if($details=$pd->fetch(PDO::FETCH_ASSOC)){
                extract($details);
                try{
                    $sql2= "select Price from products where Pid=$pid";
                    $data= $db->query($sql2);
                    $product = $data->fetch(PDO::FETCH_ASSOC);
                    extract($product);
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                echo "<div class='product'>";
                echo "<table border=1>";
                echo "<tr>";
                echo "<th>Order Id</th>";
                echo "<th>Username</th>";
                echo "<th>Status</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>$Order_id</td>";
                echo "<td>$Username</td>";
                echo "<td>$Status</td>";
                echo "<tr>";
                echo "</table>";
                echo "</div>";
            }
            else{
                echo "<h2 style='text-align:center; margin-top: 100px; color:red;'>No Order Placed</h2>";
            }
            
            ?>
        </div>
    </main>
    <footer>
            <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
