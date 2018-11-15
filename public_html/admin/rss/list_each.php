<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 

$mv=$_GET["mv"];
$id=$_GET["id"];
//=====================================================================================================================================
$sql = "Select * FROM _menu WHERE id=".$mv;
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
                    <h1><?php echo $title1;?> 
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


//ZAPISI STO SE PRIKAZUVAAT
$sql = "
SELECT records.id, 
       records.pr, 
	   records.create_date, 
	   records.edit_date, 
	   records.title, 
	   records.intro, 
	   records.id_menu,
	   records.id_workgroups, 
	   records.publish
FROM records
WHERE records.id=".$id;
//echo $sql;

$result = mysqli_query($con, $sql);
if(! $result ){die('Could not get data2: ' . mysqli_error());}
$rowcount=mysqli_num_rows($result);

?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
 </div><!-- /.box-body -->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount==0){?>

    
    <div class="box-body">NO RECORDS IN DB !</div>

<?php } else {?>
<div class="box-body no-padding table-responsive">
    <table class="table table-hover table-striped table-condensed">
  


<?php	
function pisi_rss($xml) {
	$xmlDoc = new DOMDocument();
	$xmlDoc->load($xml);
	//get elements from "<channel>"
	$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
	$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
	$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
	$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
	
	//output elements from "<channel>"
	echo("<h2><a href='" . $channel_link . "'>" . $channel_title . "</a></h2>");
	//echo("<br>");
	//echo($channel_desc . "</p>");
	
	//get and output "<item>" elements
	$x=$xmlDoc->getElementsByTagName('item');
	for ($i=0; $i<=19; $i++) {
	  $item_title=$x->item($i)->getElementsByTagName('title') ->item(0)->childNodes->item(0)->nodeValue;
	  $item_link=$x->item($i)->getElementsByTagName('link') ->item(0)->childNodes->item(0)->nodeValue;
	  //$item_desc=$x->item($i)->getElementsByTagName('description') ->item(0)->childNodes->item(0)->nodeValue;
	  echo ("<p><a href='" . $item_link . "' target='_target'>" . $item_title . "</a>");
	  echo ("<br>");
	  echo ($item_desc . "</p>");
	}
}
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { 
	$i=$i+1;
	?>
<tr>
    
    <td><?php  $xml=$row["intro"]; pisi_rss($xml);?></td>

    
  </tr>


  
<?php } ?>

</table></div>
<?php }?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


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


    </body>
</html>
<?php
mysqli_free_result($result);
 mysqli_close($con) ;?>