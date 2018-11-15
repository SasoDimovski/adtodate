<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;

$publish=$_POST["publish"];if ($_POST["publish"]==""){$publish=0;}
$title=$_POST["title"];
$description=$_POST["description"];
$link=$_POST["link"];



//if ($Licenca_datum) {$Licenca_datum=date_format(new DateTime($Licenca_datum), 'Y-m-d');}else{$Licenca_datum=NULL;}

//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("tmpQuery:".($tmpQuery)."<br>");
//=========================================================================== 
?>

<?php if($tmpID==""){

				//$Datum=date_format(new DateTime(), 'Y-m-d');
				$Date=date('Y-m-d H:i:s');
				
				$sql="INSERT INTO records_external_links (pr,
										 create_date,
										 edit_date,
										 title,
										 description, 
										 link,
										 publish) 
								 VALUES ('',
										 '$Date', 
										 '$Date',
										 '$title',
										 '$description',
										 '$link',
										 '$publish')";
				$result=mysqli_query($con, $sql);
				//die($sql);
				$Last_ID=mysqli_insert_id($con);
				$sql = "UPDATE records_external_links SET pr = ".$Last_ID." WHERE id=".$Last_ID;
				$result=mysqli_query($con, $sql);


    
    
    
 }else {
								    $edit_date=date('Y-m-d H:i:s');
									//print_r ("edit_date:".($edit_date)."<br>");
									$sql = "UPDATE records_external_links SET edit_date = '".$edit_date ."', 
									                         title = '".$title."',
															 description = '".$description."',
															 link = '".$link."',
															 publish = '".$publish."' 
															 WHERE id=".$tmpID;
									$result=mysqli_query($con, $sql);

             
             
 }
				mysqli_free_result($result);
				mysqli_close($con) ;
				header('Location: ModulList.php?'.$tmpQuery) ;
 ?>
	

