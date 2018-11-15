       
<?php 
//=====================================================================================================================================
$kat="10";

if ($_GET["mv"]==2) {$kat="13";}
if ($_GET["mv"]==6) {$kat="13";}
if ($_GET["mv"]==9) {$kat="11";}
if ($_GET["mv"]==10) {$kat="13";}
if ($_GET["mv"]==11) {$kat="9";}
if ($_GET["mv"]==12) {$kat="14";}
if ($_GET["mv"]==13) {$kat="10";}
if ($_GET["mv"]==14) {$kat="12";}
if ($_GET["mv"]=='') {$kat="13";}

$sql = "Select * FROM _menu WHERE id=".$kat;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}

$title1=$row["title"];

mysqli_free_result($result);
   
//=====================================================================================================================================
?>
        <div class="linija">
          <div class="kategorija_h"><?php echo $title1;?></div>
        </div>
        
<?php 
//=====================================================================================================================================
$sql2 = "SELECT *
FROM records
WHERE id_menu =".$kat."
AND publish =1 AND create_date<'".$date1."'
order by
create_date desc, pr desc, id desc 
LIMIT 0 , 5";
//die($sql);
$result2=mysqli_query($con, $sql2);
$rowcount2=mysqli_num_rows($result2);
//if ($result){$row = mysqli_fetch_array($result);}
//=====================================================================================================================================
?>
        <div class="madmen_mali">
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
              <td class="madmen_mali_slika"><a href="record.php?mv=<?php echo $kat;?>&id=<?php echo $row["id"];?>"> <img class="img-responsive img-hover" src="../../uploads/records/<?php echo $row["id"];?>/tn2_<?php echo $row["picture"];?>" alt=""> </a></td>
              <td class="madmen_mali_tekst"><h3> <a href="record.php?mv=<?php echo $kat;?>&id=<?php echo $row["id"];?>"><?php echo $row["title"];?></a> </h3>
              <?php if ($_GET["mv"]==13){?>
                <p><?php echo $row["reporter"];?><br><?php echo $row["subtitle"];?></p>
               <?php }?> 
                <div class="datum kat_campaing"><?php echo $create_date;?></div></td>
            </tr>
            
<?php } ?>


<?php }?>
          </table>
        </div>



 <?php  mysqli_free_result($result2);   ?>