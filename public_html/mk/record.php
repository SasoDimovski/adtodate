<?php include_once("../admin/_properties.php"); ?>
<?php include_once("../admin/_procedures.php"); ?>
<?php 
date_default_timezone_set('Europe/Skopje');
include("../simple-php-captcha-master/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
$date1 = date_format(new DateTime($date1), 'Y-m-d H:i:s');
?>

<?php
setlocale(LC_ALL, 'mk_MK.UTF8');//zaradi formatot na datumot (date)
//=====================================================================================================================================
$query="http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];

$sql = "Select * FROM _menu WHERE id=".$_GET["mv"];
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}

$title1=$row["title"];

mysqli_free_result($result);
   
//=====================================================================================================================================
?>
<?php 

$tmpID = intval($_GET["id"]) ;
$preview = $_GET["preview"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);
//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 
//=====================================================================================================================================
$sql = "Select * FROM _menu WHERE id=".$_GET["mv"];
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}

$title1=$row["title"];

mysqli_free_result($result);
   
//=====================================================================================================================================

//=====================================================================================================================================
$sql = "Select * FROM records WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$title=$row["title"];
$subtitle=$row["subtitle"];
$intro=$row["intro"];
$text=$row["text"];
$picture=$row["picture"];
$picture_description=$row["picture_description"];

$id_menu=$row["id_menu"];
$publish=$row["publish"];
$main=$row["main"];
$cover=$row["cover"];
$editor=$row["editor"];
$reporter=$row["reporter"];
$publish_intro=$row["publish_intro"];
$comment=$row["comment"];
$id_workgroups=$row["id_workgroups"];

if ($publish<>1&&$preview!="mvcv6sn76354dk76er912y56t4")
 { 
	mysqli_free_result($result);
	mysqli_close($con);
	header('Location: index.php') ;
	}

//=====================================================================================================================================
//print_r ("id_workgroups:".($id_workgroups)."<br>");
//print_r ("publish:".($publish)."<br>");
//$date1 = new DateTime($row["Licenca_datum"]);
//date_modify($date1,"+5 years");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>ADTODATE
<?php if(!$title=="") {echo ": ".$title;} else {}?></title>
<?php
$link="http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];

if (!$picture) {
	$og_picture="http://adtodate.mk/images/adtodate_logo.png";
} else {
	$og_picture="http://adtodate.mk/uploads/records/".$tmpID."/tn1_".str_replace(' ', '%20',$picture);
}
?>
<meta name="description" content="<?php echo $intro ?>">
<meta name="author" content="<?php echo $reporter ?>">
<meta property="og:locale" content="mk_MK" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo $link ?>" />
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:image" content="<?php echo $og_picture ?>" />

<meta property="og:image:width" content="360" />
<meta property="og:image:height" content="180" />
<meta property="og:description" content="<?php echo $intro ?>" />
<meta property="fb:admins" content="584499725"/>
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/mk_MK/sdk.js#xfbml=1&version=v2.8&appId=1386925178048229";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Navigation -->
<?php 
include("includes/menu.php");
?>

    <!-- Page Content -->
    <div class="container">

        <!-- Content Row -->
        <div class="row">
   
    <div class="col-md-8 vesti">
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h"><?php echo $title1;?></div>
        </div>
      </div>
    
      <div class="col-md-12 zapis">
      
<?php if($_GET["mv"]!=2&&$_GET["mv"]!=6) {?> 
        <div class="ogranicen bez_pointer" style="background-image:url(../../uploads/records/<?php echo $tmpID;?>/<?php echo $picture;?>)"></div><!--<div class="ogranicen"><a href="zapis.html"><img class="img-responsive img-hover" src="../images/ez.jpg" alt=""> </a></div>-->
        <div class="naslov">
        <h1> <?php echo $title?></h1>
        <div class="datum"><img src="../images/napisavme_bulet.png" width="11" height="27" alt=""/><?php if (($_GET["mv"]=="10"||$_GET["mv"]=="14")&&$subtitle!=""){?> <span class="zelen_tekst"> <?php echo $subtitle?>,</span><?php }?> <?php echo $create_date?> </div>
        </div>
<?php  } ?>

        <div class="sodrzina">
		<table><tr><td>
        <div class="fb-like" data-href="<?php echo urldecode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);?>" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></td>
        <td>
<div class="fb-like" style="margin:6px 0 0 5px">
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div></td></tr></table>
		<?php echo $text?></div>
        
        
        <!-- MODUL ZA galerii //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
      
      <div class="box"> 
        
        <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php 
