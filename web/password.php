<?php

function check_logged() {
		
	global $_SESSION, $USERS;	
	//if (!array_key_exists($_SESSION["logged"], $USERS)) {
	if(!isset($_SESSION["logged"])) {
		header("Location: login.php");
	};
};

function check_admin() {
	global $_SESSION;
	if(strcmp($_SESSION['logged'], 'admin')) {
		header("Location: login.php");
	};
};
?>
