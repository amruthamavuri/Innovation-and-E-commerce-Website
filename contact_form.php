<?php
include('config.php');

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];

// Prepare SQL statement
$sql = "INSERT INTO contacts (name, email, contact) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);  // Print SQL error for debugging
}

// Bind and execute
$stmt->bind_param("sss", $name, $email, $contact);

if ($stmt->execute()) {
    header("Location: innovation.html");
    exit();
} else {
    echo "<h2>Error: " . $stmt->error . "</h2>";
}

// Close connection
$stmt->close();
$conn->close();
?>
