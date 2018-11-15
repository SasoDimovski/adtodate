<?php include_once("../_properties.php"); ?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php $tmpUser = $_POST["username"] ;?>
<?php $tmpPassword = $_POST["password"] ;?>
<?php //echo ("tmpUser:".$tmpUser."<br>")?>
<?php //echo ("tmpPassword:".$tmpPassword."<br>")?>
<?php if ($tmpUser!=''||$tmpPassword!=''){;?>
<?php 
$result = mysqli_query($con,"SELECT * FROM AdminUsers where User='".$tmpUser."' and Password='".$tmpPassword."'");
//echo ("SELECT * FROM AdminUsers where User='".$tmpUser."' and Password='".$tmpPassword."'"."<br>");
$rowcount=mysqli_num_rows($result);
if ($result){$row = mysqli_fetch_array($result);}
//echo $rowcount;
?>
<?php if ($rowcount!=0) {;?>
<?php if ($row["ID"]=='1'||$row["ID"]=='2') {$_SESSION["SUPERADMIN"] ="yes";} ;?>
<?php  $_SESSION[$TmpAdminSession] = "yes";?>
<?php  $_SESSION["USER"] = $row["User"];?>
<?php  $_SESSION["NAME"] = $row["Name"];?>
<?php  $_SESSION["SURNAME"] = $row["Surname"];?>
<?php  mysqli_close($con);?>
<?php  //echo ("TmpAdminSession:".$_SESSION[$TmpAdminSession]."<br>")?>
<?php header('Location: ../!Main/ModulList.php?mv=8'); ?>
<?php } else {;?>
<?php $tmpError = "yes";?>
<?php mysqli_close($con) ;?>
<?php } ;?>
<?php };?>
<!--////////////////////////////////////////////////////////////////////////////////////////////////-->
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>:: <?php echo $TmpTitle ?> ::</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><?php echo $TmpSuperTitle ?> (<?php echo $TmpUrl ?>)</div>
            <form action="Login.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" maxlength="20"/>
                    </div>          
<!--                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>-->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    
<!--                    <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            </form>

            <div class="margin text-center">
                <span><?php if ($tmpError=="yes") {echo $TextErrorLogin;};?></span>
                <br/>
<!--                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>-->

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>