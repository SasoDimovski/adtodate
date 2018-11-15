<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);
//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 



//=====================================================================================================================================
$sql = "Select * FROM documents WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result); $edit=true;}

$id=$row["id"];
$pr=$row["pr"];
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$title=$row["title"];
$description=$row["description"];
$file=$row["file"];

$publish=$row["publish"];


if ($document_date) {$document_date=date_format(new DateTime($document_date), 'd.m.Y H:i:s');}
mysqli_free_result($result);
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
		<!-- jQuery UI -->
        <link href="../css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

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
	//alert(document.getElementById('Group').value);return false;
if (document.getElementById('title').value=='')
  {alert('Field "Title" is mandatory!');return false;}

if (document.getElementById('file1').value=='')
  {alert('Field "File" is mandatory!');return false;}
}



function FileName()
{
filename = document.form1.file.value;
tmpfilename = '';
tmpfilename = filename.substring(filename.lastIndexOf('\u005C')+1, filename.length);

tmpExt=tmpfilename.substring(tmpfilename.lastIndexOf('.')+1,tmpfilename.length, tmpfilename.length)
/*if (tmpExt!='jpg'&&tmpExt!='jpeg'&&tmpExt!='JPEG'&&tmpExt!='JPG')
{
	//alert(tmpExt);
alert('You can import only ".jpg" or ".jpeg" format');
document.form1.file1.value='';
return false;
}*/

document.form1.file1.value = tmpfilename;
}
//-->
</script>   

<!--skripti za upload-->
<script type="text/javascript" src="../image_process/jquery.form.js"></script>
<script type="text/javascript" >
$(document).ready(function() {

	$('#file_upload').die('click').live('change', function()			{
			   //$("#preview").html('');

		$("#form1").ajaxForm({target: '#preview',
			 beforeSubmit:function(){


			$("#imageloadstatus").show();
			 $("#imageloadbutton").hide();
			 },
			success:function(){

			 $("#imageloadstatus").hide();
			 $("#imageloadbutton").show();
			},
			error:function(){

			 $("#imageloadstatus").hide();
			$("#imageloadbutton").show();
			} }).submit();
	});
});
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
<!--                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>                                    
                                </div>--><!-- /.box-header -->
           
                      
                                <div class="box-body table-responsive">
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
   <form name="form1" method="post" action="_record.php" onSubmit="return ValidationSubmit(this);" enctype="multipart/form-data"> 
   
   <input name="id" id="id" type="hidden" value="<?php  echo $tmpID?>" />          
   <input name="query" id="query" type="hidden" value="<?php  echo $query?>" />
   <input name="id_menu" id="id_menu" type="hidden" value="<?php  echo $_GET["mv"]?>" /> 
   
    
                       <div class="col-xs-6">
                                       <div class="form-group">
                                       
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"    id="publish" name="publish" value="1"  <?php if ($publish=="1"){echo "checked";}?>/>
                                                   Publish
                                                </label>                                                
                                            </div>
                                            
                                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="title..." id="title" name="title" value="<?php echo $title ?>" maxlength="300"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="3" class="form-control" id="description" placeholder="description..."><?php echo $description ?></textarea>
                        </div>
                        
<!--                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control"   id="id_languages" name="id_languages" >
                            <option value=""></option>
                            <?php
                            $sql="Select * from _languages order by pr asc";
                            $options = mysqli_query($con, $sql);
                            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) {
                                $option_id=$options_row["id"];?>
                                <option value="<?php echo $option_id?>" <?php if ($id_languages==$option_id) {echo "selected";}?>><?php echo $options_row["title"]?></option>
                                <?php } 
                                mysqli_free_result($options);?>
                            </select>
                        </div>
                        -->
                        
            <!--============================================================================================================================-->                
            
            <!--============================================================================================================================-->  
            
            <!--============================================================================================================================-->  
            
            <!--============================================================================================================================-->    
            <!--============================================================================================================================-->  
            
            <!--============================================================================================================================-->     
            
            <!--============================================================================================================================--> 
                    <div class="form-group">
                        <label>Created date</label>
                        <input type="text" class="form-control" placeholder="Created date ..." disabled value="<?php echo $create_date ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label>Edit date</label>
                        <input type="text" class="form-control" placeholder="Edit date ..." disabled value="<?php echo $edit_date ?>"/>
                    </div>           
                                        
                                        
            <div class="form-group">
                <label>File</label>
                <input id="file" name="file" type="file"  OnChange="FileName()">
                <p class="help-block"><input type="text" id="file1" name="file1" class="form-control" placeholder=""  readonly value="<?php echo $file ?>" /></p>   
               <?php if ($file<>"") {?>
                <p class="help-block" id="pic_temp">
				<a href="../../uploads/documents/<?php echo $tmpID ?>/<?php echo $file ?>" target="_blank">
				<?php echo $file ?>
                </a>
                
                </p>
                <?php }?>
            </div>
                                        
                                        
<!--                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" placeholder="document_date..." value="<?php// if ($edit) {echo $document_date;} else {echo date("d.m.Y");} ?>" name="document_date" id="document_date" />
                </div>-->
                                          
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
</div>
  </form>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                                </div><!-- /.box-body -->
                                
                           
                                
                                
                            </div><!-- /.box -->
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
        <script src="../js/jquery-ui.min.js"></script>
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
				$("#document_date").datepicker({
				  dateFormat: "dd.mm.yy"
				});
            });
        </script>

    </body>
</html>
<?php mysqli_close($con) ;?>