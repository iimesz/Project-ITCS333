<?php
session_start();
require 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body {
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            box-sizing: border-box;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #b60505;
            margin-bottom: 40px;
        }

        .form {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"] {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px;
                margin: 30px auto;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"],
            input[type="tel"],
            button {
                padding: 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
                margin: 20px auto;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"],
            input[type="tel"],
            button {
                padding: 6px;
                font-size: 12px;
            }
        }

        .logout-button {
            margin-top: 20px;
            background-color: #dc3545;
        }

        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin</h1>
        <div class="form">
            <?php
            if (isset($_SESSION['username']) && $_SESSION['user_type'] == 'admin') {

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
                    
                    $staff_username = $_POST['username'];
                    $staff_password = $_POST['password'];
                    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);
                    $staff_fname = $_POST['fname'];
                    $staff_lname = $_POST['lname'];
                    $staff_email = $_POST['email'];
                    $staff_contact = $_POST['contact'];

                    $query = "INSERT INTO users (Username, Password, Fname, Lname, Email, Contact, `User-Type`) 
                              VALUES (:username, :password, :fname, :lname, :email, :contact, 'staff')";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':username', $staff_username);
                    $stmt->bindParam(':password', $hashed_password);
                    $stmt->bindParam(':fname', $staff_fname);
                    $stmt->bindParam(':lname', $staff_lname);
                    $stmt->bindParam(':email', $staff_email);
                    $stmt->bindParam(':contact', $staff_contact);

                    if ($stmt->execute()) {
                        echo "<h2>New staff member added successfully:</h2>";
                        echo "<ul>";
                        echo "<li><strong>Username:</strong> $staff_username</li>";
                        echo "<li><strong>First Name:</strong> $staff_fname</li>";
                        echo "<li><strong>Last Name:</strong> $staff_lname</li>";
                        echo "<li><strong>Email:</strong> $staff_email</li>";
                        echo "<li><strong>Contact:</strong> $staff_contact</li>";
                        echo "</ul>";
                    } else {
                        echo "<p>Error adding staff member: " . $stmt->errorInfo()[2] . "</p>";
                    }
                    echo '<button onclick="window.location.href=\'admin.php\';">Add Another Staff</button>';
                    echo '<button class="logout-button" onclick="window.location.href=\'logout.php\';">Log Out</button>';
                } else {
                    ?>
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="text" name="fname" placeholder="First Name" required>
                        <input type="text" name="lname" placeholder="Last Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="tel" name="contact" placeholder="Contact" required>
                        <button type="submit" name="add_staff">Add Staff</button>
                    </form>
                    <button class="logout-button" onclick="window.location.href='logout.php';">Log Out</button>
                    <?php
                }

                $db = null;
            } else {
                header("Location: login.php");
                exit();
            }
            ?>
        </div>
    </div>
</body>
</html>
