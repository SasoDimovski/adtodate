<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>

<?php session_start(); ?>

<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>

<?php

$tmpID = $_GET["id"] ;

//=========================================================================== 
print_r ("tmpID:".($tmpID)."<br>");
//=========================================================================== 
	
//kreiraj folder//===========================================================
	$upload_dir = $TmpUploadFolder."galleries/".$tmpID ;
	if (!file_exists($upload_dir)) {
    	mkdir($upload_dir, 0777, true);
	}
//============================================================================
				
				
				
$uploadDir = '/uploads/galleries/'.$tmpID.'/';
$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	//===========================================================================
	echo "uploadDir: ".$uploadDir."<BR>";
	echo "verifyToken: ".$verifyToken."<BR>";

	//===========================================================================

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	
	$file_tmp_name = $_FILES['Filedata']['tmp_name'];
	$file_name = $_FILES['Filedata']['name'];
	$file_type = $_FILES['Filedata']['type'];
    $file_size = $_FILES['Filedata']['size'];
	$file = basename($_FILES['Filedata']['name']);
	//===========================================================================
	echo "file_tmp_name: ".$file_tmp_name."<BR>";
	echo "file_name: ".$file_name."<BR>";
	echo "file_type: ".$file_type."<BR>";
	echo "file_size: ".$file_size."<BR>";
	echo "file: ".$file."<BR>";
	//===========================================================================
	
	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
	
	$fileTypes = array("jpg", "jpeg", "png", "gif", "bmp", "JPG", "JPEG", "PNG", "GIF", "BMP");
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
		//===========================================================================
	echo "uploadDir: ".$uploadDir."<BR>";
	echo "fileTypes: ".$fileTypes."<BR>";
	echo "fileParts: ".$fileParts."<BR>";
    //echo "ext: ".strtolower($fileParts['extension'])."<BR>";
	//===========================================================================
	
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
		
		echo "file: ".$file."<BR>";
		$ext = getExtension($file);
		
		echo "ext: ".$ext."<BR>";	
		$upload_dir=$upload_dir."/";
		$actual_image_name = date("Ymd_His")."_".$file;//.".".$ext;
		$actual_image_name = str_replace("   ","_",$actual_image_name);
		$actual_image_name = str_replace("  ","_",$actual_image_name);
		$actual_image_name = str_replace(" ","_",$actual_image_name);
		echo "ext: ".$ext."<BR>";
		echo "actual_image_name: ".$actual_image_name."<BR>";
		
		$widthArray = array(900,200,70); //You can change dimension here.
		foreach($widthArray as $newwidth)
		{
			
			
			
	        //$filename=compressImage($ext,$file_tmp_name,$upload_dir,$actual_image_name,$newwidth);
			//$filename=substr($filename, 14); // go otsekuvam delot /home/Roliaba1
			
					if ($i==0){$suffix="";}else{$suffix="tn".$i."_";}
					$filename=compressImage($ext,$file_tmp_name,$upload_dir,$actual_image_name,$newwidth,$suffix);
					$filename=substr($filename, 13); // go otsekuvam delot /home/Roliaba1
					$i=$i+1;
					//===========================================================================
					echo "filename: ".$filename."<BR>";
					echo "<img src='".$filename."' class='preview_img'/>";
					//===========================================================================
			
			
		}
		
		// Save the file
		//move_uploaded_file($file_tmp_name, $upload_dir.$actual_image_name);
		//move_uploaded_file($tempFile, $targetFile);
		//echo 1;

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	    $date=date('Y-m-d H:i:s');
		$sql = "INSERT INTO galleries_pictures (pr,
		                                        create_date, 
									            edit_date, 
		                                        file,
												description,
		                                        id_galleries
												) 
										 values 
												('',
							                     '$date',
									             '$date',
												 '$actual_image_name',
												 '',
												 '$tmpID'
												 )";
		$result=mysqli_query($con, $sql);
		mysqli_free_result($result);
		
		
		$Last_ID=mysqli_insert_id($con);
		$sql = "UPDATE galleries_pictures SET pr = ".$Last_ID." WHERE ID=".$Last_ID;
		$result=mysqli_query($con, $sql);
		mysqli_free_result($result);
	    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////v
			

	} 
	else 
	{
	 echo 'Invalid file type.';
	}
		
	
}

mysqli_close($con) ;
?>