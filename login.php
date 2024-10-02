<?php
include("database.php");
$message = ""; 
$_SESSION['login']="false";
if (isset($_POST['confirm'])) {
    extract($_POST);
    $c = "SELECT * FROM `signup` WHERE email='$email'";
    $result = $conn->query($c);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username']=$row['username'];
            $_SESSION['login']="true";
            header("Location: blog.php");
            exit(); 
        } else {
            $message = "<p style='color: red; text-align: center;'>Incorrect password. Please try again.</p>";
        }
    } else {
        $message = "<p style='color: red; text-align: center;'>Account does not exist. Please check your email.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger - Login</title>
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
            margin-bottom: 30px;;
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

        .mainbody {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .loginform {
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

        .account-link {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #ffcc00;
            text-decoration: underline;
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
                <?php  if (isset($_SESSION['login']) && $_SESSION['login'] === 'true'): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
       </ul>
   </nav>
   <div class="mainbody">
       <form action="login.php" class="loginform" method="post">
           <h2>LOGIN FORM</h2>
           <?php if (!empty($message)) echo $message; ?> 
           <label for="email" class="head">Email</label>
           <input type="email" name="email" id="email" class="inpbox" required>

           <label for="password" class="head">Password</label>
           <input type="password" name="password" id="password" class="inpbox" required>

           <button class="button" name="confirm">Submit</button>
           <div class="account-link">
               <p>Don't have an account? <a href="signup.php" style="color: #ffcc00; text-decoration: underline;">Sign up here</a></p>
           </div>
           <div class="forgot-password">
               <p><a href="forgotpassword.php">Forgot Password?</a></p>
           </div>
       </form>
   </div>
</body>
</html>
