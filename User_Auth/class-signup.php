<?php
session_start();
require "Database.php"; // defines $conn

function registerUserToClass($conn, $student_id, $class_id) {
    $check = $conn->prepare("SELECT id FROM registrations WHERE student_id = ? AND class_id = ?");
    $check->bind_param("ii", $student_id, $class_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        return "Already registered.";
    }

    $stmt = $conn->prepare("INSERT INTO registrations (student_id, class_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $student_id, $class_id);

    if ($stmt->execute()) {
        return "Registration successful.";
    } else {
        return "Error: " . $stmt->error;
    }
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'])) {
    $student_id = $_SESSION['user_id'];
    $class_id = (int) $_POST['class_id'];

    $message = registerUserToClass($conn, $student_id, $class_id);

    // Redirect back to class list with optional feedback
    header("Location: class-index.php?message=" . urlencode($message));
    exit();
}
?>