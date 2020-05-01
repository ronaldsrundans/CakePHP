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

<script>
var x = "Your lips are smoother than vaseline"
document.getElementById("plaintext").innerHTML = x;
document.getElementById("hextext").innerHTML = str2Hex(x);
document.getElementById("bintext").innerHTML =hex2Bin(str2Hex(x));


function str2Hex(str) {
    var result = '';
    for (var i=0; i<str.length; i++) {
      result += str.charCodeAt(i).toString(16);
    }
    return result;
  }
function hex2Bin(str) {
    var result = '';
    for (var i=0; i<str.length; i++) {
      result += str.charCodeAt(i).toString(2);
    }
    return result;
  }

</script>

</body>
</html>
