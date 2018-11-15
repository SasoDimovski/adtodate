<?php
session_start();
$TmpSuperTitle = "ADTODATE";
$TmpTitle = "ADMIN - ADTODATE";
$TmpUrl = "http://www.adtodate.mk";
$TmpAdminSession = "ADTODATE";
//$TmpUploadFolder = "/home/svedok/uploads/";
$TmpUploadFolder = $_SERVER['DOCUMENT_ROOT']."/uploads/";




$TextErrorLogin = "Wrong Username or Password!";


$TextUser = "USER";
$TextEncoder = "CYRILLIC ENCODER";
$TextLogoff = "LOG-OFF";
$TextMedium3 = "Developed by MEDIUM3";

$FTPUSER = "svedok";
$FTPPASSWORD = "5?#)b;V6)`$!tjB4";

//==========================================================================================================
//mysqli_connect(host,username,password,dbname,port,socket); 

//host 	    Optional. Specifies a host name or an IP address
//username 	Optional. Specifies the MySQL username
//password 	Optional. Specifies the MySQL password
//dbname 	Optional. Specifies the default database to be used
//port 	    Optional. Specifies the port number to attempt to connect to the MySQL server
//socket 	Optional. Specifies the socket or named pipe to be used
$TmpMyAdmin = "http://67.220.183.122/phpmyadmin";
define("host", "localhost");
define("username", "adtodate_user");
define("password", "67220183122");
define("dbname", "adtodate_db");
define("port", "3306");

$con=mysqli_connect(host,username,password,dbname,port);


// Proverka za konekcija so DB
//==========================================================================================================
if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}

$con->query( "SET NAMES 'utf8'");


?>