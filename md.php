<!DOCTYPE html>
<html>
<body>

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


$sql = "SELECT id,Name FROM persons_table";
$result = $conn->query($sql);
///print_r($result);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. "<br>";
    }
} else {
    echo "0 results";
}

///

 
// create a variable
$first_name=$_POST['Name'];

 echo $first_name;
 
$sql = "INSERT INTO persons_table (Name) VALUES (".$first_name.");";
$conn->query($sql)
//Execute the query
 
///mysqli_query($connect"INSERT INTO employees1(first_name,last_name,department,email)
	///			VALUES('$first_name','$last_name','$department','$email')");
///


//$conn->close();
?>
<h3>Ievadi vārdu</h3>
<form method="post" action="">
<label>First Name</label>
<input type="text" name="Name" />
<br />

<br />
<input type="submit" value="Sākt">
</form>
<h3>Izvēlies testu</h3>
</body>
</html>
