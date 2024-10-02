<?php
include("security.php");

$message = "";

if (isset($_GET['confirm']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM blog WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color: green;'>Blog post deleted successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error deleting post: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM blog ORDER BY creationdate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog Posts</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
        }

        .navbar {
            background-color: #444;
            padding: 1px 0;
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
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .ullist a:hover {
            background-color: #ffcc00;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #ffcc00;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .delete-button {
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #e63939;
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
        <h1>View Blog Posts</h1>
        <?php if ($message): ?>
            <div><?php echo $message; ?></div>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Creation Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['content']); ?></td>
                            <td><?php echo htmlspecialchars($row['creationdate']); ?></td>
                            <td>
                                <form action="viewblogs.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="confirm" class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No blog posts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <footer>
            &copy; <?php echo date("Y"); ?> Fresh Thoughts 
        </footer>
    </div>
</body>
</html>
