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
$sql = "DELETE FROM records WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);

			array_map('unlink', glob($TmpUploadFolder."records/".$tmpID."/*"));
			
			if(is_dir($TmpUploadFolder."records/".$tmpID))
  {
  rmdir($TmpUploadFolder."records/".$tmpID);
  }
			
   
//=====================================================================================================================================

?>
<?php 
//mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulList.php?'.$query) ;
?>
