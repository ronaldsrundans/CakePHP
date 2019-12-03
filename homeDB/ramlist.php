<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<h1>List of RAMs</h1>
<?php
include 'db_connection.php';

$sql = "SELECT id,man ,name, reg_date FROM RAM";
$result = $conn->query($sql);
//$sql2=""
//$countRows=
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Manufacturer</th><th>RAM size</th><th>Last changes</th><th>Edit</th><th>Delete</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["man"]. "</td><td>" . $row["name"]. "</td><td>" . $row["reg_date"]. "</td><td><input type='submit' name='submit' value='Edit'></td><td> <input type='submit' name='submit' value='Delete'></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
