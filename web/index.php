<?php
	session_start();
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
	<script type="text/javascript">
		$(document).ready(function(){
        		$('#login-trigger').click(function(){
                		$(this).next('#login-content').slideToggle();
                		$(this).toggleClass('active');                                  
				if ($(this).hasClass('active')) $(this).find('span').php('&#x25B2;')
                        	else $(this).find('span').html('&#x25BC;')
                		})
			});
	</script>
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
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"><img src="img/glyphicons-halflings.png" alt="test"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
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
        
        <!-- Ignoring login for now
        <div class="login"> 
			  	<a id="login-trigger" href="#login">Log in</a>
				<div id="login-content">
					<form>
						<fieldset id="inputs">
							<input id="username" type="text" placeholder="Username" required>
							<input id="password" type="password" placeholder="Password" required>
						</fieldset> 
						<fieldset id="actions">
							<input type="submit" id="submit" value="Log In">
							<label><input type="checkbox" checked="checked">Keep me signed in</label>
						</fieldset>
					</form>
				</div> 
        </div> End login div -->
        
      </div> <!-- End navbar-inner -->
    </div> <!-- End navbar-fixed-top -->

    <div class="container">
      <div class="hero-unit">
        <h1>Intro and login</h1>
        	<?php 
        		if ((array_key_exists("logged",$_SESSION)) && (!empty($_SESSION["logged"]))) {
        			echo "Hello " . $_SESSION["logged"];
				}
					
				else {
					
        	?>
        	
        	<!-- Login prompt --> 
        	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr>
				<form name="form1" method="post" action="login.php">
				<input type="hidden" name="act" value="log">
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr><td colspan="3"><strong>Member Login </strong></td></tr>
				<tr>
					<td width="78">Username</td>
					<td width="6">:</td>
					<td width="294"><input name="username" type="text" id="username"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input name="password" type="password" id="password"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Login"></td>
				</tr>
				</table>
			</td>
			</form>
			</tr>
			</table>
			<?php 
				} 
			?>
      </div>

      <!-- Example row of columns -->
      <!--
      <div class="row">
        <div class="span4">
          <h2>Heading</h2>
        </div>
        <div class="span4">
          <h2>Heading</h2>
       </div>
        <div class="span4">
          <h2>Heading</h2>
        </div>
      </div>
		-->
      <!-- Horizontal line <hr> --> 

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
