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
		$this->bbcodes['b'] = '<strong>{CONTENT}</strong>';
		$this->bbcodes['i'] = '<em>{CONTENT}</em>';
		$this->bbcodes['u'] = '<u>{CONTENT}</u>';
		$this->bbcodes['url'] = '<a href="{CONTENT}">{CONTENT}</a>';
		$this->bbcodes2['url'] = '<a href="{PARAM}">{CONTENT}</a>';
		$this->bbcodes['img'] = '<img src="{CONTENT}" alt="Image" />';
		$this->bbcodes2['img'] = '<img src="{CONTENT}" alt="{PARAM}" title="{PARAM}" />';
		$this->bbcodes['imgright'] = '<img src="{CONTENT}" align="right" alt="Image" />';
		$this->bbcodes['big'] = '<big>{CONTENT}</big>';
		$this->bbcodes['small'] = '<small>{CONTENT}</small>';
		$this->bbcodes['ul'] = '<ul>{CONTENT}</ul>';
		$this->bbcodes['ol'] = '<ol>{CONTENT}</ol>';
		$this->bbcodes['li'] = '<li>{CONTENT}</li>';
		$this->bbcodes['code'] = '<code>{CONTENT}</code>';
		$this->bbcodes['pre'] = '<pre><code>{CONTENT}</code></pre>';
		$this->bbcodes['pref'] = '<pre>{CONTENT}</pre>';
		$this->bbcodes2['blog'] = '<a href="/blog/{PARAM}/">{CONTENT}</a>';
		$this->bbcodes['quote'] = '<a href="/quotes/{CONTENT}.php">#{CONTENT}</a>';
		$this->bbcodes2['quote'] = '<a href="/quotes/{PARAM}.php">{CONTENT}</a>';
		$this->bbcodes['ins'] = '<ins>{CONTENT}</ins>';
		$this->bbcodes['del'] = '<del>{CONTENT}</del>';
		$this->bbcodes['bquote'] = '<div class="bquote module unrounded"><blockquote>{CONTENT}</blockquote></div><cite><strong>Anonymous</strong></cite><div class="cleardiv"></div>';
		$this->bbcodes2['bquote'] = '<div class="bquote module unrounded"><blockquote>{CONTENT}</blockquote></div><cite><strong>{PARAM}</strong></cite><div class="cleardiv"></div>';
		$this->bbcodes2['abbr'] = '<abbr title="{PARAM}">{CONTENT}</abbr>';
		$this->bbcodes['hidden'] = '<span style="display: none">{CONTENT}</span>';
		$this->bbcodes['thumb'] = '<a href="/images/{CONTENT}"><img src="http://fourisland.com/thumb.php?file=images/{CONTENT}&amp;mode=scale&amp;by=521&amp;side=0" alt="Image" /></a>';
		$this->bbcodes['thumb2'] = '<a href="/images/{CONTENT}"><img src="http://fourisland.com/thumb.php?file=images/{CONTENT}&amp;mode=scale&amp;by=260&amp;side=0" align="right" alt="Image" /></a>';
		$this->bbcodes['project'] = '<a href="http://projects.fourisland.com/projects/show/{CONTENT}">{CONTENT}</a>';
		$this->bbcodes['hr'] = '<hr size="2" color="black" />';
		$this->bbcodes2['audio'] = '<p id="audioplayer_{CONTENT}">Click to download: <a href="{PARAM}">{CONTENT}</a></p><script>AudioPlayer.embed("audioplayer_{CONTENT}", {soundFile: "{PARAM}", titles: "{CONTENT}"});</script>';

		$this->init = true;
	}

	function parseBBCode($text)
	{
		if (!$this->init)
		{
			$this->init();
		}

		$to_parse = str_replace("\n",'[br]',$text);
		
		foreach ($this->bbcodes as $name => $value)
		{
			while (strpos($to_parse, '[' . $name . ']') !== FALSE)
			{
				$bbcode_uid = unique_id();
				$bbpos = strpos($to_parse, '[' . $name . ']');
				$otag = '[' . $name . ':' . $bbcode_uid . ']';
				$ctag = '[/' . $name . ':' . $bbcode_uid . ']';
				$to_parse = substr_replace($to_parse, $otag, $bbpos, strlen($name) + 2);
				$to_parse = substr_replace($to_parse, $ctag, strpos(substr($to_parse, $bbpos), '[/' . $name . ']') + $bbpos, strlen($name) + 3);

				if (strpos($this->bbcodes[$name], '<pre>') !== -1)
				{
					$to_parse = substr_replace($to_parse, str_replace('[br]', '', substr($to_parse, strpos($to_parse, $otag) + strlen($otag), strpos($to_parse, $ctag) - (strpos($to_parse, $otag) + strlen($otag)))), strpos($to_parse, $otag) + strlen($otag), strpos($to_parse, $ctag) - (strpos($to_parse, $otag) + strlen($otag)));
				}

				$value = str_replace('{CONTENT}', '\1', $value);
				$to_parse = preg_replace('/\[' . $name . ':' . $bbcode_uid . '\](.*)\[\/' . $name . ':' . $bbcode_uid . '\]/', $value, $to_parse);
			}
		}

		foreach ($this->bbcodes2 as $name => $value)
		{
			while (strpos($to_parse, '[' . $name . '=') !== FALSE)
			{
				$bbcode_uid = unique_id();
				$bbpos = strpos($to_parse, '[' . $name . '=');
				$to_parse = substr_replace($to_parse, '[' . $name . ':' . $bbcode_uid . '=', $bbpos, strlen($name) + 2);
				$to_parse = substr_replace($to_parse, '[/' . $name . ':' . $bbcode_uid . ']', strpos(substr($to_parse, $bbpos), '[/' . $name . ']') + $bbpos, strlen($name) + 3);

				$value = str_replace('{PARAM}', '\1', $value);
				$value = str_replace('{CONTENT}', '\2', $value);
				$to_parse = preg_replace('/\[' . $name . ':' . $bbcode_uid . '=([^\]]*)\](.*)\[\/' . $name . ':' . $bbcode_uid . '\]/', $value, $to_parse);
			}
		}

		return str_replace('[br]','<br />',$to_parse);
	}
}

function parseBBCode($text)
{
	static $bbcode;
	if (!isset($bbcode))
	{
		$bbcode = new BBCode();
	}

	return $bbcode->parseBBCode($text);
}

?>
