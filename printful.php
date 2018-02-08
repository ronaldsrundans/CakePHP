<!DOCTYPE html>
<html>
<body>

<?php
class Database
{ 
private $servername = "localhost";
private $username = "";
private $password = "";


    public function connect()
    {
$conn = new mysqli();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
    }
    public function disconnect()    {   }
    public function select()        {   }
    public function insert()        {   }
    public function delete()        {   }
    public function update()    {   }
}
$testObject = new Database();
$testObject->connect();

?> 

</body>
</html>
