<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersFile = 'users.json';
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (file_exists($usersFile)) {
        $users = json_decode(file_get_contents($usersFile), true);
        if (isset($users[$username]) && password_verify($password, $users[$username])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "User database not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p><a href="index.php">Home</a></p>
</body>
</html>
