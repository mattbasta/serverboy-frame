<?

function closemem() {
	global $memcache;
	if(isset($memcache))
		$memcache->close();
}
register_shutdown_function('closemem');

$memcache = new Memcache();
$memcache->connect('localhost', 11211) or die('Cannot connect to memcache');

$memcache->increment('services/frame/total');
$memcache->increment('services/frame/0.3/total');


if(!defined('PATH_PREFIX'))
	define('PATH_PREFIX', './');

require('../cssmin_2.php');

ob_start("ob_gzhandler");

header('Content-type: text/css');

header("Expires: Tue, 01 Dec 2037 16:00:00 GMT");
header("Cache-Control: public");

if(isset($_GET['include'])) {
	$includes = explode(',', $_GET['include']);
} else {
	$includes = array(
		'reset',
		'formatting',
		'code',
		'base_typography',
		'typography',
		'layout',
		'controls',
		'forms',
		'tables',
		'form_layout',
		'paper_layout',
		'print'
	);
}
$output = '';
$lastMod = 0;
foreach($includes as $include) {
	$output .= file_get_contents(PATH_PREFIX . "$include.css");
	$lastMod = max($lastMod, filemtime(PATH_PREFIX . "$include.css"));
}

$output = Minify_CSS_Compressor::process($output);

header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastMod) . ' GMT');   
$output = str_replace("\n",' ',$output);
$output = trim($output);

$header = <<<HEADER
/*
Serverboy Frame
Copyright 2010 Matt Basta
Build 0.3 (Min)
*/
HEADER;
$output = $header . $output;

echo $output;