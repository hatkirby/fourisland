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
4::::::::::::::::4  theme/layouts/4.5/style.php
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

include('layouts/4.5/style.css');

if (((date('G') >= 20) || (date('G') <= 6)) || isset($_GET['night']) && !isset($_GET['day']))
{
	include('layouts/4.5/night.css');
} else {
	include('layouts/4.5/day.css');
}

include('layouts/4.5/headers.php');
include('layouts/4.5/navigation.css');
include('layouts/4.5/holiday.php');

?>
