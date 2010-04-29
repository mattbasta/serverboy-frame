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

header('Content-type: text/css');

header("Expires: Tue, 01 Dec 2037 16:00:00 GMT");
header("Cache-Control: public, max-age=31536000");
header('Frame: Very Yes');

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
$lastMod = 0;
foreach($includes as $include)
	$lastMod = max($lastMod, filemtime(PATH_PREFIX . "$include.css"));

if(isset($_SERVER["HTTP_IF_MODIFIED_SINCE"])) {
	$expected_modified = strtotime(preg_replace('/;.*$/','',$_SERVER["HTTP_IF_MODIFIED_SINCE"]));
	if($lastMod <= $expected_modified) {
		header("HTTP/1.0 304 Not Modified");
		exit;
	}
}

$output = '';
foreach($includes as $include)
	$output .= file_get_contents(PATH_PREFIX . "$include.css");

require('../cssmin_2.php');
$output = Minify_CSS_Compressor::process($output);

header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastMod) . ' GMT');
header('Age: ' . ((time() - $lastMod) % 31536000));

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

ob_start("ob_gzhandler");
echo $output;