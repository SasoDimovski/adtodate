
<html>
<head>
<title>Ajax Image Upload 9lessons blog</title>
</head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="../image_process/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() {

            $('#photoimg').die('click').live('change', function()			{
			           //$("#preview").html('');

				$("#imageform").ajaxForm({target: '#preview',
				     beforeSubmit:function(){


					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 },
					success:function(){

					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					},
					error:function(){

					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();


			});
        });
</script>

<style>

body
{
font-family:arial;
font-size:12px;
}
.preview
{
width:300px;
border:solid 1px #dedede;
padding:6px;
margin-right:10px;
}
.img
{
border:solid 1px #dedede;
padding:6px;
margin-right:10px;
}
#preview
{
font-size:12px;
}


</style>
<body>
<table width="100%">
<tr>
<td valign="top">
<h1>Ajax Upload and Resize an Image with PHP.</h1>

<?php

session_start();
$session_id='1'; // User login session value
?>
<div id='preview'></div>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
Upload image: 
<div id='imageloadstatus' style='display:none'><img src="../image_process/loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photoimg" id="photoimg" />

</div>
</form>


<td>

</tr></table>


</body>
</html>
