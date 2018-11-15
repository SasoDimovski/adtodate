<?php include_once("../../../admin/_properties.php"); ?>
<?php include_once("../../../admin/_procedures.php"); ?>
<?php session_start(); ?>
<?php if (!$_SESSION[$TmpAdminSession] = "yes") {header('Location: /http/');};?>
<?php 

$id = intval($_GET["id"]);

//=====================================================================================================================================
$sql = "select approved from forum where id=".$id;
//echo($sql."<BR>");
$result=mysqli_query($con, $sql);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
$approved=$row["approved"];

mysqli_free_result($result);

if ($approved==1) {$approved=0;} else {$approved=1;}
$sql = "update forum set approved=".$approved." where id=".$id;
//echo($sql."<BR>");
$result=mysqli_query($con, $sql);
confirm_query($result);
if (strlen($link)<=0) {$link=$_SERVER[HTTP_REFERER];}
//echo("link".$link."<BR>");
header('Location: '.$link);
?>
