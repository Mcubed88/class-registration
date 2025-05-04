<?php
session_start();
include 'Database.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch available classes
$all = $pdo->query("SELECT * FROM classes")->fetchAll();

// Fetch registered classes
$registered = $pdo->prepare("
    SELECT c.id FROM classes c
    JOIN registrations r ON c.id = r.class_id
    WHERE r.student_id = ?
");
$registered->execute([$user_id]);
$registered_ids = array_column($registered->fetchAll(), 'id');
?>
<!DOCTYPE html>
<html>
<head><title>Class Registry</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<h3>Available Classes</h3>
<ul>
<?php foreach ($all as $class): ?>
    <li>
        <strong><?= $class['name'] ?></strong>: <?= $class['description'] ?>
        <?php if (in_array($class['id'], $registered_ids)): ?>
            — <a href="unregister.php?class_id=<?= $class['id'] ?>">Unregister</a>
        <?php else: ?>
            — <a href="register.php?class_id=<?= $class['id'] ?>">Register</a>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
