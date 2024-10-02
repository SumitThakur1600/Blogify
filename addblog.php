<?php
include("security.php");

$message = "";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username=$_SESSION['username'];
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO blog (username,title, content,creationdate) VALUES ('$username','$title', '$content','$date')";
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color: green;'>Blog post added successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        .navbar {
            background-color: #444;
            padding: 1px 0;
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
            max-width: 600px;
            margin: 35px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #444;
            text-align: center;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        input:focus, textarea:focus {
            border-color: #ffcc00;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #ffcc00;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e6b800;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
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
        <h1>Add Blog Post</h1>
        <?php if (!empty($message)) echo $message; ?>
        <form action="addblog.php" method="post">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" rows="10" required></textarea>
            <button type="submit" name="submit">Add Blog Post</button>
        </form>
        <footer>
            &copy; <?php echo date("Y"); ?> Fresh Thoughts 
        </footer>
    </div>
</body>
</html>