//ZAPISI STO SE PRIKAZUVAAT
 $sql = "SELECT records_gallery.id_gallery, 
                galleries.title
		FROM records_gallery 
		INNER JOIN galleries  
		ON records_gallery.id_gallery=galleries.id 
		WHERE records_gallery.id_records=".$id." 
		ORDER BY records_gallery.pr DESC";
    //echo $sql."<BR>";
$set_galerii = mysqli_query($con, $sql);
while($row_galerija = mysqli_fetch_assoc($set_galerii)) {
	//echo $row_galerija["id_gallery"]."<br>";
    $sql = "SELECT galleries_pictures.id_galleries, 
	               galleries_pictures.id as picture_id, 
				   galleries_pictures.description, 
				   galleries_pictures.file
			FROM galleries_pictures 
			INNER JOIN galleries 
			ON galleries_pictures.id_galleries=galleries.id 
			WHERE galleries.id=".$row_galerija["id_gallery"]." 
			ORDER BY galleries_pictures.pr DESC";
    //die ($sql);
   //echo $sql."<BR>";
    $set_sliki = mysqli_query($con, $sql);
    if(! $set_sliki ){die('Could not get data3: ' . mysqli_error());}
    
    $vkupno_sliki=mysqli_num_rows($set_sliki);
    ?>
        <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
        <!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php if ($vkupno_sliki==0){?>
        <?php } else {?>
        <div class="box-header">
          <h3 class="box-title">Gallery: <?php echo $row_galerija["title"]?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding table-responsive gallery">
          <?php	
        while($row_sliki = mysqli_fetch_array($set_sliki, MYSQL_ASSOC)) { 
        $i=$i+1;
		$slika="/uploads/galleries/".$row_sliki["id_galleries"]."/tn1_".$row_sliki["file"];
        ?>
          <div class="slika_galerija" style="background-image:url('<?php echo $slika ?>')"> <a href="/uploads/galleries/<?php echo $row_sliki["id_galleries"]."/".$row_sliki["file"]?>" rel="prettyPhoto[sliki<?php echo $row_sliki["id_galleries"]?>]" title="<?php echo $row_sliki["description"]?>"><img src="/images/pix.gif" class="gallery_thumb" /></a></div>
          <?php } //while?>
        </div>
        <?php }//else?>
        <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
	mysqli_free_result($set_sliki);
}
mysqli_free_result($set_galerii);?>
      </div>
      
      <!-- KRAJ MODUL ZA galerii //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
      
      <!-- MODUL ZA DOKUMENTI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
      
      <div class="box"> 
        
        <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php 
    //ZAPISI STO SE PRIKAZUVAAT

	
	
    $sql = "SELECT documents.id as documents_id,
	               documents.title,  
	               documents.description, 
				   documents.file, 
				   documents.publish,
				   records_documents.id as records_documents_id, 
				   records_documents.pr as records_documents_pr, 
				   records_documents.create_date as records_documents_create_date, 
				   records_documents.edit_date as records_documents_edit_date
			FROM documents 
			INNER JOIN records_documents 
			ON documents.id=records_documents.id_documents 
			WHERE records_documents.id_records=".$id.$select." AND publish=1 
			ORDER BY records_documents.id DESC";
    //echo ($sql);
    
    $result1 = mysqli_query($con, $sql);
    if(! $result1 ){die('Could not get data3: ' . mysqli_error());}
    
    $rowcount1=mysqli_num_rows($result1);
    ?>
        <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
        
        <!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php if ($rowcount1==0){
    
  //echo "No records!";
    
   } else {?>
        <div class="box-header">
          <h3 class="box-title">Documents:</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body no-padding table-responsive">
          <table class="table table-hover table-striped table-condensed">

            
            <?php
	
        while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
        $i=$i+1;
     ?>
            <tr>
              <td><a href="../../uploads/documents/<?php  echo $row1["documents_id"]?>/<?php  echo $row1["file"]?>" target="_blank">
                <?php
			  if (strlen($row1["title"])>0) {
				                             //echo $row1["title"];
											 if (strlen($_GET["search_doc"])>0) {
											 echo str_replace($_GET["search_doc"],'<b style="background-color:#5cb85c;color:#fff ">'. $_GET["search_doc"].'</b>',$row1["title"]);
											 }
											 else
											 {echo $row1["title"];}
											 } 
			  else 
				                            {
										     echo "download";
											 }
			?>
                </a> <br />
                <small class="datum">
                <?php
		 //=========================================================================== 
            $sql="Select id,title_short from _languages WHERE id in (".rtrim($row1["id_languages"],",").") order by pr asc";
			//die($sql);
            $options = mysqli_query($con, $sql);
            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                {
					$temp=$options_row["title_short"];
				   $title_temp=$title_temp.($temp.", ");
                } 
			echo rtrim($title_temp, ", ");
			$title_temp="";
            mysqli_free_result($options);
		  //=========================================================================== 
		 
          ?>
                <?php
		 
		 //=========================================================================== 
            $sql="Select id,title from documents_categories WHERE id in (".rtrim($row1["id_documents_categories"],",").") order by pr asc";
			//die($sql);
            $options = mysqli_query($con, $sql);
            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                {
					$temp=$options_row["title"];
				   $title_temp=$title_temp.($temp.", ");
                } 
			echo rtrim($title_temp, ", ");
			$title_temp="";
            mysqli_free_result($options);
		  //=========================================================================== 
		 
          ?>
                <?php
		
		 //=========================================================================== 
            $sql="Select id,title from documents_type WHERE id in (".rtrim($row1["id_documents_type"],",").") order by pr asc";
			//die($sql);
            $options = mysqli_query($con, $sql);
            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                {
					$temp=$options_row["title"];
				   $title_temp=$title_temp.($temp.", ");
                } 
			echo rtrim($title_temp, ", ");
			$title_temp="";
            mysqli_free_result($options);
		  //=========================================================================== 
		 
          ?>
                <?php
		 
		 //=========================================================================== 
            $sql="Select id,title from _countries WHERE id in (".rtrim($row1["id_countries"],",").") order by pr asc";
			//die($sql);
            $options = mysqli_query($con, $sql);
            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                {
					$temp=$options_row["title"];
				   $title_temp=$title_temp.($temp.", ");
                } 
			echo rtrim($title_temp, ", ");
			$title_temp="";
            mysqli_free_result($options);
		  //=========================================================================== 
		 
          ?>
                <?php
		 
		 //=========================================================================== 
            $sql="Select id,title from _workgroups WHERE id in (".rtrim($row1["id_workgroups"],",").") order by pr desc";
			//die($sql);
            $options = mysqli_query($con, $sql);
            while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
                {
					$temp=$options_row["title"];
				   $title_temp=$title_temp.($temp.", ");
                } 
			echo rtrim($title_temp, ", ");
			$title_temp="";
            mysqli_free_result($options);
		  //=========================================================================== 
		 
          ?>
                </small></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <?php }?>
        <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php 
		
		mysqli_free_result($result1);
		mysqli_free_result($result);?>
      </div>

      <!-- KRAJ MODUL ZA DOKUMENTI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
