<?php
header('Content-type: text/json');
echo '[';
$separator = "";
$days = 16;


	echo '	{ "date": "1314579600000", "type": "meeting", "title": "Test Last Year", "description": "Локација, Држава, Град, Место", "url": "http://www.event3.com/" },';
	echo '	{ "date": "1377738000000", "type": "meeting", "title": "Test Next Year", "description": "Локација, Држава, Град, Место", "url": "http://www.event3.com/" },';
for ($i = 1 ; $i < $days; $i= 1 + $i * 2) {
	echo $separator;
	$initTime = (intval(microtime(true))*1000) + (86400000 * ($i-($days/2)));
	
	
	
	echo '	{ "date": "'; echo $initTime; echo '", "type": "meeting", "title": "Project 1 '; echo $i; echo ' meeting", "description": "Локација, Држава, Град, Место", "url": "http://www.event1.com/" },';
	
	echo '	{ "date": "'; echo $initTime+3600000; echo '", "type": "demo", "title": "Project 2'; echo $i; echo ' demo", "description": "Локација, Држава, Град, Место", "url": "http://www.event2.com/" },';

	echo '	{ "date": "'; echo $initTime-7200000; echo '", "type": "meeting", "title": "Project 3 '; echo $i; echo ' Brainstorming", "description": "Локација, Држава, Град, Место", "url": "http://www.event3.com/" },';
	
	echo '	{ "date": "'; echo $initTime+10800000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Локација, Држава, Град, Место", "url": "http://www.event4.com/" },';
	
	echo '	{ "date": "'; echo $initTime+1800000; echo '", "type": "meeting", "title": "Project '; echo $i; echo ' meeting", "description": "Локација, Држава, Град, Место", "url": "http://www.event5.com/" },';
	
	echo '	{ "date": "'; echo $initTime+3600000+2592000000; echo '", "type": "demo", "title": "Project '; echo $i; echo ' demo", "description": "Локација, Држава, Град, Место", "url": "http://www.event6.com/" },';
	
	echo '	{ "date": "'; echo $initTime-7200000+2592000000; echo '", "type": "meeting", "title": "Test Project '; echo $i; echo ' Brainstorming", "description": "Локација, Држава, Град, Место", "url": "http://www.event7.com/" },';
	
	echo '	{ "date": "'; echo $initTime+10800000+2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Локација, Држава, Град, Место", "url": "http://www.event8.com/" },';
	
	echo '	{ "date": "'; echo $initTime+3600000-2592000000; echo '", "type": "demo", "title": "Project '; echo $i; echo ' demo", "description": "Локација, Држава, Град, Место", "url": "http://www.event9.com/" },';
	
	echo '	{ "date": "'; echo $initTime-7200000-2592000000; echo '", "type": "meeting", "title": "Test Project '; echo $i; echo ' Brainstorming", "description": "Локација, Држава, Град, Место", "url": "http://www.event10.com/" },';
	
	echo '	{ "date": "'; echo $initTime+10800000-2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Локација, Држава, Град, Место", "url": "http://www.event11.com/" }';
	
	
	
	$separator = ",";
}
echo ']';
?>