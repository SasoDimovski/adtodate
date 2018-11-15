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
                    <h1><?php echo $title1;?> 
                        <a href="ModulEdit.php?mv=<?php echo $_GET["mv"];?>"> (<small class="fa fa-plus">  </small> додади нов)</a>
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
if ($_GET["search1"]<>"") { $search=$search."&search1=".$_GET["search1"];$select=$select." and email COLLATE UTF8_GENERAL_CI LIKE '%".$_GET["search1"]."%'";};

//order
if ($_GET["order"]=="") { $order ="pr";}else {$order =$_GET["order"];};

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

$rec_limit = 20;

//VKUPEN BROJ NA ZAPISI
$result = mysqli_query($con,"SELECT count(id) FROM newsletter WHERE id<>0 ".$tmpSelect);
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
SELECT *
FROM newsletter
WHERE id <>0 ".$select."
ORDER BY ".$order." ".$sort." 
LIMIT $offset, $rec_limit" ;
//die ($sql);

$result = mysqli_query($con, $sql);
if(! $result ){die('Could not get data2: ' . mysqli_error());}
$rowcount=mysqli_num_rows($result);
$prikazani=$offset+$rec_limit;
if ($rowcount<$rec_limit) {$prikazani=$offset+$rowcount;}
//echo "BROJ NA ZAPISI STO SE PRIKAZUVAAT (rowcount):".$rowcount."<br>";
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- SEARCH FORMA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="form1" id="form1" method="get" action="?<?php echo $query?>">

<input name="mv" id="mv" type="hidden" value="<?php  echo $_GET["mv"]?>" /> 
                        
            <div class="row">
             <div class="col-xs-1 text-right">Email:</div>
             <div class="col-xs-2">
                <input class="form-control input-sm" name="search1" id="search1" type="text" value="<?php  echo $_GET["search1"]?>" placeholder="" maxlength="100"/>
             </div>
            <div class="col-xs-1"><button class="btn btn-primary btn-sm">Пребарај</button></div>
            </div>  
</form> 

</div>

<!-- /.box-body -->
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

    <div style="clear:both"></div>
    <div class="MainTop1Text">Нема записи !</div>

<?php } else {?>
<div class="box-body no-padding table-responsive">
    <table class="table table-hover table-striped table-condensed">
  <tr>
    <th width="2%" nowrap><a href="?<?php echo $query1 ?>&order=pr&sort=<?php echo $sort?>">PR <?php if($order=="pr") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>
    <th width="2%" nowrap><a href="?<?php echo $query1 ?>&order=id&sort=<?php echo $sort?>">ID <?php if($order=="id") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>
    <th width="5%">
    <?php if ($sort =="desc"&&$order =="pr"&&$search ==""){?>
    
    <?php }?>
    </th>
    <th nowrap><a href="?<?php echo $query1 ?>&order=name&sort=<?php echo $sort?>">Наслов <?php if($order=="title") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>
    <th nowrap><a href="?<?php echo $query1 ?>&order=create_date&sort=<?php echo $sort?>">Датум на креирање <?php if($order=="create_date") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>
    <th nowrap><a href="?<?php echo $query1 ?>&order=edit_date&sort=<?php echo $sort?>">Датум на едитирање <?php if($order=="edit_date") {if($sort=="asc") { echo "<i class=\"fa fa-sort-desc\"></i>";} else { echo "<i class=\"fa fa-sort-asc\"></i>";}}?></a></th>

 <th>Email</th>
 <th width="5%">&nbsp;</th>
 <th width="5%">&nbsp;</th>

  </tr>


<?php	
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { 
	$i=$i+1;
	$email_suma=$row["email"]."; ".$email_suma;
	?>
<tr>
    <td><?php  echo $row["pr"]?></td>
    <td><?php  echo $row["id"]?></td>
    <td nowrap>
    <?php if ($sort =="desc"&&$order =="pr"&&$search ==""){?>
    
    <a href="_move.php?<?php echo $query?>&id=<?php echo $row["id"]?>&pr=<?php echo $row["pr"]?>&dir=top" title="to the top"><i class="fa fa-angle-double-up"></i></a>&nbsp;
    <a href="_move.php?<?php echo $query?>&id=<?php echo $row["id"]?>&pr=<?php echo $row["pr"]?>&dir=up" title="one level up"><i class="fa fa-angle-up"></i></a>&nbsp;
    <a href="_move.php?<?php echo $query?>&id=<?php echo $row["id"]?>&pr=<?php echo $row["pr"]?>&dir=down" title="one level down"><i class="fa fa-angle-down"></i></a>&nbsp;
    <a href="_move.php?<?php echo $query?>&id=<?php echo $row["id"]?>&pr=<?php echo $row["pr"]?>&dir=bottom" title="to the bottom"><i class="fa fa-angle-double-down"></i></a>
    
    <?php }?>
    </td>
    <td><?php  echo $row["name"]?></td>
    <td><?php  echo $row["create_date"]?></td>
    <td><?php  echo $row["edit_date"]?></td>
    <td><?php  echo $row["email"]?></td>
    <td><a class="btn btn-primary btn-xs" href="ModulEdit.php<?php echo $query?>&id=<?php echo $row["id"]?>"><i class="fa fa-edit"></i> измени</a></td>
    <td><a class="btn btn-danger btn-xs" onClick="DeleteRecord('<?php echo $row["id"]?>','<?php $temp=$row["name"]; $temp=str_replace("'"," ",$temp);echo str_replace("\""," ",$temp);?>','?<?php echo $query?>')"><i class="fa fa-exclamation-triangle"></i> бриши</a></td>   
    
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
<?php if($rowcount!=0) {?>
            <div class="form-group">
                <textarea name="t" id="t" class="form-control" rows="10" placeholder=""  maxlength="250"><?php echo $email_suma ?></textarea>
            </div>
<?php }?>
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


    </body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($con) ;?>