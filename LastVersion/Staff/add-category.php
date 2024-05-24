<?php

session_start();


if($_SESSION['user_type'] != 'staff'){
    header("location:login.php");
}


require('connection.php');

$error=" ";

if(isset($_POST['sb'])){
    $image=$_POST['cat-image'];
    $name = trim($_POST['am']);

    $nameEx = "/^[a-zA-Z]+$/";

    if (empty($name) || empty($image)) {
        $error = "Name require";    
    } 
    elseif (!preg_match($nameEx, $name)) {
        $error = "Invalid name format";
    }

    else{
    try{
        $sql="insert into category values (null,'$name' , '$image')";
        $pd= $db->exec($sql);
        $db = null;
        }
    catch(PDOException $e){
        die($e->getMessage());
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
    <link rel="stylesheet" href="category.css">
    <link rel="stylesheet" href="c.css">
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

    <section class="hero"></section>

    <div class="container">
        <h1>Add Category</h1>
        <section class="category-products">
            <div class='product'>
                <form method="post" >
                    Enter Category Name <br><br>
                    <input type="text" name='am'> <br><hr><br>
                    Select an Image <br><br>
                    <input type="file" name="cat-image"><br><hr><br>
                    <input type="submit" name='sb' style='font-size:20px'><br><br>
                </form>
                <?php echo "<h3 style='color:red'>$error<h3>"; ?>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>
