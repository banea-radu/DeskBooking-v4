<?php
$dbservername = "localhost";
$dbusername = "dbusername"; // dummy of course, for security reasons
$dbpassword = "dbpassword"; // dummy of course, for security reasons
$dbname = "dbname"; // dummy of course, for security reasons

// Database connection
try {
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "<script>console.log('Connected successfully')</script>"; 
    } catch(PDOException $e) {    
    echo "Connection to Database failed: " . $e->getMessage();
    }
?>