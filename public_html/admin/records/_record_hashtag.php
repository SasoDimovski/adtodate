<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$id= $_POST["id"] ;
$id_record= $_POST["id_record"] ;
$mv = $_POST["mv"] ;
$title = $_POST["title"] ;
//print_r ("id:".($id)."<br>");
//print_r ("id_record:".($id_record)."<br>");
//print_r ("title:".($title)."<br>");
//print_r ("mv:".($mv)."<br>");

//$query= str_replace("&id_document=".$tmpID_document,"",$query);
//$query= str_replace("id_record=","id=",$query);

//if ($date) {$date=date_format(new DateTime($date), 'Y-m-d');}else{$date=NULL;}

//=========================================================================== 
//print_r ("tmpID_document:".($tmpID_document)."<br>");
//print_r ("tmpID_record:".($tmpID_record)."<br>");
//print_r ("query:".($query)."<br>");

//=========================================================================== 


	
                //Nov zapis===========================================================================

                //die($sql);
                  //$last_id=mysqli_insert_id($con);
                  $sql = "UPDATE _workgroups SET title = '".$title."' WHERE id=".$id_record;
				  //die($sql);
                 $result=mysqli_query($con, $sql);
				


//mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulEdit.php?mv='.$mv."&id=".$id) ;
?>
	

