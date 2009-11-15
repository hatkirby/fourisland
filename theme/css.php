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
4::::::::::::::::4  theme/css.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('../headerproc.php');

header('Content-type: text/css');

include('../includes/functions.php');

include('css/website.css');
include('layouts/' . getLayout() . '/style.php');
include('css/blog.php');
include('css/bubbles.css');
include('css/quotes.css');

?>
