<?php
// Include the database configuration
include('config.php');

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to check the user's credentials
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, now check if the password matches
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to the student registration form
            header("Location: index.html");
            exit();
        } else {
            // Invalid password
            echo "Incorrect password!";
        }
    } else {
        // User not found
        echo "No user found with that email address!";
    }

    $stmt->close();
}

$conn->close();
?>
