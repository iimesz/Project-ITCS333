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

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin</h1>
        <div class="form">
            <?php
            if (isset($_SESSION['username']) && $_SESSION['user_type'] == 'admin') {

                $error = "";
                $success = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
                    
                    $staff_username = trim($_POST['username']);
                    $staff_password = trim($_POST['password']);
                    $staff_fname = trim($_POST['fname']);
                    $staff_lname = trim($_POST['lname']);
                    $staff_email = trim($_POST['email']);
                    $staff_contact = trim($_POST['contact']);
                    
                    $UserEx = "/^[a-zA-Z0-9_-]{3,16}$/";
                    $PassEx = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,16}$/";
                    $NameEx = "/^[a-zA-Z0-9_-]{3,16}$/";
                    $EmailEx = "/^[a-zA-Z0-9.-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/";
                    $ContactEx = "/^(?:\+973|00973)?(3[0-9]{7}|1[7-9][0-9]{6})$/";
                    
                    if (empty($staff_username) || empty($staff_password) || empty($staff_fname) || empty($staff_lname) || empty($staff_email) || empty($staff_contact)) {
                        $error = "All fields are required";
                    } elseif (!preg_match($UserEx, $staff_username)) {
                        $error = "Invalid username format";
                    } elseif (!preg_match($PassEx, $staff_password)) {
                        $error = "Invalid password format";
                    } elseif (!preg_match($NameEx, $staff_fname)) {
                        $error = "Invalid first name format";
                    } elseif (!preg_match($NameEx, $staff_lname)) {
                        $error = "Invalid last name format";
                    } elseif (!preg_match($EmailEx, $staff_email)) {
                        $error = "Invalid email format";
                    } elseif (!preg_match($ContactEx, $staff_contact)) {
                        $error = "Invalid contact number format";
                    } else {

                        $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

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
                            $success = "New staff member added successfully.";
                        } else {
                            $error = "Error adding staff member: " . $stmt->errorInfo()[2];
                        }
                    }
                }

                if ($error) {
                    echo "<p class='error'>$error</p>";
                }

                if ($success) {
                    echo "<p class='success'>$success</p>";
                    echo "<ul>";
                    echo "<li><strong>Username:</strong> $staff_username</li>";
                    echo "<li><strong>First Name:</strong> $staff_fname</li>";
                    echo "<li><strong>Last Name:</strong> $staff_lname</li>";
                    echo "<li><strong>Email:</strong> $staff_email</li>";
                    echo "<li><strong>Contact:</strong> $staff_contact</li>";
                    echo "</ul>";
                    echo '<button onclick="window.location.href=\'admin.php\';">Add Another Staff</button>';
                    echo '<button class="logout-button" onclick="window.location.href=\'logout.php\';">Log Out</button>';
                } else {
                    ?>
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <input type="text" name="fname" placeholder="First Name">
                        <input type="text" name="lname" placeholder="Last Name">
                        <input type="text" name="email" placeholder="Email">
                        <input type="text" name="contact" placeholder="Contact">
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
