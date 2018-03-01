<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

$q = intval($_GET['q']);
/*
$con = mysqli_connect('localhost','root','','my_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
*/
//echo $q;
if ($q==1)
{
	//echo "Size";
	echo "<p>Size
<input type='text' name='SIZE'></p>";
}
else if ($q==2)
{
	echo "
<p>Height<input type='text' name='Height'></p>
<p>Width<input type='text' name='Width'></p>
<p>Lenght<input type='text' name='Lenght'></p>
";
	//echo "HxWxL";
}
else if ($q==3)
{
	echo "<p>Weight<input type='text' name='Weight'></p>";
}

/*
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);*/
?>
</body>
</html>
