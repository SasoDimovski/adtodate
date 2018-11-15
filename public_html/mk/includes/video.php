
        
<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =15
AND publish =1 AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT 1 , 4";
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
		  $i=0;
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
			
			if ($row["picture"]>1) {$youtube_slika="../../uploads/records/".$row["id"]."/tn2_".$row["picture"];} else {$youtube_slika='https://img.youtube.com/vi/'.$youtube_code.'/maxresdefault.jpg';}
	       ?>
       

      
           <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/<?php echo $youtube_code;?>?autoplay=1&rel=0&showinfo=0&autohide=1';document.getElementById('front_image').style.display = 'none';document.getElementById('video_datum').innerHTML = '<?php echo $row["create_date"]?>';document.getElementById('video_naslov').innerHTML = '<?php echo $row["title"]?>';">
              <div class="thumb"><img src="<?php echo $youtube_slika;?>"></div>
              <div class="desc_front">
                  <div class="outerContainer">
                  <div class="facebook"><iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fadtodate.mk%2Fmk%2Frecords.php%3Fmv%3D15%23prettyPhoto%2F<?php echo $i;?>%2F&layout=button&size=small&mobile_iframe=true&appId=1386925178048229&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>
                      <div class="innerContainer"><?php echo $row["title"];?></div>
                  </div>
              </div>
              <div class="strelka"></div>
            </div>
      

            
<?php } ?>


<?php }?>

           <div class="vid-item" onClick="window.open('records.php?mv=15','_self');document.getElementById('front_image').style.display = 'none';">
              <div class="thumb"><div class="outerContainer">
                      <div class="innerContainer div_more_video"><a href="records.php?mv=15">повеќе<br>
видеа</a></div>
                  </div></div>
              <div class="desc_front">
                  <div class="outerContainer">
                      <div class="innerContainer div_more_video"><a href="records.php?mv=15">повеќе<br>
видеа</a></div>
                  </div>
              </div>
              
            </div>

 <?php  mysqli_free_result($result2);   ?>