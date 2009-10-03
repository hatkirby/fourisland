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
} else {
	if (getLayout() == '7')
	{
		header('Content-type: application/xhtml+xml');
		$xhtml = true;
	}
}

if (strpos($_SERVER['REQUEST_URI'],'index.php'))
{
	header('Location: ' . getRewriteURL());
	exit;
}

ob_start();

$pageName = isset($_GET['area']) ? $_GET['area'] : 'welcome';

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
