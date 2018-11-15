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


$name=$_POST["name"];
$email=$_POST["email"];
	//print_r ("description_mk:".($description_mk)."<br>");
	
if($ID==""){
	    $date=date('Y-m-d H:i:s');
		$sql="INSERT INTO newsletter (pr,
		                             create_date, 
									 edit_date, 
									 name, 
									 email
									 ) 
		                     VALUES ('',
							         '$date',
									 '$date',
									 '$name',
									 '$email')";
		$result=mysqli_query($con, $sql);
		//die($sql);
		$Last_ID=mysqli_insert_id($con);
		//=========================================================================== 
		//echo "Last_ID: ".$Last_ID."<BR>";
		//=========================================================================== 
		$sql = "UPDATE newsletter SET pr = ".$Last_ID." WHERE id=".$Last_ID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
		
	} 
	
	else
	
   {
		$date=date('Y-m-d H:i:s');
		$sql = "UPDATE newsletter SET edit_date = '".$date."', 
		                             name = '".$name."', 
									 email = '".$email."'
									 WHERE id=".$ID;
		$Last_ID=$ID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
	}
	
	

	
	
	
mysqli_close($con) ;
header('Location: ModulList.php'.$query) ;
?>	

