<?php

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
	//echo $ext;
	return $ext;
}

function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth,$suffix)
{

	if($ext=="jpg" || $ext=="jpeg"|| $ext=="JPG" || $ext=="JPEG"  )
	{
		$src = imagecreatefromjpeg($uploadedfile);
	}
	else if($ext=="png"|| $ext=="PNG")
	{
		$src = imagecreatefrompng($uploadedfile);
	}
	else if($ext=="gif"|| $ext=="GIF")
	{
		$src = imagecreatefromgif($uploadedfile);
	}
	else
	{
		$src = imagecreatefrombmp($uploadedfile);
	}
	
	list($width,$height)=getimagesize($uploadedfile);
	
	if(($width>$newwidth)||($height>$newwidth)) 
	   {$newheight=($height/$width)*$newwidth;}
	else {$newheight=$height;$newwidth=$width;}
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $path.$suffix.$actual_image_name; 
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
	
	return $filename;
}

function generate_password($length = 8){
  $chars =  '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz';

  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[mt_rand(0, $max)];

  return $str;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function verifyEmail($toemail, $fromemail, $getdetails = true)
{
	$email_arr = explode("@", $toemail);
	$domain = array_slice($email_arr, -1);
	$domain = $domain[0];
	// Trim [ and ] from beginning and end of domain string, respectively
	$domain = ltrim($domain, "[");
	$domain = rtrim($domain, "]");
	if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {$domain = substr($domain, strlen("IPv6") + 1);}
	//echo "domain:".$domain."<br>";

	//PROVERKA NA IP ADRESA
	$mxhosts = array();
	
	if(filter_var($domain, FILTER_VALIDATE_IP) )
	  {$mx_ip = $domain;}
	else
	 {getmxrr($domain, $mxhosts, $mxweight);}
	 
	
	$arrlength = count($mxhosts);
		for($x = 0; $x < $arrlength; $x++)
		 {
			//echo "$x:".$mxhosts[$x]."<br>";
		 }
		 
	$arrlength = count($mxweight);
		for($x = 0; $x < $arrlength; $x++)
		 {
			//echo "$x:".$mxweight[$x]."<br>";
		 }

	if(!empty($mxhosts) )
	{
	$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
	//echo "mx_ip:".$mx_ip."<br>";
	}
	else 
	{
			if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) 
			{
			$record_a = dns_get_record($domain, DNS_A);
			}
			elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) 
					{
					$record_a = dns_get_record($domain, DNS_AAAA);
					}
			
			if( !empty($record_a) )
			$mx_ip = $record_a[0]['ip'];
			else 
			{
			$result = "invalid";
			$details .= "No suitable MX records found.";
			return ( (true == $getdetails) ? array($result, $details) : $result );
			}
	}
    //PROVERKA NA KONEKCIJA SO WEB MAIL SERVER
	$connect = @fsockopen($mx_ip, 25);
	
	//echo "connect: ".$connect."<br><br>";

	if($connect)
	{ 
	    $out = fgets($connect, 1024);
		//echo "out:".$out."<br><br>";
		
		if(preg_match("/^220/i", $out))
		{	
			fputs ($connect , "HELO $mx_ip\r\n");
			$out = fgets ($connect, 1024);
			$details .= $out."\n";
			//echo "out:".$out."<br>";
			//echo "details:".$details."<br><br>";
			
			fputs ($connect , "MAIL FROM: <$fromemail>\r\n");
			$from = fgets ($connect, 1024);
			$details .= $from."\n";
			//echo "from:".$from."<br>";
			//echo "details:".$details."<br><br>";
			
			fputs ($connect , "RCPT TO: <$toemail>\r\n");
			$to = fgets ($connect, 1024);
			$details .= $to."\n";
			//echo "to:".$to."<br>";
			//echo "details:".$details."<br><br>";
			
			fputs ($connect , "QUIT");
			fclose($connect);
//			if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to))
//				{
//				$result = "invalid";
//				//echo "result:".$result."<br>";
//				}
//			else
//				{
//				$result = "valid";
//				//echo "result:".$result."<br>";
//				}
				
				
		}
	}
	else
	{
		$result = "invalid";
		$details .= "Could not connect to server";
	}
	

	if($getdetails)
	{//$testEmail = array($result, $details, $to);
	 return array($result, $details, $to);
		}
	else
	{return $result;}
	
	//echo "result:".$testEmail[0]."<br>";
	//echo "details:".$testEmail[1]."<br>";
	//echo "to:".$testEmail[2]."<br>";
	
