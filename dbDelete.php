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

$sid3 = $_POST['sid3'];

// Clean up the given query (delete leading and trailing whitespace)
trim($sid3);

// remove the extra slashes
$sid = stripslashes($sid3);

$query = 'delete from Player where sid = '.$sid3.';';

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

print "Successfully Deleted";

mysql_close($conn);
?>

<br /><br />
<a href="http://css1.seattleu.edu/~jrobinson/dbtest/db.html"> Go to Main Page </a>

</body>
</html>
