<!DOCTYPE html>
<html>
<body>

<h1>DES encryption</h1>
<h2>Plain text:</h2>
<p id="plaintext"></p>
<h2>Plain text to hex:</h2>
<p id="text2hex"></p>
<h2>Plain text to bin:</h2>
<p id="text2bin"></p>
<h2>Bin to hex:</h2>
<p id="bin2hex"></p>
<h1>Bin to text:</h1>
<p id="bin2text"></p>


<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script>
var x = "Your lips are smoother than vaseline."
document.getElementById("plaintext").innerHTML = x;
document.getElementById("text2hex").innerHTML = text2hex(x);
document.getElementById("text2bin").innerHTML = hex2bin(text2hex(x));
document.getElementById("bin2hex").innerHTML = bin2hex(hex2bin(text2hex(x)));
document.getElementById("bin2text").innerHTML = hex2text(bin2hex(hex2bin(text2hex(x))));
function myFunction(str) {
	var values, fLen, i;
	values = [];
	bin=[];
	fLen = str.length;
	for (i = 0; i < fLen; i++) {
		values.push(str.charCodeAt(i));
	}
	document.getElementById("demo").innerHTML = values;
}
function text2hex(str) {
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
    var txt = '';
    for (var i=0;i<hexSource.length;i=i+2) {
        txt += String.fromCharCode(hex2dec(hexSource.substr(i,2)));
    }
    return txt;
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
function bin2hex(binarr){
	var decarr = bin2dec(binarr);
	var i;
	var hexString = '';
	for (i=0; i<decarr.length; i++){
		hexString += decarr[i].toString(16);
	}
	return hexString;
}
function bin2dec(binarr){
	var decarr = [];
	var i;
	var tmp;
	for (i=0; i<binarr.length; i=i+4){
		tmp = binarr[i]*8;
		tmp = tmp+(binarr[i+1]*4);
		tmp = tmp+(binarr[i+2]*2);
		tmp = tmp+(binarr[i+3]);
		decarr.push(tmp);
	}
	return decarr;
}
function printArr(arr){
	var txt = "";
	numbers.forEach(myFunctionTxt);
	document.getElementById("printArr").innerHTML = txt;

}
function myFunctionTxt(value, index, array) {
  txt = txt + value + "<br>"; 
}

</script>

</body>
</html>
