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
4::::::::::::::::4  includes/common.php
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

include('includes/template.php');
include('includes/session.php');
include('includes/maintenance.php');
include('includes/parsers.php');
include('includes/xmlrpc/xmlrpc.inc');
include('includes/specialdates.php');
include('includes/functions.php');
include('includes/hits.php');
include('includes/updatePending.php');

if (isset($_GET['layout']))
{
	if (!file_exists('theme/layouts/' . basename($_GET['layout'])))
	{
		$_GET['layout'] = '7';
	}

	setcookie('layout', $_GET['layout'], time()+60*60*24*30, '/', '.fourisland.com');

	unset($_GET['layout']);

	header('Location: ' . getRewriteURL());
	exit;
}

if (preg_match('|MSIE ([0-9].[0-9]{1,2})|', $_SERVER['HTTP_USER_AGENT'], $matched))
{
	$usingIE = true;
}

?>
