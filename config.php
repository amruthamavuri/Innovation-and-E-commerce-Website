<?php
$host = "localhost"; // Database host
$username = "u672150059_vikraya"; // Database username
$password = "Vikraya2020@amrutha"; // Database password
$dbname = "u672150059_thevikraya"; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
