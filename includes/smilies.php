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
4::::::::::::::::4  includes/smilies.php
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

class Smilies
{
	var $init = false;
	var $smilies;

	function init()
	{
		$this->smilies[':)'] = '001_smile.gif';
		$this->smilies[':('] = 'sad.gif';
		$this->smilies[':D'] = 'biggrin.gif';

		$this->init = true;
	}

	function parseSmilies($text)
	{
		if (!$this->init)
		{
			$this->init();
		}

		foreach ($this->smilies as $name => $value)
		{
			$text = str_replace($name, '<img src="http://fourisland.com/theme/images/smilies/' . $value . '" alt="' . $name . '" />', $text);
		}

		return $text;
	}
}

function parseSmilies($text)
{
	global $smilies;
	if (!isset($smilies))
	{
		$smilies = new Smilies();
	}

	return $smilies->parseSmilies($text);
}

?>
