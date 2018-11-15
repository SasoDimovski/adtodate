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
$sql = "Select * FROM records WHERE id=".$tmpID;
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
$subtitle=$row["subtitle"];
$intro=$row["intro"];
$text=$row["text"];
$picture=$row["picture"];
$picture_description=$row["picture_description"];

$id_menu=$row["id_menu"];
$id_languages=$row["id_languages"];
$id_countries=$row["id_countries"];
$id_workgroups=$row["id_workgroups"];
$id_courses_categories=$row["id_courses_categories"];
$publish=$row["publish"];
$main=$row["main"];
$cover=$row["cover"];
$editor=$row["editor"];
$reporter=$row["reporter"];
$publish_intro=$row["publish_intro"];
$comment=$row["comment"];
//=====================================================================================================================================
//print_r ("title:".($title)."<br>");
//print_r ("publish:".($publish)."<br>");
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
	<link type="text/css" href="../css/jquery.simple-dtpicker.css" rel="stylesheet" />
    <link type="text/css" href="../css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
    

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



function ValidationSubmit(submit_type)
{
if (submit_type==1&&document.getElementById('hashtag').value.trim()==''){return false;}
	//alert(document.getElementById('Group').value);return false;
if (document.getElementById('title').value==''){alert('Field "Title" is mandatory!');return false;}
  
//alert(submit_type);	return false; 
  
if (document.getElementById('id_courses_categories')!=null)
{
	if (document.getElementById('id_courses_categories').value==''){alert('Field "Type" is mandatory!');return false;}
}
	 

if (submit_type==1){document.getElementById('submit_type').value='1';document.getElementById("form1").submit();}
  
  
  }
//------------------------------------------------------------------------------------------------------  
//a=0;
//for(var n = 1; n < document.getElementById('id_languages_temp').value; n++)
//{
//if (document.getElementById('id_languages'+n).checked==true){a=a+1;} 
//}
//if (a==0)
//   {alert('Field "Language" is mandatory!');return false;}
////------------------------------------------------------------------------------------------------------  
//a=0;
//for(var n = 1; n < document.getElementById('id_countries_temp').value; n++)
//{
//if (document.getElementById('id_countries'+n).checked==true){a=a+1;} 
//}
//if (a==0)
//   {alert('Field "Country" is mandatory!');return false;}
////------------------------------------------------------------------------------------------------------ 
//a=0;
//for(var n = 1; n < document.getElementById('id_workgroups_temp').value; n++)
//{
//if (document.getElementById('id_workgroups'+n).checked==true){a=a+1;} 
//}
//if (a==0)
//   {alert('Field "Workgroups" is mandatory!');return false;}
//------------------------------------------------------------------------------------------------------   


function deletePic()
{

document.getElementById('file').value=''
document.getElementById('picture').value=''
document.getElementById('pic_temp').innerHTML=''
document.getElementById('picture_description').value=''
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

document.form1.picture.value = tmpfilename;
}

function openPopup(id,type,query)
{
    document.getElementById('popup').style.display='block';
    document.getElementById('shader').style.display='block';
	
    if (type=='gallery'){getJSP('../records/_ax_get_galleries.php?'+query+ '&id=' + id, 'popup', null, null, 0);}
	if (type=='documents'){getJSP('../records/_ax_get_documents.php?'+query+ '&id=' + id, 'popup', null, null, 0);}
}

function openPopupTest(id)
{
    document.getElementById('popup').style.display='block';
    document.getElementById('shader').style.display='block';
	
    getJSP('../records/_ax_get_test.php?id=' + id, 'popup', null, null, 0);

}
function recPopupTest(id)
{
    question=document.getElementById('question_t').value;
    //alert(id);
	//alert(question);
	if (document.getElementById('question_t').value=='')
  {alert('Field "Question" is mandatory!');return false;}
    getJSP('../records/_ax_get_test_rec.php?id=' + id+'&question='+question, 'popup', null, null, 0);

}
function recPopupTest_answer(id,id_question)
{
	
		//alert(question);
	if (document.getElementById('answer_t'+id_question).value=='')
       {alert('Field "Answer" is mandatory!');return false;}
	   
    answer=document.getElementById('answer_t'+id_question).value;
	check=document.getElementById('check_t'+id_question).checked;
    getJSP('../records/_ax_get_test_rec_answer.php?id='+id+'&id_question='+id_question+'&answer='+answer+'&check='+check, 'popup', null, null, 0);

}

