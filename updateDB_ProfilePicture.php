<?php
require('dbcon.php');
$UserName = $_REQUEST["ProfileWindowUserName"];
$ProfilePictureStatus = $_REQUEST["ProfilePictureStatus"];
try {
    $conn->exec("UPDATE Users SET ProfilePicture='$ProfilePictureStatus' WHERE Username='$UserName'");
    echo "Database Updated!";
} catch(PDOException $e) {
    echo "Sorry, there was an error updating the database.";
}

?>