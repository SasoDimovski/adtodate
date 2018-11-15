<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;


$publish=$_POST["publish"];if ($_POST["publish"]==""){$publish=0;}
$title=$_POST["title"];$title=str_replace("'","&#39;",$title);
$text=$_POST["editor1"];
$position=$_POST["position"];

$editdate=$_POST["editdate"];
$createdate=$_POST["createdate"];
if ($editdate) {$editdate=date_format(new DateTime($editdate), 'Y-m-d H:i:s');}else{$editdate=date('Y-m-d H:i:s');}
if ($createdate) {$createdate=date_format(new DateTime($createdate), 'Y-m-d H:i:s');}else{$createdate=date('Y-m-d H:i:s');}
//if ($date) {$date=date_format(new DateTime($date), 'Y-m-d');}else{$date=NULL;}

//=========================================================================== 


if($tmpID==""){
	
                //Nov zapis===========================================================================
                $date=date('Y-m-d H:i:s');
                $sql="INSERT INTO baners (pr, 
				                          create_date, 
										  edit_date, 
										  title,  
										  text, 
										  publish,
										  position
										  ) 
				                  VALUES ('',
								          '$createdate', 
										  '$editdate',
										  '$title',
										  '$text',
										  '$publish',
										  '$position')";
                $result=mysqli_query($con, $sql);
                //die($sql);
                $last_id=mysqli_insert_id($con);
                $sql = "UPDATE baners SET pr = ".$last_id." WHERE id=".$last_id;
                $result=mysqli_query($con, $sql);
				//if(! $result ){mysqli_free_result($result);} 
				
}else {	
			
				//Promena zapis===========================================================================				
				$date=date('Y-m-d H:i:s');
				$sql = "UPDATE baners SET  create_date = '".$createdate."',
				                           edit_date = '".$editdate."', 
										   title = '".$title."', 
										   text = '".$text."', 
										   publish = '".$publish."',
										   position = '".$position."'
										   WHERE id=".$tmpID;
				$result=mysqli_query($con, $sql);
				//die($sql);  
				//if(! $result ){mysqli_free_result($result);}   
}





mysqli_close($con) ;
header('Location: ModulList.php?'.$tmpQuery) ;
?>
	

