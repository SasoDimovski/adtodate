       
<?php 
//=====================================================================================================================================
$kat="12";
if ($_GET["mv"]==12) {$kat="13";}

$sql = "Select * FROM _menu WHERE id=".$kat;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}

$title1=$row["title"];

mysqli_free_result($result);
   
//=====================================================================================================================================
?>
        <div class="linija">
          <div class="kategorija_h">Напишавме</div>
        </div>
        
<?php 
//=====================================================================================================================================
$sql3 = "SELECT *
FROM records
WHERE publish =1 and id_menu<>15  AND create_date<'".$date1."'
order by
 pr desc, id desc 
LIMIT 0 , 5";
//die($sql);
$result3=mysqli_query($con, $sql3);
$rowcount3=mysqli_num_rows($result3);
//if ($result){$row = mysqli_fetch_array($result);}
//=====================================================================================================================================
?>
        <div class="napisavme">
          <table>
			<?php if ($rowcount3==0){?>
            <div class="box-body">NO RECORDS IN DB !</div>
            <?php } else {?>
          <?php	
			while($row = mysqli_fetch_array($result3, MYSQL_ASSOC)) { 
			$i=$i+1;
			$create_date=$row["create_date"];
			$edit_date=$row["edit_date"];
			//if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
			if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
	       ?>
   
            <tr>
              <td class="napisavme_cas"></td>
              <td class="napisavme_tekst"><span class="datum"><?php echo $create_date;?></span><br>
                <a href="record.php?mv=<?php echo $kat;?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a></td>
            </tr>
            
            
            
<?php } ?>


<?php }?>
          </table>
        </div>



 <?php  mysqli_free_result($result2);   ?>