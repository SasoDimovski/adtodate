<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);

//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 
?>
<div class="box">
<div class="box-header">
  <h3 class="box-title">Galleries</h3>
</div>
<!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
//ZAPISI STO SE PRIKAZUVAAT
$sql = "
SELECT * 
FROM galleries 
WHERE NOT galleries.id 
IN (select records_gallery.id_gallery FROM records_gallery WHERE records_gallery.id_records=".$tmpID.") 
ORDER BY pr DESC";

$result1 = mysqli_query($con, $sql);
if(! $result1 ){die('Could not get data2: ' . mysqli_error());}
$rowcount1=mysqli_num_rows($result1);
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 

<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount1==0){?>
<div style="clear:both"></div>
<div class="MainTop1Text">NO RECORDS IN DB !</div>
<?php } else {?>
<div class="box-body no-padding table-responsive">
  <table class="table table-hover table-striped table-condensed">
    <tr>
      <td width="2%">PR</td>
      <td>Title</td>
      <td width="15%">Create date</td>
      <td width="15%">Edit date</td>
      <td width="5%">add</td>
    </tr>
    <?php	
	while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
	$i=$i+1;
	//$date = new DateTime($row["Licenca_datum"]);
	//if ($row["Licenca_datum"]) {$date=date_format(new DateTime($row["Licenca_datum"]), 'd.m.Y');}else{$date=NULL;}
	?>
    <tr>
      <td width="5%" title="id:<?php  echo $row1["id"]?>"><?php  echo $row1["pr"]?></td>
      <td><?php  echo $row1["gallery"]?></td>
      <td><?php  echo $row1["create_date"]?></td>
      <td><?php  echo $row1["edit_date"]?></td>
      <td><a class="btn btn-primary btn-xs" onClick="addGallery('<?php echo $row1["id"]?>','<?php echo $tmpID?>','<?php echo $query?>')"><i class="fa fa-plus-square"></i>add</a></td>
    </tr>
    <?php } ?>
  </table>
</div>
<?php }?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php mysqli_free_result($result1); ?>
<div class="box-footer">
  <button  onClick="document.getElementById('popup').style.display='none';document.getElementById('shader').style.display='none';" class="btn btn-primary">Close</button>
</div>
</div>
