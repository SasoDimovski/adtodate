<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);

echo $query;

$username=$_GET["username"];
$password=$_GET["password"];
$name=$_GET["name"];
$surname=$_GET["surname"];
$group=$_GET["group"];

//=========================================================================== 
print_r ("tmpPage:".($tmpPage)."<br>");
print_r ("tmpID:".($tmpID)."<br>");
//=========================================================================== 


//=====================================================================================================================================
$sql = "Select * FROM users WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];

$create_date=$row["create_date"];
$edit_date=$row["edit_date"];

$username=$row["username"];
$password=$row["password"];

$name=$row["name"];
$surname=$row["surname"];

$group=$row["category"];
$Send=$row["send"];

if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}?>


                            <!--Proverka na validnost na email===========================================================================-->
                            <?php $testEmail = verifyEmail($username, 'contact@brrln.org');
                            if( $testEmail=="invalid") {?>
                                <div class="PopupPopupLine">
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven">
                                <strong style="color: #C00">E-mail addres <?php echo $username?> does not exist, try again !</strong></div></div>
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven"><button class="PopupPoleButton" onClick="history.back()">BACK</button></div></div>
                                </div> 
                            <?php mysqli_free_result($result);mysqli_close($con) ;}else{ ?>
														<?php   $to = $username;
																$subject = "My subject";
																$txt = "Hello ".$name.",\r\n\r\nThanks for registering on the BRRLN website.\r\nA registration was made on BRRLN website using your e-mail address. In order to confirm please go to the following web address http://brrln.org.";
$txt .= ".\r\nIf you need any technical support please contact us on info@abaroli.mk.\r\nWith your entered username and password upon registration, you can access your profile and use the educational platform developed by BRRLN.  Please note that the whole menu will be in English.\r\n\r\n";
																$txt .= "Your Username is:".$username. "\r\n" ."Your Password is:".$password;
																$txt .= "\r\n\r\nSincerely, \r\nBRRLN Team";
																$headers = "From: contact@brrln.org" . "\r\n";
																mail($to,$subject,$txt,$headers);
																$sql1 = "UPDATE users SET send = 1 WHERE id=".$id;
									                            $result1=mysqli_query($con, $sql1);
																mysqli_free_result($result);
																mysqli_close($con) ;
																header('Location: ModulList.php?'.$query) ;
														   }?>
