
        
<?php 
//=====================================================================================================================================
$sql2 = "
SELECT records.id, 
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
	   _menu.title as _menu_title
FROM records
INNER JOIN _menu 
ON records.id_menu=_menu.id

WHERE records.publish=1 and records.id not in (".$site_main.") 
ORDER BY records.cover desc, records.pr desc, records.id desc 
LIMIT 0, 4
";

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
			//die($sql2);
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y');}
			
            if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
			
	       ?>
         
        <div class="col-md-6"> 
        
            <div class="ogranicen" style="background-image:url(../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>)" onClick="window.open('record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>','_self');"></div>
            <h3> <a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></h3>
            <div class="datum kat_in"><?php echo $create_date ?> <a href="records.php?mv=<?php echo $row["id_menu"];?>"><?php echo $row["_menu_title"];?></a></div>
            <p><?php echo $row["intro"];?></p>
            
        </div> 
              
              
              
              

            
<?php } ?>


<?php }?>
          
  



 <?php  mysqli_free_result($result2);   ?>