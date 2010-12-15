<?php

$memcache = new Memcache();
$memcache->connect('localhost', 11211) or die('Cannot connect to memcache');

$memcache->increment('services/frame/total');
$memcache->increment('services/frame/0.1/total');
$memcache->close();

header('Content-type: text/css');

// TODO: Set up caching in here.

require(PATH_PREFIX . '/cssmin.php');

if(isset($_GET['include'])) {
	$includes = explode(',', $_GET['include']);
} else {
	$includes = array(
		'reset',
		'code',
		'typography',
		'layout',
		'controls',
		'forms',
		'tables',
		'form_layout'
	);
}
$output = '';
foreach($includes as $include) {
	$output .= cssmin::minify(file_get_contents(PATH_PREFIX . "/0.1/$include.css"));
}
$output = str_replace(';}','}',$output);
$output = trim($output);

$header = <<<HEADER
/*
Serverboy Frame
Latest Build (Min)
*/
HEADER;
$output = $header . $output;

echo $output;
