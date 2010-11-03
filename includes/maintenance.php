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
4::::::::::::::::4  includes/maintenance.php
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

function isInMaintenance()
{
  $getconfig = "SELECT * FROM config WHERE name = \"maintenanceMode\"";
  $getconfig2 = mysql_query($getconfig);
  $getconfig3 = mysql_fetch_array($getconfig2);
  if ($getconfig3['value'] == '1')
  {
	  if (($_SERVER['REMOTE_ADDR'] != '127.0.0.1') && (!isAdmin()))
	  {
	    return true;
    }
  }
  
  return false;
}

if ((isset($dbwebpasswd)) && (isInMaintenance()))
{
	$template = new FITemplate('maintenance');
	$template->display($template);

	exit;
}

?>
