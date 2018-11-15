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
$sql = "Select * FROM galleries WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$title=$row["title"];
$description=$row["description"];
$publish=$row["publish"];
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


<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadifive.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadifive.css">





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
                    <h1><?php echo $title1;?>(<small class="fa"><?php if ($result){echo "ID:".$id.", PR:".$pr;}else{ echo "new";}?> </small>)
                    </h1>
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
                                           <div class="box-header">
                                    <h3 class="box-title">Gallery tytle: <strong><?php echo $title?></strong></h3>                                    
                                </div><!-- /.box-header -->
            
   
              <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="col-xs-6">
	<form>
      <div class="form-group"  id="queue"></div>
      
      
            <div class="form-group" style="float:left">
				<input id="file_upload" name="file_upload" type="file" multiple style="cursor:pointer">
            </div>
            <div class="form-group" style=" margin-left:70%">
				<a href="javascript:$('#file_upload').uploadifive('upload')" class="btn btn-primary">Upload Files</a>
            </div>
      
	</form>
    
<!--  <form name="form1" method="post" action="uploadifive.php" enctype="multipart/form-data">
<input id="Filedata" name="Filedata" type="file" >
<input name="id" id="id" type="hidden" value="<?php // echo $tmpID?>" /> 
<button type="submit" class="btn btn-primary">внеси</button>
      
	</form>-->


	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadifive({
				'auto'             : false,
				'checkScript'      : 'check-exists.php',
				'formData'         : {
									   'timestamp' : '<?php echo $timestamp;?>',
									   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				                     },
				'queueID'          : 'queue',
				'uploadScript'     : 'uploadifive.php?id=<?php echo $tmpID;?>',
				'onUploadComplete' : function(file, data) { console.log(data); }
			});
		});
	</script>
</div>
      <div class="box-footer">
    <a onclick="window.history.back()" class="btn btn-default">Back</a>
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