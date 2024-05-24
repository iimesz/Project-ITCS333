<?php

session_start();


if($_SESSION['user_type'] != 'staff'){
    header("location:login.php");
}

require('connection.php');


if(isset($_POST['sb'])){
    try{
        $pr_name = $_POST['pr_name'];
        $pro_description = $_POST['pro_description'];
        $pro_price = $_POST['pro_price'];
        $pro_quantity = $_POST['pro_quantity'];
        $pr_id = $_POST['pid'];


        $sql = "UPDATE products SET Name = ?, Price = ?, Description = ?, Quantity = ? WHERE Pid = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pr_name, $pro_price, $pro_description, $pro_quantity, $pr_id]);
        $db = null;
        header("Location: edit-product.php?Pid=$pr_id");

    } catch(PDOException $e){
        die($e->getMessage());
    }
}

try{
    $Pid = $_GET['Pid'];
    $sql = "SELECT * FROM products WHERE Pid = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$Pid]);
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
} catch(PDOException $e){
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="detail">
            <h1>Welcome to Our Supermarket</h1>
            <form method='post' action='search.php' class="search-form">
                <input id='se' type="text" placeholder='Search for an Item' name="search">
                <button type="submit" name='sb'><i class="fas fa-search"></i></button>
            </form>
            <nav>
                <a href="staff-mainpage.php"><i class="fas fa-home"></i> Home</a>
                <a href="staff-track.php"><i class="fa-solid fa-clipboard"></i> Orders</a>
                <?php
                if(isset($_SESSION['username'])) 
                    echo"<a href='logout.php'><i class='fa-solid fa-user'></i> Logout</a>";
                ?>  
            </nav>
        </div>
    </header>

    <section class="fruit"></section>

    <main>
        <section class="category-products">
            <?php
                if($details){
                    extract($details);
                    echo "<div class='product'>";
                    echo "<img src='images/$Picture' alt='Fruit 1'>";
                    echo "<div class='info'>";
                    echo "<form method='post'>";
                    echo "<p><b>Name:</b></p>";
                    echo "<input id='name' type='text' name='pr_name' value='$Name'/>";
                    echo "<p><b>Product Description:</b></p>";
                    echo "<textarea id='area' name='pro_description' rows='6' cols='70' value='$Description'>$Description</textarea>";
                    echo "<p><b>Price:</b></p>";
                    echo "<input class='edit' type='text' name='pro_price' value='$Price'> BD";
                    echo "<p><b>Quantity:</b></p>";
                    echo "<input class='edit' type='text' name='pro_quantity' value='$Quantity'>";
            ?>
                    <input class='add' type='submit' name='sb' />
                    <input type='hidden' name='pid' value='<?php echo $Pid; ?>' />
                <?php
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
