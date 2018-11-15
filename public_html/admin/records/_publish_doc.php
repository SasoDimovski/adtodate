<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_GET["id_doc"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id_doc=".$tmpID,"",$query);




//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 

				$sql = "select id,publish FROM documents WHERE id=".$tmpID;
				$result=mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
	     
				if ($row["publish"]==1){$publish=0;}
				if ($row["publish"]==0){$publish=1;}
				//die($sql);
				//print_r ("publish:".($publish)."<br>");  
				mysqli_free_result($result); 

				$sql = "UPDATE documents SET publish =".$publish." WHERE id=".$tmpID;
				$result=mysqli_query($con, $sql);
				//die($sql);  
				//mysqli_free_result($result); 
//=====================================================================================================================================

   
//=====================================================================================================================================

?>
<?php 
//mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulEdit.php?'.$query) ;
?>
