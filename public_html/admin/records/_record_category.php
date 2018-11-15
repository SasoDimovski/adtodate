<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$tmpID = $_GET["id"] ;
$tmpID_menu = $_GET["id_menu"] ;

//$query = urldecode($_SERVER['QUERY_STRING']);
//$query= str_replace("&id_gallery=".$tmpID_gallery,"",$query);
//$query= str_replace("id_record=","id=",$query);

//if ($date) {$date=date_format(new DateTime($date), 'Y-m-d');}else{$date=NULL;}

//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("tmpID_menu:".($tmpID_menu)."<br>");
//die;

//=========================================================================== 

                
                $last_id=mysqli_insert_id($con);
                $sql = "UPDATE records SET id_menu = ".$tmpID_menu." WHERE id=".$tmpID;
                $result=mysqli_query($con, $sql);
				


//mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulList.php?mv='.$tmpID_menu) ;
 ?>
	

