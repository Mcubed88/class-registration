<?php
session_start();
include 'Database.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['class_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("INSERT IGNORE INTO registrations (student_id, class_id) VALUES (?, ?)");
$stmt->execute([$_SESSION['user_id'], $_GET['class_id']]);

header("Location: class_registry.php");
