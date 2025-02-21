<?php
include('config.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Correctly open the block
    $ai_idea = $_POST['ai_idea'];
    $other_idea = isset($_POST['other_idea']) ? $_POST['other_idea'] : ''; // Ensure other_idea is set
    $user_idea = $_POST['user_idea'];
    
    $file_path = "";

    // Upload images
    if (!empty($_FILES['idea_files']['name'][0])) {
        $uploads_dir = 'uploads/files/';
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $file_name = $_FILES['idea_files']['name'][0];
        $file_tmp = $_FILES['idea_files']['tmp_name'][0];
        $file_path = $uploads_dir . basename($file_name);

        move_uploaded_file($file_tmp, $file_path);
    }

    // Insert data into database
    $sql = "INSERT INTO ideas (ai_idea, other_idea, user_idea, file_path) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $ai_idea, $other_idea, $user_idea, $file_path);

    if ($stmt->execute()) {
        echo "Idea submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} // Correctly close the main if block
?>
