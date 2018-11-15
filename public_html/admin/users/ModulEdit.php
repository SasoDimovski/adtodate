<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 

$tmpID = $_GET["id"] ;
$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);
//=========================================================================== 
//print_r ("tmpPage:".($tmpPage)."<br>");
//print_r ("tmpID:".($tmpID)."<br>");
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
if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$username=$row["username"];
$password=$row["password"];

$name=$row["name"];
$surname=$row["surname"];
$Send=$row["send"];

$place=$row["place"];
$company=$row["company"];


$id_workgroups=$row["id_workgroups"];
$id_countries=$row["id_countries"];
$id_profession=$row["id_profession"];
$id_privileges=$row["id_privileges"];   
//=====================================================================================================================================
//$date1 = new DateTime($row["Licenca_datum"]);
//date_modify($date1,"+5 years");
?>


<!DOCTYPE html>
<html>

    <head>
    
        <meta charset="UTF-8">
        <title>:: <?php echo $TmpTitle ?> ::</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> 
        
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Local style -->
        <link href="../css/_medium3.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <script src="../js/_main.js"></script>
 <script language="JavaScript">
<!--
function ValidationSubmit()
{
	//alert(document.getElementById('group').value);return false;
//------------------------------------------------------------------------------------------------------ 
a=0;
for(var n = 1; n < document.getElementById('id_privileges_temp').value; n++)
{
if (document.getElementById('id_privileges'+n).checked==true){a=a+1;} 
}
if (a==0)
   {alert('Field "Privileges" is mandatory!');return false;}
//------------------------------------------------------------------------------------------------------  
	
if (document.getElementById('name').value=='')
  {alert('Field "Name" is mandatory!');return false;}
  
if (document.getElementById('surname').value=='')
    {alert('Field "Surname" is mandatory!');return false;}
	
if (document.getElementById('id_countries').value=='0')
  {alert('Field "Country" is mandatory!');return false;}
  
 if (document.getElementById('id_profession').value=='0')
  {alert('Field "Proffesion" is mandatory!');return false;} 
  
//if (document.getElementById('id_workgroups').value=='0')
//  {alert('Field "Workgroup" is mandatory!');return false;}
  


if (document.getElementById('username').value=='')
  {alert('Field "Username (email)" is mandatory!');return false;}
  
if (document.getElementById('password').value=='')
  {alert('Field "Password" is mandatory!');return false;}
}

//-->
</script>   
        
    </head>
    
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once("../_header.php"); ?>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include_once("../_menu.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   


<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->
                <section class="content-header">
                    <h1>
                        User (<small class="fa"><?php if ($result){echo "id:".$id.", pr:".$pr;}else{ echo "new";}?></small>)
                    </h1>
                </section>
<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- Main content -->

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                           
                            
                            <div class="box">
<!--                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>                                    
                                </div>--><!-- /.box-header -->
           
                      
                                <div class="box-body table-responsive">
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
   <form name="form1" method="post" action="_record.php" onSubmit="return ValidationSubmit(this);"> 
   
                                        <input name="id" id="id" type="hidden" value="<?php  echo $tmpID?>" />          
                                        <input name="query" id="query" type="hidden" value="<?php  echo $query?>" />
   										<div class="col-xs-6">
                                        
                                           <div class="form-group"  style="float:left; margin-right:10px">
                                            <label>Privileges</label><br>
                        
                                            <?php
                                            $sql="Select * from _privileges order by pr desc";
                                            $options = mysqli_query($con, $sql);
                                            $a=1;
                                            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                                                {
                                                 $allowed=explode(",",$id_privileges);
                                            ?>
                                                <input type="checkbox" id="id_privileges<?php echo $a?>" name="id_privileges<?php echo $a?>" value="<?php echo $options_row["id"]?>" <?php if (in_array($options_row["id"],$allowed)){echo "checked";}?>/>
                                            <?php 
                                                echo $options_row["title"];
                                                echo "<br>";
                                                $a=$a+1;
                                                } 
                                             mysqli_free_result($options);
                                             ?>
                                          <input type="hidden" id="id_privileges_temp" name="id_privileges_temp" value="<?php echo $a ?>"/>
                                        </div>
                                        
                                        <div style="clear:both"></div>
                                        <div class="form-group">
                                         <strong>Forum</strong> - contribute to forum (enter posts and topics)<br>
                                         <strong>E-learning</strong> - only E-learning can be seen<br>
                                         <strong>WG content</strong> - only WG content can be seen<br>
                                         <strong>Administrator</strong> - everything above + forum moderator<br>
                                        </div>
                                        <div style="clear:both"></div>
                                         <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control" placeholder="name ..." id="name" value="<?php echo $name ?>" maxlength="100"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Surname</label>
                                            <input type="text" class="form-control" placeholder="surname ..." id="surname" name="surname" value="<?php echo $surname ?>" maxlength="100"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Place</label>
                                            <input type="text" class="form-control" placeholder="place ..." id="place" name="place" value="<?php echo $place ?>" maxlength="200"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Company</label>
                                            <input type="text" class="form-control" placeholder="company ..." id="company" name="company" value="<?php echo $company ?>" maxlength="200"/>
                                        </div>

                                        <div class="form-group">
                                        
                                            <label>Country</label>
                                            
                                            <select class="form-control" id="id_countries" name="id_countries" >
                                            <option value="0"></option>
                                            <?php
											$sql="Select * from _countries order by title asc";
		                                    $options = mysqli_query($con, $sql);
                                            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $options_row["id"]?>" <?php if ($id_countries==$options_row["id"]) {echo "selected";}?>><?php echo $options_row["title"]?></option>
                                            <?php }mysqli_free_result($options);?>
                                            </select>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Profession</label>
                                            <select class="form-control" id="id_profession" name="id_profession" >
                                               <option value="0"></option>
                                                <?php
                                                $sql="Select * from _profession order by pr asc";
                                                $options = mysqli_query($con, $sql);
                                                while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) {
                                                ?>
                                                    <option value="<?php echo $options_row["id"]?>" <?php if ($id_profession==$options_row["id"]) {echo "selected";}?>><?php echo $options_row["title"]?></option>
                                                <?php }mysqli_free_result($options);?>
                                            </select> 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Workgroup</label>
                                            <select class="form-control" id="id_workgroups" name="id_workgroups" >
                                               <option value="0"></option>
                                                <?php
                                                $sql="Select * from _workgroups order by pr asc";
                                                $options = mysqli_query($con, $sql);
                                                while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) {
													if($options_row["id"]<>7&&$options_row["id"]<>8) {
                                                ?>
                                                    <option value="<?php echo $options_row["id"]?>" <?php if ($id_workgroups==$options_row["id"]) {echo "selected";}?>><?php echo $options_row["title"]?></option>
                                                <?php }
												}
												mysqli_free_result($options);?>
                                            </select> 
                                        </div>
                                        

                                        

                                        
                                        
                                        </div>
                                        <div class="col-xs-6">
                                       <div class="form-group">
                                            <label>Username (email)</label>
                                            <input type="text" class="form-control" placeholder="username ..." id="username" name="username" value="<?php echo $username ?>" maxlength="40"/>
                                        </div>
                           
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Password</label> <a href="#" onClick="randomPassword('password')"> (<small class="fa fa-plus">  </small>)</a>
                                            <input name="password" type="password" class="form-control" id="password" placeholder="password ..." value="<?php if ($result){echo $password;}else{ echo generate_password();}?>" maxlength="40">
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group">
                                            <label>Created date</label>
                                            <input type="text" class="form-control" placeholder="Created date ..." disabled value="<?php echo $create_date ?>"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Edit date</label>
                                            <input type="text" class="form-control" placeholder="Edit date ..." disabled value="<?php echo $edit_date ?>"/>
                                        </div>
