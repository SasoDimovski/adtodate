<?php include_once("../admin/_properties.php"); ?>
<?php include_once("../admin/_procedures.php"); 
setlocale(LC_ALL, 'mk_MK.UTF8');
date_default_timezone_set('Europe/Skopje');

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
$sql = "SELECT *
FROM records
WHERE id_menu =11
AND publish =1
ORDER BY id DESC
LIMIT 0 , 1";
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$id_workgroups=$row["id_workgroups"];
$id_11=$row["id"];
mysqli_free_result($result);
//=====================================================================================================================================
?>
            <div class="col-md-3 col-sm-6 my-container">
              <div class="my-container-tekst">
                <div class="kat_box"><a href="record.php?mv=11&id=<?php echo $row["id"];?>" class="kat_campaing">campaigns</a></div>
                <h1><a href="record.php?mv=11&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
<?php /*?>                <div class="tag">tags: 
                                    <?php
										$sql="Select * from _workgroups order by pr desc";
										$options = mysqli_query($con, $sql);
										$a=1;
										//$allowed2 = array($id_workgroups);
										//echo $id_workgroups;
										$allowed=explode(",",$id_workgroups);
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)) {
											 //$allowed=explode(",",$id_workgroups);
										?>
					
										  <a href="records.php?ht=<?php echo $options_row["id"];?>"><?php echo $options_row["title"];?></a> 
					
											
											
											<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
                
                
                </div><?php */?>
              </div>
              <img class="" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
              
              
              
              
<?php 
//=====================================================================================================================================
$sql = "SELECT *
FROM records
WHERE id_menu =12
AND publish =1
ORDER BY id DESC
LIMIT 0 , 1";
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$id_workgroups=$row["id_workgroups"];
$id_12=$row["id"];
mysqli_free_result($result);
//=====================================================================================================================================
?>
            <div class="col-md-3 col-sm-6 my-container">
              <div class="my-container-tekst">
                <div class="kat_box"><a href="record.php?mv=12&id=<?php echo $row["id"];?>" class="kat_digital">digital</a></div>
                <h1><a href="record.php?mv=12&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
<?php /*?>                <div class="tag">tags: 
                                    <?php
										$sql="Select * from _workgroups order by pr desc";
										$options = mysqli_query($con, $sql);
										$a=1;
								//$allowed2 = array($id_workgroups);
										//echo $id_workgroups;
										$allowed=explode(",",$id_workgroups);
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)) {
											 //$allowed=explode(",",$id_workgroups);
										?>
					
										  <a href="records.php?ht=<?php echo $options_row["id"];?>"><?php echo $options_row["title"];?></a> 
					
											
											
											<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
                
                
                </div><?php */?>
              </div>
              <img class="" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
              
              
              
<?php 
//=====================================================================================================================================
$sql = "SELECT *
FROM records
WHERE id_menu =14
AND publish =1
ORDER BY id DESC
LIMIT 0 , 1";
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$id_workgroups=$row["id_workgroups"];
$id_14=$row["id"];
mysqli_free_result($result);
//=====================================================================================================================================
?>
            <div class="col-md-3 col-sm-6 my-container">
              <div class="my-container-tekst">
                <div class="kat_box"><a href="record.php?mv=14&id=<?php echo $row["id"];?>" class="kat_festival">festivals</a></div>
                <h1><a href="record.php?mv=14&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
<?php /*?>                <div class="tag">tags: 
                                    <?php
										$sql="Select * from _workgroups order by pr desc";
										$options = mysqli_query($con, $sql);
										$a=1;
								//$allowed2 = array($id_workgroups);
										//echo $id_workgroups;
										$allowed=explode(",",$id_workgroups);
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)) {
											 //$allowed=explode(",",$id_workgroups);
										?>
					
										  <a href="records.php?ht=<?php echo $options_row["id"];?>"><?php echo $options_row["title"];?></a> 
					
											
											
											<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
                
                
                </div><?php */?>
              </div>
              <img class="" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
              
              
<?php 
//=====================================================================================================================================
$sql = "SELECT *
FROM records
WHERE id_menu =10
AND publish =1
ORDER BY id DESC
LIMIT 0 , 1";
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}
$id_workgroups=$row["id_workgroups"];
$id_10=$row["id"];
mysqli_free_result($result);
//=====================================================================================================================================
?>
            <div class="col-md-3 col-sm-6 my-container">
              <div class="my-container-tekst">
                <div class="kat_box"><a href="record.php?mv=10&id=<?php echo $row["id"];?>" class="kat_madmen">admen</a></div>
                <h1><a href="record.php?mv=10&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h1>
<?php /*?>                <div class="tag">tags: 
                                    <?php
										$sql="Select * from _workgroups order by pr desc";
										$options = mysqli_query($con, $sql);
										$a=1;
								//$allowed2 = array($id_workgroups);
										//echo $id_workgroups;
										$allowed=explode(",",$id_workgroups);
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)) {
											 //$allowed=explode(",",$id_workgroups);
										?>
					
										  <a href="records.php?ht=<?php echo $options_row["id"];?>"><?php echo $options_row["title"];?></a> 
					
											
											
											<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
                
                
                </div><?php */?>
              </div>
              <img class="" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> 
              </div>
      
      
  </div>
  
  
  
  <!-- Marketing Icons Section -->
  <div class="row">
          
          
          
          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <div class="col-md-8 vesti">
              <div class="col-md-12">
                <div class="linija">
                  <div class="kategorija_h">AdToDate</div>
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
                                AND publish =1
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 1 , ".$admen_count;
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
                                                    <div class="datum kat_campaing"><?php echo $create_date;?></div>
                                                  </td>
                                                </tr>
                                                
                                                <?php } ?>
                                                <?php }?>
                                                
                                          </table>
                                 <?php  mysqli_free_result($result2);?>
                        </div>
                        
                        
                        <?php include("includes/right_2.php");?>
                        <?php //include("includes/right_3.php");?>
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
AND publish =1
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
    <div class="col-md-12">
      <div class="col-md-12"> 
      
      
      
        <!-- THE YOUTUBE PLAYER -->
