<?php
/*
       444444444  
      4::::::::4  
     4:::::::::4  
    4::::44::::4  
   4::::4 4::::4   Four Island
  4::::4  4::::4  
 4::::4   4::::4   Written and maintained by Starla Insigna
4::::444444::::444
4::::::::::::::::4  includes/bbcode.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

if (!defined('S_INCLUDE_FILE')) {define('S_INCLUDE_FILE',1);}

require('headerproc.php');

$bbcode = bbcode_create(array('' => array('type' => BBCODE_TYPE_ROOT)));

// [b][/b] - Bold
bbcode_add_element($bbcode,'b',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<B>',
					'close_tag' => '</B>'));

// [i][/i] - Italic
bbcode_add_element($bbcode,'i',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<I>',
					'close_tag' => '</I>'));

// [url][/url] - [url=][/url] - Link
bbcode_add_element($bbcode,'url',array(	'type' => BBCODE_TYPE_OPTARG,
					'open_tag' => '<a href="{PARAM}">',
					'close_tag' => '</a>',
					'default_arg' => '{CONTENT}'));

// [img][/img] - [img=][/img] - Image
bbcode_add_element($bbcode,'img',array(	'type' => BBCODE_TYPE_OPTARG,
					'open_tag' => '<IMG SRC="',
					'close_tag' => '" ALT="{PARAM}" ALIGN="RIGHT"></IMG>',
					'default_tag' => '{CONTENT}'));

// [big][/big] - Big
bbcode_add_element($bbcode,'big',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<BIG>',
					'close_tag' => '</BIG>'));

// [small][/small] - Small
bbcode_add_element($bbcode,'small',array(	'type' => BBCODE_TYPE_NOARG,
						'open_tag' => '<SMALL>',
						'close_tag' => '</SMALL>'));

// [ul][/ul] - Unordered List
bbcode_add_element($bbcode,'ul',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<UL>',
					'close_tag' => '</UL>',
					'childs' => 'li'));

// [ol][/ol] - Ordered List
bbcode_add_element($bbcode,'ol',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<OL>',
					'close_tag' => '</OL>',
					'childs' => 'li'));

// [li][/li] - List Item
bbcode_add_element($bbcode,'li',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<LI>',
					'close_tag' => '</LI>'));

// [code][/code] - Code
bbcode_add_element($bbcode,'code',array(	'type' => BBCODE_TYPE_NOARG,
						'open_tag' => '<CODE>',
						'close_tag' => '</CODE>'));

// [pre][/pre] - Preformatted Code
bbcode_add_element($bbcode,'pre',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<P><DIV CLASS="autosize"><DIV CLASS="bubble"><DIV CLASS="bquote"><BLOCKQUOTE><DIV><PRE>',
					'close_tag' => '</PRE></DIV></BLOCKQUOTE></DIV></DIV></DIV><DIV CLASS="cleardiv"></DIV>'));

function bb_fixCode($string)
{
	$he = htmlentities($string);
	$br = nl2br($he);
	$sp = str_replace('  ','&nbsp;$nbsp;',$br);
	$ta = str_replace('	','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$sp);
	return($ta);
}

// [blog][/blog] - Blog Link
bbcode_add_element($bbcode,'blog',array(	'type' => BBCODE_TYPE_OPTARG,
						'open_tag' => (isset($oldBlog) ? '<A HREF="/archives/{CONTENT}.php">' : '<A HREF="/blog/{PARAM}/">'),
						'close_tag' => '</A>',
						'default_arg' => '{CONTENT}'));

// [quote][/quote] - Quotes DB Link
bbcode_add_element($bbcode,'quote',array(	'type' => BBCODE_TYPE_NOARG,
						'open_tag' => (isset($oldBlog) ? '<A HREF="http://quotes.fourisland.com/?{CONTENT}">#' : '<A HREF="/quotes/{CONTENT}.php">#'),
						'close_tag' => '</A>'));

// [ins][/ins] - Insert
bbcode_add_element($bbcode,'ins',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<INS>',
					'close_tag' => '</INS>'));

// [del][/del] - Delete
bbcode_add_element($bbcode,'del',array(	'type' => BBCODE_TYPE_NOARG,
					'open_tag' => '<DEL>',
					'close_tag' => '</DEL>'));

// [bquote][/bquote] - Blockquote
bbcode_add_element($bbcode,'bquote',array(	'type' => BBCODE_TYPE_OPTARG,
						'open_tag' => '<P><DIV CLASS="autosize"><DIV CLASS="bubble"><DIV CLASS="bquote"><BLOCKQUOTE><DIV><NOBR>',
						'close_tag' => '</NOBR></DIV></BLOCKQUOTE></DIV><CITE><STRONG>{PARAM}</STRONG></CITE></DIV></DIV><DIV CLASS="cleardiv"></DIV>',
						'default_arg' => 'Anonymous'));

// [project][/project] - Project Link
bbcode_add_element($bbcode,'project',array(	'type' => BBCODE_TYPE_NOARG,
						'open_tag' => (isset($oldBlog) ? '<A HREF="http://projects.fourisland.com/{CONTENT}/">' : '<A HREF="/projects/{CONTENT}/">'),
						'close_tag' => '</A>'));

// [abbr][/abbr] - Abbreviation
bbcode_add_element($bbcode,'abbr',array(	'type' => BBCODE_TYPE_OPTARG,
						'open_tag' => '<ABBR TITLE="{PARAM}">',
						'close_tag' => '</ABBR>',
						'default_arg' => ''));

// [br] - Line Break
bbcode_add_element($bbcode,'br',array(	'type' => BBCODE_TYPE_SINGLE,
					'open_tag' => '<BR>'));

// [hidden][/hidden] - Hidden Text
bbcode_add_element($bbcode,'hidden',array(	'type' => BBCODE_TYPE_OPTARG,
						'open_tag' => '<DIV STYLE="display: none">',
						'close_tag' => '</DIV>',
						'default_arg' => ''));

function parseBBCode($text)
{
	global $bbcode;
	$to_parse = str_replace("\n",'[br]',htmlentities($text));
	$to_parse = bbcode_parse($bbcode,$to_parse);
	return str_replace('[br]','',$to_parse);
}

?>
