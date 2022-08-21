<?php 
// Get Variables
    $dbname = "farmers";
    $dbusername = "root";
    $dbpassword = "123456";
    $dbhost = "localhost";

    // $conn = new mysqli($dbname,$dbusername,$dbpassword,$dbhost);
    // Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
?>