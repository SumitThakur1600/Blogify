<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        .firstnav {
            background-color: #333;
            height: 20vh;
            width: auto;
            text-align: center;
            font-size: 50px;
            font-weight: 800;
            padding-top: 24px;
            color: white;
        }

        .spacer {
            height: 4vh;
        }

        .navbar {
            background-color: #444;
            height: 6vh;
        }

        .ullist {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 6vh;
            gap: 40px;
            list-style-type: none;
        }

        .ullist a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        .ullist a:hover {
            /* background-color: #ffcc00; */
            color: #ffcc00;
        }


        .footer {
            height: 6vh;
            background-color: #333;
            color: white;
            text-align: center;
            padding-top: 5px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .mainbody {
            background-color: white;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .featured-posts {
            margin-bottom: 40px;
        }

        .post {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .post:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .subscribe {
            background-color: #ffcc00;
            color: #333;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-top: 30px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .subscribe:hover {
            background-color: #e6b800;
        }

        p {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="firstnav">Fresh Thoughts </div>
    <div class="spacer"></div>
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
    <div class="mainbody">
        <h2>Welcome to CCET Blog</h2>
        <p>Discover a world of knowledge and insights! Our blog covers a range of topics from technology and lifestyle to health and education. Stay tuned for the latest updates.</p>

        <div class="featured-posts">
            <h2>Featured Posts</h2>
            <div class="post">
                <h3>Understanding the Basics of Web Development</h3>
                <p>Web development is a fast-growing field. This article breaks down the essentials you need to know to get started.</p>
            </div>
            <div class="post">
                <h3>The Importance of Mental Health Awareness</h3>
                <p>In today’s world, mental health is more important than ever. Learn how to support yourself and others.</p>
            </div>
            <div class="post">
                <h3>Top 10 Tips for a Healthy Lifestyle</h3>
                <p>Adopting a healthy lifestyle can significantly improve your quality of life. Here are some tips to get you started!</p>
            </div>
        </div>

        <h2>Recent Articles</h2>
        <p>Catch up on our latest articles and insights! Whether you’re looking for tips on productivity or exploring the latest tech trends, we’ve got you covered.</p>

        <h2>Subscribe to Our Newsletter</h2>
        <p>Stay updated with our latest posts and exclusive content. Subscribe to our newsletter and never miss out!</p>
    </div>
    <div class="footer">
        <p style="font-size: 20px;">Fresh Thoughts </p>
    </div>
</body>

</html>