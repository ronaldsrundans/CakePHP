<!DOCTYPE html>
<html>
<body>

<h2>Matrix Calculator</h2>


<form name="myForm">
  X:
  <input type="number" name="inputA" id="A"><br>
  Y:
  <input type="number" name="inputB"id="B"><br>

 <input type="button" value="+" onclick="myFunctionSum()">
<input type="button" value="*" onclick="myFunctionMult()">
<input type="button" value="null" onclick="myFunctionNull()">
<input type="button" value="<->" onclick="myFunctionRev()">


</form>
<p>Result :</p>
<p id="result"></p>
<script>
function myFunctionNull(){
document.getElementById('A').value= 0;
document.getElementById('B').value= 0;
document.getElementById('result').innerHTML= 0;

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

function myFunctionRev(){
var tmp=Number(document.forms["myForm"]["inputA"].value);
document.getElementById('A').value= Number(document.forms["myForm"]["inputB"].value);
document.getElementById('B').value=Number(tmp); 

  }
</script>
</body>
</html

