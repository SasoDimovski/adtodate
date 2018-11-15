<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php if ($_SESSION["SUPERADMIN"]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 

$tmpID = $_GET["id"] ;
$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);
//=========================================================================== 
//print_r ("tmpPage:".($tmpPage)."<br>");
//print_r ("tmpID:".($tmpID)."<br>");
//=========================================================================== 


//=====================================================================================================================================
$sql = "Select * FROM AdminUsers WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["ID"];


$username=$row["User"];
$password=$row["Password"];

$name=$row["Name"];
$surname=$row["Surname"];
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

//------------------------------------------------------------------------------------------------------  
	
if (document.getElementById('name').value=='')
  {alert('Field "Name" is mandatory!');return false;}
  
if (document.getElementById('surname').value=='')
    {alert('Field "Surname" is mandatory!');return false;}
	
if (document.getElementById('username').value=='')
  {alert('Field "Username" is mandatory!');return false;}
  
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
                        User (<small class="fa"><?php if ($result){echo "id:".$id;}else{ echo "new";}?></small>)
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
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="username ..." id="username" name="username" value="<?php echo $username ?>" maxlength="40"/>
                                        </div>
                           
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Password</label> <a href="#" onClick="randomPassword('password')"> (<small class="fa fa-plus">  </small>)</a>
                                            <input name="password" type="text" class="form-control" id="password" placeholder="password ..." value="<?php if ($result){echo $password;}else{ echo generate_password();}?>" maxlength="40">
                                        </div>
                                        
                                       
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
   
 </div>

  </form>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                                </div><!-- /.box-body -->
                                
                           
                                
                                
                            </div><!-- /.box -->
                            
<!-- MODUL ZA PRIKAZ NA TESTOVI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 


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