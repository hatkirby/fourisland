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
$headerTemp->add(strtoupper($pageCategory) . 'ACTIVE', ' CLASS="active"');

if (isset($_POST['message']))
{
	$headerTemp->adds_block('MESSAGE',array('MSG' => $_POST['message']));
}

if (($pageCategory != 'fourm') && ($pageCategory != 'wiki'))
{
	$headerTemp->add('REDIRPAGE',rawurlencode($_SERVER['REQUEST_URI']));
	$headerTemp->add('LOGDATA',echoLogData());
	$headerTemp->add('SID',getSessionID());
	$headerTemp->adds_block('MEMBERS',array('exi' => 1));
}

$headerTemp->display();

?>
