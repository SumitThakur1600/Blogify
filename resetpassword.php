<?php
include("database.php");

$message = "";
$email = $_SESSION['email']; 

if (isset($_POST['reset_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $updatePasswordQuery = "UPDATE `signup` SET `password` = '$hashedPassword', `otp` = '0' WHERE `email` = '$email'";
        if ($conn->query($updatePasswordQuery) === TRUE) {
            $message = "<p style='color: green; text-align: center;'>Password has been reset successfully.</p>";
            session_destroy(); 
            header("refresh:1;url=login.php"); 
            exit();
        } else {
            $message = "<p style='color: red; text-align: center;'>Error updating password. Please try again.</p>";
        }
    } else {
        $message = "<p style='color: red; text-align: center;'>Passwords do not match. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            background-color: #444;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .ullist {
            display: flex;
            justify-content: center;
            gap: 40px;
            list-style-type: none;
        }

        .ullist a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .ullist a:hover {
            background-color: #ffcc00;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .form-container {
            width: 400px;
            background-color: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .head {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .inpbox {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .inpbox:focus {
            border-color: #ffcc00;
            outline: none;
        }

        .button {
            width: 100%;
            padding: 10px;
            border-radius: 7px;
            background-color: #ffcc00;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #e6b800;
        }

        .message {
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="ullist">
            <li><a href="index.php">Home</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li>
                <?php include("database.php"); if (isset($_SESSION['login']) && $_SESSION['login'] === 'true'): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    
    <div class="container">
        <form action="resetpassword.php" class="form-container" method="post">
            <h2>Reset Password</h2>
            <div class="message"><?php if (!empty($message)) echo $message; ?></div>
            <label for="new_password" class="head">New Password:</label>
            <input type="password" name="new_password" id="new_password" class="inpbox" required>
            
            <label for="confirm_password" class="head">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="inpbox" required>
            
            <button type="submit" name="reset_password" class="button">Reset Password</button>
        </form>
    </div>
</body>
</html>
