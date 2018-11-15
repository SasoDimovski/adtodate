<?php
/*if( ini_get('allow_url_fopen') ) {
    die('allow_url_fopen is enabled. file_get_contents should work well');
} else {
    die('allow_url_fopen is disabled. file_get_contents would not work');
}*/

$xml=("http://adage.com/rss-feed?section_id=301&xml=RSS2");
pisi_rss($xml);
$xml=("http://feeds.mashable.com/Mashable");
pisi_rss($xml);
$xml=("http://www.nmedia-marketig.com/feed/");
//pisi_rss($xml);
$xml=("https://www.adbusters.org/feed/");
pisi_rss($xml);
$xml=("http://www.campaignlive.co.uk/rss/latest");
pisi_rss($xml);
$xml=("https://adsoftheworld.com/node/feed");
pisi_rss($xml);
$xml=("http://feeds.feedburner.com/behance/vorr");
pisi_rss($xml);
$xml=("http://www.boredpanda.com/feed/");
pisi_rss($xml);
$xml=("http://www.adweek.com/feed/");
pisi_rss($xml);

function pisi_rss($xml) {
	$xmlDoc = new DOMDocument();
	$xmlDoc->load($xml);
	//get elements from "<channel>"
	$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
	$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
	$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
	$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
	
	//output elements from "<channel>"
	echo("<h2><a href='" . $channel_link . "'>" . $channel_title . "</a></h2>");
	//echo("<br>");
	//echo($channel_desc . "</p>");
	
	//get and output "<item>" elements
	$x=$xmlDoc->getElementsByTagName('item');
	for ($i=0; $i<=3; $i++) {
	  $item_title=$x->item($i)->getElementsByTagName('title') ->item(0)->childNodes->item(0)->nodeValue;
	  $item_link=$x->item($i)->getElementsByTagName('link') ->item(0)->childNodes->item(0)->nodeValue;
	  //$item_desc=$x->item($i)->getElementsByTagName('description') ->item(0)->childNodes->item(0)->nodeValue;
	  echo ("<p><a href='" . $item_link . "' target='_target'>" . $item_title . "</a>");
	  echo ("<br>");
	  echo ($item_desc . "</p>");
	}
}
?>