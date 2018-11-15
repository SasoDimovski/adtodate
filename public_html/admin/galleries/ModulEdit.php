<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_GET["id"] ;

$query = urldecode($_SERVER['QUERY_STRING']);
//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("query:".($query)."<br>");
//=========================================================================== 


//=====================================================================================================================================
$sql = "Select * FROM galleries WHERE id=".$tmpID;
//die($sql);
$result=mysqli_query($con, $sql);
if ($result){$row = mysqli_fetch_array($result);}


$id=$row["id"];
$pr=$row["pr"];
$create_date=$row["create_date"];
$edit_date=$row["edit_date"];
if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd.m.Y H:i:s');}
if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}

$title=$row["title"];
$description=$row["description"];
$publish=$row["publish"];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>::<?php echo $TmpTitle ?>::</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<!-- bootstrap 3.0.2 -->
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Local style -->
<link href="../css/_medium3.css" rel="stylesheet" type="text/css" />
<!-- jQuery UI -->
<link href="../css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />


<script src="../js/_main.js"></script>
<script src="../js/ajaxCaller.js"></script>






<script language="JavaScript">
<!--
function ValidationSubmit()
{
if (document.getElementById('title').value=='')
  {alert('Field "Title" is mandatory!');return false;}
}

function DeleteRecord(id, description, query) {
//alert (query)

	if (confirm("Are you sure you want to delete this record?\n" + description+"\nID:"+id))
	{
	window.location.href = '_delete_picture.php'+query+'&id=' + id;
	}
} 


//-->
</script>
</head>

    <body class="skin-blue">

        <!-- header logo: style can be found in header.less -->
        <?php include_once("../_header.php"); ?>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include_once("../_menu.php"); ?>
<div id="shader" class="shader"></div>
<div id="popup" class="popup_center"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   


<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->
                <section class="content-header">
					<?php 
							$sql1 = "Select * FROM _menu WHERE id=".$_GET["mv"];
							//die($sql);
							$result1=mysqli_query($con, $sql1);
							if ($result1){$row1 = mysqli_fetch_array($result1);}
							$title1=$row1["title"];
							mysqli_free_result($result1);
                    ?>
                    <h1><?php echo $title1;?>(<small class="fa"><?php if ($result){echo "ID:".$id.", PR:".$pr;}else{ echo "new";}?> </small>)</h1>
                    <ol class="breadcrumb">
                       <!-- <li><i class="fa fa-user"></i> Activities </li>-->
                        <!--<li class="active">Blank page</li>-->
                    </ol>
                </section>
