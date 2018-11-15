<?php include_once("../_properties.php");?>
<?php include_once("../_procedures.php"); ?>
<?php session_start(); ?>
<?php if ($_SESSION[$TmpAdminSession]!="yes") {header('Location: ../!Login/Login.php') ;};?>
<?php 
date_default_timezone_set('Europe/Skopje');
$tmpID = $_POST["id"] ;
$tmpQuery = $_POST["query"] ;


$publish=$_POST["publish"];if ($_POST["publish"]==""){$publish=0;}
$main=$_POST["main"];if ($_POST["main"]==""){$main=0;}
$cover=$_POST["cover"];if ($_POST["cover"]==""){$cover=0;}
$editor=$_POST["editor"];if ($_POST["editor"]==""){$editor=0;}
$publish_intro=$_POST["publish_intro"];if ($_POST["publish_intro"]==""){$publish_intro=0;}
$comment=$_POST["comment"];if ($_POST["comment"]==""){$comment=0;}
$title=$_POST["title"];$title=str_replace("'","&#39;",$title);
//$subtitle=htmlentities($_POST["subtitle"], ENT_QUOTES);
$subtitle=$_POST["subtitle"];$subtitle=str_replace("'","&#39;",$subtitle);
$intro=$_POST["intro"];$intro=str_replace("'","&#39;",$intro);
$text=$_POST["editor1"];
$picture=$_POST["picture"];
$picture_description=$_POST["picture_description"];
$reporter=$_POST["reporter"];
$id_menu=$_POST["id_menu"];

$hashtag=$_POST["hashtag"];
$submit_type=$_POST["submit_type"];

//$id_languages=$_POST["id_languages"];if ($_POST["id_languages"]==""){$id_languages=0;}
//$id_countries=$_POST["id_countries"];if ($_POST["id_countries"]==""){$id_countries=0;}
//$id_workgroups=$_POST["id_workgroups"];if ($_POST["id_workgroups"]==""){$id_workgroups=1;}
//$id_languages=========================================================================== 
			$sql="Select * from _languages order by id asc";
			$options = mysqli_query($con, $sql);
			$a=1;
			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
				 {
				  $temp=$_POST["id_languages".$a];
				  if ($temp<>"") { $id_languages=$id_languages.($temp.",");}
				  $a=$a+1;
				 } 
			 $id_languages=rtrim($id_languages, ",");
			 if ($id_languages==""){$id_languages=1;}
			 mysqli_free_result($options);
//$id_countries=========================================================================== 
			$sql="Select * from _countries order by id asc";
			$options = mysqli_query($con, $sql);
			$a=1;
			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
				 {
				  $temp=$_POST["id_countries".$a];
				  if ($temp<>"") { $id_countries=$id_countries.($temp.",");}
				  $a=$a+1;
				 } 
			 $id_countries=rtrim($id_countries, ",");
			 if ($id_countries==""){$id_countries=6;}
			 mysqli_free_result($options);
//=========================================================================== 
			$sql="Select * from _workgroups order by id asc";
			$options = mysqli_query($con, $sql);
			$a=1;
			while($options_row = mysqli_fetch_array($options, MYSQL_ASSOC)) 
				 {
				  $temp=$_POST["id_workgroups".$a];
				  if ($temp<>"") { $id_workgroups=$id_workgroups.($temp.",");}
				  $a=$a+1;
				 } 
			 $id_workgroups=rtrim($id_workgroups, ",");
			 if ($id_workgroups==""){$id_workgroups=1;}
			 mysqli_free_result($options);
//=========================================================================== 
$id_courses_categories=$_POST["id_courses_categories"];if ($_POST["id_courses_categories"]==""){$id_courses_categories=0;}



$editdate=$_POST["editdate"];
$createdate=$_POST["createdate"];
//if ($editdate) {$editdate=date_format(new DateTime($editdate), 'Y-m-d H:i:s');}else{$editdate=date('Y-m-d H:i:s');}
if ($createdate) {$createdate=date_format(new DateTime($createdate), 'Y-m-d H:i:s');}else{$createdate=date('Y-m-d H:i:s');}
//if ($date) {$date=date_format(new DateTime($date), 'Y-m-d');}else{$date=NULL;}

//=========================================================================== 
//print_r ("tmpID:".($tmpID)."<br>");
//print_r ("tmpQuery:".($tmpQuery)."<br>");
//print_r ("id_menu:".($id_menu)."<br>");
//print_r ("subtitle:".($subtitle)."<br>");
//print_r ("intro:".($intro)."<br>");
//print_r ("picture:".($picture)."<br>");
//print_r ("editdate:".($editdate)."<br>");
//print_r ("createdate:".($createdate)."<br>");
//print_r ("hashtag:".($hashtag)."<br>");
//=========================================================================== 
if($hashtag!=""){
	
	//=========================================================================== 
			$sql_h="Select * from _workgroups WHERE title='".trim($hashtag)."'";
			//die($sql_h);
			$result_h = mysqli_query($con, $sql_h);
			$rowcount_h=mysqli_num_rows($result_h);
			if ($result_h){$row_h = mysqli_fetch_array($result_h);}
			$id_h=$row_h["id"];
			//print_r ("rowcount_h:".($rowcount_h)."<br>");
            if ($rowcount_h==0) {
	                             //print_r ("hashtag:".(trim($hashtag))."<br>");
								//Nov zapis===================================================================
								//print_r ("hashtag:".($hashtag)."<br>");
								$date=date('Y-m-d H:i:s');
								$sql="INSERT INTO _workgroups (pr, 
															  create_date, 
															  edit_date, 
															  title
														  ) 
												  VALUES ('',
														  '$createdate', 
														  '$editdate',
														  '$hashtag')";
								$result=mysqli_query($con, $sql);
								//die($sql);
								$last_id=mysqli_insert_id($con);
								$sql = "UPDATE _workgroups SET pr = ".$last_id." WHERE id=".$last_id;
								$result=mysqli_query($con, $sql);
								//if(! $result ){mysqli_free_result($result);} 
								$id_workgroups=$id_workgroups.",".$last_id;
								//=========================================================================== 
	
	                             }
				else{$id_workgroups=$id_workgroups.",".$id_h;}
								 
			mysqli_free_result($result_h);
