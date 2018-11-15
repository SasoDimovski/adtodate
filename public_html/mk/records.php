<?php include_once("../admin/_properties.php"); ?>
<?php include_once("../admin/_procedures.php"); ?>
<?php 
//=====================================================================================================================================
date_default_timezone_set('Europe/Skopje');
	$query="http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
	$search=$_GET["srch-term"];
	$search=stripslashes($search);
    $mv = intval($_GET["mv"]);
	$ht = intval($_GET["ht"]);
	//$ht= str_replace("++","#",$ht);
	//echo "Hashtag: ".$ht;
	//echo "mv: ".$mv;
//=====================================================================================================================================
$sql = "Select * FROM _workgroups WHERE id=".$ht;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$ht_title=$row["title"];
mysqli_free_result($result);
   
//=====================================================================================================================================
$sql = "Select * FROM _menu WHERE id=".$_GET["mv"];
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$title1=$row["title"];
mysqli_free_result($result);
   
//=====================================================================================================================================

if ($search!='') {$title1="Search: '".$search."'";}
if ($ht!=0) {$title1="Hashtag: '".$ht_title."'";}


    if ($mv<>"") 
	    {
			$select=$select." AND id_menu=".$mv;
		};

    if ($mv==""&&$search<>"") 
	    {
			$select=$select." AND (records.title COLLATE UTF8_GENERAL_CI LIKE '%".$search."%' OR records.intro COLLATE UTF8_GENERAL_CI LIKE '%".$search."%' OR records.text COLLATE UTF8_GENERAL_CI LIKE '%".$search."%')";
		};
		
    if ($mv==""&&$ht!=0) 
	    {
			$select=$select." AND id_workgroups LIKE '%".$ht."%'";
		};	
		
		setlocale(LC_ALL, 'mk_MK.UTF8');
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>ADTODATE</title>

<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/modern-business.css" rel="stylesheet">
<link href="../css/adtodate.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:regular,light,bold" rel="stylesheet">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--PRETTYPHOTO CSS-->
<link href="../css/prettyPhoto.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="icon" type="image/png" href="../images/favicon.png" />

</head>

<body>

<!-- Navigation -->
<?php 
include("includes/menu.php");
?>

<!-- Page Content -->
<div class="container">


  <div class="row bez_padding"> </div>
  
  
  
  <!-- Marketing Icons Section -->
  <div class="row">
  
  
  
    <div class="col-md-8 vesti">
    
    
    
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h"><?php echo $title1;?></div>
        </div>
      </div>
 <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 

$rec_limit = 8;

//VKUPEN BROJ NA ZAPISI
$sql_count = "SELECT count(id) FROM records where  publish=1 and id>=650".$select;
//$sql_count = sprintf($sql_count, mysql_real_escape_string($searh), mysql_real_escape_string($ht));
$result = mysqli_query($con,$sql_count);
$row = mysqli_fetch_array($result, MYSQL_NUM );
$rec_count = $row[0];
//die ($sql_count);
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
//$sq1l = "
//SELECT *
//FROM records
//WHERE publish=1 ".$select."
//ORDER BY create_date desc, pr desc, id desc 
//LIMIT $offset, $rec_limit" ;
//die ($sql);

$sql = "
SELECT records.id, 
       records.pr, 
	   records.create_date, 
	   records.edit_date, 
	   records.title, 
	   records.intro, 
	   records.text,
	   records.id_menu,
	   records.id_workgroups, 
	   records.publish, 
	   records.picture,
	   _menu.title as _menu_title
FROM records
INNER JOIN _menu 
ON records.id_menu=_menu.id
WHERE publish=1 and records.id>=650".$select."
ORDER BY create_date desc, pr desc, id desc 
LIMIT $offset, $rec_limit" ;

//die ($sql);

$result = mysqli_query($con, $sql);
if(! $result ){die('Could not get data2: ' . mysqli_error());}
$rowcount=mysqli_num_rows($result);
$prikazani=$offset+$rec_limit;
if ($rowcount<$rec_limit) {$prikazani=$offset+$rowcount;}
//echo "BROJ NA ZAPISI STO SE PRIKAZUVAAT (rowcount):".$rowcount."<br>";
?>


