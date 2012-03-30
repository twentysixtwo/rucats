<?php
$USERS["user"] = "pass";

function check_logged() {
		
	global $_SESSION, $USERS;	
	//if (!array_key_exists($_SESSION["logged"], $USERS)) {
	if(!isset($_SESSION["logged"])) {
		header("Location: login.php");
	};
};
?>
