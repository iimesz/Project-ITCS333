<?php
require('connection.php');
session_start();

if(!isset($_SESSION['username']))
    header("location:login.php");

$user = $_SESSION['username'];

try {
    $sql = "SELECT o.*, oi.orderid, oi.pid, oi.quantity, p.Picture, p.Price, p.Name
            FROM orders AS o
            JOIN order_items AS oi ON o.Order_id = oi.orderid
            JOIN products AS p ON oi.pid = p.Pid
            WHERE o.Username = ? AND o.Status = 'Completed'
            ORDER BY o.Date";
    $pd = $db->prepare($sql);
    $pd->execute(array($user));
} catch (PDOException $e) {
    die($e->getMessage());
}

$orders = [];
while ($details = $pd->fetch(PDO::FETCH_ASSOC)) {
    $orders[$details['Date']][] = $details;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="pre.css">
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
            if (empty($orders)) {
                echo "<h2 style='text-align:center; color:red;'>No previous orders</h2>";
            } else {
                foreach ($orders as $date => $orderDetails) {
                    echo "<h2 style='text-align:center' >Orders on $date</h2>";
                    echo "<table border='1' align='center'>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Quantity</th>";
                    echo "</tr>";
                    foreach ($orderDetails as $details) { 
                        echo "<tr>";
                        echo "<td>" . $details['Name'] . "</td>";
                        echo "<td>". $details['Price'] . " BD</td>";
                        echo "<td>" . $details['quantity'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            ?>
        </div>
    </main>
</body>
</html>
