<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 

$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);



//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 

$sql = "Select * FROM galleries_pictures WHERE ID=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$file=$row["file"];
$id_galleries=$row["id_galleries"];
//print_r ("file:".($file)."<br>");
mysqli_free_result($result); 

//print_r ($TmpUploadFolder.'galleries/'.$id_galleries.'/'.$file);

if(is_dir($TmpUploadFolder.'galleries/'.$id_galleries.'/'.$file))
{
unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/'.$file);
}
if(is_dir($TmpUploadFolder.'galleries/'.$id_galleries.'/tn1_'.$file))
{
unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/tn1_'.$file);
}							  
if(is_dir($TmpUploadFolder.'galleries/'.$id_galleries.'/tn1_'.$file))
{
unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/tn2_'.$file);
}							  

//unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/'.$file);
//unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/tn1_'.$file);
//unlink($TmpUploadFolder.'galleries/'.$id_galleries.'/tn2_'.$file);

//=====================================================================================================================================
$sql = "DELETE FROM galleries_pictures WHERE ID=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
// mysqli_free_result($result);   
//=====================================================================================================================================

mysqli_close($con) ;
header('Location: ModulEdit.php?'.$query) ;
?>