//=========================================================================== 



				
}

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
//	echo "file: ".$file."<BR>";
	//===========================================================================
	
	
//end upload file name


if($tmpID==""){
	
                //Nov zapis===========================================================================
                $date=date('Y-m-d H:i:s');
                $sql="INSERT INTO records (pr, 
				                          create_date, 
										  edit_date, 
										  title, 
										  subtitle, 
										  intro, 
										  text, 
										  picture, 
										  picture_description, 
										  id_menu, 
										  id_languages, 
										  id_countries, 
										  id_workgroups, 
										  id_courses_categories,
										  publish,
										  main,
										  cover,
										  editor,
										  reporter,
										  publish_intro,
										  comment
										  ) 
				                  VALUES ('',
								          '$createdate', '$editdate',
										  '$title',
										  '$subtitle',
										  '$intro',
										  '$text',
										  '$picture',
										  '$picture_description',
										  '$id_menu',
										  '$id_languages',
										  '$id_countries',
										  '$id_workgroups',
										  '$id_courses_categories',
										  '$publish',
										  '$main',
										  '$cover',
										  '$editor',
										  '$reporter',
										  '$publish_intro',
										  '$comment')";
                $result=mysqli_query($con, $sql);
                //die($sql);
                $last_id=mysqli_insert_id($con);
                $sql = "UPDATE records SET pr = ".$last_id." WHERE id=".$last_id;
                $result=mysqli_query($con, $sql);
				//if(! $result ){mysqli_free_result($result);} 
				
}else {	
			
				//Promena zapis===========================================================================				
				$date=date('Y-m-d H:i:s');
				$sql = "UPDATE records SET create_date = '".$createdate."',
				                           edit_date = '".$editdate."', 
										   title = '".$title."', 
										   subtitle = '".$subtitle."', 
										   intro = '".$intro."', 
										   text = '".$text."', 
										   picture = '".$picture."', 
										   picture_description = '".$picture_description."', 
										   id_menu = '".$id_menu."', 
										   id_languages = '".$id_languages."', 
										   id_countries = '".$id_countries."', 
										   id_workgroups = '".$id_workgroups."', 
										   id_courses_categories = '".$id_courses_categories."',
										   publish = '".$publish."',
										   main = '".$main."',
										   cover = '".$cover."',
										   editor = '".$editor."',
										   reporter = '".$reporter."',
										   publish_intro = '".$publish_intro."',
										   comment = '".$comment."'
										   WHERE id=".$tmpID;
				$result=mysqli_query($con, $sql);
				//die($sql);  
				//if(! $result ){mysqli_free_result($result);}   
}



//kreiraj folder//===========================================================

			if($tmpID==""){$folder_name=$last_id;}else{$folder_name=$tmpID;}
			$upload_dir = $TmpUploadFolder."records/".$folder_name;
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);}

//izbrisi se vo folderot===========================================================================
			if($file_tmp_name!=""||$picture==""){
			array_map('unlink', glob($TmpUploadFolder."records/".$folder_name."/*"));
			//rmdir($TmpUploadFolder."records/".$folder_name);
            }
//zbrisi go folderot===========================================================================
			if($picture==""){rmdir($TmpUploadFolder."records/".$folder_name);}
			
//kreiraj thumbnail===========================================================================
if($file_tmp_name!=""){
				
			$ext = getExtension($file);	
			$upload_dir=$upload_dir."/";
			$actual_image_name = date("Ymd_His")."_".$file;
			$image_formats = array("jpg", "jpeg", "png", "gif", "bmp", "JPG", "JPEG", "PNG", "GIF", "BMP");
			
					//===========================================================================
//				echo "ext: ".$ext."<BR>";
//					echo "upload_dir: ".$upload_dir."<BR>";
//					echo "actual_image_name: ".$actual_image_name."<BR>";
//					echo "image_formats: ".$image_formats."<BR>";
					//===========================================================================
			
			if(in_array($ext,$image_formats)) 
			{   $tn=740; if ($id_menu==15){$tn=1130;}
			    $tn1=360;
			    $tn2=168;
				$widthArray = array($tn,$tn1,$tn2); //You can change dimension here.
				$i=0;
				foreach($widthArray as $newwidth)
				{   
				    if ($i==0){$suffix="";}else{$suffix="tn".$i."_";}
					$filename=compressImage($ext,$file_tmp_name,$upload_dir,$actual_image_name,$newwidth,$suffix);
					$filename=substr($filename, 13); // go otsekuvam delot /home/Roliaba1
					$i=$i+1;
					//===========================================================================
//					echo "actual_image_name: ".$actual_image_name."<BR>";
//					echo "filename: ".$filename."<BR>";
//					echo "<img src='".$filename."' class='preview_img'/>";
					//===========================================================================
					$sql = "UPDATE records SET picture = '".$actual_image_name."' WHERE id=".$folder_name;
					$result=mysqli_query($con, $sql);
				}

	

			}
}

mysqli_close($con) ;
if($submit_type==1){
header('Location: ModulEdit1.php?'.$tmpQuery."&id=".$tmpID) ;}
if($submit_type==0){
header('Location: ModulList.php?'.$tmpQuery) ;}
?>
	

