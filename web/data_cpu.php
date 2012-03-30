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
            <span class="icon-bar"><img src="img/glyphicons-halflings.png" alt="test"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">RUCATS</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="data.php">Data</a>
              	<ul class="sub-level sub-level-data">
              		<!--<li class="active"><a href="#">CPU Data</a></li>-->
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
					<center>
									<?php
										      session_start();
										      $liveGraph = $_POST["liveGraph"];
										      $submit = $_POST["submit"];
										      $numpts = $_POST["numpts"];
										      $_SESSION['info'] = 'cpuinfo';
										      //print_r($_POST);
										      echo '<br/><br/>';
										      if(!isset($_POST['numpts'])){
										          $_SESSION['numpts'] = 6;
										      }
										      else{
										          $_SESSION['numpts'] = $numpts;
										      }
										      if ($liveGraph == 'live'){
										          echo '<img src="graph.php" id="reloader" onload="setTimeout(\'document.getElementById(\\\'reloader\\\').src=\\\'graph.php?\\\'+new Date().getMilliseconds()\', 5000)" height="230" width="700" />';
										      }
										      else{
										          echo '<img src="graph.php" height="230" width="700" />';
										      }
									?>
							</center>
					 <br>
					 <center>
							 <form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method ="post">
									 <center>
									 Graph Type:
									 <select name="liveGraph" style="min-width:125px;">
										   <?php
										      if(!isset($_POST['liveGraph'])){                
										          echo '<option value="static">Select one</option>';
										          echo '<option value="static">Static Graph</option>';
										          echo '<option value="live">Live Graph</option>';
										      }
										      else{ 
										              if($liveGraph == 'static'){
										                  echo '<option selected value="static">Static Graph</option>';
										                  echo '<option value="live">Live Graph</option>';
										              }
										              else{
										                  echo '<option selected value="live">Live Graph</option>';
										                  echo '<option value="static">Static Graph</option>';
										              }
										      }
										   ?>   
									 </select>
									 </center>
									<br/>
									<center>
									Plot Points:    
									<select name="numpts" style="min-width: 125px;">
										  <?php
										      if(!isset($_POST['numpts'])){
										          echo '<option value="6">Select one</option>';
										          echo '<option value="6">1 min.</option>';
										          echo '<option value="30">5 mins.</option>';
										          echo '<option value="60">10 mins.</option>';
										      }
										      else{
										          if($numpts == '6'){
										          echo '<option selected value="6">1 min.</option>';
										          echo '<option value="30">5 mins.</option>';
										          echo '<option value="60">10 mins.</option>';                        
										          }
										          else if($numpts == '30'){
										          echo '<option selected value="30">5 min.</option>';
										          echo '<option value="6">1 mins.</option>';
										          echo '<option value="60">10 mins.</option>';                             
										          }
										          else if($numpts == '60'){
										          echo '<option selected value="60">10 min.</option>';
										          echo '<option value="6">1 mins.</option>';
										          echo '<option value="30">5 mins.</option>';                          
										          }
										      }
										  ?>
									</select>
									</center>
									<br>
									<input type="submit" name="submit" value="Generate Graph">
							 </form>
					 </center>
      </div>


      <footer>
      </footer>

    </div> <!-- /container -->
    
    <!-- unneeded scripts 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>


<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
	-->
</body>
</html>
