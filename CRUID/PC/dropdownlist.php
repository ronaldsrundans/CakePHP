<html>
<!-- Put you mysqli connection here ................ -->
<title>PHP SAMPLE SYSTEM</title>
<header>
<h1 align="center">Populate Drop Down List From Database Using PHP and MySQLi</h1>
</header>
<!-- Put your style layout here...... -->
<body>
<div id="box">
<div class="column"></div>
<div class="column">
<div class="clear"></div>
<label class="first-column ">Select a Book:</label><div class="clear"></div>
<div class="clear"></div>
ate the dropdown list codePHP
<?php
    // Include config file
    require_once "config.php";

echo '<select>
<option>Select</option>';


$sqli = "SELECT * FROM CPU";
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
echo '<option>'.$row['cpuname'].'</option>';
}
 
echo '</select>';
 
?>
</div>
<div class="column"></div>
</div>
</body>
</html>
