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

    <?php if (isset($_SESSION['username'])): ?>
        <p>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
</body>
</html>
