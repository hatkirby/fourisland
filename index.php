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
4::::::::::::::::4  index.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('headerproc.php');

header('X-Pingback: http://fourisland.com/xmlrpc.php');

include('../security/config.php');
include('includes/db.php');
include('includes/common.php');

if (strpos($_SERVER['REQUEST_URI'],'index.php'))
{
	header('Location: ' . getRewriteURL());
	exit;
}

if (sd_isSpecialDay('April Fools Day'))
{
  if (rand(0,20) == 4)
  {
    header('Location: http://www.youtube.com/watch?v=CD2LRROpph0');
    echo(" ");
    exit;
  }
}

ob_start();

$pageName = basename($_GET['area']);

if (file_exists('pages/' . $pageName . '.php'))
{
	include('pages/' . $pageName . '.php');
} else {
	generateError('404');
}

$content = ob_get_contents();

ob_end_clean();

include('includes/layout.php');

?>
