<?php
// get the deskNr and bookDate parameter from URL
$deskNr = $_REQUEST["deskNr"];
$bookDate = $_REQUEST["bookDate"];

require('dbcon.php');

// Query database if Desk Number is booked in selected date
    $query_deskDetails = $conn->query("SELECT * FROM Bookings WHERE BookDate='$bookDate' AND Desk='$deskNr'");
    $found_desk = $query_deskDetails->rowCount();
    if ($found_desk > 0) {
        $query_deskDetails_result = $query_deskDetails->fetch(PDO::FETCH_ASSOC);
        $db_booker = $query_deskDetails_result["Booker"];
        $db_username = $query_deskDetails_result["Username"];
        $query_username = $conn->query("SELECT * FROM Users WHERE Username LIKE BINARY '$db_username'");
        $query_username_result = $query_username->fetch(PDO::FETCH_ASSOC);
        $db_ProfilePicture = $query_username_result["ProfilePicture"];
    } else {
        $db_booker = "Free";
    }
    
//echo $db_booker;
echo json_encode(array('db_booker'=>$db_booker, 'db_username'=>$db_username, 'db_ProfilePicture'=>$db_ProfilePicture));
?>