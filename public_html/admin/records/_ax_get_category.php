<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$tmpID = $_GET["id"] ;
$tmpID_MENU = $_GET["id_menu"] ;


$query = urldecode($_SERVER['QUERY_STRING']);
$query= str_replace("&id=".$tmpID,"",$query);

//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 
?>
<div class="box">
<div class="box-header">
  <h3 class="box-title">Categories</h3>
</div>
<!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
//ZAPISI STO SE PRIKAZUVAAT
$sql = "
SELECT * 
FROM _menu 
WHERE visibility_in=1 AND protected=1 AND id<>".$tmpID_MENU."
ORDER BY pr ASC";

$result1 = mysqli_query($con, $sql);
if(! $result1 ){die('Could not get data2: ' . mysqli_error());}
$rowcount1=mysqli_num_rows($result1);
?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 

<!-- TABELA SO PRIKAZI //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($rowcount1==0){?>
<div class="box-body">NO RECORDS IN DB !</div>
<?php } else {?>
<div class="box-body no-padding table-responsive">
  <table class="table table-hover table-striped table-condensed">
    <?php	
	while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
	$i=$i+1;
	//$date = new DateTime($row["Licenca_datum"]);
	//if ($row["Licenca_datum"]) {$date=date_format(new DateTime($row["Licenca_datum"]), 'd.m.Y');}else{$date=NULL;}
	?>
    <tr>

      <td><?php if($row1["id_parent"]<>"0"){?>&nbsp;&nbsp;&nbsp;<?php }?><?php  echo $row1["title"]?></td>
      <td width="5%">
      <?php  //echo $row1["id_parent"];
	  
	 // if($row1["id_parent"]<>"0"){?>
      <a class="btn btn-primary btn-xs" onClick="addCategory('<?php echo $tmpID?>','<?php echo $row1["id"]?>')"><i class="fa fa-plus-square"></i>change</a>
      <?php //}?>
      
      </td>
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
