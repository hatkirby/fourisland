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
4::::::::::::::::4  includes/header.php
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

$headerTemp = new FITemplate('header');

if (!isset($_COOKIE['splashOnce']))
{
        setcookie('splashOnce', '1');

	$headerTemp->adds_block('SPLASH', array('exi'=>1));
}

if ((date('G') >= 20) || (date('G') <= 6))
{
	$bodyID = 'night';
} else {
	$bodyID = 'day';
}
$headerTemp->add('BODYID',$bodyID);
$headerTemp->add('CATEGORY',(isset($pageCategory)) ? $pageCategory : 'none');
$headerTemp->add('AID',(isset($pageAID)) ? $pageAID : 'none');
$headerTemp->add('BODYTAGS',(isset($bodyTags)) ? $bodyTags : '');
$headerTemp->add('HEADTAGS',isset($headtags) ? $headtags : '');
$headerTemp->add('EXTRATITLE',isset($title) ? ($title . ' - ') : '');
$headerTemp->add('PAGEID',(isset($pageID)) ? $pageID : 'none');

if (isset($_POST['message']))
{
	$headerTemp->adds_block('MESSAGE',array('MSG' => $_POST['message']));
}

$headerTemp->display();

?>