function DeleteQuestion(id_question,id_record,title)
{
	if (confirm("Are you sure you want to delete this record?\n" + title+"\nID:"+id_question))
	{
	 getJSP('../records/_ax_get_test_delete_question.php?id_question='+id_question+'&id_record='+id_record, 'popup', null, null, 0);
	}
}

function DeleteAnswer(id_answer,id_record,title)
{
	if (confirm("Are you sure you want to delete this record?\n" + title+"\nID:"+id_answer))
	{
	 getJSP('../records/_ax_get_test_delete_answer.php?id_answer='+id_answer+'&id_record='+id_record, 'popup', null, null, 0);
	}
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




function addDocument(id_document, id_record, query) {

if (confirm("Are you sure you want to add document with id:" + id_document+'?'))
{
window.location.href = '_record_document.php?'+query+'&id_document=' + id_document + '&id_record=' + id_record;
}
} 
function DeleteDocument(id_document, id_record, query) {

if (confirm("Are you sure you want to delete document with id:" + id_document+'?'))
{
window.location.href = '_delete_documents.php?'+query+'&id_document=' + id_document + '&id_record=' + id_record;
}
} 

function openPopup1(id_record,id,mv)
{
    document.getElementById('popup').style.display='block';
    document.getElementById('shader').style.display='block';
	
    getJSP('../records/_ax_change_hashtag.php?mv='+mv+ '&id=' + id+ '&id_record=' + id_record, 'popup', null, null, 0);

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
   <form name="form1" id="form1" method="post" action="_record.php" onSubmit="return ValidationSubmit('0');" enctype="multipart/form-data">
   
   <input name="id" id="id" type="hidden" value="<?php  echo $tmpID?>" />          
   <input name="query" id="query" type="hidden" value="<?php  echo $query?>" />
   <input name="id_menu" id="id_menu" type="hidden" value="<?php  echo $_GET["mv"]?>" />
   <input name="submit_type" id="submit_type" type="hidden" value="0" />  
   
<div class="col-xs-6"><!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group" style="float:left; margin-right:20px">
                                            <div class="checkbox">
                                                <label>Publish
                                                    <input type="checkbox"    id="publish" name="publish" value="1"  <?php if ($publish=="1"){echo "checked";} elseif ($publish=="0") {} else {echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>


<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group" style="float:left; margin-right:20px">
                                            <div class="checkbox">
                                                <label>Comments
                                                    <input type="checkbox" id="comment" name="comment" value="1"  <?php if ($comment=="1"){echo "checked";} elseif ($comment=="0") {} else {echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>

<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group" style="float:left; margin-right:20px">
                                            <div class="checkbox">
                                                <label>Main
                                                    <input type="checkbox"    id="main" name="main" value="1"  <?php if ($main=="1"){echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group" style="float:left; margin-right:20px">
                                            <div class="checkbox">
                                                <label>on index page
                                                    <input type="checkbox"    id="cover" name="cover" value="1"  <?php if ($cover=="1"){echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group">
                                            <div class="checkbox">
                                                <label>RSS
                                                    <input type="checkbox" id="editor" name="editor" value="1"  <?php if ($editor=="1"){echo "checked";} elseif ($editor=="0") {} else {echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>
<?php 
$allowed = array("1");
if(in_array($_GET["mv"],$allowed)) {
?>                                   
                  <div class="form-group"  style="float:left; margin-right:10px">
                    <label>Language</label><br>

                    <?php
                    $sql="Select * from _languages order by pr asc";
                    $options = mysqli_query($con, $sql);
                    $a=1;
                    while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                        {
                         $allowed=explode(",",$id_languages);
                    ?>
                        <input type="checkbox" id="id_languages<?php echo $a?>" name="id_languages<?php echo $a?>" value="<?php echo $options_row["id"]?>" <?php if (in_array($options_row["id"],$allowed)){echo "checked";}?>/>
                    <?php 
                        echo $options_row["title"];
                        echo "<br>";
                        $a=$a+1;
                        } 
                     mysqli_free_result($options);
                     ?>
                  <input type="hidden" id="id_languages_temp" name="id_languages_temp" value="<?php echo $a ?>"/>
                </div>
 
<?php }?>
<?php 
$allowed = array("1");
if(in_array($_GET["mv"],$allowed)) {
?> 
                  <div class="form-group"  style="float:left; margin-right:10px">
                    <label>Country</label><br>

                    <?php
                    $sql="Select * from _countries order by pr asc";
                    $options = mysqli_query($con, $sql);
                    $a=1;
                    while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                        {
                         $allowed=explode(",",$id_countries);
                    ?>
                        <input type="checkbox" id="id_countries<?php echo $a?>" name="id_countries<?php echo $a?>" value="<?php echo $options_row["id"]?>" <?php if (in_array($options_row["id"],$allowed)){echo "checked";}?>/>
                    <?php 
                        echo $options_row["title"];
                        echo "<br>";
                        $a=$a+1;
                        } 
                     mysqli_free_result($options);
                     ?>
                  <input type="hidden" id="id_countries_temp" name="id_countries_temp" value="<?php echo $a ?>"/>
                </div>
<?php }?>


<div style="clear:both"> </div>









<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>                                     
                                                    
             <div class="form-group">
             
                <label>Title</label>
                <input name="title" id="title" type="text" class="form-control" placeholder="Title..." value="<?php echo htmlspecialchars($title, ENT_COMPAT, 'UTF-8') ?>" maxlength="100"/>
            </div>
<?php }?>




<?php 
$allowed = array("1","10");
if(in_array($_GET["mv"],$allowed)) {
?>                                     
                                                    
             <div class="form-group">
             
                <label>Name & Surname</label>
                <input name="reporter" id="reporter" type="text" class="form-control" placeholder="Name & Surname..." value="<?php echo htmlspecialchars($reporter, ENT_COMPAT, 'UTF-8') ?>" maxlength="100"/>
            </div>
<?php }?>

<?php 
$allowed = array("1","10","14");
if(in_array($_GET["mv"],$allowed)) {
?> 
            <div class="form-group">
<?php if ($_GET["mv"]=="10"){ $Subtitle_lable="Company"; }?>
<?php if ($_GET["mv"]=="14"){ $Subtitle_lable="Location, Country, City, Town"; }?>                
                <label><?php echo $Subtitle_lable;?></label>
                <input name="subtitle" id="subtitle" type="text" class="form-control" placeholder="<?php echo $Subtitle_lable;?>" value="<?php echo htmlspecialchars($subtitle, ENT_COMPAT, 'UTF-8') ?>" maxlength="500"/>
            </div>
<?php }?>


<?php 
$allowed = array("1","14");
if(in_array($_GET["mv"],$allowed)) {
?> 
            <div class="form-group">
                <label>Type</label>
                      <select class="form-control" name="id_courses_categories" id="id_courses_categories">
                      <option value=""></option>
                        <option value="2" <?php if ($id_courses_categories==2) {echo "selected";}?>>Локален</option>
                        <option value="3" <?php if ($id_courses_categories==3) {echo "selected";}?>>Регионален</option>
                        <option value="4" <?php if ($id_courses_categories==4) {echo "selected";}?>>Светски</option>
            </select>
            </div>
<?php }?>



<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?> 
            <div class="form-group">
                <label>Intro</label>
                <textarea name="intro" id="intro" class="form-control" rows="3" placeholder="Intro..."  maxlength="250"><?php echo $intro ?></textarea>
            </div>
<?php }?>

<?php 
$allowed = array("1");
if(in_array($_GET["mv"],$allowed)) {
?>  
                                  <div class="form-group" style="float:left; margin-right:20px">
                                            <div class="checkbox">
                                                <label>Publish intro
                                                    <input type="checkbox"    id="publish_intro" name="publish_intro" value="1"  <?php if ($publish_intro=="1"){echo "checked";}?>/>
                                                   
                                                </label>                                                
                                            </div>
                                        </div>                                  
<?php }?>

<div style="clear:both"></div>



        <div class="form-group">
            <label>Create date</label>
            <input type="text" class="form-control" placeholder="Created date..." id="createdate" name="createdate" readonly style=" cursor:pointer" value="<?php echo $create_date ?>"/>
        </div>
        
        <div class="form-group">
            <label>Edit date</label>
            <input type="text" class="form-control" placeholder="Edit date..."  id="editdate" name="editdate" readonly  style=" cursor:pointer" value="<?php if ($_GET["id"]!='') {echo $edit_date;} ?>"/>
        </div>
        
        
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?> 
            <div class="form-group">
                    <div class="ui-widget">
                        <label for="hashtag">Hashtag: </label>
                        <input id="hashtag" name="hashtag"/>
                        <button type="button" class="btn btn-primary btn-xs" onClick="ValidationSubmit('1');">add</button> 
                    </div>
           
                    <?php
                    $sql="Select * from _workgroups order by pr desc";
                    $options = mysqli_query($con, $sql);
                    $a=1;
                    while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
					
                        {if($options_row["id"]<>0) {
                        $allowed=explode(",",$id_workgroups);
						
						if (in_array($options_row["id"],$allowed)){
                    ?>
                        <div style=" float:left">
                        
                            <input type="checkbox" 
                            id="id_workgroups<?php echo $a?>" 
                            name="id_workgroups<?php echo $a?>" 
                            value="<?php echo $options_row["id"]?>" 
                            <?php if (in_array($options_row["id"],$allowed)){echo "checked";}?>/>
                            
                            <a href="#" 
                            onClick="openPopup1('<?php echo $options_row["id"] ?>','<?php echo $tmpID ?>','<?php echo $_GET["mv"] ?>')">
                            <?php echo $options_row["title"];?>&nbsp;&nbsp;&nbsp;
                            </a>
                        
                        
                        </div>
                    
                        <?php //echo "<br>";echo "&nbsp;&nbsp;&nbsp;"; ?>
                        
                        
                        <?php $a=$a+1;
                        } }}
                     mysqli_free_result($options);
                     ?> 
                     
            </div>
<?php }?>
        
        


                                           

</div><!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                                        
                                        
                                        
<div class="col-xs-6"><!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>                                   
            <div class="form-group">
                <label>Photo</label>
                <input id="file" name="file" type="file"  OnChange="FileName()">
                <p class="help-block"><input type="text" id="picture" name="picture" class="form-control" placeholder=""  readonly value="<?php echo $picture ?>" /></p>   
               <?php if ($picture<>"") {?>
                <p class="help-block"><a href="#" onClick="deletePic()">delete picture</a></p>

                <p class="help-block" id="pic_temp"><img src="../../uploads/records/<?php echo $id ?>/tn2_<?php echo $picture ?>"></p>
                
                
                <?php }?>
            </div>
<?php }?>
            
            
            
            
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?>        
            <div class="form-group">
                <label>Description to photo</label>
                <input name="picture_description" id="picture_description" type="text" class="form-control" placeholder="Picture description..." value="<?php echo $picture_description ?>" maxlength="500"/>
            </div>
<?php }?>                                    

<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)&&$tmpID<>"") {
?> 

             <div class="form-group">
                     <p class="help-block"><a href="../../mk/record.php?mv=<?php echo $id_menu ?>&id=<?php echo $id ?>&preview=mvcv6sn76354dk76er912y56t4" target="_blank">preview</a></p>
            </div>
<?php }?>      
                                      
