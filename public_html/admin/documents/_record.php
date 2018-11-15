<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;

	//===========================================================================
	//echo "tmpID: ".$tmpID."<BR>";
	//echo "tmpQuery: ".$tmpQuery."<BR><BR>";
	//===========================================================================

$upload_errors = array(
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	UPLOAD_ERR_NO_FILE 		=> "No file.",
	UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

	$file_tmp_name = $_FILES['file']['tmp_name'];
	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
	$file = basename($_FILES['file']['name']);
	//===========================================================================
//	echo "file_tmp_name: ".$file_tmp_name."<BR>";
//	echo "file_name: ".$file_name."<BR>";
//	echo "file_type: ".$file_type."<BR>";
//	echo "file_size: ".$file_size."<BR>";
//	echo "file: ".$file."<BR><BR>";
	//===========================================================================


$title=$_POST["title"];
$description=$_POST["description"];
$file1=$_POST["file1"];

$id_countries=$_POST["id_countries"];
$id_workgroups=$_POST["id_workgroups"];
$publish=$_POST["publish"];if ($_POST["publish"]==""){$publish=0;}

////$id_languages=========================================================================== 
//			$sql="Select * from _languages order by id asc";
//			$options = mysqli_query($con, $sql);
//			$a=1;
//			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
//				 {
//				  $temp=$_POST["id_languages".$a];
//				  if ($temp<>"") { $id_languages=$id_languages.($temp.",");}
//				  $a=$a+1;
//				 } 
//			 $id_languages=rtrim($id_languages, ",");
//			 mysqli_free_result($options);
////=========================================================================== 
////$id_documents_categories=========================================================================== 
//			$sql="Select * from documents_categories order by id asc";
//			$options = mysqli_query($con, $sql);
//			$a=1;
//			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
//				 {
//				  $temp=$_POST["id_documents_categories".$a];
//				  if ($temp<>"") { $id_documents_categories=$id_documents_categories.($temp.",");}
//				  $a=$a+1;
//				 } 
//			 $id_documents_categories=rtrim($id_documents_categories, ",");
//			 mysqli_free_result($options);
////=========================================================================== 
////$id_documents_type=========================================================================== 
//			$sql="Select * from documents_type order by id asc";
//			$options = mysqli_query($con, $sql);
//			$a=1;
//			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
//				 {
//				  $temp=$_POST["id_documents_type".$a];
//				  if ($temp<>"") { $id_documents_type=$id_documents_type.($temp.",");}
//				  $a=$a+1;
//				 } 
//			 $id_documents_type=rtrim($id_documents_type, ",");
//			 mysqli_free_result($options);
////=========================================================================== 
////$id_countries=========================================================================== 
//			$sql="Select * from _countries order by id asc";
//			$options = mysqli_query($con, $sql);
//			$a=1;
//			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
//				 {
//				  $temp=$_POST["id_countries".$a];
//				  if ($temp<>"") { $id_countries=$id_countries.($temp.",");}
//				  $a=$a+1;
//				 } 
//			 $id_countries=rtrim($id_countries, ",");
//			 mysqli_free_result($options);
////=========================================================================== 
////$id_workgroups=========================================================================== 
//			$sql="Select * from _workgroups order by id asc";
//			$options = mysqli_query($con, $sql);
//			$a=1;
//			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
//				 {
//				  $temp=$_POST["id_workgroups".$a];
//				  if ($temp<>"") { $id_workgroups=$id_workgroups.($temp.",");}
//				  $a=$a+1;
//				 } 
//			 $id_workgroups=rtrim($id_workgroups, ",");
//			 mysqli_free_result($options);
//=========================================================================== 
//print_r ("title:".($title)."<br>");
//print_r ("description:".($description)."<br>");
//print_r ("file1:".($file1)."<br>");
//print_r ("id_languages:".($id_languages)."<br>");
//print_r ("id_documents_categories:".($id_documents_categories)."<br>");
//print_r ("id_countries:".($id_countries)."<br>");
//print_r ("id_workgroups:".($id_workgroups)."<br><br>");

//=========================================================================== 


if($tmpID==0){
	    $date=date('Y-m-d H:i:s');
		$sql="INSERT INTO documents (pr,
		                             create_date, 
									 edit_date, 
									 title, 
									 description, 
									 file, 
									 publish) 
		                     VALUES ('',
							         '$date',
									 '$date',
									 '$title',
									 '$description',
									 '$file',
									 '$publish')";
		$result=mysqli_query($con, $sql);
		//die($sql);
		$Last_ID=mysqli_insert_id($con);
		//=========================================================================== 
		//echo "Last_ID: ".$Last_ID."<BR>";
		//=========================================================================== 
		$sql = "UPDATE documents SET pr = ".$Last_ID." WHERE id=".$Last_ID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
		
	} else {
		$date=date('Y-m-d H:i:s');
		$sql = "UPDATE documents SET edit_date = '".$date."', 
		                             title = '".$title."', 
									 description = '".$description."', 
									 file = '".$file1."', 
									 publish = '".$publish."' 
									 WHERE id=".$tmpID;
		$Last_ID=$tmpID;
		$result=mysqli_query($con, $sql);
		//mysqli_free_result($result);
	}

//upload file
	$upload_dir = $TmpUploadFolder."documents/".$Last_ID;
		//=========================================================================== 
		//echo "upload_dir: ".$upload_dir."<BR>";
		//=========================================================================== 
	if (!file_exists($upload_dir)) {
    	mkdir($upload_dir, 0777, true);
	}
//kreiraj folder//===========================================================

			if($tmpID==""){$folder_name=$Last_ID;}else{$folder_name=$tmpID;}
			$upload_dir = $TmpUploadFolder."documents/".$folder_name;
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);}

//izbrisi se vo folderot===========================================================================
			if($file_tmp_name!=""||$file1==""){
			array_map('unlink', glob($TmpUploadFolder."documents/".$folder_name."/*"));
			//rmdir($TmpUploadFolder."records/".$folder_name);
            }
//zbrisi go folderot===========================================================================
			if($file1==""){
				
				//rmdir($TmpUploadFolder."documents/".$folder_name);
										if(is_dir($TmpUploadFolder."documents/".$folder_name))
							  {
							  rmdir($TmpUploadFolder."documents/".$folder_name);
							  }
				
				}
			
			
	

$ext = getExtension($file);
$upload_dir=$upload_dir."/";

//=========================================================================== 
//echo "ext: ".$ext."<BR>";
//echo "upload_dir: ".$upload_dir."<BR>";
//=========================================================================== 


//upload original file

$valid_formats = array("doc","DOC","docx","DOCX","pdf","PDF","xls","XLS","xlsx","XLSX","ppt","pptx","pps","PPT","PPTX","PPS");

if(in_array($ext,$valid_formats)) 
		{
				//=========================================================================== 
				//echo "file_tmp_name: ".$file_tmp_name."<BR>";
				//echo "upload_dir.file: ".$upload_dir.$file."<BR>";
				//=========================================================================== 
			if(move_uploaded_file($file_tmp_name, $upload_dir.$file)) {
				$message = "File uploaded successfully.";

			} else {
				$error = $_FILES['file']['error'];
				$message = $upload_errors[$error];
			}
		}

else 

      { //echo "nevaliden format"; 
	  }

if(!empty($message)) { //echo "<p>{$message}</p>"; 
}





mysqli_close($con) ;
header('Location: ModulList.php?'.$tmpQuery) ;
 ?>