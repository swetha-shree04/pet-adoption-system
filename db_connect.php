<?php
$host = 'localhost';
$user = 'root';  // Change if using a different MySQL user
$pass = '';  // Set your MySQL password
$dbname = 'pet_adoption';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
