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
4::::::::::::::::4  includes/parsers.php
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

include('includes/bbcode.php');
include('includes/smilies.php');

function parseText($text)
{
	$text = htmlspecialchars($text);
	$text = parseSmiliesFirstPass($text);
	$text = parseBBCode($text);
	$text = parseSmiliesSecondPass($text);
	$text = doAprilFoolsDay($text);

	return $text;
}

?>
