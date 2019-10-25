                                                                        

<!DOCTYPE html>
<html>
<body>

<h2>Number Field</h2>
<p>The <strong>input type="number"</strong> defines a numeric input field.</p>
<p>You can use the min and max attributes to add numeric restrictions in the input field:</p>

<form name="myForm">
  X:
  <input type="number" name="inputA" id="A"><br>
  Y:
  <input type="number" name="inputB"id="B"><br>

 <input type="button" value="sum" onclick="myFunction()">
</form>
<p>Result :</p>
<p id="sum"></p>
<script>

function myFunction(){
var x=Number(document.forms["myForm"]["inputA"].value);
var y=Number(document.forms["myForm"]["inputB"].value);

document.getElementById('sum').innerHTML= (x+y);
}
</script>
</body>
</html
