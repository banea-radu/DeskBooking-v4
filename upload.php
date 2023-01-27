<?php
$UserName = $_REQUEST["ProfileWindowUserName"];
$target_dir = "images/Users/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$final_path = $target_dir . $UserName;

require('dbcon.php');

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["file"]["tmp_name"]);
if($check) {
    //echo "File is an image - " . $check["mime"] . ".";
    // Allow certain file formats
    if($check["mime"] == "image/jpg" || $check["mime"] == "image/png" || $check["mime"] == "image/jpeg" || $check["mime"] == "image/gif" ) {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $final_path)) {
            try {
                $conn->exec("UPDATE Users SET ProfilePicture='custom' WHERE Username='$UserName'");
                echo "The image has been uploaded.";
            } catch(PDOException $e) {
                echo "Sorry, there was an error updating the database.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
} else {
    echo "File is not an image.";
}
?>