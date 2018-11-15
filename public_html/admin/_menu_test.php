<?php include_once("_properties.php");?>
<?php include_once("_procedures.php"); 
	
function display_children_menu($parent, $level) { 
	global $con;
	$toplevel=$level;
    // retrieve all children of $parent 
	$query  = "SELECT title, id, link ";
	$query .= "FROM _menu ";
	//$query .= "inner join users on users.id=forum.user_id ";
	$query .= "WHERE id_parent = ".$parent." ";
	$query .= "ORDER BY pr ASC";
	//echo $query."<BR>";
    $result=mysqli_query($con, $query);
 	//confirm_query($result);
	//print_r ($result);
    // display each child 
	echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        // indent and display the post of this child 
		echo "<li>";
		echo "<a href=\"".$row['link']."\">".$row['title']."</a>";
		echo "</li>";
        // call this function again to display this 
        // child's children 

        display_children_menu($row['id'], $level+1);
    }
	echo "</ul>";
} 
display_children_menu(0,0);
?>






