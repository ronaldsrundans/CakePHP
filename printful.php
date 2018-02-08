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

$sql = "SELECT id,Name FROM persons_table";
$result = $conn->query($sql);
print_r($result);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
