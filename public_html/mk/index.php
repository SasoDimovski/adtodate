<?php include_once("../admin/_properties.php"); ?>
<?php include_once("../admin/_procedures.php"); 
setlocale(LC_ALL, 'mk_MK.UTF8');
date_default_timezone_set('Europe/Skopje');
$date1 = date_format(new DateTime($date1), 'Y-m-d H:i:s');
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
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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


  <div class="row bez_padding"> 
    <!-- x4 -->
<?php 
//=====================================================================================================================================
$sql = "SELECT records.id, 
       records.pr, 
	   records.create_date, 
	   records.edit_date, 
	   records.title, 
	   records.cover, 
	   records.intro, 
	   records.id_menu,
	   records.id_workgroups, 
	   records.publish, 
	   records.picture,
	   _menu.title as _menu_title,
	   _menu.id as _menu_id
FROM records
INNER JOIN _menu ON records.id_menu=_menu.id
WHERE publish=1 AND main=1 AND records.create_date<'".$date1."' 
ORDER BY id DESC
LIMIT 0 , 4";

$result=mysqli_query($con, $sql);
$site_main = "";
while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	$site_main = $site_main.", ".$row["id"];
}
$site_main=substr($site_main,2);
?>
            <div class="col-md-6 col-sm-6 my-container">
			<?php 
            mysqli_data_seek($result, 0);
            $row = mysqli_fetch_array($result);
            ?>
              <div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
            
            <div class="col-md-6 col-sm-6 my-container sredni_vesti_edna">
            <?php 
            mysqli_data_seek($result, 1);
            $row = mysqli_fetch_array($result);
            ?>
              <div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
            </div>            
              
              <div class="col-md-6 col-sm-6 my-container sredni_vesti_edna">
            <?php 
            mysqli_data_seek($result, 2);
            $row = mysqli_fetch_array($result);
            ?>
              <div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
            </div>
              
            <div class="col-md-3 col-sm-6 my-container sredni_vesti_dve">
            <div class="gore">
			  <?php 
            mysqli_data_seek($result, 1);
            $row = mysqli_fetch_array($result);
            ?>
              <div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo skrati($row["title"],200);?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
            <div class="dole">
              <?php 
            mysqli_data_seek($result, 2);
            $row = mysqli_fetch_array($result);
            ?>
<div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo skrati($row["title"],200);?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
              </div>
              
              
            <div class="col-md-3 col-sm-6 my-container">
            <?php 
            mysqli_data_seek($result, 3);
            $row = mysqli_fetch_array($result);
            ?>
              <div class="my-container-tekst">
                <div class="kat_box"><a href="records.php?mv=<?php echo $row["_menu_id"];?>" class="kat_<?php echo strtolower($row["_menu_title"]);?>"><?php echo $row["_menu_title"];?></a></div>
                <h1><a href="record.php?mv=<?php echo $row["_menu_id"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
              </div>
              <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
      
      <?php mysqli_free_result($result);?>
  </div>
  
  
  
  <!-- Marketing Icons Section -->
  <div class="row">
          
          
          
          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <div class="col-md-8 vesti">
              <div class="col-md-12">
                <div class="linija">
                  <div class="kategorija_h">AdToDate News</div>
                </div>
              </div>
              <?php include("includes/in.php");?>
              <?php $bannerID=4;?> 
             <div class="col-md-12 banner_top"><?php include("includes/banner.php");?> </div>
              
            </div>
          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            
          <!-- BANNER POZICIJA 3  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                                <?php 
								
                                //=====================================================================================================================================
                                $sql2 = "SELECT *
                                FROM baners
                                WHERE position =3
                                AND publish =1
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 0 , 2";
                                //die($sql);
                                $result2=mysqli_query($con, $sql2);
                                $rowcount2=mysqli_num_rows($result2);
								$banners3=$rowcount2;
                                //if ($result){$row = mysqli_fetch_array($result);}
                                //=====================================================================================================================================
                                ?>

                                                <?php if ($rowcount2==0){?>
                                                <?php } else {?>
                                                <div class="col-md-4 vesti_mali banners"> 
                                                <div class="col-md-12">
													<?php	
                                                    while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
                                                    $i=$i+1;
                                                    $create_date=$row["create_date"];
                                                    $edit_date=$row["edit_date"];
                                                    //if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
                                                    if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
                                                    if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
                                                   ?>
                                                   <?php echo $row["text"];?>
                                                   <div class="" style="height:10px"></div>                                                
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php }?>
                                                

                                 <?php  mysqli_free_result($result2);?>
                
                

          <!-- BANNER POZICIJA 3  KRAJ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            
          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <div class="col-md-4 vesti_mali"> 
                <div class="col-md-12">
                
                <!--<a href="http://www.marketing-summit.rs" target="_blank"><img src="../images/300x250 banner SR govorci3.jpg" width="300" height="250" alt="" style="margin:10px 20px"/></a>-->
                
                
                        <div class="linija">
                          <div class="kategorija_h">Admen</div>
                        </div>
                        <div class="madmen_mali">
                                        
                                <?php $admen_count=5-($banners3+1);
                                //=====================================================================================================================================
                                $sql2 = "SELECT *
                                FROM records
                                WHERE id_menu =10
                                AND publish =1 AND create_date<'".$date1."'
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 0 , ".$admen_count;
                                //die($sql);
                                $result2=mysqli_query($con, $sql2);
                                $rowcount2=mysqli_num_rows($result2);
                                //if ($result){$row = mysqli_fetch_array($result);}
                                //=====================================================================================================================================
                                ?>
                                          <table>
                                                <?php if ($rowcount2==0){?>
                                                <tr> 
                                                    <td>
                                                     NO RECORDS IN DB !
                                                    </td>
                                                </tr>
                                                <?php } else {?>
                                                <?php	
                                                while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
                                                $i=$i+1;
                                                $create_date=$row["create_date"];
                                                $edit_date=$row["edit_date"];
                                                //if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
                                                if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
                                                if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
                                               ?>
                                                <tr>
                                                  <td class="madmen_mali_slika">
                                                  <a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"> 
                                                  <img class="img-responsive img-hover" src="../../uploads/records/<?php echo $row["id"];?>/tn2_<?php echo $row["picture"];?>" alt=""> 
                                                  </a>
                                                  </td>
                                                  <td class="madmen_mali_tekst">
                                                    <h3><a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"><?php echo skrati($row["title"],90);?></a> </h3>
                                                    <p><?php echo skrati($row["reporter"],100);?><?php //echo "<br>".skrati($row["subtitle"],16);?></p>
                                                    <div class="datum kat_campaigns"><?php echo $create_date;?></div>
                                                  </td>
                                                </tr>
                                                
                                                <?php } ?>
                                                <?php }?>
                                                
                                          </table>
                                 <?php  mysqli_free_result($result2);?>
                        </div>
                        
                        
                        <?php include("includes/right_2.php");?>
                        <?php //include("includes/right_3.php");?>
                        <?php include("includes/_newsletter.php");?>
                      </div>
                      
            </div>
           <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
           
           
  </div>
  
  <!-- /.row -->
  
  <div class="row">
    <div class="col-md-12 vesti">
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h">Campaigns</div>
        </div>
      </div>
    </div>
    
