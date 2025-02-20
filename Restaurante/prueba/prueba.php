<?php
function saveImage($image)
{
    $targetDir = __DIR__ . "/images/cheff/";

    // Check if the target directory exists, if not create it
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0777, true)) {
            return "Failed to create directory: " . $targetDir;
        }
    }

    $targetFile = $targetDir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        return "Sorry, file already exists.";
    }

    // Check file size (5MB limit)
    if ($image["size"] > 500000000000) {
        return "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Try to move file
    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        return "The file " . htmlspecialchars(basename($image["name"])) . " has been uploaded.";
    } else {
        return "Sorry, there was an error uploading your file.";
    }
}

function deleteImage($filePath)
{
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return "The file has been deleted.";
        } else {
            return "Sorry, there was an error deleting your file.";
        }
    } else {
        return "File does not exist.";
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        echo saveImage($_FILES["image"]);
    } elseif (isset($_POST["delete"])) {
        echo deleteImage($_POST["filePath"]);
    }
}
