<?php include("product_class.php");?>
 
<!DOCTYPE html>
<html>
<head>
<h2>
Product add
</h2>
</p>
<input type="submit" value="Save" name="Save">
<p>
</head>
<body>

<form method="post" >
<p>SKU
<input type="text" name="SKU" >
</p>
<p>Name
<input type="text" name="Name" >
</p>

<p>Price
<input type="text" name="Price" >
</p>

<form>
<select id="sel" onchange="showUser(this.value)" >
<option value="">Type sitcher</option>
<option value=1>
DVD
</option>
<option value=2>
Furniture
</option>
<option value=3>
Book
</option>
</select>
</form>


<div id="txtHint"><b></b></div>

<p id="demo"></p>
<script>
function myFunction() {
    var x = document.getElementById("sel");
	//echo x;
    var i = x.selectedIndex;
	
    document.getElementById("demo").innerHTML = i;

}
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } 
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}

</script>
</form>
</body>
</html>
