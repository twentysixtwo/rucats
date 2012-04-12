<?php
	ob_start();
	session_start();
		
	if ($_POST["act"]=="reg") {
		//if(($_POST['password'])==($_POST['password2'])) {
		if(!strcmp($_POST['password'], $_POST['password2'])) { //returns 0 on equal
			$host="localhost"; // Host name 
			$username="user"; // Mysql username 
			$password=""; // Mysql password 
			$db_name="test"; // Database name 
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
			
			//SELECT COUNT(*) ...
			//$sql="SELECT * FROM " . $tbl_name . " WHERE username='" . $myusername . "'";
			//$result=mysql_query($sql);
			// Mysql_num_row is counting table row
			//$count=mysql_num_rows($result);
			$count=mysql_query("SELECT COUNT(*) FROM " . $tbl_name . " WHERE username ='" . $myusername . "'");
			if(mysql_num_rows($count)==1){ // username is used already
				sleep(0);
				$_SESSION['username'] = $myusername;
				header("location: register_fail.php"); 
			} else { //username and password valid put in db
				mysql_query("INSERT INTO members (username, password) values ('" . $myusername . "','" . $mypassword . "')");
				header("location: register_success.php");
			}
		} else { //passwords not equal
			sleep(0);
			header("location: register_fail.php");
		}			 

}
	
ob_end_flush();
?>
