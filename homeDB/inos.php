
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $manErr = "";
$name = $man= = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "OS name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
  
  if (empty($_POST["man"])) {
    $manErr = "OS manufacturer is required";
  } else {
    $man = test_input($_POST["man"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Add new OS</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

   Manufacturer:
  <input type="radio" name="man" value="Windows">Windows
  <input type="radio" name="man" value="Linux">Linux
  <span class="error">* <?php echo $manErr;?></span>
  <br><br>
  OS name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $man;
echo "<br>";
echo $name;
echo "<br>";

?>
