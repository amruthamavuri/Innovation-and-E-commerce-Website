<?php
include('config.php');

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cloudPlatforms = $_POST['cloudPlatforms'];
    $devOpsTools = $_POST['devOpsTools'];
    $programmingLanguages = $_POST['programmingLanguages'];
    $experience = $_POST['experience'];
    $projects = $_POST['projects'];
    $portfolio = $_POST['portfolio'];
    $experienceDetails = $_POST['experienceDetails'];

    // Handle resume upload
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resumeName = $_FILES['resume']['name'];
        $resumeTmpName = $_FILES['resume']['tmp_name'];
        $resumeDestination = 'uploads/resume/' . $resumeName;

        // Check if the directory exists, create it if not
        if (!file_exists('uploads/resume')) {
            mkdir('uploads/resume', 0777, true);
        }

        // Move the uploaded file to the "uploads" directory
        if (move_uploaded_file($resumeTmpName, $resumeDestination)) {
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO cloud_job (fullName, email, phone, cloudPlatforms, devOpsTools, programmingLanguages, experience, projects, portfolio, experienceDetails, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Check if prepare() failed
            if ($stmt === false) {
                die('MySQL Error: ' . $conn->error);  // Show MySQL error message
            }

            // Bind parameters
            $stmt->bind_param("sssssssssss", $fullName, $email, $phone, $cloudPlatforms, $devOpsTools, $programmingLanguages, $experience, $projects, $portfolio, $experienceDetails, $resumeDestination);

            // Execute the query
            if ($stmt->execute()) {
                echo "Application submitted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Please upload a valid resume.";
    }
}

// Close the database connection
$conn->close();
?>
