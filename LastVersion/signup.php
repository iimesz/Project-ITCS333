<?php
session_start();
require 'connection.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $user_type = 'customer';

    $UserEx = "/^[a-zA-Z0-9_-]{3,16}$/";
    $PassEx = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,16}$/";
    $NameEx = "/^[a-zA-Z0-9_-]{3,16}$/";
    $EmailEx = "/^[a-zA-Z0-9.-_]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/";
    $ContactEx = "/^(?:\+973|00973)?(3[0-9]{7}|1[7-9][0-9]{6})$/";

    if (empty($username) || empty($password) || empty($confirm_password) || empty($fname) || empty($lname) || empty($email) || empty($contact)) {
        $error = "All fields are required.";
    } elseif (!preg_match($UserEx, $username)) {
        $error = "Invalid username format.";
    } elseif (!preg_match($PassEx, $password)) {
        $error = "Invalid password format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!preg_match($NameEx, $fname)) {
        $error = "Invalid first name format.";
    } elseif (!preg_match($NameEx, $lname)) {
        $error = "Invalid last name format.";
    } elseif (!preg_match($EmailEx, $email)) {
        $error = "Invalid email format.";
    } elseif (!preg_match($ContactEx, $contact)) {
        $error = "Invalid contact number format.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (Username, Password, Fname, Lname, Email, Contact, `User-Type`) VALUES (:username, :password, :fname, :lname, :email, :contact, :user_type)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':user_type', $user_type);

        if ($stmt->execute()) {
            $success = "User registered successfully.";
        } else {
            $error = "Error registering user.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            box-sizing: border-box;
            text-align: center;
            margin: 50px auto; 
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        .form {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }

        button {
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .login-button {
            background-color: #007bff;
            margin-top: 10px;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px;
                margin: 30px auto;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"],
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
            button {
                padding: 6px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <div class="form">
            <form method="post">
                <input type="text" id="username" name="username" placeholder="Username" onkeyup="checkUN(this.value)">
                <span id="unmsg"></span>
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <input type="text" name="fname" placeholder="First Name">
                <input type="text" name="lname" placeholder="Last Name">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="contact" placeholder="Contact Number">
                <button type="submit">Sign Up</button>
            </form>
            <button class="login-button" onclick="window.location.href='login.php';">Go to Login</button>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
        </div>
    </div> 
<script>
function checkUN(str) {
  if (str.length <= 3) {
    document.getElementById("unmsg").innerHTML = "Type at least 4 characters";
    document.getElementById("unmsg").style.color = "orange";
    return;
    
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    if (this.responseText == "taken") {
      document.getElementById('username').style.borderColor = "red";
      document.getElementById("unmsg").style.color = "red";
      document.getElementById("unmsg").innerHTML = "Not available";
    } else {
      document.getElementById('username').style.borderColor = "green";
      document.getElementById("unmsg").innerHTML = "Available";
      document.getElementById("unmsg").style.color = "green";

    }
  };
  xhttp.open("GET", "checkun.php?q=" + str, true);
  xhttp.send();
}
</script>
</body>
</html>