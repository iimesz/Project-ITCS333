<?php


session_start();

if (isset($_POST['addtocart'])) {
    $pid = $_POST['pid'];
    $qty = $_POST['qty'];
    $cid = $_POST['cid'];
    $_SESSION['mycart'][$pid] = $qty;
    header("location:cart.php");
}


try{
    require('connection.php');
    if(isset($_POST['sb'])) {
        $search = $_POST['search'];
        $search = "{$search}";
        $sql = "SELECT * FROM products WHERE Name REGEXP ? OR Description REGEXP ?";
        
        $stmt = $db->prepare($sql);
        $stmt->execute(array($search, $search));
    }
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
    <link rel="stylesheet" href="search.css">
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

    <div class="container">

    <section class="category-products">
        <?php
           while($details=$stmt->fetch(PDO::FETCH_ASSOC)){
            extract($details);
            echo "<div class='product'>";
            echo "<a href='detail.php?Pid=$Pid'>";
            echo"<img src='images/$Picture' alt='Fruit 1'></a>";
            echo "<h3>$Name</h3></br>";
            echo "<p >Price:$Price BD</p></br>";
            if ($Quantity==0)
                echo "<h3 style='color:red'>Out of Stock</h3>";
            else{
        ?>
            <form method='post'>
                <select name='qty' class='q'>
                <?php
                    for($i=1;$i<=$Quantity;++$i)
                    echo "<option>$i</option>\n";
                ?>
                </select>
                <input type='hidden' name='pid' value='<?php echo $Pid; ?>' />
                <input type='submit' class='add' name='addtocart' value='Add to Cart' />
            </form>
        <?php
            }
            echo "</div>";
            }
        ?>
    </section>
    </div>

    <footer>
            <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>