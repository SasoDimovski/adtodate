<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =12
AND publish =1 AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT ".$count1." , ".$count2;
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
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
	       ?>
<div class="my-container vesti_digital" <?php if($count2==1) {?>style="margin:0 7px 7px 0"<?php };?>>
  <div class="my-container-tekst">
                <div class="kat_box">
<a href="record.php?mv=<?php echo $row["id_menu"];?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></div>
</div>
  <img class="slika_gradient" src="../../uploads/records/<?php echo $row["id"];?>/tn1_<?php echo $row["picture"];?>" alt=""> </div>
<?php } ?>
<?php }?>
<?php  mysqli_free_result($result2);   ?>
