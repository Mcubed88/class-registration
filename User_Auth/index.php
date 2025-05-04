<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Landing Page</title>
</head>
<body>
    <h1>Welcome to Our Site</h1>

    <?php if (isset($_SESSION['user_name'])): ?>
        <p>Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
        <a href="logout.php">Logout</a> | <a href="class-index.php">Register for classes</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
</body>
</html>
