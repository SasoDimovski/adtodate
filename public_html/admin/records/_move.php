<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
$ID1 = $_GET["id"] ;
$PR1 = $_GET["pr"] ;

$tmpPage = $_GET["page"] ;
$tmpMV = $_GET["mv"] ;
$tmpDir = $_GET["dir"] ;

$tmpSearch= $_GET["search1"];

//=========================================================================== 
print_r ("ID1:".($ID1)."<br>");
print_r ("PR1:".($PR1)."<br>");
print_r ("tmpMV:".($tmpMV)."<br>");
print_r ("tmpPage:".($tmpPage)."<br>");
print_r ("tmpDir:".($tmpDir)."<br>");
print_r ("tmpSearch:".($tmpSearch)."<br>");
//=========================================================================== 


//if ($tmpSearch<>"") { $search ="&search1=".$tmpSearch;$select=" and category = ".$tmpSearch;};
$select=" and id_menu = ".$tmpMV;


$query ="?mv=".$tmpMV;
if ($tmpPage<>""){$query =$query."&page=".$tmpPage;}
if ($search<>""){$query =$query.$search;}

if($tmpDir=="up"){
	
                $sql="SELECT * FROM records WHERE pr >=".$PR1.$select." order by pr asc LIMIT 2;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                //die($sql);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
						mysqli_data_seek($result,($rowcount-1)); 
						$row = mysqli_fetch_array($result);
						$PR2=$row["pr"];
						$ID2=$row["id"];
													
						$sql = "UPDATE records SET pr = '".$PR2."'  WHERE id=".$ID1;
						$result=mysqli_query($con, $sql);
						mysqli_free_result($result);
						
						$sql = "UPDATE records SET pr = '".$PR1."'  WHERE id=".$ID2;
						$result=mysqli_query($con, $sql);
						mysqli_free_result($result);
				}
				
}

//=========================================================================== 

if($tmpDir=="down"){
	
                $sql="SELECT * FROM records WHERE pr <= ".$PR1.$select." order by pr desc LIMIT 2;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                //die($sql);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];

						    $sql = "UPDATE records SET pr = '".$PR2."'  WHERE id=".$ID1;
				            $result=mysqli_query($con, $sql);
						    mysqli_free_result($result);
						   
						    $sql = "UPDATE records SET pr = '".$PR1."'  WHERE id=".$ID2;
				            $result=mysqli_query($con, $sql);
						    mysqli_free_result($result);
					}
				
}

//=========================================================================== 

if($tmpDir=="top"){
	
                $sql="SELECT * FROM records WHERE pr >=".$PR1.$select." order by pr asc;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                echo($rowcount);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];

							$sql="SELECT * FROM records WHERE pr >".$PR1.$select." order by pr asc;";
                            $result=mysqli_query($con, $sql);
									while($row = mysqli_fetch_array($result)) 
											  { 
											  $sql1 = "UPDATE records SET pr = '".($row["pr"]-1)."'  WHERE id=".$row["id"];
											  $resul1t=mysqli_query($con, $sql1);
											  mysqli_free_result($result1);
											 }
							 $sql1 = "UPDATE records SET pr = '".$PR2."'  WHERE id=".$ID1;
							 $resul1t=mysqli_query($con, $sql1);
							 mysqli_free_result($result1);		

				}
}

//=========================================================================== 

if($tmpDir=="bottom"){
	
                $sql="SELECT * FROM records WHERE pr <= ".$PR1.$select." order by pr desc;";
                $result=mysqli_query($con, $sql);
				$rowcount=mysqli_num_rows($result);
                echo($rowcount);
				if ($rowcount <> 0 and $rowcount >= 2)
				{
							mysqli_data_seek($result,($rowcount-1)); 
							$row = mysqli_fetch_array($result);
							$PR2=$row["pr"];
							$ID2=$row["id"];
							//=========================================================================== 
							//echo "<br>";
							//echo "PR1:".($PR1)."<br>";
							//echo "ID1:".($ID1)."<br>";
							//=========================================================================== 
							//=========================================================================== 
							//echo "<br>";
							//echo "PR2:".($PR2)."<br>";
							//echo "ID2:".($ID2)."<br>";
							//=========================================================================== 
							
							$sql="SELECT * FROM records WHERE pr < ".$PR1.$select." order by pr desc;";
                            $result=mysqli_query($con, $sql);
							while($row = mysqli_fetch_array($result)) 
							          { 
									  $sql1 = "UPDATE records SET pr = '".($row["pr"]+1)."'  WHERE id=".$row["id"];
									  $resul1t=mysqli_query($con, $sql1);
									  mysqli_free_result($result1);
							         }
							 $sql1 = "UPDATE records SET pr = '".$PR2."'  WHERE id=".$ID1;
							 $resul1t=mysqli_query($con, $sql1);
							 mysqli_free_result($result1);		

				}
}

//=========================================================================== 

mysqli_free_result($result);
mysqli_close($con) ;
header('Location: ModulList.php'.$query) ;
 ?>
	

