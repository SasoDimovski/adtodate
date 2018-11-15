<?php
session_start();
if (strlen($link)<=0) {$link=$_SERVER[HTTP_REFERER];}
//echo("link: ".$link."<BR>");
//echo "captcha: ".strtolower($_SESSION['captcha']['code'])."<BR>";
//echo "captcha_pisan: ".strtolower($_POST['captcha_kod'])."<BR>";
if ($_POST['bez_captcha']==1) {
	insert_post();
	} else {
	if (strtolower($_SESSION['captcha']['code'])!=strtolower($_POST['captcha_kod'])) {
		header('Location: '.$link."&komentar=2#komentari");
		}
	else {
		insert_post();
	}
}

function insert_post() {
	global $link;
	require_once("../../../admin/_properties.php");
	include_once("../../../admin/_procedures.php");
	//$post = mysql_prep($_POST["post"]);
	//$name = mysql_prep($_POST["name"]);
	//$post = $_POST["post"];
	//$post = nl2br(htmlspecialchars(mysql_prep($_POST['post'])));
	$post = str_replace('%', 'procenti ',$_POST["post"]);
	$post = str_replace('\'', '%20',$post);
	$post = str_replace('\\', '%20',$post);
	$post = str_replace('/', '%20',$post);
	$post = str_replace('=', '%20',$post);
	$post = nl2br(htmlspecialchars($post));
	
	$name = str_replace('%', 'procenti ',$_POST["name"]);
	$name = str_replace('\'', '%20',$name);
	$name = str_replace('\\', '%20',$name);
	$name = str_replace('/', '%20',$name);
	$name = str_replace('=', '%20',$name);
	$name = nl2br(htmlspecialchars($name));
	
	$record_id = intval($_POST["record_id"]);
	$parent = intval($_POST["parent"]);
	$create_date = date("Y-m-d H:i:s");
	
	//=====================================================================================================================================
	$sql = "insert into forum (post, name, record_id, create_date, parent, hidden, approved) ";
	$sql .= "values ('".$post."', '".$name."', ".$record_id.", '".$create_date."', ".$parent.", 0, 0) ";
	
	//echo($sql."<BR>");
	$result=mysqli_query($con, $sql);
	confirm_query($result);
	
	//echo("link: ".$link."<BR>");
	header('Location: '.$link."&komentar=1#komentari");
}
?>
