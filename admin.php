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
4::::::::::::::::4  admin.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('headerproc.php');

include('../security/config.php');
include('includes/db.php');
include('includes/common.php');

if (!isAdmin())
{
	ob_start();
	generateError('404');
	$content = ob_get_contents();
	ob_end_clean();

	include('includes/layout.php');

	exit;
}

ob_start();

$pageName = isset($_GET['area']) ? $_GET['area'] : 'welcome';

if (file_exists('admin/' . $pageName . '.php'))
{
	include('admin/' . $pageName . '.php');
} else {
	generateError('404');
}

$doc = ob_get_contents();
ob_end_clean();

$doc = stripslashes($doc);

$template = new FITemplate('admin/header');
$template->add(strtoupper($category) . 'ACTIVECAT', ' class="active"');
$template->adds_block(strtoupper($category) . 'ISACTIVECAT', array('exi'=>1));
if (isset($pageaid)) $template->add(strtoupper($pageaid) . 'ACTIVE', ' class="active"');
if (!isset($flashmsg)) $template->add('HIDEFLASH', ' style="display: none"');
if (isset($flashmsg)) $template->add('FLASH', $flashmsg);
$template->display();

echo($doc);

$template = new FITemplate('admin/footer');
$template->display();

?>
