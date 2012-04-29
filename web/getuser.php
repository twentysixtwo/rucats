<?php
$q=$_GET["q"];

$host="localhost"; // Host name 
$username="user"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM members WHERE username = '".$q."'";

$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>id</th>
<th>username</th>
<th>password</th>
<th>group</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['password'] . "</td>";
  echo "<td>" . $row['group'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>