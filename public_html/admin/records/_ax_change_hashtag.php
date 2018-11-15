<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$id = $_GET["id"] ;
$id_record = $_GET["id_record"] ;
$mv = $_GET["mv"] ;

///$query = urldecode($_SERVER['QUERY_STRING']);
//$query= str_replace("&id=".$tmpID,"",$query);

//=========================================================================== 
//print_r ("id:".($id)."<br>");
//print_r ("id_record:".($id_record)."<br>");
//print_r ("mv:".($mv)."<br>");
//=========================================================================== 
?>
<div class="box">

    <!-- DB LOGIKA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php 
    $sql = "Select * FROM _workgroups WHERE id=".$id_record;
    //die($sql);
    $result=mysqli_query($con, $sql);
    if ($result){$row = mysqli_fetch_array($result);}
    
    
    //$id=$row["id"];
    $title=$row["title"];
    ?>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --> 
    <div class="col-xs-12">
        <div class="box-header">
      
  
       <form name="form2" id="form2"  method="post" action="_record_hashtag.php" onSubmit="return ValidationSubmit(this);" >
       
       <input name="id" id="id" type="hidden" value="<?php  echo $id?>" />  
       <input name="id_record" id="id_record" type="hidden" value="<?php  echo $id_record?>" />        
       <input name="mv" id="mv" type="hidden" value="<?php  echo $mv?>" />
       
                   <div class="form-group">
                 
                    <h3 class="box-title">Title</h3>
                    <input name="title" id="title" type="text" class="form-control" placeholder="Title..." value="<?php echo htmlspecialchars($title, ENT_COMPAT, 'UTF-8') ?>" maxlength="300" autocomplete="off"/>
                </div> 
       </form>
        <button  onClick="document.getElementById('popup').style.display='none';document.getElementById('shader').style.display='none';" class="btn btn-primary">Close</button>
        <button type="submit" class="btn btn-danger" onClick="document.getElementById('form2').submit()">Submit</button> 
       
       
      </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php mysqli_free_result($result1); ?>
    <div class="box-footer">
      
    </div>
    </div>
</div>
