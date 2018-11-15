<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
$ID = $_GET["id"] ;
$ID1 = $_GET["id_pic"] ;
$PR1 = $_GET["pr_pic"] ;
$DIR = $_GET["dir"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id_pic=".$ID1,"",$query);
$query= str_replace("&pr_pic=".$PR1,"",$query);
$query= str_replace("&dir=".$DIR,"",$query);
//=========================================================================== 
print_r ("ID:".($ID)."<br>");
print_r ("ID1:".($ID1)."<br>");
print_r ("PR1:".($PR1)."<br>");
print_r ("DIR:".($DIR)."<br>");
print_r ("query:".($query)."<br>");
//=========================================================================== 

$select=" and id_galleries = ".$ID;

if($DIR=="up"){
	
                $sql="SELECT * FROM galleries_pictures WHERE pr >=".$PR1.$select." order by pr asc LIMIT 2;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                //die($sql);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
						mysqli_data_seek($result,($rowcount-1)); 
						$row = mysqli_fetch_array($result);
						$PR2=$row["pr"];
						$ID2=$row["id"];
													
						$sql = "UPDATE galleries_pictures SET pr = '".$PR2."'  WHERE id=".$ID1;
						$result=mysqli_query($con, $sql);
						mysqli_free_result($result);
						
						$sql = "UPDATE galleries_pictures SET pr = '".$PR1."'  WHERE id=".$ID2;
						$result=mysqli_query($con, $sql);
						mysqli_free_result($result);
				}
				
}

//=========================================================================== 

if($DIR=="down"){
	
                $sql="SELECT * FROM galleries_pictures WHERE pr <= ".$PR1.$select." order by pr desc LIMIT 2;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                //die($sql);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];

						    $sql = "UPDATE galleries_pictures SET pr = '".$PR2."'  WHERE id=".$ID1;
				            $result=mysqli_query($con, $sql);
						    mysqli_free_result($result);
						   
						    $sql = "UPDATE galleries_pictures SET pr = '".$PR1."'  WHERE id=".$ID2;
				            $result=mysqli_query($con, $sql);
						    mysqli_free_result($result);
					}
				
}

//=========================================================================== 

if($DIR=="top"){
	
                $sql="SELECT * FROM galleries_pictures WHERE pr >=".$PR1.$select." order by pr asc;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                echo($rowcount);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];

							$sql="SELECT * FROM galleries_pictures WHERE pr >".$PR1.$select." order by pr asc;";
                            $result=mysqli_query($con, $sql);
									while($row = mysqli_fetch_array($result)) 
											  { 
											  $sql1 = "UPDATE galleries_pictures SET pr = '".($row["pr"]-1)."'  WHERE id=".$row["id"];
											  $resul1t=mysqli_query($con, $sql1);
											  mysqli_free_result($result1);
											 }
							 $sql1 = "UPDATE galleries_pictures SET pr = '".$PR2."'  WHERE id=".$ID1;
							 $resul1t=mysqli_query($con, $sql1);
							 mysqli_free_result($result1);		

				}
}

//=========================================================================== 

if($DIR=="bottom"){
	
                $sql="SELECT * FROM galleries_pictures WHERE pr <= ".$PR1.$select." order by pr desc;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                echo($rowcount);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];
							
							$sql="SELECT * FROM galleries_pictures WHERE pr < ".$PR1.$select." order by pr desc;";
                            $result=mysqli_query($con, $sql);
							while($row = mysqli_fetch_array($result)) 
							          { 
									  $sql1 = "UPDATE galleries_pictures SET pr = '".($row["pr"]+1)."'  WHERE id=".$row["id"];
									  $resul1t=mysqli_query($con, $sql1);
									  mysqli_free_result($result1);
							         }
							 $sql1 = "UPDATE galleries_pictures SET pr = '".$PR2."'  WHERE id=".$ID1;
							 $resul1t=mysqli_query($con, $sql1);
							 mysqli_free_result($result1);		

				}
}

//=========================================================================== 

mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulEdit.php?'.$query) ;
 ?>
	

