<!DOCTYPE html>
<html>
<body>

<h1>DES encryption</h1>
<h2>Plain text:</h2>
<p id="plaintext"></p>
<h2>Plain text to hex:</h2>
<p id="text2hex"></p>
<h2>Key to hex:</h2>
<p id="key2hex"></p>
<h2>Plain text to bin:</h2>
<p id="text2bin"></p>
<h2>Key to bin:</h2>
<p id="key2bin"></p>
<h2>Bin text to hex:</h2>
<p id="bin2hex"></p>
<h2>Bin key to hex:</h2>
<p id="binkey2hex"></p>
<h2>Bin to text:</h2>
<p id="bin2text"></p>
<h1>Print arr:</h1>
<p id="printArr"></p>
<p id="demo"></p>

<script>
var x = "Your lips are smoother than vaseline."
var y = "0123456789ABCDEF";
var key ="133457799BBCDFF1";
//document.getElementById("plaintext").innerHTML = x;
document.getElementById("text2hex").innerHTML = y;
document.getElementById("key2hex").innerHTML = key;
document.getElementById("text2bin").innerHTML = hex2bin(y);
document.getElementById("key2bin").innerHTML = hex2bin(key);
document.getElementById("printArr").innerHTML = bin2hex(des(hex2bin(y),hex2bin(key)));
//document.getElementById("printArr").innerHTML = myTest();
//des(hex2bin(y),hex2bin(key));
//document.getElementById("bin2hex").innerHTML = bin2hex(hex2bin(y));
//document.getElementById("binkey2hex").innerHTML = bin2hex(hex2bin(key));