</div><!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="col-xs-10">
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?> 
<div style="clear:both; height:20px"></div>
            <div class="form-group">
                <label>Text</label>
             <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $text ?></textarea>   
            </div>  
<?php }?> 
<div style="clear:both; height:20px"></div>
<?php 
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","17","18","19","20","21","22","24","26","27","28","29");
if(in_array($_GET["mv"],$allowed)) {
?> 
             <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>  
                </div>   
               
                
<?php }?>
<div style="clear:both"></div>

</div>
</form>
  
  
<?php
$allowed = array("18");
if ($tmpID<>""&&in_array($_GET["mv"],$allowed)) {
?>
  <!--<button type="button" class="btn btn-primary" onClick="openPopupTest('<?php echo $tmpID?>')">test</button>-->
<?php }?>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
</div>


</div><!-- /.box -->




<!-- MODUL ZA GALERII //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","17","18","19","20","21","22","24","26","27","28","29");
if ($tmpID<>""&&in_array($_GET["mv"],$allowed)) {
?>

<div class="box">

<div class="box-header">
<h3 class="box-title">Galleries <a href="#" onClick="openPopup('<?php echo $tmpID ?>','gallery','<?php echo $query ?>')"> (<small class="fa fa-plus">  </small> add new gallery)</a></h3>
</div><!-- /.box-header -->

<!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php 
//ZAPISI STO SE PRIKAZUVAAT
$sql = "SELECT 
galleries.id as galleries_id, 
galleries.title, 
galleries.publish,
records_gallery.id as records_gallery_id, 
records_gallery.pr as records_gallery_pr, 
records_gallery.create_date as records_gallery_create_date, 
records_gallery.edit_date as records_gallery_edit_date 
FROM galleries 
INNER JOIN records_gallery 
ON galleries.id=records_gallery.id_gallery 
WHERE records_gallery.id_records=".$tmpID." 
ORDER BY records_gallery.pr DESC";

//die ($sql);
$result1 = mysqli_query($con, $sql);
if(! $result1 ){die('Could not get data2: ' . mysqli_error());}

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
        <th width="5%">Publish</th>
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
        <td>
		<?php  if ($row1["publish"]==1) {?>
             <a href="_publish_gall.php?<?php echo ($query)?>&id=<?php echo $tmpID?>&id_gall=<?php echo $row1["galleries_id"]?>" class="btn btn-danger btn-xs" ><i class="fa fa-check"></i></a>
			<?php } else {?>
             <a href="_publish_gall.php?<?php echo ($query)?>&id=<?php echo $tmpID?>&id_gall=<?php echo $row1["galleries_id"]?>" class="btn btn-danger btn-xs" > <span class="warning"><i class="fa fa-warning"></i>no </span></a>
				<?php }?>
         </td>  
            
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



 
<!-- MODUL ZA DOKUMENTI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php
$allowed = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","16","17","18","19","20","21","22","23","24","25","26","27");
if ($tmpID<>""&&in_array($_GET["mv"],$allowed)) {
?>                       
<div class="box">

    <div class="box-header">
    <h3 class="box-title">Documents<a href="#" onClick="openPopup('<?php echo $tmpID ?>','documents','<?php echo $query ?>')"> (<small class="fa fa-plus"></small>add new document)</a></h3>                 
    </div><!-- /.box-header -->           
                
    <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
    <?php 
    //ZAPISI STO SE PRIKAZUVAAT
    $sql = "SELECT documents.id as documents_id, 
	               documents.description, 
				   documents.title,
				   documents.file, 
				   documents.publish,
				   records_documents.id as records_documents_id, 
				   records_documents.pr as records_documents_pr, 
				   records_documents.create_date as records_documents_create_date, 
				   records_documents.edit_date as records_documents_edit_date 
		
    FROM documents 
    INNER JOIN records_documents 
    ON documents.id=records_documents.id_documents 
    WHERE records_documents.id_records=".$tmpID." 
    ORDER BY records_documents.id DESC";
    //die ($sql);
    
    $result1 = mysqli_query($con, $sql);
    if(! $result1 ){die('Could not get data3: ' . mysqli_error());}
    
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
        <th width="5%">ID(DOC)</th>
        <th>Title</th>
        <th>File</th>
        <th width="10%">Create date</th>
        <th width="10%">Edit date</th>
        <th width="5%">Publish</th>
        <th width="5%">delete</th>
      </tr>
    
    
    <?php	
        while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
        $i=$i+1;
        ?>
    <tr>
        <td width="5%" title="id:<?php  echo $row1["records_documents_id"]?>"><?php  echo $row1["records_documents_pr"]?></td>
        <td width="5%"><?php  echo $row1["documents_id"]?></td>
        <td title="<?php  echo $row1["title"]?>"><a href="../../uploads/documents/<?php  echo $row1["documents_id"]?>/<?php  echo $row1["file"]?>" target="_blank">
		    <?php if (strlen($row1["title"])>80 ){echo substr($row1["title"], 0, 80)."...";} else {  echo $row1["title"];}?>
            </a>
        </td>
        <td><?php  echo $row1["file"]?></td>
         <td><?php  echo $row1["records_documents_create_date"]?></td>
        <td><?php  echo $row1["records_documents_edit_date"]?></td>
        <td>
		<?php  if ($row1["publish"]==1) {?>
             <a href="_publish_doc.php?<?php echo ($query)?>&id=<?php echo $tmpID?>&id_doc=<?php echo $row1["documents_id"]?>" class="btn btn-danger btn-xs" ><i class="fa fa-check"></i></a>
			<?php } else {?>
             <a href="_publish_doc.php?<?php echo ($query)?>&id=<?php echo $tmpID?>&id_doc=<?php echo $row1["documents_id"]?>" class="btn btn-danger btn-xs" > <span class="warning"><i class="fa fa-warning"></i>no </span></a>
				<?php }?>
         </td>      

            
    <td width="5%"><a class="btn btn-danger btn-xs" onClick="DeleteDocument('<?php echo $row1["records_documents_id"]?>','<?php echo $tmpID?>','<?php echo ($query)?>')"><i class="fa fa-exclamation-triangle"></i> Delete</a></td>
      
      </tr>
    
    
      
    <?php } ?>
    
    </table></div>
    <?php }?>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php 
	if(! $result1 ){mysqli_free_result($result1);}
	//mysqli_free_result($result1);
	
	?>                         
</div>
<?php }?> 
<!-- KRAJ MODUL ZA DOKUMENTI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      
                          
    </div><!-- /.col-xs-12 -->
</div><!-- /.row -->
                        
                        
                        
</section><!-- /.content -->
                
                
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        
        <script src="../js/jquery-ui.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
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
	//CKEDITOR.config.width = 790;
	CKEDITOR.config.height = 500;
	CKEDITOR.config.removePlugins = 'form, forms';
	CKEDITOR.config.contentsCss = ['/mk/css/bootstrap.min.css', '/css/adtodate.css'];
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
			//$('*[name=editdate]').appendDtpicker({dateFormat: "DD.MM.YYYY hh:mm"});
			$('*[name=createdate]').appendDtpicker({dateFormat: "DD.MM.YYYY hh:mm"});
            });
</script>

<script>
$(function() {
    $( "#hashtag" ).autocomplete({
        source: 'autocomplete.php'
    });
});
</script>


    </body>
</html>
<?php
//echo ($result);
//if(! $result ){mysqli_free_result($result);}
//mysqli_free_result($result);
 mysqli_close($con) ;
 
 ?>