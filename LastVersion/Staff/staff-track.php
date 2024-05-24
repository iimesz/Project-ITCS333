<?php
session_start();

if ($_SESSION['user_type'] != 'staff') {
    header("location:login.php");
}

try {
    require('connection.php');

    if (isset($_POST['orderId']) && isset($_POST['status'])) {
        $orderId = $_POST['orderId'];
        $newStatus = $_POST['status'];

        $updateQuery = "UPDATE orders SET status = :status WHERE Order_id = :orderId";
        $stmt = $db->prepare($updateQuery);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
    }

    $sql = "SELECT * FROM orders WHERE Status != 'Completed'";
    $pd = $db->prepare($sql);
    $pd->execute();
    $orderCount = $pd->rowCount();
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="st.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <form method="post" action="search.php" class="search-form">
                <input id='se' type="text" placeholder="Search for an item" name="search">
                <button type="submit" name="sb"><i class="fas fa-search"></i></button>
            </form>
            <nav>
                <a href="staff-mainpage.php"><i class="fas fa-home"></i> Home</a>
                <a href="staff-track.php"><i class="fa-solid fa-clipboard"></i> Orders</a>
                <?php
                if (isset($_SESSION['username'])) 
                    echo "<a href='logout.php'><i class='fa-solid fa-user'></i> Logout</a>";
                ?> 
            </nav>
        </div>
    </header>
    <section class="fruit"></section>
    <main>
        <div class="category-products">
            <?php
            if ($orderCount > 0) {
                echo "<div class='product'>";
                echo "<table border=1 align='center'>";
                echo "<tr>";
                echo "<th>Order Id</th>";
                echo "<th>Username</th>";
                echo "<th>Status</th>";
                echo "<th>Update Status</th>";
                echo "</tr>";

                while ($details = $pd->fetch(PDO::FETCH_ASSOC)) {
                    extract($details);
                    echo "<tr>";
                    echo "<td>$Order_id</td>";
                    echo "<td>$Username</td>";
                    echo "<td>$Status</td>";
                    echo "<td id='bt'>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='orderId' value='$Order_id'>";
                    echo "<button type='submit' name='status' value='Acknowledge'>Acknowledge</button>";
                    echo "<button type='submit' name='status' value='In Process'>In Process</button>";
                    echo "<button type='submit' name='status' value='In Transit'>In Transit</button>";
                    echo "<button type='submit' name='status' value='Completed'>Completed</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</div>";
                }

                echo "</table>";
            } else {
                echo "<h2 style='text-align:center; margin-top: 100px; color:red;'>No Orders</h2>";
            }
            ?>
        </div>
    </main>
   
    <footer>
        <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
