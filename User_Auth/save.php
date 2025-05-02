<?php

use function Safe\mysql_real_escape_string;
// 1. Database Connection
$host = "localhost" ;
$user = 'mcubed88' ;
$pass = 'Charlie198822$$' ;
$dbname = 'registration_enr' ;

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
    $password = $conn->real_escape_string($_POST['password']);

    // 3. Insert into database
    $sql = "INSERT INTO users (email, first_name, last_name, username, password) VALUES ( '$email', '$username', '$first_name', '$last_name', '$password' )";

    if ($conn->query($sql) === TRUE) {
        echo "Record saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

