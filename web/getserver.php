<?php
$q=$_GET["q"]; // q will hold server name to display group permissions

$host="localhost"; // Host name 
$username="user"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="servers"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM " . $tbl_name . " WHERE server = '".$q."'";

$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>server</th>
<th>Admin</th>
<th>Group 1</th>
<th>Group 2</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['server'] . "</td>";
  echo "<td>" . $row['group1'] . "</td>";
  echo "<td>" . $row['group2'] . "</td>";
  echo "<td>" . $row['group3'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>	