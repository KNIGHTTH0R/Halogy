<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* CodeIgniter BBCode Helpers
*
* @package  CodeIgniter
* @subpackage Helpers
* @category Helpers
* @author  Philip Sturgeon
* @changes  MpaK http://mrak7.com
* @link  http://codeigniter.com/wiki/BBCode_Helper/
*/

// ------------------------------------------------------------------------

/**
* parse_bbcode
*
* Converts BBCode style tags into basic HTML
*
* @access public
* @param string unparsed string
* @param int max image width
* @return string
*/

function bbcode($str = '', $max_images = 0)
{
	// convert to html entities
	$str = htmlentities($str);

	$str = auto_link($str);
	
	// Max image size eh? Better shrink that pic!
	if($max_images > 0):
		$str_max = "style=\"max-width:".$max_images."px; width: [removed]this.width > ".$max_images." ? ".$max_images.": true);\"";
	endif;
	
	$find = array(
	"'\n'i",
	"'\[b\](.*?)\[/b\]'is",
	"'\[i\](.*?)\[/i\]'is",
	"'\[u\](.*?)\[/u\]'is",
	"'\[s\](.*?)\[/s\]'is",
	"'\[img\](.*?)\[/img\]'i",
	"'\[url\](.*?)\[/url\]'i",
	"'\[url=(.*?)\](.*?)\[/url\]'i",
	"'\[link\](.*?)\[/link\]'i",
	"'\[link=(.*?)\](.*?)\[/link\]'i",
	"'\[size=small\](.*?)\[/size\]'is",	
	"'\[size=normal\](.*?)\[/size\]'is",
	"'\[size=medium\](.*?)\[/size\]'is",
	"'\[size=big\](.*?)\[/size\]'is",
	"'\[quote\](.*?)\[/quote\]'is",
	"'\[code\](.*?)\[/code\]'is"	
	);
	
	$replace = array(
	'<br />',
	'<strong>\\1</strong>',
	'<em>\\1</em>',
	'<u>\\1</u>',
	'<s>\\1</s>',
	'<img src="\\1" alt="" />',
	'<a href="\\1">\\1</a>',
	'<a href="\\1">\\2</a>',
	'<a href="\\1">\\1</a>',
	'<a href="\\1">\\2</a>',
	'<span style="font-size:0.9em;">\\1</span>',	
	'<span style="font-size:1em;">\\1</span>',
	'<span style="font-size:1.2em;">\\1</span>',
	'<span style="font-size:1.4em;">\\1</span>',
	'</p><blockquote>\\1</blockquote><p>',	
	'<pre><code>\\1</pre></code>'				
	);
	
	
	$str = preg_replace($find, $replace, $str);

	return '<p>'.$str.'</p>';

}

?>