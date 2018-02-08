<?php
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "printful";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else
{
	echo "Connected successfully";
}

$sql = "SELECT id FROM persons_table";
$result = $conn->query($sql);
print_r($result);
$conn->close();
?>
