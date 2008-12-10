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
4::::::::::::::::4  pages/polloftheweek.php
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

if (!isset($forceDisplay))
{
	$getpoll = "SELECT * FROM polloftheweek ORDER BY id DESC LIMIT 0,1";
} else {
	$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $forceDisplay;
}
$getpoll2 = mysql_query($getpoll);
$getpoll3 = mysql_fetch_array($getpoll2);

$template->add('QUESTION', $getpoll3['question']);
$template->add('OPTION1', $getpoll3['option1']);
$template->add('OPTION2', $getpoll3['option2']);
$template->add('OPTION3', $getpoll3['option3']);
$template->add('OPTION4', $getpoll3['option4']);

$getip = "SELECT * FROM didpollalready WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
$getip2 = mysql_query($getip);
$getip3 = mysql_fetch_array($getip2);

if (($getip3['ip'] != $_SERVER['REMOTE_ADDR']) && (!isset($forceDisplay)))
{
	$template->adds_block('FORM',array('exi'=>1));
} else {
	$template->adds_block('DISPLAY',array('exi'=>1));

	$template->add('PERCENT1', getpercent($getpoll3,'1'));
	$template->add('PERCENT2', getpercent($getpoll3,'2'));
	$template->add('PERCENT3', getpercent($getpoll3,'3'));
	$template->add('PERCENT4', getpercent($getpoll3,'4'));
}

?>