<!-- Content Header (Page header)/////////////////////////////////////////////////////////////////////////////////////////// -->
    
    <!-- Main content --> 
    
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box"> 
            <!--                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>                                    
                                </div>--><!-- /.box-header -->
            
            <div class="box-body table-responsive"> 
              <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
             
              <div class="col-xs-6">
              
                <form name="form1" method="post" action="_record.php" onSubmit="return ValidationSubmit(this);" enctype="multipart/form-data">
                
                   <input name="id" id="id" type="hidden" value="<?php  echo $tmpID?>" />          
                   <input name="query" id="query" type="hidden" value="<?php  echo $query?>" /> 
                   
                       <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"    id="publish" name="publish" value="1"  <?php if ($publish=="1"){echo "checked";}?>/>
                                   Publish
                                </label>                                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Title..." id="title" name="title" value="<?php echo htmlspecialchars($title, ENT_COMPAT, 'UTF-8') ?>" maxlength="300"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="3" class="form-control" id="description" placeholder="Description..."><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Created date</label>
                            <input type="text" class="form-control" placeholder="Created date ..." disabled value="<?php echo $create_date ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Edit date</label>
                            <input type="text" class="form-control" placeholder="Edit date ..." disabled value="<?php echo $edit_date ?>"/>
                        </div>
                  
                  
                  
                  <button type="submit" class="btn btn-primary">Submit</button>
                   <?php if ($tmpID<>"") {?>
                  <a class="btn btn-default" href="../galleries_uploadifive/ModulEdit.php?<?php echo $query ?>" style=" margin-left:100px"  role="button">Add pictures</a>
                   <?php }?>
                  
                  
                  <br>
                  <br>
                </form>
                
                
                

                <?php if ($tmpID<>"") {?>
                
                
                 <?php 
				 
				    $sql="SELECT * FROM galleries_pictures WHERE id_galleries=".$tmpID." ORDER BY pr DESC";
                    $options = mysqli_query($con, $sql);
					$rowcount=mysqli_num_rows($options);
					?>
                <div class="form-group">
                  <label>Pictures</label>
                  <?php if ($rowcount==0){?>

                    <div style="clear:both"></div>
                    <div class="MainTop1Text">NO RECORDS IN DB !</div>
                
                  <?php } else {?>
                  <table class="table table-striped table-condensed">
                  <tr>
                    <th width="2%" nowrap>PR</th>
                    <th width="2%" nowrap>ID</th>
                    <th width="5%"></th>
                    <th nowrap>Pictire</th>
                    <th nowrap>Description</th>
                    <th nowrap>Edit</th>
                    <th nowrap>Delete</th>
                  </tr>
                  
                    <?php
				    }
                    while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) {
                        $option_id=$options_row["id"];?>
                    <tr>
                    <td width="2%"><?php  echo $options_row["pr"]?></td>
                    <td width="2%"><?php  echo $options_row["id"]?></td>
                    <td width="5%" nowrap>
                    <a href="_move_picture.php?<?php echo $query?>&id_pic=<?php echo $options_row["id"]?>&pr_pic=<?php echo $options_row["pr"]?>&dir=top" title="to the top"><i class="fa fa-angle-double-up"></i></a>&nbsp;
                    <a href="_move_picture.php?<?php echo $query?>&id_pic=<?php echo $options_row["id"]?>&pr_pic=<?php echo $options_row["pr"]?>&dir=up" title="one level up"><i class="fa fa-angle-up"></i></a>&nbsp;
                    <a href="_move_picture.php?<?php echo $query?>&id_pic=<?php echo $options_row["id"]?>&pr_pic=<?php echo $options_row["pr"]?>&dir=down" title="one level down"><i class="fa fa-angle-down"></i></a>&nbsp;
                    <a href="_move_picture.php?<?php echo $query?>&id_pic=<?php echo $options_row["id"]?>&pr_pic=<?php echo $options_row["pr"]?>&dir=bottom" title="to the bottom"><i class="fa fa-angle-double-down"></i></a>
                    </td>
                    
                    
                    
                      <td width="10%">
                      <a href="/uploads/<?php echo "/galleries/".$tmpID."/".$options_row["file"]?>" target="_blank"><img src="/uploads/<?php echo "/galleries/".$tmpID."/tn1_".$options_row["file"]?>" class="preview_thumb"></a>
                      </td>
                      
                      
                      <td>
                      <form name="form_description<?php echo $option_id?>" method="post" action="_record_description.php">
                      
                      
                          <input name="query" id="query" type="hidden" value="<?php  echo $query?>" /> 
                          <input name="picture_id" id="picture_id" type="hidden" value="<?php  echo $option_id?>" />
                          
                          <textarea name="description" rows="2" class="form-control" id="description<?php $options_row["id"]?>" placeholder="Description..."><?php echo $options_row["description"] ?></textarea>

                          
                      
                        
                        </td>
                      <td>

                          <button type="submit" class="btn btn-primary btn-xs">Edit Description</button>
                          
                        </form>
                        
                        </td>
                      <td>
<a class="btn btn-danger btn-xs" onClick="DeleteRecord('<?php echo $options_row["id"]?>','(file: <?php $temp=$options_row["file"]; $temp=str_replace("'"," ",$temp);echo str_replace("\""," ",$temp);?>)','?<?php echo $query?>')"<i class="fa fa-exclamation-triangle"></i> Delete</a>
                      </td>
                        
                        
                    </tr>
                    <?php } 
						mysqli_free_result($options);?>
                  </table>


                  
                  
                  
                  </div>
                <?php } ?>
                
                

              </div>
<div class="col-xs-6">



</div>
              
              <div class="box-footer"></div>
              
              <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
            </div>
            <!-- /.box-body --> 
            
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content --> 
    
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--> 
    
  </aside>
  <!-- /.right-side --> 
</div>
<!-- ./wrapper --> 



        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/app.js" type="text/javascript"></script>

</body>
</html>
<?php mysqli_close($con) ;?>