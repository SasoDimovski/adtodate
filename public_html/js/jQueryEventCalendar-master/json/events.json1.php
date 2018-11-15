<?php

//==========================================================================================================
//mysqli_connect(host,username,password,dbname,port,socket); 

//host 	    Optional. Specifies a host name or an IP address
//username 	Optional. Specifies the MySQL username
//password 	Optional. Specifies the MySQL password
//dbname 	Optional. Specifies the default database to be used
//port 	    Optional. Specifies the port number to attempt to connect to the MySQL server
//socket 	Optional. Specifies the socket or named pipe to be used
date_default_timezone_set('Europe/Skopje');
$TmpMyAdmin = "http://67.220.183.122/phpmyadmin";
define("host", "localhost");
define("username", "adtodate_user");
define("password", "67220183122");
define("dbname", "adtodate_db");
define("port", "3306");

$con=mysqli_connect(host,username,password,dbname,port);
if (!$con) {
    die('mysqli connection failed: ' . mysql_error() );
}


// Proverka za konekcija so DB
//==========================================================================================================
if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}
//echo 'saso'.password;
$con->query( "SET NAMES 'utf8'");

//header('Content-type: text/json');

//echo 'saso'.$con;
echo '[';
$separator = "";
$days = 20;
$i = 10;
$date = date_create();
//echo date_timestamp_get($date);
//for ($i = 1 ; $i < $days; $i= 1 + $i * 2) {
	//echo $separator;
	$initTime1 = (intval(microtime(true))*1000) + (86400000 * ($i-($days/2)));
	//$initTime = date("Y")."-".date("m")."-".date("d")." ".date("H").":00:00";
	$initTime = date("Y")."-".date("m")."-".date("d");
	$date = new DateTime($initTime);
	$initTime = date_timestamp_get($date);


	
$sql3 = "SELECT *
FROM records
WHERE publish =1 and id_menu=14 
order by
create_date desc, pr desc, id desc 
LIMIT 0 , 50";
$result3=mysqli_query($con, $sql3);
$rowcount3=mysqli_num_rows($result3);
$rowcount4=" / ";
$s=0;
 if ($rowcount3==0){} else {	
					while($row = mysqli_fetch_array($result3, MYSQL_ASSOC)) { 
					$s=$s+1;
					$create_date=$row["create_date"];
					$festival_date=$row["create_date"];
					$edit_date=$row["edit_date"];
					if ($create_date) {
						
						//$create_date=strftime("%d %b %Y", strtotime($create_date));
						$create_date = new DateTime($create_date);
	                    $create_date = date_timestamp_get($create_date);
						
						};
					if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

						echo '	{ "date": "';
						echo $festival_date;
						//echo date("Y-m-d H:i:00",strtotime($initTime)); 
						echo '", "type": "meeting", "title": "';
						echo $row["title"]; 
						echo '", "description": "';
						echo $row["subtitle"];//echo $rowcount4; echo $initTime1; echo $rowcount4;echo $create_date; echo $festival_date;
						echo '", "url": "';
						echo "record.php?mv=14&id="; 
						echo $row["id"];
//echo $s;
						
				   
				   
				    if ($rowcount3==$s) {
						
						//echo '	{ "date": "';echo $initTime; echo '", "type": "meeting", "title": "';echo $row["title"];echo $rowcount3;echo $rowcount4;echo $s; echo '", "description": "';echo $row["subtitle"]; echo '", "url": "';echo "record.php?mv=14&id="; echo $row["id"];echo '" },';
						

						echo '" }';
						
						}
						
						else{
							echo '" },';
							
//echo '	{ "date": "'; echo $initTime+10800000-2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Локација, Држава, Град, Место", "url": "http://www.event11.com/" }';
							
							
							}
							
							
							         }
//echo '	{ "date": "'; echo $initTime+10800000-2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Локација, Држава, Град, Место", "url": "http://www.event11.com/" }';
		
					
					  

        } 

	mysqli_free_result($result2);  
	

	
	$separator = ",";
//}
echo ']';

 
	mysqli_close($con) ;
?>