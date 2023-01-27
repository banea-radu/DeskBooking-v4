<?php
// get the deskNr and bookDate parameter from URL
$booker = $_REQUEST["booker"];
$username = $_REQUEST["username"];
$deskNr = $_REQUEST["deskNr"];
$bookDate = $_REQUEST["bookDate"];
$hasPicture = $_REQUEST["hasPicture"];
$today = date("Y-m-d");

require('dbcon.php');

if ($bookDate < $today) {
    $bookState = "Cannot change older bookings!";   
} else {
// Query database if Desk Number is booked in selected date
    $query_deskDetails = $conn->query("SELECT * FROM Bookings WHERE BookDate='$bookDate' AND Desk='$deskNr'");
    $found_desk = $query_deskDetails->rowCount();
    if ($found_desk > 0) {
        $query_deskDetails_result = $query_deskDetails->fetch(PDO::FETCH_ASSOC);
        $dbBooker = $query_deskDetails_result["Booker"];
        if ($dbBooker == $booker) {
            $conn->exec("DELETE FROM Bookings WHERE BookDate='$bookDate' AND Desk='$deskNr'");
            $bookState = "Desk UnBooked!";
        } else {
            $bookState = "Cannot UnBook somebody else!";    
        }
    } else {
        $query_BookerDetails = $conn->query("SELECT * FROM Bookings WHERE BookDate='$bookDate' AND Booker='$booker'");
        $found_booker = $query_BookerDetails->rowCount();
        if ($found_booker > 0) {
            $bookState  = "Already Booked a Desk in Selected Date!";
        } else {
            $dbNextBookID_query = $conn->query("SELECT MAX(BookID) FROM Bookings");
            $found_results = $dbNextBookID_query->rowCount();
            $dbNextBookID_query_result = $dbNextBookID_query->fetch(PDO::FETCH_ASSOC);
            $dbNextBookID = $dbNextBookID_query_result["MAX(BookID)"] + 1;
            try {
                $conn->exec("INSERT INTO Bookings (BookID, BookDate, Desk, Booker, Username) VALUES ('$dbNextBookID', '$bookDate', '$deskNr', '$booker', '$username')");
                $bookState  = "Desk Booked!";
            } catch(PDOException $e) {
                $bookState = $e->getMessage();
            }
        }
    }
}
echo $bookState;
?>
