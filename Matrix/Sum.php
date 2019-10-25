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

 <input type="button" value="sum" onclick="myFunctionSum()">
<input type="button" value="multiply" onclick="myFunctionMult()">
<input type="button" value="null" onclick="myFunctionNull()">

</form>
<p>Result :</p>
<p id="result"></p>
<script>
  
function myFunctionNull(){
document.getElementById('A').value= 0;
document.getElementById('B').value= 0;
}
  
function myFunctionSum(){
var x=Number(document.forms["myForm"]["inputA"].value);
var y=Number(document.forms["myForm"]["inputB"].value);
document.getElementById('result').innerHTML= (x+y);
}

function myFunctionMult(){
var x=Number(document.forms["myForm"]["inputA"].value);
var y=Number(document.forms["myForm"]["inputB"].value);
document.getElementById('result').innerHTML= (x*y);
}

</script>
</body>
</html


