<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

include("database.php");

$message = ""; 
$otpSent = false; 
$email = ""; 
if (isset($_POST['submit_email'])) {
    extract($_POST);
    $_SESSION['email']=$email;
    $checkEmailQuery = "SELECT * FROM `signup` WHERE `email` = '$email'";
    $emailCheckResult = $conn->query($checkEmailQuery);

    if ($emailCheckResult->num_rows === 0) {
        $message = "<p style='color: red; text-align: center;'>Email does not exist. Please sign up first.</p>";
    } else {
        $otp = rand(100000, 999999);
        $updateOtpQuery = "UPDATE `signup` SET `otp` = '$otp' WHERE `email` = '$email'";
        $conn->query($updateOtpQuery);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = ''; // Your email
            $mail->Password = ''; // Your email password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('GMAIL', 'NAME'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = "RESET PASSWORD";
            $mail->Body = "Hi, here is your OTP for password reset: $otp";

            $mail->send();
            $message = "<p style='color: green; text-align: center;'>OTP has been sent to your email. Please check your inbox.</p>";
            $otpSent = true;
        } catch (Exception $e) {
            $message = "<p style='color: red; text-align: center;'>Email sending failed: " . $mail->ErrorInfo . "</p>";
        }
    }
}

if ($otpSent) {
    echo "<script>
        setTimeout(function() {
            window.location.href = 'otppage.php';
        }, 3000);
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <form action="forgotpassword.php" class="form-container" method="post">
            <h2>Forgot Password</h2>
            <div class="message"><?php if (!empty($message)) echo $message; ?></div>
            <label for="email" class="head">Enter your email:</label>
            <input type="email" name="email" id="email" class="inpbox" required>
            <button type="submit" name="submit_email" class="button">Submit</button>
        </form>
    </div>
</body>
</html>
