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
