<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 


//=====================================================================================================================================
$sql = "Select * FROM newsletter WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$name=$row["name"];
$email=$row["email"];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>::<?php echo $TmpTitle ?>::</title>
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
<!-- jQuery UI -->
<link href="../css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />


<script src="../js/_main.js"></script>
<script src="../js/ajaxCaller.js"></script>






<script language="JavaScript">
<!--
function ValidationSubmit()
{
if (document.getElementById('email').value=='')
  {alert('Field "Email" is mandatory!');return false;}
}

function DeleteRecord(id, description, query) {
//alert (query)

	if (confirm("Are you sure you want to delete this record?\n" + description+"\nID:"+id))
	{
	window.location.href = '_delete_picture.php'+query+'&id=' + id;
	}
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
<div id="shader" class="shader"></div>
<div id="popup" class="popup_center"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   


<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->
                <section class="content-header">
					<?php 
							$sql1 = "Select * FROM _menu WHERE id=".$_GET["mv"];
							//die($sql);
							$result1=mysqli_query($con, $sql1);
							if ($result1){$row1 = mysqli_fetch_array($result1);}
							$title1=$row1["title"];
							mysqli_free_result($result1);
                    ?>
                    <h1><?php echo $title1;?>(<small class="fa"><?php if ($result){echo "ID:".$id.", PR:".$pr;}else{ echo "new";}?> </small>)</h1>
                    <ol class="breadcrumb">
                       <!-- <li><i class="fa fa-user"></i> Activities </li>-->
                        <!--<li class="active">Blank page</li>-->
                    </ol>
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
             
              <div class="col-xs-6">
              
                <form name="form1" method="post" action="_record.php" onSubmit="return ValidationSubmit(this);" enctype="multipart/form-data">
                
                   <input name="id" id="id" type="hidden" value="<?php  echo $tmpID?>" />          
                   <input name="query" id="query" type="hidden" value="?<?php  echo $query?>" /> 
                   

                        
                        <div class="form-group">
                            <label>Име и презиме</label>
                            <input name="name" id="name" type="text" class="form-control" placeholder="Име и презиме..." value="<?php echo htmlspecialchars($name, ENT_COMPAT, 'UTF-8') ?>" maxlength="100"/>
                        </div>
                        <div class="form-group">
                <label>Email</label>
                <input name="email" id="email" type="text" class="form-control" placeholder="Title..." value="<?php echo htmlspecialchars($email, ENT_COMPAT, 'UTF-8') ?>" maxlength="100"/>
                        </div>
      
                        <div class="form-group">
                            <label>Датум на креирање</label>
                            <input type="text" class="form-control" placeholder="Датум на креирање ..." disabled value="<?php echo $create_date ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Датум на едитирање</label>
                            <input type="text" class="form-control" placeholder="Датум на едитирање ..." disabled value="<?php echo $edit_date ?>"/>
                        </div>
                  
                  
                  
                  <button type="submit" class="btn btn-primary">сними</button>

                  
                  
                  <br>
                  <br>
                </form>
                
                
                

                
                

              </div>
<div class="col-xs-6">



</div>
              
              <div class="box-footer"></div>
              
              <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
            </div>
            <!-- /.box-body --> 
            
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content --> 
    
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
    
  </aside>
  <!-- /.right-side --> 
</div>
<!-- ./wrapper --> 



        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/app.js" type="text/javascript"></script>

</body>
</html>
<?php mysqli_close($con) ;?>