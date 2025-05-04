<?php
session_start();
include 'Database.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['class_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM registrations WHERE student_id = ? AND class_id = ?");
$stmt->execute([$_SESSION['user_id'], $_GET['class_id']]);

header("Location: class_registry.php");
