<?php

// edit these elements to fit your data desire

$subreddit = "The_Donald";										// check exact spelling!
$fn_list = "list_The_Donald_top_all_2017-01-31_15-33.json";		// the file generated by the grab_list.php in your data_subreddit directory	


// do not edit anything below this line
//-----------------------------------------------------

// basic script conf
date_default_timezone_set("UTC");
set_time_limit(3600*5);
ini_set("memory_limit","100M");
ini_set("error_reporting",1);

// set file paths
$workdir = getcwd();
$jsondir = $workdir . "/data_" . $subreddit . "/";

// get list and iterate over it
$fullist = json_decode(file_get_contents($jsondir . $fn_list));

echo "\ngetting data: ";

$counter = 0;
foreach($fullist as $listitem) {
	
	$id = $listitem->data->id;
	$thread = "http://www.reddit.com" . $listitem->data->permalink . ".json";
	$url = $listitem->data->url;
	
	$fn_thread = $jsondir . "thread_" . $id . ".json";

	if(!file_exists($fn_thread)) {
	
		$data = file_get_contents($thread);
		file_put_contents($fn_thread, $data);
	}
	
	$counter++;
	echo $counter . " ";
	
	sleep(.2);				// let's just back off a litte and wait for 200ms to be polite
}

echo "\n\nfinished";

?>