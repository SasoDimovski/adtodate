<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);



//=========================================================================== 
//print_r ("$tmpID:".($tmpID)."<br>");
//print_r ("$query:".($query)."<br>");
//=========================================================================== 


//=====================================================================================================================================
$sql = "DELETE FROM galleries WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);

			array_map('unlink', glob($TmpUploadFolder."galleries/".$tmpID."/*"));
			
							  if(is_dir($TmpUploadFolder."galleries/".$tmpID))
							  {
							  rmdir($TmpUploadFolder."galleries/".$tmpID);
							  }
			
			//rmdir($TmpUploadFolder."galleries/".$tmpID);
//mysqli_free_result($result);   
//=====================================================================================================================================


//=====================================================================================================================================
$sql = "DELETE FROM records_gallery WHERE id_gallery=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
//mysqli_free_result($result);   
//=====================================================================================================================================


//=====================================================================================================================================
$sql = "DELETE FROM galleries_pictures WHERE id_galleries=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
//mysqli_free_result($result);   
//=====================================================================================================================================



mysqli_close($con) ;
header('Location: ModulList.php?'.$query) ;
?>
