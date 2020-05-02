<!DOCTYPE html>
<html>
<body>

<h2>DES encryption</h2>
<h3>Plain text:</h3>
<p id="plaintext"></p>
<h3>Plain text to hex:</h3>
<p id="hextext"></p>
<h3>Hex to bin:</h3>
<p id="bintext"></p>
<h4>Hex text2:</h4>
<p id="hextext2"></p>
<h4>Hex tex2 to bin:</h4>
<p id="bintext2"></p>
<h4>Hex to text:</h4>

<p id="demo3"></p>

<button onclick="myFunction()">Try it</button>

<p id="demo"></p>
<p id="demo2"></p>

<script>
function myFunction() {
var values, fLen, i;
var str = "0123456789abcdefABCDEF";
values = [];
bin=[];
fLen = str.length;
for (i = 0; i < fLen; i++) {

  values.push(str.charCodeAt(i));
  //bin.push(str.toString());
}
document.getElementById("demo").innerHTML = values;
//document.getElementById("demo2").innerHTML = bin;

}
var x = "Your lips are smoother than vaseline."

var y = "0123456789ABCDEF";
document.getElementById("plaintext").innerHTML = x;
document.getElementById("hextext2").innerHTML = y;
document.getElementById("hextext").innerHTML = str2hex(x);
document.getElementById("demo3").innerHTML = hex2text(str2hex(x));

document.getElementById("bintext").innerHTML =hex2bin(str2hex(x));
document.getElementById("bintext2").innerHTML =hex2bin('0123456789abcdef');

///needs padding to fit in block
function str2hex(str) {
    var hex = '';
    var hexPadding, hexLen, i;
    var strLen=str.length;
    for (i=0; i<strLen; i++) {
      hex += str.charCodeAt(i).toString(16);
    } 
    hexLen = hex.length;
    hexPadding = hexPadSize(hexLen);
    for (i=0; i<hexPadding; i++) {
      hex += 0;
    } 
    return hex;
  }
function hexPadSize(strLenght){
	var n=0;
	while(((strLenght+n)*4)%64!=0){
		n+=1;
		}
	return n;
}
function hex2text(hexSource) {
    var bin = '';
    for (var i=0;i<hexSource.length;i=i+2) {
        bin += String.fromCharCode(hex2dec(hexSource.substr(i,2)));
    }
    return bin;
}
function hex2dec(hexStr) {
    hexStr = (hexStr + '').replace(/[^a-f0-9]/gi, '')
    return parseInt(hexStr, 16)
}
function hex2bin(hexstr){
	var dec = [];
	var bin = [];
	//var binstr = '';
	var binarr = [];
	var i,j;
	var hex = hexstr.toLowerCase();
	var hexLen = hex.length;
	for (i=0; i<hexLen; i++) {
    	dec.push(hex2dec(hex[i]));
    } 
    for(i=0; i<hexLen; i++){
    	for(j=4; j>0; j--){
    		//bin[j-1] = dec[i]%2;
    		binarr[j-1+i*4] = dec[i]%2;
    		dec[i] = parseInt(dec[i]/2);
    	}
    	//binstr += bin.toString();
    	//binstr += ',';
    	//binstr += bin.join();
    }
    
    //binstr=binstr.trim(' ');
    //return binstr;
    return binarr;
}
function bin2hex(){
}
</script>

</body>
</html>
