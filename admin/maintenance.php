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
4::::::::::::::::4  admin/maintenance.php
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

$category = 'home';
$pageaid = 'maintenance';

if (isset($_GET['submit']))
{
	if ($_POST['mode'] == 'on')
	{
		$set = 1;
	} else if ($_POST['mode'] == 'off')
	{
		$set = 0;
	}

	if (isset($set))
	{
		$setconfig = "UPDATE config SET value = \"" . $set . "\" WHERE name = \"maintenanceMode\"";
		$setconfig2 = mysql_query($setconfig);

		$flashmsg = 'Maintenance Mode has successfully been set to "' . $_POST['mode'] . '"';
	}
}

$template = new FITemplate('admin/maintenance');

$getconfig = "SELECT * FROM config WHERE name = \"maintenanceMode\"";
$getconfig2 = mysql_query($getconfig);
$getconfig3 = mysql_fetch_array($getconfig2);
if ($getconfig3['value'] == '1')
{
	$template->add('ON', ' selected="selected"');
} else {
	$template->add('OFF', ' selected="selected"');
}

$template->display();

?>
