<html>
<!-- Put you mysqli connection here ................ -->
<title>PHP SAMPLE SYSTEM</title>
<header>
<h1>Select CPU</h1>
</header>
<!-- Put your style layout here...... -->
<body>
<form action="/action_page.php" id="cpuform">
 
  <input type="submit">
</form>
<?php
    // Include config file
    require_once "config.php";

echo '<select name="cpulist" form="cpuform">';



$sqli = "SELECT * FROM CPU";
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
echo '<option value="'.$row['cpuid'].'">'.$row['cpuname'].'</option>';
}
 
echo '</select>';
 
?>

</body>
</html>
