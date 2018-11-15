<?php include_once("../_properties.php"); ?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php $tmpUser = $_POST["username"] ;?>
<?php $tmpPassword = $_POST["password"] ;?>
<?php //echo ("tmpUser:".$tmpUser."<br>")?>
<?php //echo ("tmpPassword:".$tmpPassword."<br>")?>
<?php if ($tmpUser!=''||$tmpPassword!=''){;?>
<?php 
$result = mysqli_query($con,"SELECT * FROM AdminUsers where User='".$tmpUser."' and Password='".$tmpPassword."'");
//echo ("SELECT * FROM AdminUsers where User='".$tmpUser."' and Password='".$tmpPassword."'"."<br>");
$rowcount=mysqli_num_rows($result);
if ($result){$row = mysqli_fetch_array($result);}
//echo $rowcount;
?>
<?php if ($rowcount!=0) {;?>
<?php  $_SESSION[$TmpAdminSession] = "yes";?>
<?php  $_SESSION["USER"] = $row["User"];?>
<?php  $_SESSION["NAME"] = $row["Name"];?>
<?php  $_SESSION["SURNAME"] = $row["Surname"];?>
<?php  mysqli_close($con);?>
<?php  //echo ("TmpAdminSession:".$_SESSION[$TmpAdminSession]."<br>")?>
<?php header('Location: ../!Main/ModulList.php?mv=8'); ?>
<?php } else {;?>
<?php $tmpError = "yes";?>
<?php mysqli_close($con) ;?>
<?php } ;?>
<?php };?>