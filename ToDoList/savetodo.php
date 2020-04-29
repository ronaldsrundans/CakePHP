<?php
	include 'database.php';
	$name=$_POST['name'];

	$sql = "INSERT INTO `ToDoTable`( `task`) 
	VALUES ('$name')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>
