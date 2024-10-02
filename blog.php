<?php
include("security.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Posts</title>
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

        .container {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 50px auto;
        }

        h1 {
            margin-bottom: 20px;
            color: #444;
        }

        a.button {
            display: block;
            background-color: #ffcc00;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            transition: background-color 0.3s, transform 0.3s;
        }

        a.button:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
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

    <div class="container">
        <h1>Manage Blog Posts</h1>
        <a class="button" href="addblog.php">Create New Blog Post</a>
        <a class="button" href="viewblogs.php">View Blog Posts</a>
        <a class="button" href="viewblogs.php">Delete Blog Post</a>
        <footer>
            &copy; <?php echo date("Y"); ?> Fresh Thoughts 
        </footer>
    </div>
</body>
</html>
