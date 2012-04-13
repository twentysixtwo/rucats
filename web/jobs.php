<?php 
//ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);

session_start(); 
include("password.php"); 

check_logged(); /// function checks if visitor is logged. 

//If user is not logged the user is redirected to login.php page  

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
	
	
	<!-- Use SimpLESS (Win/Linux/Mac) or LESS.app (Mac) to compile your .less files
	to style.css, and replace the 2 lines above by this one:
	-->
	
	<!--<link rel="stylesheet/less" href="less/style.css">-->
	 
	<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	
	<script src="js/libs/bootstrap/transition.js"></script>
	<script src="js/libs/bootstrap/collapse.js"></script>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
        		$('#login-trigger').click(function(){
                		$(this).next('#login-content').slideToggle();
                		$(this).toggleClass('active');                                  
				if ($(this).hasClass('active')) $(this).find('span').php('&#x25B2;')
                        	else $(this).find('span').php('&#x25BC;')
                		})
			});
	</script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<style>
	ul.sub-level {
		display:none;
		text-align:center;
	}
	li:hover .sub-level-data {
    background-color: rgb(44,44,44);
    /*text-decoration: none;*/
    border: #fff solid;
    border-width: 1px;
    display: block;
    position: absolute;
    left: 28px;
    top: 40px;
}
	li:hover .sub-level-jobs {
	background-color: rgb(44,44,44);
    /*text-decoration: none;*/
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
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <a class="brand" href="#">RUCATS</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="data.php">Data</a>
              	<ul class="sub-level sub-level-data">
              		<li><a href="data_cpu.php">CPU Data</a></li>
              		<li><a href="data_net.php">Network Data</a></li>
              		<li><a href="data_temp.php">Temperature Data</a></li>
              	</ul>
              </li>
              <li class="active"><a href="#">Jobs</a>
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
        <h1>Placeholder for jobs</h1>
        <form action="upload_file.php" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="file[]" multiple/> 
			<br />
			<input type="submit" name="submit" value="Submit" />
		</form>
        	
      </div>
      <footer>
      </footer>

    </div> <!-- /container -->
</body>
</html>