<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =11
AND publish =1 AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT 0 , 1";
//die($sql);
$result2=mysqli_query($con, $sql2);
$rowcount2=mysqli_num_rows($result2);
//if ($result){$row = mysqli_fetch_array($result);}
//=====================================================================================================================================
?>
<?php if ($rowcount2==0){?>

	 NO RECORDS IN DB !

<?php } else {?>
<?php	
while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
$i=$i+1;
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
$id_temp=$row["id"];
?>
    <div class="col-md-8 vesti">
      <div class="col-md-12">  <div class="ogranicen" style="background-image:url('../../uploads/records/<?php echo $row["id"];?>/<?php echo $row["picture"];?>')" onClick="window.open('record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>','_self');"></div><!--<div class="ogranicen"><a href="zapis.html"><img class="img-responsive img-hover" src="../images/ez.jpg" alt=""> </a></div>-->
        <h3> <a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h3>
        <p><?php echo $row["intro"];?></p>
        <div class="datum kat_in"><?php echo $create_date;?><!--<a href="zapis.html">CAMPAIGNS</a>--></div>
      </div>
                    <?php $bannerID=6;?> 
             <div class="col-md-12 banner_top"><?php include("includes/banner.php");?> </div>
      
    </div>
                <?php } ?>
                <?php }?>
<?php  mysqli_free_result($result2);   ?>


          <!-- BANNER POZICIJA 3  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                                <?php 
								
                                //=====================================================================================================================================
                                $sql2 = "SELECT *
                                FROM baners
                                WHERE position =5
                                AND publish =1
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 0 , 1";
                                //die($sql);
                                $result2=mysqli_query($con, $sql2);
                                $rowcount2=mysqli_num_rows($result2);
								$banners7=$rowcount2;
                                //if ($result){$row = mysqli_fetch_array($result);}
                                //=====================================================================================================================================
                                ?>

                                                <?php if ($rowcount2==0){?>
                                                <?php } else {?>
                                                <div class="col-md-4 vesti_mali banners"> 
                                                <div class="col-md-12">

													<?php	
                                                    while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
                                                    $i=$i+1;
                                                    $create_date=$row["create_date"];
                                                    $edit_date=$row["edit_date"];
                                                    //if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
                                                    if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
                                                    if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
                                                   ?>
                                                   <?php echo $row["text"];?>
    
    
                                                    
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php }?>
                                                

                                 <?php  mysqli_free_result($result2);?>
                
                

          <!-- BANNER POZICIJA 3  KRAJ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    
    <div class="col-md-4 campaigns_mali">
      <div class="col-md-12">
      <?php include("includes/campaings.php");?>
      </div>
    </div>
    
  </div>
  <!-- /.row -->
  
  
  
  
  <div class="row">
    <div class="col-md-12 vesti">
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h">Video</div>
        </div>
        </div>
    <div class="col-md-12 video_container" style="background-color:#4f4b4c; padding:0 !important; margin: 25px 10px; ">
      <div class="col-md-8" style="padding:0 !important"> 
      
      
      
        <!-- THE YOUTUBE PLAYER -->