//document.getElementById("bin2text").innerHTML = hex2text(bin2hex(hex2bin(y)));
function myTest(){
const items = [1, 29, 47];
const copy = [];

items.forEach(function(item){
  copy.push(item*item);
});
return copy;
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
function binPadSize(strLenght){
	var n=0;
	while((strLenght+n)%64!=0){
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
	var binarr = [];
	var i,j;
	var hex = hexstr.toLowerCase();
	var hexLen = hex.length;
	//hexLen = hex.length;
    var hexPadding = hexPadSize(hexLen);
    for (i=0; i<hexPadding; i++) {
      hex += 0;
    }
    hexLen = hexLen+hexPadding;
	for (i=0; i<hexLen; i++) {
    	dec.push(hex2dec(hex[i]));
    } 
    for(i=0; i<hexLen; i++){
    	for(j=4; j>0; j--){
    		binarr[j-1+i*4] = dec[i]%2;
    		dec[i] = parseInt(dec[i]/2);
    	}
    }
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
function dec2bin(dec, binarr){
	var tmp=dec;
    for(var i=3;i>=0;i--)
    {
        binarr[i]=tmp%2;
        tmp=parseInt(tmp/2);
    }
    
	//return dec;
}

function xorFunction( arr1,  arr2, arr3,  n){
	for( i=0;i<n;i++){
		if(((arr1[i]==1) | (arr2[i]==1))& (arr1[i]!= arr2[i])){
			arr3[i]=1;
		}
		else{
			arr3[i]=0;
		}
	}
}

function leftShift(arr, n){
	var tmp;
	for(var i=0; i<n; i++){
		tmp=arr[0];//save first element
		arr.shift();//removes first element
		arr.push(tmp);//pushes first element at the end
	}
}
function splitArr(arr, arr1, arr2,  n){
	for( i=0;i<n;i++){
		arr1[i]=arr[i];
		arr2[i]=arr[i+n];
	}
}
function permutation( n, arr1,  arr2,  arrp){
 	for(var i=0;i<n;i++){
		arr2[i] = arr1[arrp[i]-1];
	}
}
function des(binTxt, binKey){
	var ip = [58,50,42,34,26,18,10,2,60,52,44,36,28,20,12,4,
              62,54,46,38,30,22,14,6,64,56,48,40,32,24,16,8,
              57,49,41,33,25,17, 9,1,59,51,43,35,27,19,11,3,
              61,53,45,37,29,21,13,5,63,55,47,39,31,23,15,7];
    var kp = [57,49,41,33,25,17, 9, 1,58,50,42,34,26,18,
              10, 2,59,51,43,35,27,19,11, 3,60,52,44,36,
              63,55,47,39,31,23,15, 7,62,54,46,38,30,22,
              14, 6,61,53,45,37,29,21,13, 5,28,20,12,4];
    var bsh = [1,1,2,2,2,2,2,2,1,2,2,2,2,2,2,1];
    var debsh = [0,1,2,2,2,2,2,2,1,2,2,2,2,2,2,1];
    var cp = [14,17,11,24, 1, 5,3,28,15,6,21,10,
              23,19,12, 4,26, 8,16, 7,27,20,13, 2,
              41,52,31,37,47,55,30,40,51,45,33,48,
              44,49,39,56,34,53,46,42,50,36,29,32];
              
    var ep = [32, 1, 2, 3, 4, 5, 4, 5, 6, 7, 8, 9,
    		   8, 9,10,11,12,13,12,13,14,15,16,17,
    		  16,17,18,19,20,21,20,21,22,23,24,25,
    		  24,25,26,27,28,29,28,29,30,31,32, 1];

    var fp = [40,8,48,16,56,24,64,32,39,7,47,15,55,23,63,31,
              38,6,46,14,54,22,62,30,37,5,45,13,53,21,61,29,
              36,4,44,12,52,20,60,28,35,3,43,11,51,19,59,27,
              34,2,42,10,50,18,58,26,33,1,41, 9,49,17,57,25];

    var sbox1 = [[14, 4,13,1, 2,15,11, 8, 3,10, 6,12, 5, 9,0, 7],
                 [ 0,15, 7,4,14, 2,13, 1,10, 6,12,11, 9, 5,3, 8],
                 [ 4, 1,14,8,13, 6, 2,11,15,12, 9, 7, 3,10,5, 0],
                 [15,12, 8,2, 4, 9, 1, 7, 5,11, 3,14,10, 0,6,13]];

    var sbox2 = [[15, 1, 8,14, 6,11, 3, 4, 9,7, 2,13,12,0, 5,10],
                 [ 3,13, 4, 7,15, 2, 8,14,12,0, 1,10, 6,9,11, 5],
                 [ 0,14, 7,11,10, 4,13, 1, 5,8,12, 6, 9,3, 2,15],
                 [13, 8,10, 1, 3,15, 4, 2,11,6, 7,12, 0,5,14, 9]];

    var sbox3 = [[10, 0, 9,14,6, 3,15,5,1,13,12,7,11,4,2,8],
                 [13, 7, 0, 9,3, 4, 6,10,2,8,5,14,12,11,15,1],
                 [13, 6, 4, 9,8,15, 3,0,11,1,2,12,5,10,14,7],
                 [ 1,10,13, 0,6, 9, 8,7,4,15,14,3,11,5,2,12]];

    var sbox4 = [[ 7,13,14,3, 0, 6, 9,10, 1,2,8, 5,11,12, 4,15],
                 [13, 8,11,5, 6,15, 0, 3, 4,7,2,12, 1,10,14, 9],
                 [10, 6, 9,0,12,11, 7,13,15,1,3,14, 5, 2, 8, 4],
                 [ 3,15, 0,6,10, 1,13, 8, 9,4,5,11,12, 7, 2,14]];

    var sbox5 = [[ 2,12, 4, 1, 7,10,11, 6, 8, 5, 3,15,13,0,14, 9],
                 [14,11, 2,12, 4, 7,13, 1, 5, 0,15,10, 3,9, 8, 6],
                 [ 4, 2, 1,11,10,13, 7, 8,15, 9,12, 5, 6,3, 0,14],
                 [11, 8,12, 7, 1,14, 2,13, 6,15, 0, 9,10,4, 5, 3]];

    var sbox6 = [[12,1,10,15,9,2,6,8,0,13,3,4,14,7,5,11],
               [10,15,4,2,7,12,9,5,6,1,13,14,0,11,3,8],
               [9,14,15,5,2,8,12,3,7,0,4,10,1,13,11,6],
               [4,3,2,12,9,5,15,10,11,14,1,7,6,0,8,13]];

    var sbox7=[[4,11,2,14,15,0,8,13,3,12,9,7,5,10,6,1],
               [13,0,11,7,4,9,1,10,14,3,5,12,2,15,8,6],
               [1,4,11,13,12,3,7,14,10,15,6,8,0,5,9,2],
               [6,11,13,8,1,4,10,7,9,5,0,15,14,2,3,12]];

    var sbox8=[[13,2,8,4,6,15,11,1,10,9,3,14,5,0,12,7],
               [1,15,13,8,10,3,7,4,12,5,6,11,0,14,9,2],
               [7,11,4,1,9,12,14,2,0,6,10,13,15,3,5,8],
               [2,1,14,7,4,10,8,13,15,12,9,0,3,5,6,11]];

    var pbox = [16,7,20,21,29,12,28,17,1,15,23,26,5,18,31,10,2,8,24,14,32,27,3,9,19,13,30,6,22,11,4,25];              
    var rn = [];
	var ln = [];
	var rn1 = [];
	var ln1 = [];
	var i, j, k;
	var c = [];
	var d = [];
	var ipTxt=[];
	var kpKey=[];
	var kpKeyL=[];
	var kpKeyR=[];
	var fKey=[];
	var cpKey=[];
	var xorExp=[];
	var rnExp=[];
	var mLen=binTxt.length/2;
	var row;
	var col;
	var stmp;
	var bintmp=[];
	var ctmp;
	var sbox=[];
	var xbox=[];
	
	var cypherTxt=[];
    permutation(64, binTxt, ipTxt, ip);
    ///key permutationS
    permutation(56, binKey, kpKey, kp);
    splitArr(kpKey,kpKeyL,kpKeyR,28);
	///F function
	for(i=0; i<16; i++){//change to 16
		splitArr(ipTxt,ln,rn,32);
		for(j=0;j<32;j++)
        {
            ln1[j]=rn[j];
        }
		leftShift(kpKeyL,bsh[i]);
        leftShift(kpKeyR,bsh[i]);
        for(j=0;j<28;j++){
            fKey[j]=kpKeyL[j];
            fKey[j+28]=kpKeyR[j];
        }
        ///fkey compression permutation
		permutation(48, fKey, cpKey, cp);
		///Expantion Permutation
 		permutation(48, rn, rnExp, ep);
 		/// XOR (RNEXP,CPKEY)
 		xorFunction(rnExp,cpKey,xorExp,48);
 		///Sbox substitution
 		
 		ctmp=0;
        for(j=0;j<48;j=j+6){
 			row=xorExp[j]*2+xorExp[j+5];
       		col=8*xorExp[j+1]+4*xorExp[j+2]+2*xorExp[j+3]+xorExp[j+4];
       		stmp=0;
    		if(j==0)stmp=sbox1[row][col]; 
        	if(j==6)stmp=sbox2[row][col];
        	if(j==12)stmp=sbox3[row][col];
       	 	if(j==18)stmp=sbox4[row][col];
        	if(j==24)stmp= sbox5[row][col];
        	if(j==30)stmp= sbox6[row][col];
        	if(j==36)stmp=sbox7[row][col];
        	if(j==42)stmp=sbox8[row][col];
        	/*switch(j){
        	case 0:
        		stmp=sbox1[row][col]; 
        		break;
        	case 6:
        		stmp=sbox2[row][col];
        		break;
        	case 12:
        	case 18:
        	case 24:
        	case 30:
        	case 36:
        	case 42:
        	}*/
        	dec2bin(stmp,bintmp);
        	for(k=0;k<4;k++)
            {
                sbox[ctmp+k]=bintmp[k];
            }
            ctmp=ctmp+4;
        }
        ///Pbox permutation
        permutation(32, sbox, xbox, pbox);
		/// XOR(xbox,ln)
        xorFunction(xbox,ln,rn1,32);

        ///new ipplain
        for(j=0;j<32;j++)
        {
            ipTxt[j]=ln1[j];
            ipTxt[j+32]=rn1[j];
        }
	}///function F end
	 for(j=0;j<32;j++)
        {
            ipTxt[j]=rn1[j];
            ipTxt[j+32]=ln1[j];
        }
        ///Final permutation
        permutation(64, ipTxt,cypherTxt , fp);
	//document.getElementById("demo").innerHTML = pbox.toString();
	return cypherTxt;
}

</script>

</body>
</html>
