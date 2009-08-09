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

$headerTemp->add('CATEGORY',(isset($pageCategory)) ? $pageCategory : 'none');
$headerTemp->add('AID',(isset($pageAID)) ? $pageAID : 'none');
$headerTemp->add('EXTRATITLE',isset($title) ? ($title . ' - ') : '');
$headerTemp->add(strtoupper($pageCategory) . 'ACTIVE', ' class="active"');

if (($pageCategory != 'fourm') && ($pageCategory != 'wiki'))
{
	$headerTemp->add('REDIRPAGE',rawurlencode($_SERVER['REQUEST_URI']));
	$headerTemp->add('LOGDATA',echoLogData());
	$headerTemp->add('SID',getSessionID());
	$headerTemp->adds_block('MEMBERS',array('exi' => 1));

	if (isAdmin())
	{
		$headerTemp->adds_block('ADMIN',array('exi' => 1));
	}
}

if (isset($hatNav) && is_array($hatNav))
{
	$headerTemp->adds_block('CREATE_HATNAV', array('exi'=>1));
	
	foreach ($hatNav as $item)
	{
		$headerTemp->adds_block('HATNAV',array('TITLE' => $item['title'], 'URL' => $item['url'], 'ICON' => $item['icon']));
	}
}

$headerTemp->add('POTW', getPollOfTheWeek());

$gethits = "SELECT * FROM config WHERE name = \"hits\"";
$gethits2 = mysql_query($gethits);
$gethits3 = mysql_fetch_array($gethits2);
$headerTemp->add('HITS', $gethits3['value']);

$gethits = "SELECT * FROM config WHERE name = \"todayHits\"";
$gethits2 = mysql_query($gethits);
$gethits3 = mysql_fetch_array($gethits2);
$headerTemp->add('TODAY', $gethits3['value']);

$headerTemp->add('DATEFINDER', sd_dateFinder());

if ($usingIE)
{
	$headerTemp->add('FLASH', 'It appears you are using Internet Explorer. Four Island is not likely to work properly in IE due to a <a href="http://www.webdevout.net/articles/beware-of-xhtml#ie">huge bug</a> in it. <a href="http://getfirefox.com/">There are better browsers out there, why not try one?</a>');
}

$headerTemp->display();

?>
