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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function display_children_temp($parent, $level) { 
	global $con;
	$toplevel=$level;
    // retrieve all children of $parent 
		$query  = "SELECT * ";
		$query .= "FROM forum ";
		$query .= "WHERE parent = ".$parent." ";
		$query .= "ORDER BY id ASC";
		//echo $query."<BR>";
    $result_children = mysqli_query($con, $query);
 	confirm_query($result_children);
	if (!isset($prethoden_level)) $prethoden_level=0; 
    while ($row_children = mysqli_fetch_assoc($result_children)) {

		?>

        <?php
		echo "start";
       echo str_repeat('_ ',$level).$row_children['post']."(".$row_children['id'].")"."(level: ".$level.")"."(prethoden_level: ".$prethoden_level.")"."<BR>";
	   $prethoden_level = $level;
		display_children_temp($row_children['id'], $level+1);
		echo "stop"."<BR>";
	}
    }
	
	function display_children_topic($parent, $level) { 
	global $con;
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
        <div class="media <?php if ($row_children_topic["hidden"]==1) {echo " post_marked"; if ($_SESSION[$TmpAdminSession] != "yes") {echo " post_hidden";}} else if ($row_children_topic["approved"]==0) {echo "post_notapproved";}?>">
        <a class="pull-left"><img class="media-object" src="/images/pix.gif" style="width:30px" alt=""></a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo($row_children_topic["name"]." ".$row_children_topic["surname"]) ?>
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
		//}
		if ($_SESSION[$TmpAdminSession] == "yes") {
			if ($row_children_topic["hidden"]==1) {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_hide_post.php?id=".$row_children_topic["forum_id"]."\" >Unhide</a>";
			} else {
					echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_hide_post.php?id=".$row_children_topic["forum_id"]."\" >Hide</a>";
			}
		}
		//echo "<a class=\"btn btn-default btn-sm pull-right approve_kopce kopce\" href=\"/includes/forum/_approve_post.php?id=".$row_children_topic["forum_id"]."\" >Approve/Disapprove</a>";
		echo "</div><div class=\"comment\"></div></div>";

        // call this function again to display this 
        // child's children 

        display_children_topic($row_children_topic['forum_id'], $level+1);
    }
	echo "</div><!--.media-body--></div><!--.media-->";
} 
function pecati($ispis) {
	echo htmlentities($ispis);
}

function display_children_menu($parent, $level,$privilegija) { 
	global $con;
	global $id;
	global $all_parents;
	$toplevel=$level;
    // retrieve all children of $parent 
	$query  = "SELECT title, id, link_ex, id_parent ";
	$query .= "FROM _menu ";
	//$query .= "inner join users on users.id=forum.user_id ";
	$query .= "WHERE id_parent = ".$parent." ";if ($privilegija==""||$privilegija=="7"){$query .= "AND protected = 0 ";}
	$query .= "AND visibility_ex = 1 ";
	$query .= "ORDER BY pr ASC";
	//echo $query."<BR>";
    $result_children_menu=mysqli_query($con, $query);
 	//confirm_query($result_children_menu);
	//print_r ($result_children_menu);
    // display each child 
	$rowcount=mysqli_num_rows($result_children_menu);
	if ($rowcount>0 and $level<2) 
	{
		
		if ($parent==0) { echo "";} else {echo "<ul class=\"dropdown-menu\">";}
		    $i=1;
			while ($row_children_menu = mysqli_fetch_assoc($result_children_menu)) 
			{
				// indent and display the post of this child 
				$has_children=has_children($row_children_menu['id']);
				
				echo "<li class=\"";if ($has_children>0) {echo " dropdown ";}if ($row_children_menu['id_parent']==0) {echo " boja".$i." ";} echo "\">";

							echo "<a href=\"".$row_children_menu['link_ex'];
							    if ($row_children_menu['link_ex']!="") 
								{
								  if ($has_children>0) {echo "";} else {echo "mv=".$row_children_menu['id'];}
								 }
							 echo "\"";
							    if (in_array($row_children_menu['id'], $all_parents)) {echo " class=\"selected\"";}
							 echo ">";
							 if ($row_children_menu['id_parent']==0) 
							 {echo strtoupper($row_children_menu['title']);}else{echo $row_children_menu['title'];}
							 
								 if ($has_children>0 and $level<1) {echo " <b class=\"caret\"></b>";}
							echo " </a>";
							
							// call this function again to display this 
							// child's children 
							if ($level < 2) {display_children_menu($row_children_menu['id'], $level+1,$privilegija); /* stop at his level */}
							
							
							
				echo "</li>";
				$i=$i+1;
				if ($i==7) {$i=1;}
			}
	   echo "</ul>";
	}
	
} 

