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
4::::::::::::::::4  headerproc.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

if (!defined('S_INCLUDED') && defined('S_INCLUDE_FILE'))
{
	header('Location: /hackersdie.php');
	exit;
}

if (!defined('S_INCLUDED')) {define('S_INCLUDED',1);}

set_include_path(get_include_path() . ':' . $_SERVER['DOCUMENT_ROOT']);

?>
