<?php
include("database.php");

$message = ""; 

if (isset($_POST['confirm'])) {
    extract($_POST);
    
    $checkEmailQuery = "SELECT * FROM `signup` WHERE `email` = '$email'";
    $emailCheckResult = $conn->query($checkEmailQuery);

    if ($emailCheckResult->num_rows > 0) {
        $message = "<p style='color: red; text-align: center;'>Email already exists. Please use a different email.</p>";
    } else {
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        
        $c = "INSERT INTO `signup`(`username`, `email`, `password`, `otp`) VALUES ('$username', '$email', '$hashpass', '0')";
        $result = $conn->query($c);
        
        if ($result) {
            $message = "<p style='color: green; text-align: center;'>Account Created Successfully</p>";
        } else {
            $message = "<p style='color: red; text-align: center;'>Unable to Create Account</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger - Sign Up</title>
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
            margin-bottom: 25px;
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
            transition: background-color 0.3s, color 0.3s;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .ullist a:hover {
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #ffcc00;
        }

        .mainbody {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        #signupform {
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

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #444;
            color: white;
        }

        .account-link {
            text-align: center;
            margin-top: 15px;
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
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'true'): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
   </nav>
   <div class="mainbody">
       <form action="signup.php" id="signupform" method="post">
           <h2>SIGN UP FORM</h2>
           <?php if (!empty($message)) echo $message; ?> 
           <label for="username" class="head">Username</label>
           <input type="text" name="username" id="username" class="inpbox" required>

           <label for="email" class="head">Email</label>
           <input type="email" name="email" id="email" class="inpbox" required>

           <label for="password" class="head">Password</label>
           <input type="password" name="password" id="password" class="inpbox" required>

           <button class="button" name="confirm">Submit</button>
           <div class="account-link">
               <p>Already have an account? <a href="login.php" style="color: #ffcc00; text-decoration: underline;">Login here</a></p>
           </div>
       </form>
   </div>
   <script>
       document.getElementById('signupform').addEventListener('submit', function(event) {
           event.preventDefault();
           const username = document.getElementById('username').value;
           const password = document.getElementById('password').value;
           const usernameRegex = /^[a-zA-Z0-9]{6,}$/;
           if (!usernameRegex.test(username)) {
               alert('Username must be at least 6 characters long and contain only letters and numbers.');
               return;
           }
           if (password.length < 8) {
               alert('Password must be at least 8 characters long.');
               return;
           }
           this.submit();
       });
   </script>
</body>
</html>
