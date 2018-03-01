<!DOCTYPE html>
<html>
<head>

<h1>Product list</h1>

<html>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$con = mysqli_connect('localhost','root','','scand');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM product";
$result = mysqli_query($con,$sql);
//<input type= 'checkbox' name= 'check' value='check'> Delete<br>
echo "

<table>
<tr>
<th>SKU</th>
<th>Name</th>
<th>Price</th>
<th>Type</th>
<th>Delete</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['SKU'] . "</td>";
    echo "<td>" . $row['NAME'] . "</td>";
    echo "<td>" . $row['PRICE'] . "</td>";
    echo "<td>" . $row['TYPE'] . "</td>";
	echo "<td><input type= 'checkbox' "."</td>";
    //echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>

</body>
</html>
