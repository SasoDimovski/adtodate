<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 

$ID = $_POST["picture_id"] ;
$description=$_POST["description"];
$query = $_POST["query"] ;

//=========================================================================== 
//print_r ("ID:".($ID)."<br>");
//print_r ("description:".($description)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 


		$sql = "UPDATE galleries_pictures SET description = '".$description."' WHERE ID=".$ID;
		//die($sql);
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
		//mysqli_close($con) ;

mysqli_close($con) ;
header('Location: ModulEdit.php?'.$query) ;?>