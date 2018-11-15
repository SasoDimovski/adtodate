<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); date_default_timezone_set('Europe/Skopje');?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php $tmpID = $_POST["id"] ;?>
<?php $tmpQuery = $_POST["query"] ;?>
<?php $title=$_POST["title"];?>
<?php $subtitle=$_POST["subtitle"];?>
<?php $text=$_POST["editor1"];?>
<?php $editdate=$_POST["editdate"];?>
<?php $createdate=$_POST["createdate"];?>
<?php if ($editdate) {$editdate=date_format(new DateTime($editdate), 'Y-m-d H:i:s');}else{$editdate=date('Y-m-d H:i:s');}?>
<?php if ($createdate) {$createdate=date_format(new DateTime($createdate), 'Y-m-d H:i:s');}else{$createdate=date('Y-m-d H:i:s');}?>
<?php $sql = "UPDATE records SET edit_date = '".$editdate."',create_date = '".$createdate."', title = '".$title."', subtitle = '".$subtitle."', text = '".$text."'  WHERE id=".$tmpID;?>
<?php $result=mysqli_query($con, $sql);?>
<?php if(! $result ){mysqli_free_result($result);}?>
<?php mysqli_close($con) ;?>
<?php header('Location: ModulEdit.php?'.$tmpQuery) ;?>