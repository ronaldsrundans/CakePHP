<!DOCTYPE html>
<html>
<body>

<h2>DES encryption</h2>
<h3>Plain text:</h3>
<p id="plaintext"></p>
<h3>Plain hex text:</h3>
<p id="hextext"></p>
<h3>Plain bin text:</h3>
<p id="bintext"></p>
<h4>Plain hex text2:</h4>
<p id="hextext2"></p>
<h4>Plain bin text2:</h4>
<p id="bintext2"></p>
<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script>
function myFunction() {
var values, text, fLen, i;
var str = "Your lips are smoother than vaseline"

values = [];
fLen = str.length;

text = "<ul>";
for (i = 0; i < fLen; i++) {
  text += "<li>" +str[i]+"="+str.charCodeAt(i) + "</li>";
}
text += "</ul>";

document.getElementById("demo").innerHTML = text;
}
var x = "Your lips are smoother than vaseline"

var y = "0123456789ABCDEF";
document.getElementById("plaintext").innerHTML = x;
document.getElementById("hextext2").innerHTML = y;
document.getElementById("hextext").innerHTML = str2hex(x);
document.getElementById("bintext").innerHTML =hex2bin(str2hex(x));
document.getElementById("bintext2").innerHTML =hex2bin(y);


function str2hex(str) {
    var hex = '';
    for (var i=0; i<str.length; i++) {
      hex += str.charCodeAt(i).toString(16);
    }
    
    return hex;
  }
function hex2bin(hexstr) {
    var bin='';
    for (var i=0; i<str.length; i++) {
      bin += str.charCodeAt(i).toString(2);
      //document.write(5);
    //  bin.push(str.charCodeAt(i));
    }    
    return bin;
}

</script>

</body>
</html>
