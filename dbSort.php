<!-- dbInsert.php
     A PHP script to access the sailor database
     through MySQL
     -->
<html>
<head>
<title> Access the cars database with MySQL </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php

// Connect to MySQL

$servername = "cs100.seattleu.edu";
$username = "user57";
$password = "1234abcdF!";

$conn = mysql_connect($servername, $username, $password);

if (!$conn) {
     print "Error - Could not connect to MySQL ".$conn;
     exit;
}

// Database Access Name
$dbname = "bw_db57";

$db = mysql_select_db($dbname, $conn);
if (!$db) {
    print "Error - Could not select the sailor database ".$dbname;
    exit;
}

$opt = $_POST['opt'];

// Clean up the given query (delete leading and trailing whitespace)
trim($opt);

// remove the extra slashes
$opt = stripslashes($opt);
$nice = $opt;

//Translating Inputs
if ($opt == 'Points Scored')
    $opt = 'PointS';
else if ($opt == 'Points Assisted')
    $opt = 'PointA';
else if ($opt == 'Games Played')
    $opt = 'gplayed';
else if ($opt == 'MVP Number')
    $opt = 'MVPC';
else {
    print "Error - the option was not found";
    exit;
}

$query = 'select P.tid, T.Tname, sum(P.'.$opt.') from Team T, Player P where P.tid = T.tid group by P.tid order by sum(P.'.$opt.')desc;';

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Get the number of fields in the rows
$num_fields = mysql_num_fields($result);
//print "Number of fields = $num_fields <br />";

// Get the number of rows in the result
$num_rows = mysql_num_rows($result);

// Get the number of fields in the rows
$num_fields = mysql_num_fields($result);

// Get the first row
$row = mysql_fetch_array($result);

// Display the results in a table
print "<table border='border'><caption> <h2> Query Results </h2> </caption>";
print "<tr align = 'center'>";

// Produce the column labels
print "<th> TID </th>";
print "<th> Team Name </th>";
print "<th> $nice </th>";

print "</tr>";

// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {

    print "<tr align = 'center'>";
    $values = array_values($row);

    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<td>" . $value . "</td> ";
    }

    print "</tr>";
    $row = mysql_fetch_array($result);
}

print "</table>";

mysql_close($conn);
?>

<br /><br />
<a href="http://css1.seattleu.edu/~jrobinson/dbtest/db.html"> Go to Main Page </a>

</body>
</html>
