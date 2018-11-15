<?php include_once("../admin/_properties.php");?>
<?php include_once("../admin/_procedures.php"); ?>
<?php session_start(); ?>
<?php
$name=$_POST["name"];$name=str_replace("'","",$name);$name=str_replace(";","",$name);
$email=$_POST["email"];$email=str_replace("'","",$email);$email=str_replace(";","",$email);

$editdate=date('Y-m-d H:i:s');
$createdate=date('Y-m-d H:i:s');
//

//print_r ("name:".($name)."<br>");
//print_r ("email:".($email)."<br>");
//die;


if (strlen($name)>70 ||strlen($email)>70) {$error="Максималниот број на карактери во секое поле е 50";}
else{

				$sql = "select *  FROM newsletter WHERE email='".$email."'";
				$result=mysqli_query($con, $sql);
	            $rowcount=mysqli_num_rows($result);
				//die($sql);
				//print_r ("rowcount:".($rowcount)."<br>");
				
				if ( $rowcount!=0) {$error="Email адресата е веќе внесена во база!";mysqli_free_result($result); }
				else {
					
					                 $sql="INSERT INTO newsletter (
									      pr, 
				                          create_date, 
										  edit_date, 
										  name, 
										  email
										  ) 
				                  VALUES ('',
								          '$createdate', 
										  '$editdate',
										  '$name',
										  '$email')";
											$result=mysqli_query($con, $sql);
											//die($sql);
											$last_id=mysqli_insert_id($con);
											$sql = "UPDATE newsletter SET pr = ".$last_id." WHERE id=".$last_id;
											$result=mysqli_query($con, $sql);
					                        $error="Податоците се успешно внесени. Ви благодариме на довербата!";
					}

}



 $_SESSION["NEWSLETTER_MASSAGE"] = $error;
 $_SESSION["NEWSLETTER_NAME"] = $name;
 $_SESSION["NEWSLETTER_EMAIL"] = $email;
mysqli_close($con) ;
header('Location:_newsletter.php') ;
?> 