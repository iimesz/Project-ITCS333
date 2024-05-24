<?php
session_start();
require 'connection.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $UserEx = "/^[a-zA-Z0-9_-]{3,16}$/";
    $PassEx = "/^(?=.*\d)(?=.*[a-z]).{6,16}$/";

    if (!preg_match($UserEx, $username)) {
        $error = "Invalid username format.";
    } elseif (!preg_match($PassEx, $password)) {
        $error = "Invalid password format.";
    } else {
        $query = "SELECT * FROM users WHERE Username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['Password'])) {
                $_SESSION['username'] = $user['Username'];
                $_SESSION['user_type'] = $user['User-Type'];

                if ($user['User-Type'] == 'admin') {
                    header("Location: project.php");
                } elseif ($user['User-Type'] == 'customer') {
                    header("Location: mainpage.php");
                }elseif($user['User-Type'] == 'staff'){
                    header("Location: Staff/staff-mainpage.php");
                } 
                else {
                    $error = "Invalid user type.";
                }
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            color: #b60505;
            margin-bottom: 20px;
        }

        .form {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
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

        .Sign-up {
            background-color: #28a745;
            margin-top: 10px;
        }

        .Sign-up:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .signup-text {
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
        }
        @media (max-width: 768px) {
            .container {
                padding: 30px;
                margin: 30px auto;
            }

            input[type="text"],
            input[type="password"],
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
            button {
                padding: 6px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <div class="form">
            <form method="post">
                <input type="text" name="username" placeholder="Username" required >
                <input type="password" name="password" placeholder="Password" required >
                <button type="submit">Login</button>
            </form>
            <p class="signup-text">Don't have an account ?</p>
            <button class="Sign-up" onclick="window.location.href='signup.php';">Sign Up</button>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
