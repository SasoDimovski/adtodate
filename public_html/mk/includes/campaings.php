
        
<?php 
$campain_count=5-($banners7+1);
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =11
AND publish =1 and id<>".$id_temp."  AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT 0 , ".$campain_count;
//die($sql);
$result2=mysqli_query($con, $sql2);
$rowcount2=mysqli_num_rows($result2);
//if ($result){$row = mysqli_fetch_array($result);}
//=====================================================================================================================================
?>
<table>
  <?php if ($rowcount2==0){?>
  <div class="box-body">NO RECORDS IN DB !</div>
  <?php } else {?>
  <?php	
			while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
			$i=$i+1;
			$create_date=$row["create_date"];
			$edit_date=$row["edit_date"];
			$id_workgroups=$row["id_workgroups"];
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
            if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
	       ?>
  <tr>
    <td class="campaigns_mali_slika" style="background-image:url(../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>);background-position: center; background-size:auto 130px"><div onClick="window.open('record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>','_self');"></div></td>
    <td class="campaigns_mali_tekst"><a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a>
      <div class="tag">Таг: 
              
              
              
                                <?php
										$sql="Select * from _workgroups order by pr desc";

										$options = mysqli_query($con, $sql);
										$a=1;
										//$allowed2 = array($id_workgroups);
										$allowed=explode(",",$id_workgroups);
										//echo $allowed;
										while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC))
											{if(in_array($options_row["id"],$allowed)&&$a<3) {
											 
										?>
					
								  <a href="records.php?ht=<?php echo $options_row["id"];?>"><?php echo $options_row["title"];?></a> 
					
											
											
									<?php $a=$a+1;
											} }
										 mysqli_free_result($options);
                                     ?>
              
              
            
              
              
              
      </div>
              
              
              
    </td>
              
  
  </tr>
            
<?php } ?>


<?php }?>
</table>




 <?php  mysqli_free_result($result2);   ?>