<?php if($_GET["mv"]!=2&&$_GET["mv"]!=6) {?> 
        <div class="tags"><div>tags:</div>
        
                                         <?php
										$sql="Select * from _workgroups order by pr desc";

										$options = mysqli_query($con, $sql);
										$a=1;
										//$allowed2 = array($id_workgroups);
										$allowed=explode(",",$id_workgroups);
										//echo $allowed;
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)) {
											 
										?>
					                    <?php $ht= str_replace("#","++",$options_row["title"]);?>
										  <a href="records.php?ht=<?php echo $options_row["id"];?>">
										  
                                          <?php echo $options_row["title"];?>
                                          
                                          </a> 
					
											
											
											<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
        </div>
          <br>
          <br>
          <table><tr><td>
        <div class="fb-like" data-href="<?php echo urldecode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);?>" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></td>
        <td>
<div class="fb-like" style="margin:6px 0 0 5px">
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div></td></tr></table>
          <br>
<?php  } ?>
<div class="linija">
          <div class="kategorija_h">Слична содржина</div>
        </div>
        <?php include("includes/bottom_1.php");?>
        <?php include("includes/right_2.php");?>
        
<?php if($comment==1) {include_once("includes/comments.php");} ?>
          
      </div>
    </div>
    <div class="col-md-4 vesti_mali">
      <div class="col-md-12">
      
      

<?php if($_GET["mv"]!=2&&$_GET["mv"]!=6) {?>
      <div class="linija">
          <div class="kategorija_h">Слична содржина</div>
        </div>
        <?php include("includes/right_4.php");?>
<?php  } ?>     

        
        
        <?php include("includes/right_3.php");?>
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
    <script src="../js/jquery.js"></script>

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
    if ($('.gallery').length) {
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000,
            autoplay_slideshow: false
        });
        $(".frame[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000,
            autoplay_slideshow: false
        });
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            slideshow: 10000,
            hideflash: true
        });
    }
})

$(document).ready(function(){
	$( ".reply_div .reply_kopce" ).click(function() {
	  	var parent = $(this).attr('parent');
		$( this ).parent().parent().find( ".comment" ).load( "/mk/includes/forum/comment.php?parent="+parent).fadeIn(1000);
	});

});
  </script>  
<?php include_once("includes/analyticstracking.php") ?>
</body>

</html>
<?php
mysqli_free_result($result);
 mysqli_close($con) ;?>