<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount==0){?>
<div class="col-md-6"> 
    <div class="box-body">NO RECORDS IN DB !</div>
</div>
<?php } else {?>



<?php	
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) { 
	$i=$i+1;
	$create_date=$row["create_date"];
	
$edit_date=$row["edit_date"];
//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
if ($edit_date) {$edit_date=strftime("%d %b %Y", strtotime($edit_date));};


$date1=date('Y-m-d H:i:s');
$date2=$row["create_date"];

$date1 = date_format(new DateTime($date1), 'Y-m-d H:i:s');
$date2 = date_format(new DateTime($date2), 'Y-m-d H:i:s');


	?>
 <?php if ($row["id_menu"]<>15&&$date1>=$date2){?>
      <div class="col-md-6"> 
					 <?php if($row["picture"]!="") {?> 
                      <div class="ogranicen" style="background-image:url(../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>)" onClick="window.open('record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>','_self')"></div>
                      <?php }?> 
                      
                      <?php     if ($mv==""&&($search<>""||$ht!=0)) {?> 
                        <h5><?php echo $row["_menu_title"];?></h5>
                       <?php }?>  
                        <h3> <a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>">
											<?php 
                                             if (strlen($search)>0) {
                                             echo str_replace($search,'<b style="background-color:#5cb85c;color:#fff ">'. $search.'</b>',$row["title"]);
                                             }
                                             else
                                             {echo $row["title"];}
                                            ?>
                        </a></h3>
                        <div class="datum kat_in"><?php echo $create_date;?>
     
                        
                        </div>
							   <?php
                                 if (strlen($search)>0) {
                                 echo str_replace($search,'<b style="background-color:#5cb85c;color:#fff ">'. $search.'</b>',$row["intro"]);
                                 }
                                 else
                                 {echo $row["intro"];}
                               ?>
      </div>
<?php } ?>


 <?php if ($row["id_menu"]==15){?>
      <div class="col-md-6">
		<?php if($row["picture"]!="") {?> 
        	<div class="ogranicen" style="background-image:url(../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>); cursor:default !important"></div>
        <?php }?> 
         <h3> <a href="<?php echo $row["intro"];?>" rel="prettyPhoto">
											<?php 
                                             if (strlen($search)>0) {
                                             echo str_replace($search,'<b style="background-color:#5cb85c;color:#fff ">'. $search.'</b>',$row["title"]);
                                             }
                                             else
                                             {echo $row["title"];}
                                            ?>
                        </a></h3>
         <div class="datum kat_in"><?php echo $create_date;?></div>
      
      </div> 
<?php } ?>


      
 <?php if (($i%2)==0){?> <!--<div style="clear:both"></div>--><?php } ?>
  
<?php } ?>


<?php }?>
<div style="clear:both; height:40px"></div>
    <!-- PAGE-ING //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if($rowcount!=0) {

	pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$query);
}
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->  
      
<!--      <div class="col-md-6"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Индустриски стандард кој се корис како модел уште пред 1500 години Индустриски стандард кој се корис како модел уште пред 1500 години...</a></h3>
        <div class="datum kat_local">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>
      <div class="col-md-6"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Индустриски стандард кој се корис како модел уште пред 1500 години...</a></h3>
        <div class="datum kat_in">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>
      <div class="col-md-6"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Lorem Ipsum е едноставен модел на текст кој се користел во печатарската...</a></h3>
        <div class="datum kat_digital">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>-->
      
      
      
      
    </div>

    
    
    
    <div class="col-md-4 vesti_mali">
      <div class="col-md-12">
      
<?php  if ($mv!=""&&$mv!=14) {?>
      <?php include("includes/right_1.php");?>
<?php  }?>
<?php  if ($mv!=14) {?> 
      <?php include("includes/right_2.php");?>
      <?php include("includes/right_3.php");?>
<?php  }?> 


<?php  if ($mv==14) {?>       
    <?php include("includes/festivali_cal.php");?>
    <?php $value= 2;?>
    <?php include("includes/festivali_list.php");?>
    <?php $value= 3;?>
   <?php include("includes/festivali_list.php");?>
   <?php $value= 4;?>
  <?php include("includes/festivali_list.php");?>
<?php  } else { echo "<script src='../js/jquery.js'></script>";}?>    


 <?php include("includes/_newsletter.php");?>
      </div>
    </div>
  </div>
  
  <!-- /.row -->
  
 <hr>

  
  <!-- Footer -->
  
  <?php include("includes/footer.php");?>

</div>
<!-- /.container --> 


<!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
<!--PRETYPHOTO JS--> 
<script src="../js/jquery.prettyPhoto.js"></script> 
<script>
jQuery(document).ready(function($) {
    "use strict";
    //For Pretty Photo Validation
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
    });

    //Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000, 
    		iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>", 
            autoplay_slideshow: false
     });
})
</script>  
<?php include_once("includes/analyticstracking.php") ?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($con) ;
?>