<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =15
AND publish =1 AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT 0 , 1";
//die($sql);
$result2=mysqli_query($con, $sql2);
$rowcount2=mysqli_num_rows($result2);
//if ($result){$row = mysqli_fetch_array($result);}
//=====================================================================================================================================
?>

			<?php if ($rowcount2==0){?>
            <div class="box-body">NO RECORDS IN DB !</div>
            <?php } else {?>
          <?php	
			while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
			$i=$i+1;
			$create_date=$row["create_date"];
			$edit_date=$row["edit_date"];
			$title=$row["title"];
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
			$parts = parse_url($row["intro"]);
			parse_str($parts['query'], $query);
			$youtube_code=$query['v'];
			
			if ($row["picture"]>1) {$youtube_slika="../../uploads/records/".$row["id"]."/".$row["picture"];} else {$youtube_slika='https://img.youtube.com/vi/'.$youtube_code.'/maxresdefault.jpg';}
	       ?>
       

            
         <div class="vid-container">
          <iframe id="vid_frame" src="http://www.youtube.com/embed/<?php echo $youtube_code;?>?rel=0&showinfo=0&autohide=1" frameborder="0" width="777" height="375" allowfullscreen></iframe>
          <div id="front_image" onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/<?php echo $youtube_code;?>?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';" style="background-image:url('<?php echo $youtube_slika;?>')"><img src="../images/strelka.png" alt="">
<br><?php echo $row["title"]?></div>
        </div>
      

            
<?php } ?>


<?php }?>



 <?php  mysqli_free_result($result2);   ?>
        
        
        
        

        
        
        
        
        <!-- THE PLAYLIST -->
        <div class="vid-list-container">
          <div class="vid-list">
          
          <?php include("includes/video.php");?>

            
            
          </div>
        </div>
        
        <!-- LEFT AND RIGHT ARROWS -->
        <div class="arrows">
          <div class="arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
          <div class="arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
        </div>
        
        
      </div>
      <div class="col-md-4"><div id="video_naslov"><?php echo $title?></div>
<div id="video_datum"><?php echo $create_date?></div>
      </div>
    </div>
  </div>
  
  </div>
  
  
  <div class="row">
    <div class="col-md-12 vesti">
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h">Local</div>
        </div>
      </div>
      
      <?php include("includes/local.php");?>
      
      
      
      
    </div>
    
  </div>
  
  
  
  
  <!-- Features Section -->
  <div class="row bez_padding">
    <div class="col-md-12 vesti">
      <div class="col-md-12">
        <div class="linija">
          <div class="kategorija_h">Digital</div>
        </div>
      </div>
    </div>
    
    
    <div class="col-md-8 col-sm-6">
    <?php $count1=0; $count2=1;?>
     <?php include("includes/digital.php");?>

    </div>
    <div class="col-md-4 col-sm-6">
    <?php $count1=1; $count2=2;?>
    <?php include("includes/digital.php");?>

        
    </div>
    
    
    
    
    
    
    
    
  </div>
  
 <hr>

  
  <!-- Footer -->
  
  <?php include("includes/footer.php");?>
</div>
<!-- /.container --> 

<!-- jQuery --> 
<script src="../js/jquery.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="../js/bootstrap.min.js"></script> 

<!-- Script to Activate the Carousel --> 
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script> 
<!-- JS FOR SCROLLING THE ROW OF THUMBNAILS --> 
<script type="text/javascript">
  		$(document).ready(function () {
			$(".vid-item").mouseover(function() {
		        $(this).find(".desc_front").css("display", "block");
		        $(this).find(".strelka").css("display", "none");
				
		    });
			$(".vid-item").mouseout(function() {
		        $(this).find(".desc_front").css("display", "none");
		        $(this).find(".strelka").css("display", "block");
		    });
		    $(".arrow-right").bind("click", function (event) {
		        event.preventDefault();
		        $(".vid-list-container").stop().animate({
		            scrollLeft: "+=336"
		        }, 750);
		    });
		    $(".arrow-left").bind("click", function (event) {
		        event.preventDefault();
		        $(".vid-list-container").stop().animate({
		            scrollLeft: "-=336"
		        }, 750);
		    });
		});
  	</script>
<?php include_once("includes/analyticstracking.php") ?>
</body>
</html>