//die;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$queryf) {
	
    $queryf= str_replace("&page=".$page,"",$queryf);
	$offset += 1;
	echo "<div class=\"text-right\">прикажани (од <strong>".$offset."</strong> до <strong>".$prikazani."</strong>) од вкупно: <strong>".$rec_count."</strong> ";
	if ($page!=0) {
		$previous_page=$page-1;
		echo " | <a href=\"".$queryf."&page=".$previous_page."\">претходни </a>";
	}
	if ($page<$page_vkupno-1){
		$next_page=$page+1;
		echo " | <a href=\"".$queryf."&page=".$next_page."\">следни </a>";
	}
	echo "</div>";
}
function comment_count() {
	global $con;
	$query  = "SELECT *  ";
	$query .= "FROM forum ";
	$query .= "WHERE approved = 0 and record_id<>0";
    $result=mysqli_query($con, $query);
	$rowcount=mysqli_num_rows($result);
	return $rowcount;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function display_children($parent, $level) { 
	global $connection;
	$toplevel=$level;
    // retrieve all children of $parent 
		$query  = "SELECT _menu.title, _menu.link ";
		$query .= "FROM _menu ";
		//$query .= "inner join users on users.id=forum.user_id ";
		$query .= "WHERE _menu.parent = ".$parent." ";
		$query .= "ORDER BY _menu.pr ASC";
		//echo $query."<BR>";
    $result = mysqli_query($connection, $query);
 	confirm_query($result);
	//print_r ($result);
    // display each child 
	
	echo "<ul class=\"treeview-menu\">";
    while ($row = mysqli_fetch_assoc($result)) {

		?>
        
        <li class="treeview"><a href="<?php echo $row["link"]."?id=" ?>"><i class="fa fa-angle-double-right"></i><?php echo $row["title"]?></a></li>
        <?php
        display_children($row['forum_id'], $level+1);
    }
	echo "</ul>";
} 

function display_children_menu($parent, $level) { 
	global $con;
	global $tmpMV;
	global $all_parents;
	$toplevel=$level;
    // retrieve all children of $parent 
	$query  = "SELECT title, id, link_in, visibility_in ";
	$query .= "FROM _menu ";
	//$query .= "inner join users on users.id=forum.user_id ";
	$query .= "WHERE id_parent = ".$parent." ";
	$query .= "AND visibility_in = 1 ";
    if ($_SESSION["SUPERADMIN"] =="yes") {$query .= "AND (superadmin = 0 OR superadmin = 1)";}
	if ($_SESSION["SUPERADMIN"] !="yes") {$query .= "AND superadmin = 0 ";}
	//$query .= "AND (superadmin = 0 OR superadmin = 1)";
	
	$query .= "ORDER BY pr ASC";
	//echo $query."<BR>";
    $result=mysqli_query($con, $query);
 	confirm_query($result);
	//print_r ($result);
    // display each child 
	$rowcount=mysqli_num_rows($result);
	if ($rowcount>0) 
	{
		
		if ($parent==0) { echo "";} else {echo "<ul class=\"treeview-menu\">";}
			while ($row = mysqli_fetch_assoc($result)) 
			{
				// indent and display the post of this child 
				$has_children=has_children($row['id']);
				
				echo "<li class=\"";
				if ($has_children>0) {echo " treeview ";} 
				if ($tmpMV==$row['id']) {echo " active ";} 
				//if ($row['id']==2) {echo " active ";} 
				if (in_array($row['id'], $all_parents)) {echo " active ";} 
				echo "\">";
				
							echo "<a href=\"".$row['link_in']."mv=".$row['id']."\"><i class=\"fa fa-angle-double-right\"></i>".$row['title'];
								 if ($has_children>0) {echo " <i class=\"fa fa-angle-left pull-right\"></i>";}
								 if ($row['id']==32) {echo " <i class=\"fa fa-comment\"  style=\"color:red;\"> "."</i>".comment_count();}
							echo " </a>";
							
							// call this function again to display this 
							// child's children 
					
							display_children_menu($row['id'], $level+1);
							
				echo "</li>";
			}
	   echo "</ul>";
	}
	
} 



function has_children($parent) {
	global $con;
	$query  = "SELECT id,visibility_in ";
	$query .= "FROM _menu ";
	$query .= "WHERE id_parent = ".$parent;
	$query .= " AND visibility_in=1 ";
    $result=mysqli_query($con, $query);
	$rowcount=mysqli_num_rows($result);
	return $rowcount;
}

function has_children_dissapproved($parent) {
	global $con;
	$query  = "SELECT count(id) as children_dissapproved ";
	$query .= "FROM forum ";
	$query .= "WHERE parent = ".$parent;
	$query .= " AND approved=0 ";
    $result=mysqli_query($con, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	return $row["children_dissapproved"];
}

function get_path($node) { 
	global $con;
    // look up the parent of this node 
	$query  = "SELECT id_parent FROM _menu WHERE id=".$node;
    $result=mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result); 
    // save the path in this array 
    $path = array(); 
    // only continue if this $node isn't the root node 
    // (that's the node with no parent) 
    if ($row["id_parent"]!="") { 
        // the last part of the path to $node, is the name 
        // of the parent of $node 
        $path[] = $row["id_parent"]; 
        // we should add the path to the parent of this node 
        // to the path 
        $path = array_merge(get_path($row["id_parent"]), $path); 
    } 
 
    // return the path 
    return $path; 
}
function display_children_topic_comments($parent, $level) { 
//session_start();
	global $con;
	global $TmpAdminSession;
	$toplevel=$level;
    // retrieve all children of $parent 
		$query  = "SELECT forum.name, forum.post, forum.hidden, forum.approved, forum.id as forum_id, forum.create_date as forum_date ";
		$query .= "FROM forum ";
		//$query .= "inner join users on users.id=forum.user_id ";
		$query .= "WHERE forum.parent = ".$parent." ";
		$query .= "ORDER BY forum.id ASC";
		//echo $query."<BR>";
    $result_children_topic = mysqli_query($con, $query);
 	confirm_query($result_children_topic);
	//print_r ($result_children_topic);
    // display each child
	
		
    while ($row_children_topic = mysqli_fetch_assoc($result_children_topic)) {
	$forum_date=strftime("%d %b %Y %H:%M", strtotime($row_children_topic["forum_date"]));
		?>
        <div class="media <?php if ($row_children_topic["approved"]!=1) {echo " post_marked"; if ($TmpAdminSession != "yes") {echo " post_hidden";}}// else if ($row_children_topic["approved"]==0) {echo "post_notapproved";}?>">
        <a class="pull-left"><img class="media-object" src="/images/pix.gif" style="width:30px" alt=""></a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo($row_children_topic["name"]) ?>
                    <small><?php echo $forum_date ?></small>
                </h4>
        <?php
        // indent and display the post of this child 
		
        //echo str_repeat('!',$level).$row_children_topic['post']."(".$row_children_topic['id'].")"."(level: ".$level.")"."<BR>";
		echo stripslashes($row_children_topic['post']);
		echo "<div class=\"reply_div\"><div style=\"display: block; clear:both; float:none; overflow:hidden; margin-bottom:10px;\">
		";
		//if (isset($_SESSION["user"])) {//komentari se dozvoleni samo za logiranite korisnici
			echo "<button type=\"button\" class=\"btn btn-default btn-sm pull-right reply_kopce kopce\" parent=\"".$row_children_topic["forum_id"]."\" ><i class=\"fa fa-reply\" aria-hidden=\"true\"></i> одговори</button>";
		//
		//echo "TmpAdminSession_procedures: ".$TmpAdminSession;
		if ($TmpAdminSession == "yes") {
			if ($row_children_topic["approved"]==1) {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_approve_post.php?id=".$row_children_topic["forum_id"]."\" ><i class=\"fa fa-warning\"></i> Disapprove as administrator</a>";
			} else {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_approve_post.php?id=".$row_children_topic["forum_id"]."\" ><i class=\"fa fa-check\"></i> Approve as administrator</a>";
			}
		}
		//echo "<a class=\"btn btn-default btn-sm pull-right approve_kopce kopce\" href=\"/includes/forum/_approve_post.php?id=".$row_children_topic["forum_id"]."\" >Approve/Disapprove</a>";
		echo "</div><div class=\"comment\"></div></div>";

        // call this function again to display this 
        // child's children 

        display_children_topic_comments($row_children_topic['forum_id'], $level+1);
    }
	echo "</div><!--.media-body--></div><!--.media-->";
} 
function pecati($ispis) {
	echo htmlentities($ispis);
}

function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}

function skrati($tekst,$karakteri) {
	$startlen=strlen(trim($tekst));
	if ($startlen>$karakteri) {
		$tekst=substr(trim($tekst),0,$karakteri);
		$prazno=strrpos($tekst," ");
		
		//echo "<br>".$tekst;
		$tekst=substr($tekst,0,$prazno);
		echo $tekst;
		//echo "<br>".$prazno." !!! ".(int)(strlen(trim($tekst))+3)." !!! ".$startlen;
		if ((int)(strlen(trim($tekst))+3)<$startlen) {
			echo "...";
			};
	}
	else {
		echo $tekst;
	}
}
?>