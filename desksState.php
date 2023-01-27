<?php
// get the datePicker parameter from URL
$datePicker = $_REQUEST["datePicker"];

require('dbcon.php');

// Query database for which Desks are booked in selected date
    $query_deskDetails = $conn->query("SELECT * FROM Bookings WHERE BookDate='$datePicker'");
    $found_desk = $query_deskDetails->rowCount();
    if ($found_desk > 0) {
        $query_deskDetails_result = $query_deskDetails->fetchAll(PDO::FETCH_ASSOC);
        foreach ($query_deskDetails_result as $dbRow) {
            $dbDesk = $dbRow["Desk"];
            $dbBooker = $dbRow["Booker"];
            $dbUsername = $dbRow["Username"];
            $query_username = $conn->query("SELECT * FROM Users WHERE Username LIKE BINARY '$dbUsername'");
            $query_username_result = $query_username->fetch(PDO::FETCH_ASSOC);
            $ProfilePicture = $query_username_result["ProfilePicture"];
            $AllBookers = $AllBookers . $dbBooker . " - " . $dbDesk . " - " . $dbUsername . " - " . $ProfilePicture . ";";
        }
    }

echo $AllBookers;
?>