<?php
// Directory where videos will be saved
$targetDir = "uploads/";

// Check if the upload directory exists, create it if not
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file is uploaded
    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $fileName = basename($_FILES["video"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array("mp4", "avi", "mov", "mkv");

        // Check if the uploaded file is a video
        if (in_array($fileType, $allowedTypes)) {
            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFilePath)) {
                echo "Video uploaded successfully!";
            } else {
                echo "Error uploading video. Please try again.";
            }
        } else {
            echo "Only video files (MP4, AVI, MOV, MKV) are allowed.";
        }
    } else {
        echo "No video file uploaded.";
    }
}
?>
