<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
$tmpID = $_GET["id"] ;
$tmpPage = $_GET["page"] ;
$tmpMV = $_GET["mv"] ;
$tmpOrder = $_GET["order"] ;
$tmpSort = $_GET["sort"] ;

//$folder=$_GET["folder"];
//$upload_id=$_GET["upload_id"];
$folder="galleries";
$upload_id="17";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>::<?php echo $TmpTitle ?>::</title>
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadifive.min.js" type="text/javascript"></script>

<!-- bootstrap 3.0.2 -->
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Local style -->
<link href="../css/_medium3.css" rel="stylesheet" type="text/css" />
<!-- jQuery UI -->
<link href="../css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="uploadifive.css">

</head>

<body>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Documents</h3>
  </div>
  <div class="box-body table-responsive">
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple>
		<a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')" class="btn btn-primary">Upload Files</a>
	</form>
	<?php 
    $upload_query="?upload_id=".$upload_id;
    $upload_query.="&id=".$tmpID;
    $upload_query.="&folder=".$folder;
    //$upload_query.="&referer=".$_GET["referer"];
	echo "<BR><br>".$upload_query."<BR>";
	echo '/uploads/'.$folder.'/'.$upload_id.'/'."<BR>";
    ?>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadifive({
				'auto'             : false,
				'checkScript'      : 'check-exists.php',
				'formData'         : {
									   'timestamp' : '<?php echo $timestamp;?>',
									   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				                     },
				'queueID'          : 'queue',
				'uploadScript'     : 'uploadifive.php<?php echo $upload_query;?>',
				'onUploadComplete' : function(file, data) { console.log(data); }
			});
		});
	</script>
    </div>
      <div class="box-footer">
    <a onclick="window.history.back()" class="btn btn-default">Back</a>
  </div>
</div>
</body>
</html>