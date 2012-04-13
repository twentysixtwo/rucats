<?php
	ob_start();
	session_start();
		
	if ($_POST["act"]=="reg") {
		//if(($_POST['password'])==($_POST['password2'])) {
		$_SESSION['regtry']=TRUE;
		$pass1=$_POST['password1'];
		$pass2=$_POST['password2'];
		if(!strcmp($pass1,$pass2)) { //returns 0 on equal
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
			$mypassword=$pass1;
			// To protect MySQL injection
			$myusername = stripslashes($myusername);
			$mypassword = stripslashes($mypassword);
			$myusername = mysql_real_escape_string($myusername);
			$mypassword = mysql_real_escape_string($mypassword);
			
			if( strlen($_POST['username']) < 4 ) {
				$_SESSION['regreturn'] = "Username too short. Must be at least 4 characters.";
				header("location: register.php");
			}
			if( strlen($_POST['username']) > 16 ) {
				$_SESSION['regreturn'] = "Username too long. Must be less than 16 characters.";
				header("location: register.php");
			}
			if( strlen($mypassword) < 4 ) {
				$_SESSION['regreturn'] = "Password too short. Must be at least 4 characters.";
				header("location: register.php");
			}
			if( strlen($mypassword) > 16 ) {
				$_SESSION['regreturn'] = "Password too long. Must be less than 16 characters.";
				header("location: register.php");
			}
			if( !preg_match("#[0-9]+#", $mypassword) ) {
				$_SESSION['regreturn'] = "Password must include at least one number!";
				header("location: register.php");
			}
			if( !preg_match("#[a-z]+#", $mypassword) ) {
				$_SESSION['regreturn' ]= "Password must include at least one letter!";
				header("location: register.php");
			}
			if( !preg_match("#[A-Z]+#", $mypassword) ) {
				$_SESSION['regreturn'] = "Password must include at least one CAPS!";
				header("location: register.php");
			}
			
			//SELECT COUNT(*) ...
			$sql="SELECT * FROM " . $tbl_name . " WHERE username='" . $myusername . "'";
			$result=mysql_query($sql);
			// Mysql_num_row is counting table row
			$count=mysql_num_rows($result);
			//JUST MAKE $_SESSION['ERROR'] STRING VARIABLE
			//$count=mysql_query("SELECT COUNT(*) FROM " . $tbl_name . " WHERE username ='" . $myusername . "'");
			if($count==1){ // username is used already
				sleep(0);
				$_SESSION['regreturn'] = "Username " . $myusername . " already in use." . mysql_num_rows($count);
				header("location: register.php"); 
			} else { //username and password valid put in db
				mysql_query("INSERT INTO members (username, password) values ('" . $myusername . "','" . $mypassword . "')");
				$_SESSION['regreturn'] = "Username " . $myusername . " successfully registered.";
				header("location: register.php");
			}
		} else { //passwords not equal 
			sleep(0);
			$_SESSION['regreturn'] = "Passwords do not match.";
			header("location: register.php");
		}			 

}
	
ob_end_flush();
?>
