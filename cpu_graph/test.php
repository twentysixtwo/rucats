<?php
header("Refresh: 10;");
error_reporting(E_ALL);
include('phpgraphlib.php');

$dbhost = 'localhost';
$dbuser = 'aditya';
$dbpass = 'obelix1';
$dbname = "cluster";
$tblname = 'cpuinfo';
//while(true){
$dbhandle = mysql_connect($dbhost, $dbuser, $dbpass);
if(!$dbhandle){
  die('Could not connect to MySQL database: '. mysql_error());    
}
//echo 'Successfully Connected to Database.<br>';

mysql_select_db($dbname, $dbhandle) or die ($dbname . " Database not found. " . $dbuser);

$query = 'select distinct procID from ' . $tblname;
$result = mysql_db_query($dbname, $query) or die("Failed query: ".$query);
//echo "<br>";
$i = 0;
$j = 0;

while($thisrow = mysql_fetch_row($result)){
    
    $query_d = 'select * from (select * from cpuinfo where procID=' . $thisrow[0] .' order by cur_timestamp desc limit 6) as tbl order by tbl.cur_timestamp';
    $result_d = mysql_db_query($dbname,$query_d) or die("Failed query: ".$query_d);
    while($thisrow_d = mysql_fetch_row($result_d)){
        $data[$i][$j++] = $thisrow_d[0];
        //print_r($thisrow_d);
        //echo "<br>";
    }
    $i++;
    //echo "<br>";
   // $data[$i++] = $thisrow[0];
}

//echo "Done printing table ".$tblname." <br><br><br>";
//print_r($data); 
mysql_close();

$graph = new PHPGraphLib(650,200);
foreach($data as $val){
    $graph->addData($val);
}
$graph->setTitle('CPU Utilization');
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataPointColor('maroon');
$graph->setDataValues(true);
$graph->setDataValueColor('green');
$graph->setGoalLine(.0025);
$graph->setGoalLineColor('red');
$graph->setXValuesHorizontal(true);
$graph->createGraph();
?>