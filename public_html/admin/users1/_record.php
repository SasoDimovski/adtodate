<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php if ($_SESSION["SUPERADMIN"]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;


$username=$_POST["username"];
$password=$_POST["password"];
$name=$_POST["name"];
$surname=$_POST["surname"];


//$id_workgroups=========================================================================== 

//=========================================================================== 
//if ($Licenca_datum) {$Licenca_datum=date_format(new DateTime($Licenca_datum), 'Y-m-d');}else{$Licenca_datum=NULL;}

//=========================================================================== 
//die ("id_privileges:".($id_privileges)."<br>");
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("tmpQuery:".($tmpQuery)."<br>");
//=========================================================================== 
?>

<?php if($tmpID==""){?>
                                    <!--Nov zapis===========================================================================-->
                                    <?php 
                                    $sql="INSERT INTO AdminUsers (User,
															 Password, 
															 Name,
															 Surname
															 ) 
									                 VALUES (
															 '$username',
															 '$password',
															 '$name',
															 '$surname')";
													//die($sql);		 
															 
								$result=mysqli_query($con, $sql);

 }else {

									$sql = "UPDATE AdminUsers SET 
									                         Name = '".$name."',
															 Surname = '".$surname."',
															 User = '".$username."',
															 Password = '".$password."'
															 WHERE ID=".$tmpID;
															 //die($sql);
									$result=mysqli_query($con, $sql);
} 


mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulList.php?'.$tmpQuery)  ;

?>
	

