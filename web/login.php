<?php
	ob_start();
	session_start();

	include("password.php");
		
	if ($_POST["act"]=="log") { /// do after login form is submitted
	$_SESSION['logtry']=TRUE;
	$host="localhost"; // Host name 
	$username="user";//"rucats"; // Mysql username 
	$password="";//"Hill#252"; // Mysql password 
	$db_name="test";//"rucats"; // Database name 
	$tbl_name="members"; // Table name
	
	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// Define $myusername and $mypassword 
	$myusername=$_POST['username']; 
	$mypassword=$_POST['password'];
	// To protect MySQL injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	
	$sql="SELECT * FROM " . $tbl_name . " WHERE username='" . $myusername . "' and password='". $mypassword. "'";
	$result=mysql_query($sql);
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		$_SESSION["logged"]=$_POST["username"];
		$_SESSION['logreturn']=$_SESSION["logged"] . " successfully logged in.";
		header("location: index.php"); 
	} else { 
		$_SESSION['logreturn']='Incorrect username/password. Please, try again.'; 
	}; 

};
	header("location:index.php");
	//if ((array_key_exists($_SESSION["logged"],$USERS)) && (!empty($_SESSION["logged"]))) { 
	//	header("location: index.php");
	//} else { // if not logged show login form (eventually redirect to prettier login page) 
	
		//echo '<form action="login.php" method="post"><input type="hidden" name="act" value="log"> '; 
     	//echo 'Username: <input type="text" name="username" /><br />'; 
     	//echo 'Password: <input type="password" name="password" /><br />'; 
     	//echo '<input type="submit" value="Login" />'; 
     	//echo '</form>'; 
	//}; 
ob_end_flush();
?>
