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
    <h3 class="box-title">Documents</h3>
  </div>
  <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
  <?php 
//ZAPISI STO SE PRIKAZUVAAT
		$sql = "
		SELECT documents.id, 
		       documents.pr,
			   documents.create_date,
			   documents.edit_date,
			   documents.title, 
	           documents.description, 
			   documents.file,
			   documents.publish
		FROM documents 
		WHERE NOT documents.id 
		IN(
			SELECT records_documents.id_documents 
			FROM records_documents 
			WHERE records_documents.id_records=".$tmpID."
		   ) 
		ORDER BY pr DESC";
//die($sql);
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
   
        <th width="2%">PR</td>
        <th>Title</th>
        <th>File</th>
        <th width="10%">Created date</th>
        <th width="10%">Edit date</th>
        <th width="5%">Publish</th>
       <th width="5%">add</td>
      </tr>
      <?php	
	while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)) { 
	$i=$i+1;
	//$date = new DateTime($row["Licenca_datum"]);
	//if ($row["Licenca_datum"]) {$date=date_format(new DateTime($row["Licenca_datum"]), 'd.m.Y');}else{$date=NULL;}
	?>
      <tr>
        <td title="id:<?php  echo $row1["id"]?>"><?php  echo $row1["pr"]?></td>
        <td title="<?php  echo $row1["title"]?>"><a href="../../uploads/documents/<?php  echo $row1["id"]?>/<?php  echo $row1["file"]?>" target="_blank"><?php if (strlen($row1["title"])>80 ){echo substr($row1["title"], 0, 80)."...";} else {  echo $row1["title"];}?></a></td>

   <td><?php  echo $row1["file"]?></td>
           <td><?php  echo $row1["create_date"]?></td>
        <td><?php  echo $row1["edit_date"]?></td>
        
        <td><?php  if ($row1["publish"]==1) {echo "<i class=\"fa fa-check\"></i>";}else {echo "<span class=\"warning\"><i class=\"fa fa-warning\"></i> no </span>";}?></td>

      <td><a class="btn btn-primary btn-xs" onClick="addDocument('<?php echo $row1["id"]?>','<?php echo $tmpID?>','<?php echo $query?>')"><i class="fa fa-plus-square"></i> add</a></td>
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
