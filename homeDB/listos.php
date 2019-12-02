<!DOCTYPE html>
<html>
<body>
<h1>List of Operating Systems</h1>
<?php
include 'db_connection.php';
$sql = "SELECT id,man ,name, reg_date FROM OS";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>  ". $row["id"]. " ". $row["man"]. " ". $row["name"]. " " . $row["reg_date"] . "<br>";
    }
} else {
    echo "0 results";
}
?>

</body>
</html>
