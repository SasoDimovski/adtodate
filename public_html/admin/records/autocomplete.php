
<?php
    //database configuration
    $dbHost = "localhost";
    $dbUsername = "adtodate_user";
    $dbPassword = "67220183122";
    $dbName = "adtodate_db";
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    $db->query( "SET NAMES 'utf8'");
    //get search term
    $searchTerm = $_GET["term"];
	//echo $searchTerm;
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM _workgroups WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC LIMIT 0, 20");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row["title"];
		//echo $row["title"];
		//echo $data[];	
    }
    
    //return json data
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
?> 
