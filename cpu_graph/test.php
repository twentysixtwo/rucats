<?php
//header("Refresh: 5;");
error_reporting(E_ALL);
echo include('pChart/pData.class');
echo include('pChart/pChart.class');
echo'<br>';
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
$fp = fopen('test.out', 'w+');
while($thisrow = mysql_fetch_row($result)){
    
    $query_d = 'select * from (select * from cpuinfo where procID=' . $thisrow[0] .' order by cur_timestamp desc limit 6) as tbl order by tbl.cur_timestamp';
    $result_d = mysql_db_query($dbname,$query_d) or die("Failed query: ".$query_d);
    while($thisrow_d = mysql_fetch_row($result_d)){
        $data[$i][$j++] = $thisrow_d[0];
        //print_r($thisrow_d);
        //echo "<br>";
    }
    $j = 0;
    $i++;
    //echo "<br>";
   // $data[$i++] = $thisrow[0];
}

//echo "Done printing table ".$tblname." <br><br><br>";
print_r($data); 
echo '<br>';
mysql_close();

$i = 1;
print_r(sizeof($data));
print_r(sizeof($data[0]));

for($counter = 0; $counter < sizeof($data[0]); $counter++){
    fwrite($fp,$counter+1);
    for($counter1 = 0; $counter1 < sizeof($data); $counter1++){
        fwrite($fp,','.$data[$counter1][$counter]);
    }
    fwrite($fp,"\n");
}

fclose($fp);
//foreach($data as $val){
    $DataSet = new pData;  
    $DataSet->ImportFromCSV("test.out",",",array(1,2),FALSE,0);   
    $DataSet->AddAllSeries();  
    $DataSet->SetAbsciseLabelSerie(); 
    $DataSet->SetSerieName("Core 0","Serie1");
    $DataSet->SetSerieName("Core 1","Serie2");
    //$DataSet->SetSerieName("Sample data3","Serie3");
    $DataSet->SetYAxisName("Percent of CPU");  
    $DataSet->SetYAxisUnit("%"); 
    //$i++;
//}
$Test = new pChart(700,230);  
$Test->setFontProperties("Fonts/tahoma.ttf",8);     
 $Test->setGraphArea(70,30,680,200);     
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);     
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);     
 $Test->drawGraphArea(255,255,255,TRUE); 
 $Test->setFixedScale(0,100);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_MODE_MANUAL,150,150,150,TRUE,0,2);     
 $Test->drawGrid(4,TRUE,230,230,230,50);  

// Draw the 0 line     
 $Test->setFontProperties("Fonts/tahoma.ttf",6);     
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);     
   
 // Draw the line graph  
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());     
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);     
   
 // Finish the graph     
 $Test->setFontProperties("Fonts/tahoma.ttf",8);     
 $Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);     
 $Test->setFontProperties("Fonts/tahoma.ttf",10);     
 $Test->drawTitle(60,22,"CPU Utilization",50,50,50,585);     
 $Test->Render("CPU.png");        
?>