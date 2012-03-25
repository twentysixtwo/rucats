<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <center>
        <?php
                session_start();
                $liveGraph = $_POST["liveGraph"];
                $submit = $_POST["submit"];
                $numpts = $_POST["numpts"];
                $info = $_POST["info"];
                
                print_r($_POST);
                echo '<br/><br/>';
                if(!isset($_POST['info'])){
                    $_SESSION['info'] = 'cpuinfo';
                }
                else{
                    $_SESSION['info'] = $info;
                }
                if(!isset($_POST['numpts'])){
                    $_SESSION['numpts'] = 6;
                }
                else{
                    $_SESSION['numpts'] = $numpts;
                }
                if ($liveGraph == 'live'){
                    echo '<img src="graph.php" id="reloader" onload="setTimeout(\'document.getElementById(\\\'reloader\\\').src=\\\'test.php?\\\'+new Date().getMilliseconds()\', 5000)" height="230" width="700" />';
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
        Graph Info. :
        <select name="info" style="min-width:125px;">
            <?php
                if(!isset($_POST['info'])){
                    echo '<option value="cpuinfo">Select one</option>';
                    echo'<option value="cpuinfo">CPU Info</option>';
                    echo '<option value="netinfo">Network Info</option>';
                    echo '<option value="tempinfo">Temperature Info</option>';
                }
                else{
                    if($info == 'cpuinfo'){
                        echo '<option selected value="cpuinfo">CPU Info</option>';
                        echo '<option value="netinfo">Network Info</option>';
                        echo '<option value="tempinfo">Temperature Info</option>';
                    }
                    else if($info == 'netinfo'){
                        echo '<option selected value="netinfo">Network Info</option>';
                        echo'<option value="cpuinfo">CPU Info</option>';
                        echo '<option value="tempinfo">Temperature Info</option>';
                    }
                    else if($info == 'tempinfo'){
                        echo '<option selected value="tempinfo">Temperature Info</option>';
                        echo '<option value="cpuinfo">CPU Info</option>';
                        echo'<option value="netinfo">Network Info</option>';                        
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
 </body> 
</html>
