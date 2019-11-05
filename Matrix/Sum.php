<script>
function createTableA()
{
    var num_rows = document.getElementById('rowsA').value;
    var num_cols = document.getElementById('colsA').value;
    var theader = '<table border="1">';
    var tbody = '';
    for( var i=0; i<num_rows;i++)
    {
        tbody += '<tr>';
        for( var j=0; j<num_cols;j++)
        {
            tbody += '<td>';
            tbody += '<input type="number" id = A' + i + j+' >';
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
            tbody += '<input type="number" id = B' + i + j+' >';
            tbody += '</td>'

        }
        tbody += '</tr>\n';
    }
    var tfooter = '</table>';
    document.getElementById('wrapperB').innerHTML = theader + tbody + tfooter;
}
function myMatrix(){
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
</script>
</head>

<body>
<form name="tablegenA">
<label>Rows: <input type="text" name="rowsA" id="rowsA"></label>
<label>Cols: <input type="text" name="colsA" id="colsA"></label><br>
<input name="generate" type="button" value="Create Table A!" onclick='createTableA();'>
</form>

<div id="wrapperA"></div>
<form name="tablegenB">
<label>Rows: <input type="text" name="rowsB" id="rowsB"></label>
<label>Cols: <input type="text" name="colsB" id="colsB"></label><br>
<input name="generate" type="button" value="Create Table B!" onclick='createTableB();'>
</form>

<div id="wrapperB"></div>
<button onclick="myMatrix()">Test</button>

<div id="result"></div>
</body>
</html>
