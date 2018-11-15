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


$sql = "
SELECT records.id, 
       records.pr, 
	   records.create_date, 
	   records.edit_date, 
	   records.title, 
	   records.subtitle,
	   records.intro,
	   records.text,
	   records.picture,
	   records.picture_description,
	   records.id_menu, 
	   records.id_languages,
	   records.id_countries,
	   records.id_workgroups,
	   records.id_courses_categories,
	   _menu.title as _menu_title
FROM records
INNER JOIN _menu ON records.id_menu=_menu.id
WHERE records.id=".$tmpID;

//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];
$createdate=$row["create_date"];
$editdate=$row["edit_date"];
if ($createdate) {$createdate=date_format(new DateTime($createdate), 'd.m.Y H:i:s');}
if ($editdate) {$editdate=date_format(new DateTime($editdate), 'd.m.Y H:i:s');}


$title=$row["title"];
$subtitle=$row["subtitle"];
$text=$row["text"];
$publish=$row["publish"];
$_menu_title=$row["_menu_title"];



   
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
        


	<link type="text/css" href="../css/jquery.simple-dtpicker.css" rel="stylesheet" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <script src="../js/_main.js"></script>
        <script src="../js/ajaxCaller.js"></script>
 <script language="JavaScript">
<!--
function ValidationSubmit()
{
	//alert(document.getElementById('group').value);return false;
if (document.getElementById('title').value=='0')
  {alert('Field "Title" is mandatory!');return false;}

}
function openPopup(id,type,query)
{
    document.getElementById('popup').style.display='block';
    document.getElementById('shader').style.display='block';
	
    if (type=='gallery'){getJSP('../records/_ax_get_galleries.php?'+query+ '&id=' + id, 'popup', null, null, 0);}
	if (type=='documents'){getJSP('../records/_ax_get_documents.php?'+query+ '&id=' + id, 'popup', null, null, 0);}
}
function addGallery(id_gallery, id_record,query) {

if (confirm("Are you sure you want to addd gallery with id:" + id_gallery+'?'))
{
window.location.href = '_record_gallery.php?'+query+'&id_gallery=' + id_gallery + '&id_record=' + id_record;
}
} 
function DeleteGallery(id_gallery, id_record, query) {

if (confirm("Are you sure you want to delete gallery with id:" + id_gallery+'?'))
{
window.location.href = '_delete_gallery.php?'+query+'&id_gallery=' + id_gallery + '&id_record=' + id_record;
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
                    <h1>
                       <?php echo $_menu_title;?> (<small class="fa"><?php echo "ID:".$id.", PR:".$pr;?> </small>)
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
                                        
  
                                       <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" placeholder="title ..." id="title" name="title" value="<?php echo $title ?>" maxlength="500"/>
                                        </div>
                                        
                                       <div class="form-group">
                                            <label>Subtitle</label>
                                            <input type="text" class="form-control" placeholder="subtitle ..." id="subtitle" name="subtitle" value="<?php echo $subtitle ?>" maxlength="500"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Text</label>
                                         <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $text ?></textarea>   
                                        </div>   
                                        <div class="form-group">
                                            <label>Created date</label>
                                            <input type="text" class="form-control" placeholder="Created date ..." id="createdate" name="createdate" readonly style=" cursor:pointer" value="<?php echo $createdate ?>"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Edit date</label>
                                            <input type="text" class="form-control" placeholder="Edit date ..."  id="editdate" name="editdate" readonly  style=" cursor:pointer" value="<?php echo $editdate ?>"/>
                                        </div>
<?php
$allowed = array("8","33");
if (!in_array($_GET["mv"],$allowed)) {
?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
 <?php }?>                                   
                                    
 </div>
  </form>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                                </div><!-- /.box-body -->
                                
                           
                                
                                
                            </div><!-- /.box -->
                            
<!-- MODUL ZA GALERII //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","23","24","25","26","27","28","29","35");
if ($tmpID<>""&&in_array($_GET["mv"],$allowed)) {
?>

<div class="box">

<div class="box-header">
<h3 class="box-title">Galleries <a href="#" onClick="openPopup('<?php echo $tmpID ?>','gallery','<?php echo $query ?>')"> (<small class="fa fa-plus">  </small> add new gallery)</a></h3>
</div><!-- /.box-header -->

<!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php 
//ZAPISI STO SE PRIKAZUVAAT
$sql = "SELECT galleries.id as galleries_id, galleries.title, records_gallery.id as records_gallery_id, records_gallery.pr as records_gallery_pr, records_gallery.create_date as records_gallery_create_date, records_gallery.edit_date as records_gallery_edit_date 
FROM galleries 
INNER JOIN records_gallery 
ON galleries.id=records_gallery.id_gallery 
WHERE records_gallery.id_records=".$tmpID." 
ORDER BY records_gallery.pr DESC";


$result1 = mysqli_query($con, $sql);
if(! $result1 ){die('Could not get data2: ' . mysqli_error());}
//die ($sql);
$rowcount1=mysqli_num_rows($result1);
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php if ($rowcount1==0){?>
    
       
        <div class="box-body">NO RECORDS IN DB !</div>
    
    <?php } else {?>
    <div class="box-body no-padding table-responsive">
        <table class="table table-hover table-striped table-condensed">
      <tr>
        <th width="5%">PR</th>
        <th width="5%">ID(GL)</th>
        <th>Title</th>
        <th width="10%">Create date</th>
        <th width="10%">Edit date</th>
        <th width="5%">delete</th>
      </tr>
    
    
    <?php	
        while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
        $i=$i+1;
        //$date = new DateTime($row["Licenca_datum"]);
        //if ($row["Licenca_datum"]) {$date=date_format(new DateTime($row["Licenca_datum"]), 'd.m.Y');}else{$date=NULL;}
        ?>
    <tr>
        <td width="5%" title="id:<?php  echo $row1["records_gallery_id"]?>"><?php  echo $row1["records_gallery_pr"]?></td>
        <td width="5%"><?php  echo $row1["galleries_id"]?></td>
    
        <td><?php  echo $row1["title"]?></td>
        <td><?php  echo $row1["records_gallery_create_date"]?></td>
        <td><?php  echo $row1["records_gallery_edit_date"]?></td>
            
        <td width="5%"><a class="btn btn-danger btn-xs" onClick="DeleteGallery('<?php echo $row1["records_gallery_id"]?>','<?php echo $tmpID?>','<?php echo ($query)?>')"><i class="fa fa-exclamation-triangle"></i> Delete</a></td>
      
      </tr>
    
    
      
    <?php } ?>
    
    </table></div>
    <?php }?>
    
    <?php mysqli_free_result($result1);?>  
<!-- KRAJ TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                       
                                
</div> 
<?php }?> 
<!--KRAJ MODUL ZA GALERII //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<!-- CK Editor -->
<script src="../js/ckeditor/ckeditor.js" type="text/javascript"></script>        
<!-- Bootstrap WYSIHTML5 -->
<script src="../js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 
   	<script type="text/javascript" src="../js/jquery.simple-dtpicker.js"></script>
 <script type="text/javascript">
$(function() {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'editor1', {

	filebrowserBrowseUrl :'/admin/js/ckeditor/filemanager/browser/default/browser.html?Connector=/admin/js/ckeditor/filemanager/connectors/php/connector.php',
	filebrowserImageBrowseUrl : '/admin/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/js/ckeditor/filemanager/connectors/php/connector.php',
	filebrowserFlashBrowseUrl :'/admin/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/js/ckeditor/filemanager/connectors/php/connector.php',
	filebrowserFileBrowseUrl :'/admin/js/ckeditor/filemanager/browser/default/browser.html?Type=File&Connector=/admin/js/ckeditor/filemanager/connectors/php/connector.php'

});

	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5();
	

	
	
});


</script>
<script type="text/javascript">
            $(function () {
			$('*[name=editdate]').appendDtpicker({dateFormat: "DD.MM.YYYY hh:mm"});
			$('*[name=createdate]').appendDtpicker({dateFormat: "DD.MM.YYYY hh:mm"});
            });
</script>
    </body>
</html>
<?php
 mysqli_free_result($result);
 mysqli_close($con) ;
 
 ?>