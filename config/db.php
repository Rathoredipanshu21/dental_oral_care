<?php
// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dental"; // Make sure this matches the database name you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



<?php
// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "oral_dental";
$password = "AKCSGroups@21";
$dbname = "oral_dental"; // Make sure this matches the database name you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


