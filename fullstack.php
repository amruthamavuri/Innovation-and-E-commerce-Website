<?php
include('config.php');

// Prepare data from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $frontendSkills = $_POST['frontendSkills'];
    $backendSkills = $_POST['backendSkills'];
    $databaseSkills = $_POST['databaseSkills'];
    $experience = $_POST['experience'];
    $projects = $_POST['projects'];
    $portfolio = $_POST['portfolio'];
    $experienceDetails = $_POST['experienceDetails'];

    // File upload for the resume
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resumeName = $_FILES['resume']['name'];
        $resumeTmpName = $_FILES['resume']['tmp_name'];
        $resumeDestination = 'uploads/resume/' . $resumeName;

        // Check if the directory exists, create if not
        if (!file_exists('uploads/resume')) {
            mkdir('uploads/resume', 0777, true);
        }

        // Move the file to the "uploads" folder
        if (move_uploaded_file($resumeTmpName, $resumeDestination)) {
            // Insert form data into the database
            $stmt = $conn->prepare("INSERT INTO fullstack_job (fullName, email, phone, frontendSkills, backendSkills, databaseSkills, experience, projects, portfolio, experienceDetails, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Check if prepare() failed
            if ($stmt === false) {
                die('SQL error: ' . $conn->error);  // Show the database error message
            }

            // Bind parameters
            $stmt->bind_param("sssssssssss", $fullName, $email, $phone, $frontendSkills, $backendSkills, $databaseSkills, $experience, $projects, $portfolio, $experienceDetails, $resumeDestination);

            // Execute the query
            if ($stmt->execute()) {
                echo "Application submitted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
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
