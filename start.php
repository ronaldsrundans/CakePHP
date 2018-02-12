<?php include("class_lib.php"); ?>
<!DOCTYPE html>
<html>
<body>

<h2>Testa uzdevums</h2>

<h3>Ievadi savu vārdu:</h3>

<form method="post" action="">

<input type="text" name="Name" />
</form>
<br>
<form>
<select name='id'>
<option value=0>Izvēlies testu</option>
<?php thatfunk();?>
</select>
</form>
<br>
<form>
<input type="submit" value="Sākt">
</form>
<h3>Izvēlies testu</h3>

</body>
</html>
