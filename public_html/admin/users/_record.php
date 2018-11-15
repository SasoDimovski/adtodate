<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 


$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;


$username=$_POST["username"];
$password=$_POST["password"];
$name=$_POST["name"];
$surname=$_POST["surname"];
$place=$_POST["place"];
$company=$_POST["company"];

$id_countries=$_POST["id_countries"];if ($_POST["id_countries"]==""){$id_countries=0;}
$id_workgroups=$_POST["id_workgroups"];if ($_POST["id_workgroups"]==""){$id_workgroups=0;}
$id_profession=$_POST["id_profession"];if ($_POST["id_profession"]==""){$id_profession=0;}

//$id_workgroups=========================================================================== 
			$sql="Select * from _privileges order by id asc";
			$options = mysqli_query($con, $sql);
			$a=1;
			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
				 {
				  $temp=$_POST["id_privileges".$a];
				  if ($temp<>"") { $id_privileges=$id_privileges.($temp.",");}
				  $a=$a+1;
				 } 
			 $id_privileges=rtrim($id_privileges, ",");
			 if ($id_privileges==""){$id_privileges=0;}
			 mysqli_free_result($options);
//=========================================================================== 
//if ($Licenca_datum) {$Licenca_datum=date_format(new DateTime($Licenca_datum), 'Y-m-d');}else{$Licenca_datum=NULL;}

//=========================================================================== 
//die ("id_privileges:".($id_privileges)."<br>");
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("tmpQuery:".($tmpQuery)."<br>");
//=========================================================================== 
?>

<?php if($tmpID==""){?>

               <!--Proverka na USER===========================================================================-->
                <?php $sqlZ = "SELECT username FROM users where username= '".$username."'";
                //die($sqlZ);
                $resultZ = mysqli_query($con, $sqlZ);
                $rowcountZ=mysqli_num_rows($resultZ);?>
      
                <?php if( $rowcountZ!=0 ) {?>
                    <div class="PopupPopupLine">
                    <div class="PopupLine_0"><div class="PopupTextNaslovGlaven">
                    <strong style="color: #C00">There is user with following username: <?php echo $username?>, try again !</strong></div></div>
                    <div class="PopupLine_0"><div class="PopupTextNaslovGlaven"><button class="PopupPoleButton" onClick="history.back()">BACK</button></div></div>
                    </div> 
                <?php mysqli_close($con) ;}else{?>
                
                            <!--Proverka na validnost na email===========================================================================-->
                            <?php $testEmail = verifyEmail($username, 'contact@brrln.org');
                            if( $testEmail=="invalid") {?>
                                <div class="PopupPopupLine">
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven">
                                <strong style="color: #C00">E-mail addres <?php echo $username?> does not exist, try again !</strong></div></div>
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven"><button class="PopupPoleButton" onClick="history.back()">BACK</button></div></div>
                                </div> 
                            <?php mysqli_free_result($resultZ); mysqli_close($con) ;}else{ ?>
                
          
                                    <!--Nov zapis===========================================================================-->
                                    <?php 
                                    //$Datum=date_format(new DateTime(), 'Y-m-d');
                                    $Date=date('Y-m-d H:i:s');
                                    
                                    $sql="INSERT INTO users (pr,
									                         create_date,
															 edit_date,
															 username,
															 password, 
															 name,
															 surname,
															 place,
															 company,
															 send,
															 id_workgroups,
															 id_profession,
															 id_countries,
															 id_privileges
															 ) 
									                 VALUES ('',
													         '$Date', 
															 '$Date',
															 '$username',
															 '$password',
															 '$name',
															 '$surname',
															 '$place',
															 '$company',
															 '0',
															 '$id_workgroups',
															 '$id_profession',
															 '$id_countries',
															 '$id_privileges')";
                                    $result=mysqli_query($con, $sql);
                                    //die($sql);
                                    $Last_ID=mysqli_insert_id($con);
                                    $sql = "UPDATE users SET pr = ".$Last_ID." WHERE id=".$Last_ID;
                                    $result=mysqli_query($con, $sql);
									mysqli_free_result($result);
                                    mysqli_close($con) ;
                                    header('Location: ModulList.php?'.$tmpQuery) ; ;}}
                                    ?>
    
    
    
<?php }else {?>

               <!--Proverka na USER===========================================================================-->
                <?php $sqlZ = "SELECT username FROM users where username= '".$username."' and id<>".$tmpID;
                //die($sqlZ);
                $resultZ = mysqli_query($con, $sqlZ);
                $rowcountZ=mysqli_num_rows($resultZ);?>
      
                <?php if( $rowcountZ!=0 ) {?>
                    <div class="PopupPopupLine">
                    <div class="PopupLine_0"><div class="PopupTextNaslovGlaven">
                    <strong style="color: #C00">There is user with following username: <?php echo $username?>, try again !</strong></div></div>
                    <div class="PopupLine_0"><div class="PopupTextNaslovGlaven"><button class="PopupPoleButton" onClick="history.back()">BACK</button></div></div>
                    </div> 
                <?php mysqli_free_result($result);mysqli_close($con) ;}else{?>

                            <!--Proverka na validnost na email===========================================================================-->
                            <?php $testEmail = verifyEmail($username, 'contact@brrln.org');
                            if( $testEmail=="invalid") {?>
                                <div class="PopupPopupLine">
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven">
                                <strong style="color: #C00">E-mail addres <?php echo $username?> does not exist, try again !</strong></div></div>
                                <div class="PopupLine_0"><div class="PopupTextNaslovGlaven"><button class="PopupPoleButton" onClick="history.back()">BACK</button></div></div>
                                </div> 
                            <?php mysqli_free_result($result);mysqli_close($con) ; }else {$edit_date=date('Y-m-d H:i:s');
									//print_r ("edit_date:".($edit_date)."<br>");
									$sql = "UPDATE users SET edit_date = '".$edit_date ."', 
									                         name = '".$name."',
															 surname = '".$surname."',
															 place = '".$place."',
															 company = '".$company."',
															 username = '".$username."',
															 password = '".$password."',
															 id_workgroups = ".$id_workgroups.",
															 id_profession = ".$id_profession.",
															 id_countries = ".$id_countries.",
															 id_privileges = '".$id_privileges."' 
															 WHERE id=".$tmpID;
									$result=mysqli_query($con, $sql);
									//die($sql);
									mysqli_free_result($result);
									mysqli_close($con) ;
									header('Location: ModulList.php?'.$tmpQuery)  ;} }?> 
             
             
<?php } ?>
	

