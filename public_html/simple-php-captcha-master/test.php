<?php
session_start();
echo strtolower($_SESSION['captcha']['code'])."<BR>";
echo strtolower($_POST['kod']);
?>