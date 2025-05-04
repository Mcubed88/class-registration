<?php
session_start();
require "Database.php"; // Make sure this defines $pdo or adjust to use mysqli

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

try {
    // Fetch all classes
    $stmt = $pdo->query("SELECT id, name, description FROM classes");
    $classes = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching classes: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Classes</title>
</head>
<body>
    <h1>Available Classes</h1>
    <ul>
        <?php foreach ($classes as $class): ?>
            <li>
                <strong><?= htmlspecialchars($class['name']) ?></strong><br>
                <?= nl2br(htmlspecialchars($class['description'])) ?>
                <form action="class-signup.php" method="POST" style="display:inline">
                    <input type="hidden" name="class_id" value="<?=$class['id']; ?>" />
                    <button type="submit">Register</button>
                </form>
                <hr />
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>