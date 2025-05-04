<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST["first_name"]));
    $lastName = htmlspecialchars(trim($_POST["last_name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($_POST["password"])) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Simulate saving to a database (in practice, use MySQL or similar)
        // Here we just display success message
        $success = "Registration successful! Welcome, $firstName.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration</h2>
    
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php elseif (!empty($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="save.php">
        <label>First Name:</label><br>
        <input type="text" name="first_name" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>