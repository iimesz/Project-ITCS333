<?php

session_start();


if($_SESSION['user_type'] != 'staff'){
    header("location:login.php");
}

require('connection.php');


$category_id = $_GET['Cid'];
$error = '';

if(isset($_POST['sb'])){
    try{
        require('connection.php');

        $name1 = trim($_POST['pn']);
        $price1 = trim($_POST['pp']);
        $des = trim($_POST['pd']);
        $qua = trim($_POST['pq']);
        $image=$_POST['pi'];
        
        

        $desEx = "/^[a-zA-Z]+$/";
        $prEx = "/^\d+(.\d{1,3})?$/";
        $desEx = "/^[a-zA-Z0-9&]*$/"; 
        $quaEx = "/^\d+$/";

    if (empty($name1) || empty($price1) || empty($des) || empty($qua || empty($image))) {
        $error = "All fields are required.";
    } elseif (!preg_match($desEx, $name1)) {
        $error = "Invalid name format.";
    } elseif (!preg_match($prEx, $price1)) {
        $error = "Invalid price format.";
    } elseif (!preg_match($desEx, $des)) {
        $error = "Invalid decrption format.";
    } elseif (!preg_match($quaEx, $qua)) {
        $error = "Invalid quantity format.";
    } else {
        $sql="insert into products values (null,'$name1' , $price1 , '$des' , $qua , $category_id , '$image')";
        $pd= $db->exec($sql);
        $db = null;
    }
    }
    
    catch(PDOException $e){
        die($e->getMessage());
      }
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
                <input id='se' type="text" placeholder="Search for an item" name="search">
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
        <h1>Add product</h1>
        <section class="category-products">
            <div class='product'>
                <form method="post" >
                    Enter Product Name <br><br>
                    <input type="text" name='pn'> <br><hr><br>
                    Enter Product Price <br><br>
                    <input type="text" name='pp'><br><hr><br>
                    Enter Product Discribtion <br><br>
                    <textarea name='pd' rows='5' cols='50'></textarea><br><hr><br>
                    Enter Product Quantity <br><br>
                    <input type="text" name='pq' ><br><hr><br>
                    The Category is 
                    <?php

                    try{
                    require('connection.php');
                    $sql = "SELECT * FROM category where Cid = $category_id ";
                    $pd = $db->query($sql);
                    $db = null;
                    }
                    catch(PDOException $e) {
                        die($e->getMessage());
                    }
                    if($details = $pd->fetch(PDO::FETCH_ASSOC)) {
                        extract($details);
                        echo "<h4>$Cname</h4>";
                    }
                   
                    ?>
                    <br><hr><br>
                    Select an Image <br><br>
                    <input type="file" name="pi" ><br><hr><br>
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