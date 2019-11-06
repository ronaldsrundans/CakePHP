<script>
function createTableA(){
    var num_rows = document.getElementById('rowsA').value;
    var num_cols = document.getElementById('colsA').value;
    var theader = '<table border="1">';
    var tbody = '';
    for( var i=0; i<num_rows;i++){
        tbody += '<tr>';
        for( var j=0; j<num_cols;j++){
            tbody += '<td>';
            tbody += '<input type="number" id = A' + i + j+' value="0" >';
            tbody += '</td>'
        }
        tbody += '</tr>';
    }
    var tfooter = '</table>';
    document.getElementById('wrapperA').innerHTML = theader + tbody + tfooter;
}
function createTableB()
{
    var num_rows = document.getElementById('rowsB').value;
    var num_cols = document.getElementById('colsB').value;
    var theader = '<table border="1">\n';
    var tbody = '';

    for( var i=0; i<num_rows;i++)
    {
        tbody += '<tr>';
        for( var j=0; j<num_cols;j++)
        {
            tbody += '<td>';
            tbody += '<input type="number" id = B' + i + j+' value="0" >';
            tbody += '</td>'

        }
        tbody += '</tr>\n';
    }
    var tfooter = '</table>';
    document.getElementById('wrapperB').innerHTML = theader + tbody + tfooter;
}
function sumMatrix(){
    var num_rows = document.getElementById('rowsA').value;
    var num_cols = document.getElementById('colsB').value;
    var theader = '<table border="1">';
    var tbody = '';


for( var i=0; i<num_rows;i++)
    {
        tbody += '<tr>';
        for( var j=0; j<num_cols;j++)
        {
            var a = Number(document.getElementById('A'+i+j).value);
            var b = Number(document.getElementById('B'+i+j).value);
            tbody += '<td>';
            tbody += (a+b);
            tbody += '</td>'

        }
        tbody += '</tr>\n';
    }
    var tfooter = '</table>';
    document.getElementById('result').innerHTML = theader + tbody + tfooter;
}

function multiplyMatrix(){
  var num_rowsA = document.getElementById('rowsA').value;
  var num_colsA = document.getElementById('colsA').value;
  var num_rowsB = document.getElementById('rowsB').value;
  var num_colsB = document.getElementById('colsB').value;
  var theader = '<table border="1">';
  var tbody = '';
  var tmp=Number(0);
 /* for(var i=0;i<num_rowsA;i++){
    tbody += '<tr>';
    for( var j=0; j<num_colsB;j++){
      for(var k=0; k<num_colsA; k++){
         var a = Number(document.getElementById('A'+i+k).value);
         var b = Number(document.getElementById('B'+k+j).value);
         tmp+=(a*b)
       }
       tbody += '<td>';
       tbody += tmp;
       tbody += '</td>'
       tmp=Number(0);
     }
    tbody += '</tr>;
   }
    var tfooter = '</table>';
    document.getElementById('result').innerHTML = theader + tbody + tfooter;
}
*/
for( var i=0; i<num_rowsA;i++)
    {
        tbody += '<tr>';
        for( var j=0; j<num_colsB;j++)
        {
            for(var k=0; k<num_colsA;k++)
            {
              var a = Number(document.getElementById('A'+i+k).value);
              var b = Number(document.getElementById('B'+k+j).value);
              tmp+=(a*b);
            }
           /* var a = Number(document.getElementById('A'+i+j).value);
            var b = Number(document.getElementById('B'+i+j).value);*/
            tbody += '<td>';
            tbody += tmp;
            tbody += '</td>'
            tmp=Number(0);

        }
        tbody += '</tr>\n';
    }
    var tfooter = '</table>';
    document.getElementById('result').innerHTML = theader + tbody + tfooter;
}


</script>
</head>

<body>
<form name="tablegenA">
<label>Rows: <input type="text" name="rowsA" id="rowsA"></label>
<label>Cols: <input type="text" name="colsA" id="colsA"></label><br>
<input name="generate" type="button" value="Create Matrix A!" onclick='createTableA();'>
</form>

<div id="wrapperA"></div>
<form name="tablegenB">
<label>Rows: <input type="text" name="rowsB" id="rowsB"></label>
<label>Cols: <input type="text" name="colsB" id="colsB"></label><br>
<input name="generate" type="button" value="Create Matrix B!" onclick='createTableB();'>
</form>

<div id="wrapperB"></div>
<p>
<button onclick="sumMatrix()">+</button>
<button onclick="multiplyMatrix()">Test</button>

</p>
<p><label>Results:</label></p>
<div id="result"></div>

</body>
</html>