function display_children_submenu($parent, $level,$privilegija) { 
	global $con;
	global $mv;
	global $all_parents;
    // retrieve all children of $parent 
	$query  = "SELECT title, id, link_ex ";
	$query .= "FROM _menu ";
	$query .= "WHERE id_parent = ".$parent." ";
	$query .= "AND visibility_ex = 1 ";
	if ($privilegija==""||$privilegija=="7"){$query .= "AND protected = 0 ";}
	$query .= "ORDER BY pr ASC";

    $result_children_submenu=mysqli_query($con, $query);
	$rowcount=mysqli_num_rows($result_children_submenu);
	$row_children_submenu = mysqli_fetch_assoc($result_children_submenu);
	if ($rowcount>0) 
	{
		
		if ($parent==0) { echo "";} else {
				echo "<div class=\"";
				
				if ($level>0) {
					if (in_array($parent, $all_parents)) {
						echo " collapsed submeni ";
					}
					else {
						echo " collapse submeni ";					
					}
				}
				//if (in_array($parent, $all_parents)) {echo " in ";}
/*				if (in_array(7, $all_parents)) {echo " portokalov ";}
				if (in_array(10, $all_parents)) {echo " zolt ";}
				if (in_array(15, $all_parents)) {echo " zelen ";}
				if (in_array(16, $all_parents)) {echo " sin ";}*/
				echo "\" id=\"id_".$parent."\">";
				//print_r($all_parents);
			}
			mysqli_data_seek($result_children_submenu,0);
			while ($row_children_submenu = mysqli_fetch_assoc($result_children_submenu)) 
			{
				// indent and display the post of this child 
				$has_children=has_children($row_children_submenu['id']);
				echo "<a ";
				if ($has_children>0) 
					{echo "href=\"#id_".$row_children_submenu['id']."\" data-toggle=\"collapse\"";
					echo "onclick=\"focusCategory('#id=".$row_children_submenu['id']."');\"";}
				else
					{
						echo "href=\"".$row_children_submenu['link_ex'];
						//if (strpos($row_children_submenu['link_ex'],"st.php")>0) {echo "mv=".$row_children_submenu['id'];}
						if ($row_children_submenu['link_ex']!="") {echo "mv=".$row_children_submenu['id'];}
						echo "\" ";}
						//echo "href=\"".$row_children_submenu['link_ex']."id=".$row_children_submenu['id']."\" ";}
				echo "data-parent=\"#MainMenu\" class=\"list-group-item ";
				if (!$has_children>0) {echo " list-group-item-default ";}
				//if (!$has_children>0) {echo " side_submenu";}
				if (($pos = strpos($row_children_submenu['link_ex'], "mv=")) != FALSE) {
					$id_link_ex = substr($row_children_submenu['link_ex'], $pos + 3);
					if ($id_link_ex==$mv) {echo " selected";} 
				}
				//if (strpos($row_children_submenu['link_ex'],"st.php")>0) {if ($row_children_submenu['id']==$mv) {echo " selected";}}
				if ($row_children_submenu['link_ex']!="") {if ($row_children_submenu['id']==$mv) {echo " selected";}}
				
				$margina=15+20*$level."px";
				echo "\" style=\"padding-left:".$margina.";";
				if ($level>0) {echo " border-bottom:none";}
				echo "\">".$row_children_submenu['title'];
				if ($has_children>0) {echo " <i class=\"fa fa-caret-down\"></i>";}
				echo " </a>";
				
				// call this function again to display this 
				// child's children 
				if ($level < 2) {display_children_submenu($row_children_submenu['id'], $level+1,$privilegija); /* stop at his level */}
							
			}
	   echo "</div>";
	}
	
} 
function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}
function has_children($parent) {
	global $con;
	$query  = "SELECT id,visibility_ex ";
	$query .= "FROM _menu ";
	$query .= "WHERE id_parent = ".$parent;
	$query .= " AND visibility_ex=1 ";
    $result_has_children=mysqli_query($con, $query);
	$rowcount=mysqli_num_rows($result_has_children);
	mysqli_free_result($result_has_children);
	return $rowcount;
}

function get_path($node) { 
	global $con;
    // look up the parent of this node 
	$query  = "SELECT id_parent FROM _menu WHERE id=".$node;
    $result_path=mysqli_query($con, $query);
    $row_path = mysqli_fetch_assoc($result_path); 
    // save the path in this array 
    $path = array(); 
    // only continue if this $node isn't the root node 
    // (that's the node with no parent) 
    if ($row_path["id_parent"]!="") { 
        // the last part of the path to $node, is the name 
        // of the parent of $node 
        $path[] = $row_path["id_parent"]; 
        // we should add the path to the parent of this node 
        // to the path 
        $path = array_merge(get_path($row_path["id_parent"]), $path); 
    } 
	mysqli_free_result($result_path);
    return $path; 
} 
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}
?>