</div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

  </form>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                                </div><!-- /.box-body -->
                                
                           
                                
                                
                            </div><!-- /.box -->
                            
<!-- MODUL ZA PRIKAZ NA TESTOVI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<div class="box">          
    <?php 
	$sql3 = "SELECT *
			FROM courses_tests 
			WHERE id_user=".$tmpID." 
			GROUP BY id_record
			ORDER BY id_record asc";
    //die ($sql);
    
    $result3 = mysqli_query($con, $sql3);
    //if(! $result3 ){die('Could not get data4: ' . mysqli_error());}
    
    $rowcount3=mysqli_num_rows($result3);
	
	while($row3 = mysqli_fetch_array($result3, MYSQL_ASSOC)) { 
	
	
	//echo $row3["id_record"]."<BR>";
	
	
    ?>       
          
                          
                          


                
    <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
    <?php 
    //ZAPISI STO SE PRIKAZUVAAT
	$sql1 = "SELECT attempt,
	                create_date,
					edit_date
			FROM courses_tests 
			WHERE id_user=".$tmpID." 
			AND id_record=".$row3["id_record"]."
			GROUP BY attempt
			ORDER BY attempt asc";
    //die ($sql);
    
    $result1 = mysqli_query($con, $sql1);
    if(! $result1 ){die('Could not get data4: ' . mysqli_error());}
    
    $rowcount1=mysqli_num_rows($result1);
    ?>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    
    
    
    <!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php if ($rowcount1==0){?>
    

    
    <?php } else {?>
        <div class="box-header">
    <h3 class="box-title">Attempt of test <?php  echo $row3["id_record"]?></h3>                 
    </div><!-- /.box-header -->  
    <div class="box-body no-padding table-responsive">
        <table class="table table-hover table-striped table-condensed">
      <tr>
        <th>Attempt</th>
        <th>Correct answers</th>
        <th>Uncorrec answers</th>
        <th>Create date</th>
        <th>Edit date</th>
      </tr>
    
    
    <?php	
        while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
        $d=$d+1;
			$sql2 = "SELECT count(correctly)  FROM courses_tests WHERE id_user=".$tmpID." AND id_record=".$row3["id_record"]." AND correctly=1 AND attempt=".$row1["attempt"];
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_array($result2, MYSQL_NUM );
            $rec_count = $row2[0];
			//die($sql2);
			//print_r ("rec_count:".($rec_count)."<br>");
			mysqli_free_result($result2);
			
			$sql2 = "SELECT count(correctly)  FROM courses_tests WHERE id_user=".$tmpID." AND id_record=".$row3["id_record"]." AND correctly=0 AND attempt=".$row1["attempt"];
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_array($result2, MYSQL_NUM );
            $rec_count1 = $row2[0];
			///print_r ("rec_count1:".($rec_count1)."<br>");
			mysqli_free_result($result2);
    //die ($sql);
   
		

		
        ?>
    <tr>
        <td width="5%"><?php  echo $row1["attempt"]?></td>
        <td><?php  echo $rec_count?></td>
        <td><?php  echo $rec_count1?></td>
        <td><?php  echo $row1["create_date"]?></td>
        <td><?php  echo $row1["edit_date"]?></td>
            
      
      </tr>
    
    
      
    <?php } ?>
    
    </table></div>
    <?php }?>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php mysqli_free_result($result1);?>  
    
    
    
   <?php }?> 
<?php mysqli_free_result($result3);?>  
    
                           
</div>

<!-- KRAJ MODUL ZA DOKUMENTI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                            
                            
                        </div>
                    </div>

                </section><!-- /.content -->
                
                
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>
<?php
 mysqli_free_result($result);
 mysqli_close($con) ;
 
 ?>