<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$tmpID_gallery = $_GET["id_gallery"] ;
$tmpID_record = $_GET["id_record"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id_gallery=".$tmpID_gallery,"",$query);
$query= str_replace("id_record=","id=",$query);

//if ($date) {$date=date_format(new DateTime($date), 'Y-m-d');}else{$date=NULL;}

//=========================================================================== 
//print_r ("tmpID_gallery:".($tmpID_gallery)."<br>");
//print_r ("tmpID_record:".($tmpID_record)."<br>");
//print_r ("query:".($query)."<br>");

//=========================================================================== 

	
//=====================================================================================================================================
$sql = "DELETE FROM records_gallery WHERE id=".$tmpID_gallery;
//die($sql);
$result=mysqli_query($con, $sql);
   
//=====================================================================================================================================
				


//mysqli_free_result($result);
//if(! $result ){mysqli_free_result($result);}
mysqli_close($con) ;
header('Location: ModulEdit.php?'.$query) ;
 ?>
	
