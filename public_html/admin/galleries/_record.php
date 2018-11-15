<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
date_default_timezone_set('Europe/Skopje');
$ID = $_POST["id"] ;

$query = $_POST["query"] ;
$query= str_replace("&id=".$ID,"",$query);

//=========================================================================== 
//print_r ("ID:".($ID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 


$title=$_POST["title"];
$description=$_POST["description"];
$publish=$_POST["publish"];if ($_POST["publish"]==""){$publish=0;}
	
	
if($ID==""){
	    $date=date('Y-m-d H:i:s');
		$sql="INSERT INTO galleries (pr,
		                             create_date, 
									 edit_date, 
									 title, 
									 description,
									 publish) 
		                     VALUES ('',
							         '$date',
									 '$date',
									 '$title',
									 '$description',
									 '$publish')";
		$result=mysqli_query($con, $sql);
		//die($sql);
		$Last_ID=mysqli_insert_id($con);
		//=========================================================================== 
		//echo "Last_ID: ".$Last_ID."<BR>";
		//=========================================================================== 
		$sql = "UPDATE galleries SET pr = ".$Last_ID." WHERE id=".$Last_ID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
		
	} 
	
	else
	
   {
		$date=date('Y-m-d H:i:s');
		$sql = "UPDATE galleries SET edit_date = '".$date."', 
		                             title = '".$title."', 
									 description = '".$description."', 
									 publish = '".$publish."' 
									 WHERE id=".$ID;
		$Last_ID=$ID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
	}
	
	

	
	
	
mysqli_close($con) ;
header('Location: ModulList.php?'.$query) ;
?>	

