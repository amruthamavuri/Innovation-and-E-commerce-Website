<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}

// Include the database configuration
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    $college = $_POST['college'];
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    $roll_no = $_POST['roll_no'];
    $skills = $_POST['skills'];

    // Handle file uploads
    $profile_picture = $_FILES['profile_picture']['name'];
    $payment_receipt = $_FILES['payment_receipt']['name'];

    // Upload the files to the server
    $profile_picture_temp = $_FILES['profile_picture']['tmp_name'];
    $payment_receipt_temp = $_FILES['payment_receipt']['tmp_name'];

    // Specify the upload directories (make sure these directories exist)
    $profile_picture_dir = "uploads/profile_pictures/" . $profile_picture;
    $payment_receipt_dir = "uploads/payment_receipts/" . $payment_receipt;

    // Move the files to the appropriate directories
    move_uploaded_file($profile_picture_temp, $profile_picture_dir);
    move_uploaded_file($payment_receipt_temp, $payment_receipt_dir);

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO students (email, gender, full_name, profile_picture, mobile, whatsapp, college, year, branch, roll_no, skills, payment_receipt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssssss", $email, $gender, $full_name, $profile_picture_dir, $mobile, $whatsapp, $college, $year, $branch, $roll_no, $skills, $payment_receipt_dir);

        if ($stmt->execute()) {
            // Success message
            echo "<script>alert('Registration Successful!');</script>";
            echo "<script>window.location.href = 'student_form.html';</script>";
        } else {
            // Error message
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    } else {
        // Error message if query preparation fails
        echo "<script>alert('Failed to prepare the database query!');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
