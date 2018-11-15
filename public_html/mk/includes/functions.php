<?php

	function generate_pin($length = 50){
	  $chars =  '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz$^*';
	
	  $str = '';
	  $max = strlen($chars) - 1;
	
	  for ($i=0; $i < $length; $i++)
		$str .= $chars[mt_rand(0, $max)];
	
	  return $str;
	}

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
	function find_all_subjects($public=true) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		if ($public) {
			$query .= "WHERE visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		return $subject_set;
	}
	
	function find_pages_for_subject($subject_id, $public=true) {
		global $connection;
		
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE subject_id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}
	
	function find_all_users() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM Users ";
		$query .= "ORDER BY Email ASC";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		return $user_set;
	}
	
	function find_subject_by_id($subject_id, $public=true) {
		global $connection;
		
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		if($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}
	}

	function find_page_by_id($page_id, $public=true) {
		global $connection;
		
		$safe_page_id = mysqli_real_escape_string($connection, $page_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)) {
			return $page;
		} else {
			return null;
		}
	}
	
	function find_user_by_id($user_id) {
		global $connection;
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);
		
		$query  = "SELECT * ";
		$query .= "FROM Users ";
		$query .= "WHERE id = {$safe_user_id} ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

	function find_user_by_email($email) {
		global $connection;
		
		$safe_email = mysqli_real_escape_string($connection, $email);
		echo "query1: ".$query."<BR>";
		$query  = "SELECT * ";
		$query .= "FROM Users ";
		$query .= "WHERE Email = '{$safe_email}' ";
		$query .= "LIMIT 1";
		echo "query2: ".$query."<BR>";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		echo "user_set: ";
		print_r (mysqli_fetch_assoc($user_set));
		echo "<br>";
		echo "user_set: ".mysqli_fetch_assoc($user_set)."<BR>";
		if($admin = mysqli_fetch_assoc($user_set)) {
			echo "najde email vo mysqli_fetch_assoc<br>";
			//return $admin;
		} else {
			echo "ne najde email vo mysqli_fetch_assoc<br>";
			//return null;
		}
		echo "lazam, admin: ".print_r ($admin)."<BR><BR>";
		return $admin;//moj test
	}

	function find_default_page_for_subject($subject_id) {
		$page_set = find_pages_for_subject($subject_id);
		if($first_page = mysqli_fetch_assoc($page_set)) {
			return $first_page;
		} else {
			return null;
		}
	}
	
	function find_selected_page($public=false) {
		global $current_subject;
		global $current_page;
		
		if (isset($_GET["subject"])) {
			$current_subject = find_subject_by_id($_GET["subject"], $public);
			if ($current_subject && $public) {
				$current_page = find_default_page_for_subject($current_subject["id"]);
			} else {
				$current_page = null;
			}
		} elseif (isset($_GET["page"])) {
			$current_subject = null;
			$current_page = find_page_by_id($_GET["page"], $public);
		} else {
			$current_subject = null;
			$current_page = null;
		}
	}

	// navigation takes 2 arguments
	// - the current subject array or null
	// - the current page array or null
	function navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects(false);
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"]);
			$output .= "</a>";
			
			$page_set = find_pages_for_subject($subject["id"], false);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $page["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_content.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"]);
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function public_navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"index.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"]);
			$output .= "</a>";
			
			if ($subject_array["id"] == $subject["id"] || 
					$page_array["subject_id"] == $subject["id"]) {
				$page_set = find_pages_for_subject($subject["id"]);
				$output .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)) {
					$output .= "<li";
					if ($page_array && $page["id"] == $page_array["id"]) {
						$output .= " class=\"selected\"";
					}
					$output .= ">";
					$output .= "<a href=\"index.php?page=";
					$output .= urlencode($page["id"]);
					$output .= "\">";
					$output .= htmlentities($page["menu_name"]);
					$output .= "</a></li>";
				}
				$output .= "</ul>";
				mysqli_free_result($page_set);
			}

			$output .= "</li>"; // end of the subject li
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  //$hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($email, $password) {
		echo $email ." i ". $password."<BR /><BR />";
		$admin = find_user_by_email($email);
		echo "admin: ". $admin ."<BR />";
		//echo "find_user_by_email: ". find_user_by_email($email) ."<BR />";
		echo "print_r: ";
		print_r ($admin);
		echo "<BR />";
		if ($admin ) {
			// found user, now check password
			if (password_check($password, $admin["Password"])) {
				// password matches
				echo "najden e password_check: ". $admin."<BR />";
				return $admin;
			} else {
				// password does not match
				echo "ne e najden password_check: ". $admin."<BR />";
				return false;
			}
		} else {
			// user not found
			echo "ne e najden admin". $admin."<BR />";
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['user_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}
	
	function list_all_topics($since) {
		global $connection;
		$sql  = "SELECT users.name, users.surname, forum.topic, forum.post, forum.hidden, forum.approved, forum.id as forum_id, forum.create_date as forum_date ";
		$sql .= "FROM forum ";
		$sql .= "inner join users on users.id=forum.user_id ";
		$sql .= "WHERE forum.parent=0 ";
		if (isset($since)) {$sql .= "and DATE('".$since."') > DATE(forum.create_date) ";}
		$sql .= "ORDER BY forum.id ASC";
		//echo $sql;
		$topic_set = mysqli_query($connection, $sql);
		confirm_query($topic_set);
		return $topic_set;
		
	}
	
	function display_children_temp($parent, $level) { 
	global $connection;
	$toplevel=$level;
    // retrieve all children of $parent 
		$query  = "SELECT * ";
		$query .= "FROM forum ";
		$query .= "WHERE parent = ".$parent." ";
		$query .= "ORDER BY id ASC";
		//echo $query."<BR>";
    $result_children = mysqli_query($connection, $query);
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
	global $connection;
	$toplevel=$level;
    // retrieve all children of $parent 
		$query  = "SELECT users.name, users.surname, forum.post, forum.hidden, forum.approved, forum.id as forum_id, forum.create_date as forum_date ";
		$query .= "FROM forum ";
		$query .= "inner join users on users.id=forum.user_id ";
		$query .= "WHERE forum.parent = ".$parent." ";
		$query .= "ORDER BY forum.id ASC";
		//echo $query."<BR>";
    $result_children_topic = mysqli_query($connection, $query);
 	confirm_query($result_children_topic);
	//print_r ($result_children_topic);
    // display each child 
    while ($row_children_topic = mysqli_fetch_assoc($result_children_topic)) {

		?>
        <div class="media <?php if ($row_children_topic["hidden"]==1) {echo " post_marked"; if ($_SESSION["privilegija"]!=1) {echo " post_hidden";}} else if ($row_children_topic["approved"]==0) {echo "post_notapproved";}?>">
        <a class="pull-left"><img class="media-object" src="/http/images/pixel.gif" width="20px" alt=""></a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo($row_children_topic["name"]." ".$row_children_topic["surname"]) ?>
                    <small><?php echo $row_children_topic["forum_date"] ?></small>
                </h4>
        <?php
        // indent and display the post of this child 
		
        //echo str_repeat('!',$level).$row_children_topic['post']."(".$row_children_topic['id'].")"."(level: ".$level.")"."<BR>";
		echo stripslashes($row_children_topic['post']);
		echo "<div class=\"reply_div\"><div style=\"display: block; clear:both; float:none; overflow:hidden; margin-bottom:10px;\">";
		if (isset($_SESSION["user"])) {//komentari se dozvoleni samo za logiranite korisnici
			echo "<button type=\"button\" class=\"btn btn-default btn-sm pull-right reply_kopce kopce\" parent=\"".$row_children_topic["forum_id"]."\" >Reply</button>";
		}
		if ($_SESSION["privilegija"]==1) {
			if ($row_children_topic["hidden"]==1) {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/http/includes/forum/_hide_post.php?id=".$row_children_topic["forum_id"]."\" >Unhide</a>";
			} else {
					echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/http/includes/forum/_hide_post.php?id=".$row_children_topic["forum_id"]."\" >Hide</a>";
			}
		}
		//echo "<a class=\"btn btn-default btn-sm pull-right approve_kopce kopce\" href=\"/http/includes/forum/_approve_post.php?id=".$row_children_topic["forum_id"]."\" >Approve/Disapprove</a>";
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
	global $connection;
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
    $result_children_menu=mysqli_query($connection, $query);
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
	global $connection;
	global $mv;
	global $all_parents;
    // retrieve all children of $parent 
	$query  = "SELECT title, id, link_ex ";
	$query .= "FROM _menu ";
	$query .= "WHERE id_parent = ".$parent." ";
	$query .= "AND visibility_ex = 1 ";
	if ($privilegija==""||$privilegija=="7"){$query .= "AND protected = 0 ";}
	$query .= "ORDER BY pr ASC";

    $result_children_submenu=mysqli_query($connection, $query);
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
	global $connection;
	$query  = "SELECT id,visibility_ex ";
	$query .= "FROM _menu ";
	$query .= "WHERE id_parent = ".$parent;
	$query .= " AND visibility_ex=1 ";
    $result_has_children=mysqli_query($connection, $query);
	$rowcount=mysqli_num_rows($result_has_children);
	mysqli_free_result($result_has_children);
	return $rowcount;
}

function get_path($node) { 
	global $connection;
    // look up the parent of this node 
	$query  = "SELECT id_parent FROM _menu WHERE id=".$node;
    $result_path=mysqli_query($connection, $query);
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
function pagination($offset,$page,$page_vkupno,$prikazani,$rec_count,$link) {
	
    //$queryf= str_replace("&page=".$page,"",$queryf);
	$offset += 1;
	echo "<div class=\"text-right\">shown (from <strong>".$offset."</strong> to <strong>".$prikazani."</strong>) out of total: <strong>".$rec_count."</strong> ";
	if ($page!=0) {
		$previous_page=$page-1;
		echo " | <a href=\"".$link."&page=".$previous_page."\">previous </a>";
	}
	if ($page<$page_vkupno-1){
		$next_page=$page+1;
		echo " | <a href=\"".$link."&page=".$next_page."\">next </a>";
	}
	echo "</div>";
}



function verifyEmail($toemail, $fromemail, $getdetails = false){
$email_arr = explode("@", $toemail);
$domain = array_slice($email_arr, -1);
$domain = $domain[0];
// Trim [ and ] from beginning and end of domain string, respectively
$domain = ltrim($domain, "[");
$domain = rtrim($domain, "]");
if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
$domain = substr($domain, strlen("IPv6") + 1);
}
$mxhosts = array();
if( filter_var($domain, FILTER_VALIDATE_IP) )
$mx_ip = $domain;
else
getmxrr($domain, $mxhosts, $mxweight);
if(!empty($mxhosts) )
$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
else {
if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
$record_a = dns_get_record($domain, DNS_A);
}
elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
$record_a = dns_get_record($domain, DNS_AAAA);
}
if( !empty($record_a) )
$mx_ip = $record_a[0]['ip'];
else {
$result = "invalid";
$details .= "No suitable MX records found.";
return ( (true == $getdetails) ? array($result, $details) : $result );
}
}
$connect = @fsockopen($mx_ip, 25);
if($connect){
if(preg_match("/^220/i", $out = fgets($connect, 1024))){
fputs ($connect , "HELO $mx_ip\r\n");
$out = fgets ($connect, 1024);
$details .= $out."\n";
fputs ($connect , "MAIL FROM: <$fromemail>\r\n");
$from = fgets ($connect, 1024);
$details .= $from."\n";
fputs ($connect , "RCPT TO: <$toemail>\r\n");
$to = fgets ($connect, 1024);
$details .= $to."\n";
fputs ($connect , "QUIT");
fclose($connect);
if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
$result = "invalid";
}
else{
$result = "valid";
}
}
}
else{
$result = "invalid";
$details .= "Could not connect to server";
}
if($getdetails){
return array($result, $details);
}
else{
return $result;
}
}

function SendMail($ToName, $ToEmail, $FromName, $FromEmail, $Subject, $Body, $Header)
{
        $SMTP = fsockopen("smtp.t-home.mk", 25);
        if(!$SMTP)
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "HELO FROM t-home.mk\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "MAIL FROM: <$FromEmail>\r\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "RCPT To: <$ToEmail>\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "DATA\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "From: $FromName <$FromEmail>\n");
        fputs($SMTP, "To: $ToName <$ToEmail>\n");
        fputs($SMTP, "Subject: $Subject\n\n");
        fputs($SMTP, "$Body\r\n.\r\n");
        fputs($SMTP, "QUIT\n");
        $InputBuffer = fgets($SMTP, 1024);

        fclose($SMTP);
        return true;
}
?>
