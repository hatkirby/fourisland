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

class BBCode
{
	var $init = false;
	var $bbcodes;
	var $bbcodes2;

	function init()
	{
		$this->bbcodes['b'] = '<B>{CONTENT}</B>';
		$this->bbcodes['i'] = '<I>{CONTENT}</I>';
		$this->bbcodes['url'] = '<A HREF="{CONTENT}">{CONTENT}</A>';
		$this->bbcodes2['url'] = '<A HREF="{PARAM}">{CONTENT}</A>';
		$this->bbcodes['img'] = '<IMG SRC="{CONTENT}" />';
		$this->bbcodes2['img'] = '<IMG SRC="{CONTENT}" ALT="{PARAM}" TITLE="{PARAM}" ALIGN="right" />';
		$this->bbcodes['big'] = '<BIG>{CONTENT}</BIG>';
		$this->bbcodes['small'] = '<SMALL>{CONTENT}</SMALL>';
		$this->bbcodes['ul'] = '<UL>{CONTENT}</UL>';
		$this->bbcodes['ol'] = '<OL>{CONTENT}</OL>';
		$this->bbcodes['li'] = '<LI>{CONTENT}</LI>';
		$this->bbcodes['code'] = '<CODE>{CONTENT}</CODE>';
		$this->bbcodes['pre'] = '<P><DIV CLASS="autosize"><DIV CLASS="bubble"><DIV CLASS="bquote"><BLOCKQUOTE><DIV><PRE>{CONTENT}</PRE></DIV></BLOCKQUOTE></DIV></DIV></DIV><DIV CLASS="cleardiv"></DIV>';
		$this->bbcodes2['blog'] = '<A HREF="/blog/{PARAM}/">{CONTENT}</A>';
		$this->bbcodes['ins'] = '<INS>{CONTENT}</INS>';
		$this->bbcodes['del'] = '<DEL>{CONTENT}</DEL>';
		$this->bbcodes['bquote'] = '<P><DIV CLASS="autosize"><DIV CLASS="bubble"><DIV CLASS="bquote"><BLOCKQUOTE><DIV><NOBR>{CONTENT}</NOBR></DIV></BLOCKQUOTE></DIV><CITE><STRONG>Anonymous</STRONG></CITE></DIV></DIV><DIV CLASS="cleardiv"></DIV>';
		$this->bbcodes2['bquote'] = '<P><DIV CLASS="autosize"><DIV CLASS="bubble"><DIV CLASS="bquote"><BLOCKQUOTE><DIV><NOBR>{CONTENT}</NOBR></DIV></BLOCKQUOTE></DIV><CITE><STRONG>{PARAM}</STRONG></CITE></DIV></DIV><DIV CLASS="cleardiv"></DIV>';
		$this->bbcodes2['abbr'] = '<ABBR TITLE="{PARAM}">{CONTENT}</ABBR>';
		$this->bbcodes['hidden'] = '<DIV STYLE="display: none">{CONTENT}</DIV>';

		$this->init = true;
	}

	function parseBBCode($text)
	{
		if (!$this->init)
		{
			$this->init();
		}

		$to_parse = str_replace("\n",'[br]',htmlentities($text));
		
		foreach ($this->bbcodes as $name => $value)
		{
			while (strpos($to_parse, '[' . $name . ']') !== FALSE)
			{
				$bbcode_uid = unique_id();
				$to_parse = substr_replace($to_parse, '[' . $name . ':' . $bbcode_uid . ']', strpos($to_parse, '[' . $name . ']'), strlen($name) + 2);
				$to_parse = substr_replace($to_parse, '[/' . $name . ':' . $bbcode_uid . ']', strpos($to_parse, '[/' . $name . ']'), strlen($name) + 3);

				$value = str_replace('{CONTENT}', '\1', $value);
				$to_parse = preg_replace('/\[' . $name . ':' . $bbcode_uid . '\](.*)\[\/' . $name . ':' . $bbcode_uid . '\]/', $value, $to_parse);
			}
		}

		foreach ($this->bbcodes2 as $name => $value)
		{
			while (strpos($to_parse, '[' . $name . '=') !== FALSE)
			{
				$bbcode_uid = unique_id();
				$to_parse = substr_replace($to_parse, '[' . $name . ':' . $bbcode_uid . '=', strpos($to_parse, '[' . $name . '='), strlen($name) + 2);
				$to_parse = substr_replace($to_parse, '[/' . $name . ':' . $bbcode_uid . ']', strpos($to_parse, '[/' . $name . ']'), strlen($name) + 3);

				$value = str_replace('{PARAM}', '\1', $value);
				$value = str_replace('{CONTENT}', '\2', $value);
				$to_parse = preg_replace('/\[' . $name . ':' . $bbcode_uid . '=([^\]]*)\](.*)\[\/' . $name . ':' . $bbcode_uid . '\]/', $value, $to_parse);
			}
		}

		return str_replace('[br]','<BR />',$to_parse);
	}
}

function parseBBCode($text)
{
	global $bbcode;
	if (!isset($bbcode))
	{
		$bbcode = new BBCode();
	}

	return $bbcode->parseBBCode($text);
}

?>
