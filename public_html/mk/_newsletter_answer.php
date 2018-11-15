<?php include_once("../admin/_properties.php"); ?>
<?php include_once("../admin/_procedures.php"); ?>
<?php 
//=====================================================================================================================================
date_default_timezone_set('Europe/Skopje');
 session_start(); ?>
<?php if ( $_SESSION["NEWSLETTER_MASSAGE"]=="") {header('Location:index.php') ;} ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>ADTODATE</title>

<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/modern-business.css" rel="stylesheet">
<link href="../css/adtodate.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:regular,light,bold" rel="stylesheet">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--PRETTYPHOTO CSS-->
<link href="../css/prettyPhoto.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="icon" type="image/png" href="../images/favicon.png" />

</head>

<body>

<!-- Navigation -->
<?php 
include("includes/menu.php");
?>

<!-- Page Content -->
<div class="container">


  <div class="row bez_padding"> </div>
  
  
  
  <!-- Marketing Icons Section -->
  <div class="row">
  
<br>
<br>
<br>
<br>
<br><p><em  style="color:green;"><?php echo $_SESSION["NEWSLETTER_MASSAGE"];?></em></p>
<br>
<br>
<br>
<br>
<br>
<br>

  </div>
  
  <!-- /.row -->
  
 <hr>

  
  <!-- Footer -->
  
  <?php include("includes/footer.php");?>

</div>
<!-- /.container --> 


<!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
<!--PRETYPHOTO JS--> 
<script src="../js/jquery.prettyPhoto.js"></script> 
 
<?php include_once("includes/analyticstracking.php") ?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($con) ;
?>
<?php   $_SESSION["NEWSLETTER_MASSAGE"] = "";
 $_SESSION["NEWSLETTER_NAME"] = "";
 $_SESSION["NEWSLETTER_EMAIL"] = ""; 
 ?>