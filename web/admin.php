<?php
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>RUCATS</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width">

	
	<link rel="stylesheet/less" href="less/style.less">
	<script src="js/libs/less-1.2.1.min.js"></script>
	
	<!--<link rel="stylesheet/less" href="less/style.css">-->
	 
	<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	
	<script src="js/libs/bootstrap/transition.js"></script>
	<script src="js/libs/bootstrap/collapse.js"></script>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--<script type="text/javascript">
		$(document).ready(function(){
        		$('#login-trigger').click(function(){
                		$(this).next('#login-content').slideToggle();
                		$(this).toggleClass('active');                                  
				if ($(this).hasClass('active')) $(this).find('span').php('&#x25B2;')
                        	else $(this).find('span').html('&#x25BC;')
                		})
			});
	</script>-->
</head>
<body>

<style>
	ul.sub-level {
		display:none;
		text-align:center;
	}
	li:hover .sub-level-data {
    	background-color: rgb(44,44,44);
    	border: #fff solid;
    	border-width: 1px;
    	display: block;
    	position: absolute;
    	left: 28px;
    	top: 40px;
}
	li:hover .sub-level-jobs {
		background-color: rgb(44,44,44);
    	border: #fff solid;
    	border-width: 1px;
    	display: block;
    	position: absolute;
    	left: 75px;
    	top: 40px;
	}
	ul.sub-level li {
		list-style: none;
	}
	ul.sub-level li a {
		display:block;
		width: 120px;
		height: 25px;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		color: rgb(255,255,255);
		font-size:13px;
		text-decoration:none;
		text-align: left;
	}
	ul.sub-level li a:hover {
		outline: 0pt none;
		color:rgb(255,255,255);
		background-color:rgba(0,0,0,0.5);
	}
</style>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">RUCATS</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="data.php">Data</a>
              	<ul class="sub-level sub-level-data">
              		<li><a href="data_cpu.php">CPU Data</a></li>
              		<li><a href="data_net.php">Network Data</a></li>
              		<li><a href="data_temp.php">Temperature Data</a></li>
              	</ul>
              </li>
              <li><a href="jobs.php">Jobs</a>
              	<ul class="sub-level sub-level-jobs">
              		<li><a href="jobs_live.php">Live Jobs</a></li>
              		<li><a href="jobs_submit.php">Submit Jobs</a></li>
              	</ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!-- End container --> 
        
      </div> <!-- End navbar-inner -->
    </div> <!-- End navbar-fixed-top -->

    <div class="container">
      <div class="hero-unit">
      	<script type="text/javascript">
			function showUser(str) {
				if (str=="") {
  					document.getElementById("txt").innerHTML="BLANK";
  					return;
  				} 
				if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else {// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function() {
  					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    					document.getElementById("txt").innerHTML=xmlhttp.responseText;
    				}
  				}
				xmlhttp.open("GET","getuser.php?q="+str,true);
				xmlhttp.send();
				}
		</script>
		
			<?php 
					$host="localhost"; // Host name 
					$username="user"; // Mysql username 
					$password=""; // Mysql password 
					$db_name="test"; // Database name 
					$tbl_name="members"; // Table name

					// Connect to server and select database.
					mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
					mysql_select_db("$db_name")or die("cannot select DB");
					
					$query = "SELECT username FROM " . $tbl_name;
					$result = mysql_query($query);
					
					//if (isset($_POST['selectgroup'])) {
						//echo update group new info user
					//}
					
					//if (isset($_POST['selectuser'])) {
						//echo info groupid
					//}
					?>
					<!--<form name="selectuser" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">-->
					<form>
						<!--<input type="submit" name="submit" value="Update user">-->
						<select name="users" onchange="showUser(this.value)">-->
						
						<option value="">Select user:</option>
					<?php
					while ($row = mysql_fetch_array($result)) {
						if(!empty($row['username']))
						echo "<option value=" . $row['username'] . ">" . $row['username'] . "</option>";
					}
					?>
					</select>
					</form>
					<br />
					<div id="txt"><b>User info will be listed here.</b></div>
					
      </div>

    </div> <!-- /container -->
</body>
</html>
