<?php
session_start();
require "Database.php";

$conn = new mysqli($host, $user, $pass, $dbname) ;

// Check connection
if ($conn->connect_error) {
     die('connection failed'. $conn->connect_error);
}  

// 2. Handle form Submission
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $first_name = $conn->real_escape_string($_POST["first_name"]);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['email']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 3. Insert into database
    $sql = "INSERT INTO users (email, first_name, last_name, username, password) VALUES ( '$email', '$username', '$first_name', '$last_name', '$hashed_password' )";

    if ($conn->query($sql) === TRUE) {
        echo "Record saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

