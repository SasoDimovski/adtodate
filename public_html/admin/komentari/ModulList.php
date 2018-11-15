<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
date_default_timezone_set('Europe/Skopje');


//=====================================================================================================================================
$sql = "Select * FROM _menu WHERE id=".$_GET["mv"];
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}

$title1=$row["title"];

mysqli_free_result($result);
   
//=====================================================================================================================================

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
        <link href="../css/_main.css" rel="stylesheet" type="text/css" />
        <link href="../css/_medium3.css" rel="stylesheet" type="text/css" />       
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
          <script src="../js/ajaxCaller.js"></script>
<script language="JavaScript">
<!--     
function DeleteRecord(id, description, query) {
//alert (query)

if (confirm("Are you sure you want to delete this record?\n" + description+"\nID:"+id))
{
window.location.href = '_delete.php'+query+'&id=' + id;
}
}  
function openPopup(id,type,query)
{
    document.getElementById('popup').style.display='block';
    document.getElementById('shader').style.display='block';
	
    getJSP('../records/_ax_get_category.php?'+query+ '&id=' + id, 'popup', null, null, 0);

}
function addCategory(id, id_menu) {

window.location.href = '_record_category.php?id=' + id + '&id_menu=' + id_menu;

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
<div id="popup" class="popup_center" style="width:50%"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   


<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->
                <section class="content-header">
                    <h1><?php echo $title1;?><?php echo comment_count() ?> 
                        <a href="ModulEdit.php?mv=<?php echo $_GET["mv"];?>"></a>
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
                            

 <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<?php 

//search
//if ($_GET["search1"]<>"") { $search ="&search1=".$_GET["search1"];$select=" and category = ".$_GET["search1"];};
if ($_GET["search1"]<>"") { $search=$search."&search1=".$_GET["search1"];$select=$select." and records.title COLLATE UTF8_GENERAL_CI LIKE '%".$_GET["search1"]."%'";};

//order
if ($_GET["order"]=="") { $order ="id";}else {$order =$_GET["order"];};

//sort
if ($_GET["sort"]=="") { $sort ="desc";}
else { if ($_GET["sort"]=="desc") { $sort ="asc";}else{$sort ="desc";}; };

//query 
$query ="?mv=".$_GET["mv"];
	if ($_GET["order"]<>""){$query =$query."&order=".$_GET["order"];}
	if ($_GET["sort"]<>""){$query =$query."&sort=".$_GET["sort"];}
	if ($_GET["page"]<>""){$query =$query."&page=".$_GET["page"];}
	if ($search<>""){$query =$query.$search;}

$query1 = "mv=".$_GET["mv"].$search;

$rec_limit = 30;

//VKUPEN BROJ NA ZAPISI
$result = mysqli_query($con,"SELECT count(id) FROM forum where record_id<>0 ".$select);
$row = mysqli_fetch_array($result, MYSQL_NUM );
$rec_count = $row[0];
if(! $row ){die('Could not get data1: ' . mysqli_error());}
//echo "VKUPEN BROJ NA ZAPISI (rec_count):".$rec_count."<br>";

//VKUPEN BROJ NA STRANI
$page_vkupno = ceil($rec_count/$rec_limit);
//echo "VKUPEN BROJ NA STRANI (page_vkupno):".$page_vkupno."<br>";

//SETIRANJE OD KOJ ZAPIS DA SE PRIKAZUVA
if( isset($_GET{'page'}) && $_GET{'page'}!=0)
{
   $page = $_GET{'page'};
   $offset = $rec_limit * $page ;
}
else
{
   $page = 0;
   $offset = 0;
}

//ZAPISI STO SE PRIKAZUVAAT
$sql = "
SELECT forum.id, 
       forum.pr, 
	   forum.create_date, 
	   forum.edit_date, 
	   forum.post as forum_post, 
	   forum.name as forum_name, 
	   forum.record_id,
	   forum.hidden, 
	   forum.approved,
	   records.title as records_title
FROM forum
INNER JOIN records 
ON forum.record_id=records.id
WHERE forum.record_id<>0 ".$select."
ORDER BY ".$order." ".$sort." 
LIMIT $offset, $rec_limit" ;
//echo ($sql);

$result = mysqli_query($con, $sql);
if(! $result ){die('Could not get data2: ' . mysqli_error());}
$rowcount=mysqli_num_rows($result);
$prikazani=$offset+$rec_limit;
if ($rowcount<$rec_limit) {$prikazani=$offset+$rowcount;}
//echo "BROJ NA ZAPISI STO SE PRIKAZUVAAT (rowcount):".$rowcount."<br>";
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- SEARCH FORMA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="form1" id="form1" method="get" action="<?php echo $query?>">

<input name="mv" id="mv" type="hidden" value="<?php  echo $_GET["mv"]?>" /> 
                        
<!--            <div class="row">
            <div class="col-xs-1 text-right">Categories:</div>
            <div class="col-xs-3">

                <select  id="search1" name="search1" class="form-control input-sm">
                 <option value="">All</option>

                </select>
            
            </div>
            
             <div class="col-xs-1 text-right">Title:</div>
             <div class="col-xs-3">
                <input class="form-control input-sm" name="search1" id="search1" type="text" value="<?php  echo $_GET["search1"]?>" placeholder="search by surname" maxlength="50"/>
             </div>
            <div class="col-xs-1"><button class="btn btn-primary btn-sm">Search</button></div>
            </div> --> 
</form>

</div><!-- /.box-body -->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- PAGE-ING //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if($rowcount!=0) {
	pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$query);
}
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount==0){?>

    <div class="box-body">NO RECORDS IN DB !</div>

<?php } else {?>
<div class="box-body no-padding table-responsive">
    <table class="table table-hover table-striped table-condensed">
  <tr>
    <th width="1%" nowrap>ID</th>

    <th nowrap>Title of record</th>
    
<!--    <th nowrap><a href="?<?php echo $query1 ?>&order=id_workgroups&sort=<?php echo $sort?>">Group<?php if($order=="title") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>-->
    
    <th nowrap>Comment</th>
    <th nowrap>Name</th>
    <th nowrap>Create date</th>
<!--    <th nowrap>Edit date</th>-->
    <th width="5%">Publish</th>
   <!-- <th width="5%">&nbsp;</th>-->
    <th width="5%">&nbsp;</th>

  </tr>


<?php	
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { 
	$i=$i+1;
	$children_dissapproved=has_children_dissapproved($row["id"]);
	
	
	$create_date=$row["create_date"];
	if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
	?>
<tr>
    <td width="5%"><?php  echo $row["id"]?></td>
    <td><a href="http://adtodate.mk/mk/record.php?mv=11&id=<?php  echo $row["record_id"]?>" target="_blank"><?php  echo $row["records_title"]?></a> 
	<?php if ($children_dissapproved>0) { echo "<span style=\"color:red\">(".$children_dissapproved." dissaproved subcomments)</span>";}?></td>
    <td><?php  echo $row["forum_post"]?></td>
    <td><?php  echo $row["forum_name"]?></td>
    <td><?php  echo $create_date?></td>
   <!-- <td><?php  echo $row["edit_date"]?></td>-->
<td>
    <?php  if ($row["approved"]==1) {?>
    
            <a href="_publish.php<?php echo ($query)?>&id=<?php echo $row["id"]?>" class="btn btn-danger btn-xs" ><i class="fa fa-check"></i></a>
			<?php } else {?>
            <a href="_publish.php<?php echo ($query)?>&id=<?php echo $row["id"]?>" class="btn btn-danger btn-xs" > <span class="warning"><i class="fa fa-warning"></i> no</span></a>
	<?php }?>

</td>
   <!-- <td><a class="btn btn-primary btn-xs" href="ModulEdit.php<?php echo $query?>&id=<?php echo $row["id"]?>"><i class="fa fa-edit"></i> Edit</a></td>-->
    <td><a class="btn btn-danger btn-xs" onClick="DeleteRecord('<?php echo $row["id"]?>','<?php $temp=$row["title"]; $temp=str_replace("'"," ",$temp);echo str_replace("\""," ",$temp);?>','<?php echo $query?>')"><i class="fa fa-exclamation-triangle"></i> Delete</a></td>   
    
  </tr>


  
<?php } ?>

</table></div>
<?php }?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- PAGE-ING //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if($rowcount!=0) {

	pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$query);
}
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->




<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                               
                                
                           
                                
                                
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
 mysqli_close($con) ;?>