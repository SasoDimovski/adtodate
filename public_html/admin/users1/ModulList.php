<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php if ($_SESSION["SUPERADMIN"]!="yes") {header('Location: ../!Login/Login.php') ;};?>

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
<script language="JavaScript">
<!--     
function DeleteRecord(id, description, query) {
//alert (query)
if (confirm("Are you sure you want to delete this record?\n" + description+"\nID:"+id))
{
window.location.href = '_delete.php'+query+'&id=' + id;
}
}  


function SendEmail(id, description, query) {

if (confirm("Are you sure you want so send an email to user:\n" + description+"?"))
{
window.location.href = '_sendemail.php'+query+'&id=' + id;
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
                    <h1>
                        Users
                        <a href="ModulEdit.php?mv=<?php echo $_GET["mv"];?>"> (<small class="fa fa-plus">  </small> add new user)</a>
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
if ($_GET["search1"]<>"") { $search ="&search1=".$_GET["search1"];$select=" and id_workgroups = ".$_GET["search1"];};
if ($_GET["search2"]<>"") { $search=$search."&search2=".$_GET["search2"];$select=$select." and name COLLATE UTF8_GENERAL_CI LIKE '%".$_GET["search2"]."%'";};
if ($_GET["search3"]<>"") { $search=$search."&search3=".$_GET["search3"];$select=$select." and surname COLLATE UTF8_GENERAL_CI LIKE '%".$_GET["search3"]."%'";};

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

$rec_limit = 20;

//VKUPEN BROJ NA ZAPISI
$result = mysqli_query($con,"SELECT count(id) FROM AdminUsers where id>1 ".$select);
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
$sql = "SELECT *
		FROM AdminUsers
		WHERE id >1 ".$select."
		ORDER BY ".$order." ".$sort." 
		LIMIT $offset, $rec_limit" ;
//die ($sql);


$result = mysqli_query($con, $sql);
if(! $result ){die('Could not get data1: ' . mysqli_error());}
$rowcount=mysqli_num_rows($result);
$prikazani=$offset+$rec_limit;
if ($rowcount<$rec_limit) {$prikazani=$offset+$rowcount;}
//echo "BROJ NA ZAPISI STO SE PRIKAZUVAAT (rowcount):".$rowcount."<br>";
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- SEARCH FORMA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="form1" id="form1" method="get" action="ModulList.php">
<input name="mv" id="mv" type="hidden" value="<?php  echo $_GET["mv"]?>" /> 
            <div class="row">                        
            <div class="row">
            <div class="col-xs-1 text-right">name:</div><div class="col-xs-2"><input class="form-control input-sm" name="search2" id="search2" type="text" value="<?php  echo $Search1?>" maxlength="50" placeholder="search by name" /></div>
            <div class="col-xs-1 text-right">surname:</div><div class="col-xs-2"><input class="form-control input-sm" name="search3" id="search3" type="text" value="<?php  echo $Search2?>" maxlength="50" placeholder="search by surname" /></div>
            <div class="col-xs-1"><button class="btn btn-primary btn-sm">Search</button></div>
            </div> 
</form> 
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- PAGE-ING //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if($rowcount!=0) {
	pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$query);
}
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount==0){?>

    <div style="clear:both"></div>
    <div class="MainTop1Text">NO RECORDS IN DB !</div>

<?php } else {?>
<div class="box-body no-padding table-responsive">
    <table class="table table-hover table-striped table-condensed">
  <tr>
    <th width="1%" nowrap>ID</th>

    <th nowrap>Name</th>
    <th nowrap>Surname</th>
    <th nowrap>Username</th>
    <th nowrap>Pass</th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>

  </tr>


<?php	
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { 
	$i=$i+1;
	?>

<tr>
    <td width="5%"><?php  echo $row["ID"]?></td>

    
    <td><?php  echo $row["Name"]?></td>
    <td><?php  echo $row["Surname"]?></td>
    <td><?php  echo $row["User"]?></td>
    <td><?php  echo $row["Password"]?></td>
    <td><a class="btn btn-primary btn-xs" href="ModulEdit.php<?php echo $query?>&id=<?php echo $row["ID"]?>"><i class="fa fa-edit"></i> Edit</a></td>
    <td>
    <?php  if ($row["ID"]!='2') {?>
    <a class="btn btn-danger btn-xs" onClick="DeleteRecord('<?php echo $row["ID"]?>','<?php echo ($row["Username"])?>','<?php echo $query?>')"><i class="fa fa-exclamation-triangle"></i> Delete</a>
    <?php }?>
    
    </td> 
    

  </tr>


  
<?php } ?>

</table></div>
<?php }

?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- PAGE-ING //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="box-body table-responsive">
<?php
if($rowcount!=0) {
	pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$query);
}
?>
</div>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->




<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
                          </div><!-- /.box-body -->
                                
                           
                                
                                
                            </div><!-- /.box -->
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