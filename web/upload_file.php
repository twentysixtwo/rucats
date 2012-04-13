<head>
<meta http-equiv="refresh" content="109; URL=jobs.php">
</head>

<?php
	error_reporting(E_ALL);
	ini_set("display_errors",1);
	
	session_start();

	include("password.php");

	check_logged();	
	$username = $_SESSION['logged'];
	


	$dbhost = 'hostname';
	$dbuser = 'username';
	$dbpass = 'password';
	$dbname = "dbname";
	$tblname = "tablename";
    $query = "select jobcount from " . $tblname . " where username='" . $username . "';";

	$dbhandle = mysql_connect($dbhost, $dbuser, $dbpass);
    if(!$dbhandle){
    die('Could not connect to MySQL database: '. mysql_error());
    }

    mysql_select_db($dbname, $dbhandle) or die ($dbname . " Database not found. " . $dbuser);

	$result = mysql_query($query) or die("Failed query: ".$query);
	$row = mysql_fetch_row($result);
	$jobcount = $row[0];
	$jobcount++;
	echo 'jobcount='. $jobcount . "<br>";

	$query = "update " . $tblname . " set jobcount=jobcount+1 where username='" . $username . "';";
	$result = mysql_query($query);
	
	if(!$result){
		die('Invalid query: ' . mysql_error());
	}


	mysql_close($dbhandle);


	$path = '/tmp/'. $username . '-jid' . $jobcount;

	if(!mkdir($path,0777)){
		echo "Error: Server cannot create tmp folder for user '" . $username . "' (already exists)<br>";
	}
	$cprogram = 0;
	$makefile = 0;
	$javaprogram = 0;

	$length = count($_FILES['file']['name']);
	$size = 0;
	
	for($i = 0; $i < $length; $i++){
		$name = $_FILES['file']['name'][$i];
	
		if(!$cprogram){
			$cprogram = preg_match('/\.c|\.cpp/',$name);
		}

		if(!$makefile){
			$makefile = preg_match('/[Mm]akefile/',$name);
		}

		if(!$javaprogram){
			$javaprogram = preg_match('/\.java/',$name);
		}

		if(file_exists($path . '/' . $name)){
			echo $name . " already exists (skipping).<br />";
		}
		else{
		$tempname = $_FILES["file"]["tmp_name"][$i];
      			if(move_uploaded_file($tempname, $path . '/' . $name)){
			    	echo "Upload: " . $name . "<br />";
			    	echo "Type: " . $_FILES["file"]["type"][$i] . "<br />";
			    	echo "Size: " . round(($_FILES["file"]["size"][$i] / 1024),3) . " Kb<br />";
					$size += $_FILES['file']['size'][$i];
			}
			else{
				echo "There was a problem uploading the files.<br>";
			}
		}
	}

	echo "<br />Total Size: " . round(($size / 1024),3) . " Kb<br />";	

	/*Create archive (tar) of uploaded code. Makes for easy shipment to job scheduler and compute nodes*/

	$fp = fopen($path . '/manifest','w');

	if($cprogram && $makefile){
		fwrite($fp,"C");
		fclose($fp);	
	}
	
	else if($javaprogram){
		fwrite($fp,"java");
		fclose($fp);
	}

	$phar = new PharData($path . '.tar');
	$phar->buildFromDirectory($path);

	deleteDirectory($path);
	//deleteDirectory($path . '.tar');
	

	function deleteDirectory($dir){
		if (!file_exists($dir)) return true;
		if (!is_dir($dir)) return unlink($dir);
		foreach (scandir($dir) as $item){
			if($item == '.' || $item == '..') continue;
			if(!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) return false;
		}
		return rmdir($dir);
	}
?>
