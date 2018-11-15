<?php
//http://www.9lessons.info/ script
function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i)
	{
		return "";
	}
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	$ext=strtolower($ext);
	return $ext;
}

function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
{

	if($ext=="jpg" || $ext=="jpeg" )
	{
		$src = imagecreatefromjpeg($uploadedfile);
	}
	else if($ext=="png")
	{
		$src = imagecreatefrompng($uploadedfile);
	}
	else if($ext=="gif")
	{
		$src = imagecreatefromgif($uploadedfile);
	}
	else
	{
		$src = imagecreatefrombmp($uploadedfile);
	}
	
	list($width,$height)=getimagesize($uploadedfile);
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $path.$newwidth.'_'.$actual_image_name; //PixelSize_TimeStamp.jpg
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
	return $filename;
}
?>