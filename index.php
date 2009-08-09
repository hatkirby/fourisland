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

header('Content-type: application/xhtml+xml');
header('X-Pingback: http://fourisland.com/xmlrpc.php');

include('../security/config.php');
include('includes/db.php');
include('includes/template.php');
include('includes/session.php');
include('includes/maintenance.php');
include('includes/parsers.php');
include('includes/xmlrpc/xmlrpc.inc');
include('includes/specialdates.php');
include('includes/functions.php');
include('includes/hits.php');
include('includes/updatePending.php');

ob_start();

$pageName = isset($_GET['area']) ? $_GET['area'] : 'welcome';

if (file_exists('pages/' . $pageName . '.php'))
{
	include('pages/' . $pageName . '.php');
} else {
	generateError('404');
}

$doc = ob_get_contents();
ob_end_clean();

$doc = stripslashes($doc);

include('includes/header.php');
echo($doc);
include('includes/footer.php');

?>