<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =15
AND publish =1
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
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
			$parts = parse_url($row["intro"]);
			parse_str($parts['query'], $query);
			$youtube_code=$query['v'];
			
			if ($row["picture"]>1) {$youtube_slika="../../uploads/records/".$row["id"]."/".$row["picture"];} else {$youtube_slika='https://img.youtube.com/vi/'.$youtube_code.'/maxresdefault.jpg';}
	       ?>
       

            
         <div class="vid-container">
          <iframe id="vid_frame" src="http://www.youtube.com/embed/<?php echo $youtube_code;?>?rel=0&showinfo=0&autohide=1" frameborder="0" width="711" height="400" allowfullscreen></iframe>
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
<!--            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/eg6kNoJmzkY?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/eg6kNoJmzkY/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Jessica Hernandez & the Deltas - Dead Brains</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/_Tz7KROhuAw?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/_Tz7KROhuAw/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Barbatuques - CD Tum P&aacute; - Sambalel&ecirc;</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/F1f-gn_mG8M?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/F1f-gn_mG8M/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Eleanor Turner plays Baroque Flamenco</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/fB8UTheTR7s?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/fB8UTheTR7s/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Sleepy Man Banjo Boys: Bluegrass</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/0SNhAKyXtC8?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/0SNhAKyXtC8/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Edmar Castaneda: NPR Music Tiny Desk Concert</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/RTHI_uGyfTM?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/RTHI_uGyfTM/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Winter Harp performs Caravan</div></div></div>
              <div class="strelka"></div>
            </div>
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/abQRt6p8T7g?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/abQRt6p8T7g/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">The Avett Brothers Tiny Desk Concert</div></div></div>
              <div class="strelka"></div>
            </div>
            
            
            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/fpmN9JorFew?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><img src="http://img.youtube.com/vi/fpmN9JorFew/0.jpg"></div>
              <div class="desc_front"><div class="outerContainer">
          <div class="innerContainer">Tracy Chapman - Give Me One Reason</div></div></div>
              <div class="strelka"></div>
            </div>-->
            
            
            
          </div>
        </div>
        
        <!-- LEFT AND RIGHT ARROWS -->
        <div class="arrows">
          <div class="arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
          <div class="arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
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
      
<!--      <div class="col-md-4"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Lorem Ipsum е едноставен модел на текст кој се користел во печатарската...</a></h3>
        <div class="datum kat_in">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>
      <div class="col-md-4"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Индустриски стандард кој се корис како модел уште пред 1500 години Индустриски стандард кој се корис како модел уште пред 1500 години</a></h3>
        <div class="datum kat_local">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>
      <div class="col-md-4"> <div class="ogranicen" style="background-image:url(../images/ez.jpg)" onClick="alert();"></div>
        <h3> <a href="zapis.html">Индустриски стандард кој се корис како модел уште пред 1500 години...</a></h3>
        <div class="datum kat_in">01 Септември, 2016 \ <a href="zapis.html">CAMPAIGNS</a></div>
        <p>На книга. И не само што овој модел опстанал пет векови туку почнал да се користи и во електронските медиуми, кој се уште не е променет. Се популаризирал во 60-тите години на дваесеттиот век со издавањето на збирка од страни во кои се наоѓале Lorem Ipsum...</p>
      </div>-->
      
      
      
      
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
    
    
    
    <div class="col-md-4 col-sm-6">
    <?php $count1=0; $count2=2;?>
    <?php include("includes/digital.php");?>
<!--      <div class="my-container vesti_digital">
        <div class="my-container-tekst">
          <div class="kat_box"><a href="zapis.html">Текст кој се користел во
            печатарската индустрија.</a></div>
          <div class="tag kat_digital">tags: <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a></div>
        </div>
        <img class="img-responsive img-portfolio" src="../images/ez.jpg" alt=""> 
        </div>
        
      <div class="my-container vesti_digital">
        <div class="my-container-tekst">
          <div class="kat_box"><a href="zapis.html">Текст кој се користел во
            печатарската индустрија.</a></div>
          <div class="tag kat_digital">tags: <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a></div>
        </div>
        <img class="img-responsive img-portfolio" src="../images/ez.jpg" alt=""> 
        </div>-->
        
    </div>
    
    
    <div class="col-md-8 col-sm-6">
    <?php $count1=2; $count2=1;?>
     <?php include("includes/digital.php");?>
<!--      <div class="my-container vesti_digital">
        <div class="my-container-tekst">
          <div class="kat_box"><a href="zapis.html">Текст кој се користел во
            печатарската индустрија1</a></div>
          <div class="tag kat_digital">tags: <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a> <a href="zapis.html">Digital</a></div>
        </div>
        <img class="img-responsive img-portfolio" src="../images/ez.jpg" alt=""> 
      </div>-->
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
