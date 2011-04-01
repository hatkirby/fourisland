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
4::::::::::::::::4  includes/layout.php
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

$template = new FITemplate('layouts/' . getLayout() . '/layout');

$template->add('CATEGORY',(isset($pageCategory)) ? $pageCategory : 'none');
$template->add('AID',(isset($pageAID)) ? $pageAID : 'none');
$template->add('EXTRATITLE',isset($title) ? ($title . ' - ') : '');
$template->add(strtoupper($pageCategory) . 'ACTIVE', ' class="active"');
$template->add('EXTRASIDEBAR', isset($extraSidebar) ? $extraSidebar : '');

$template->add('REDIRPAGE',rawurlencode($_SERVER['REQUEST_URI']));
$template->add('LOGDATA',echoLogData());
$template->add('LOWERLOGDATA','log' . strtolower(echoLogData()));
$template->add('SID',getSessionID());
$template->adds_block('MEMBERS',array('exi' => 1));

if (isAdmin())
{
	$template->adds_block('ADMIN',array('exi' => 1));
}

if (isset($hatNav) && is_array($hatNav))
{
	$template->adds_block('CREATE_HATNAV', array('exi'=>1));
	
	foreach ($hatNav as $item)
	{
		$template->adds_block('HATNAV',array('TITLE' => doAprilFoolsDay($item['title']), 'URL' => $item['url'], 'ICON' => $item['icon']));
	}
}

$gethits = "SELECT * FROM config WHERE name = \"hits\"";
$gethits2 = mysql_query($gethits);
$gethits3 = mysql_fetch_array($gethits2);
$template->add('HITS', $gethits3['value']);

$gethits = "SELECT * FROM config WHERE name = \"todayHits\"";
$gethits2 = mysql_query($gethits);
$gethits3 = mysql_fetch_array($gethits2);
$template->add('TODAY', $gethits3['value']);

$template->add('DATEFINDER', sd_dateFinder());

if ($usingIE)
{
	$template->add('FLASH', 'It appears you are using Internet Explorer. Four Island is not likely to work properly in IE due to a <a href="http://www.webdevout.net/articles/beware-of-xhtml#ie">huge bug</a> in it. <a href="http://getfirefox.com/">There are better browsers out there, why not try one?</a>');
}

$getaffs = "SELECT * FROM links WHERE type = \"affiliates\" ORDER BY id ASC";
$getaffs2 = mysql_query($getaffs);
$i=0;
while ($getaffs3 = mysql_fetch_array($getaffs2))
{
	$template->adds_block('AFFILIATES', array(	'COLOR' => getTagColor($i++),
							'TITLE' => doAprilFoolsDay(htmlspecialchars($getaffs3['title'])),
							'URL' => $getaffs3['url']));
}

$getwebps = "SELECT * FROM links WHERE type = \"webprojs\" ORDER BY id ASC";
$getwebps2 = mysql_query($getwebps);
$i=0;
while ($getwebps3 = mysql_fetch_array($getwebps2))
{
	$template->adds_block('WEBPROJS', array(	'COLOR' => getTagColor($i++),
							'TITLE' => doAprilFoolsDay(htmlspecialchars($getwebps3['title'])),
							'URL' => $getwebps3['url']));
}

if (isset($onFourm))
{
	$template->adds_block('ONFOURM',array('exi'=>1));
}

$getcomments = "SELECT * FROM comments ORDER BY id DESC LIMIT 0,5";
$getcomments2 = mysql_query($getcomments);
$i=0;
while ($getcomments3[$i] = mysql_fetch_array($getcomments2))
{
	if ($getcomments3[$i]['is_anon'] == 0)
		{
				$getuser = "SELECT * FROM phpbb_users WHERE user_id = " . $getcomments3[$i]['user_id'];
				$getuser2 = mysql_query($getuser);
				$getuser3 = mysql_fetch_array($getuser2);

				$username = $getuser3['username'];
				$website = $getuser3['user_website'];
		} else if ($getcomments3[$i]['is_anon'] == 1) 
		{
				$getanon = "SELECT * FROM anon_commenters WHERE id = " . $getcomments3[$i]['user_id'];
				$getanon2 = mysql_query($getanon);
				$getanon3 = mysql_fetch_array($getanon2);

				if ($getanon3['id'] == $getcomments3[$i]['user_id'])
				{
						$username = $getanon3['username'] . ' (Guest)';
						$website = $getanon3['website'];
				}
		}

	if (strpos($getcomments3[$i]['page_id'], 'updates') !== FALSE)
	{
		$getpost = "SELECT * FROM updates WHERE id = " . substr($getcomments3[$i]['page_id'],strpos($getcomments3[$i]['page_id'],'-')+1);
		$getpost2 = mysql_query($getpost);
		$getpost3 = mysql_fetch_array($getpost2);

		$template->adds_block('COMMENTS', array(	'ID' => $getcomments3[$i]['id'],
								'AREA' => 'blog',
								'CODED' => $getpost3['slug'],
								'ENDING' => '/',
								'TITLE' => htmlspecialchars($getpost3['title']),
								'AUTHOR' => (($website != '') ? '<a href="' . $website . '">' . $username . '</a>' : $username)));
		$i++;
	} else if (strpos($getcomments3[$i]['page_id'], 'quote') !== FALSE)
	{
		$num = substr($getcomments3[$i]['page_id'],strpos($getcomments3[$i]['page_id'],'-')+1);

		$template->adds_block('COMMENTS', array(	'ID' => $getcomments3[$i]['id'],
								'AREA' => 'quotes',
								'CODED' => $num,
								'ENDING' => '.php',
								'TITLE' => 'Quote #' . $num,
								'AUTHOR' => (($website != '') ? '<a href="' . $website . '">' . $username . '</a>' : $username)));
		$i++;			
		}
}

$users = array();
$getusers = "SELECT DISTINCT user_id FROM comments WHERE is_anon = 0";
$getusers2 = mysql_query($getusers);
$i=0;
while ($getusers3[$i] = mysql_fetch_array($getusers2))
{
	$getcount = "SELECT COUNT(*) FROM comments WHERE user_id = " . $getusers3[$i]['user_id'];
	$getcount2 = mysql_query($getcount);
	$getcount3 = mysql_fetch_array($getcount2);

			$getuser = "SELECT * FROM phpbb_users WHERE user_id = " . $getusers3[$i]['user_id'];
			$getuser2 = mysql_query($getuser);
			$getuser3 = mysql_fetch_array($getuser2);

			$username = $getuser3['username'];
			$website = $getuser3['user_website'];

	$name = (($website != '') ? '<a href="' . $website . '">' . $username . '</a>' : $username);
	$users[] = array('name' => $name, 'count' => $getcount3['COUNT(*)']);

	$i++;
}

function count_sort($a, $b)
{
	$a = $a['count'];
	$b = $b['count'];

	if ($a > $b)
	{
		return -1;
	} else if ($a < $b)
	{
		return 1;
	} else {
		return 0;
	}
}

usort($users, 'count_sort');
$i=0;
foreach ($users as $value)
{
	if ($i == 5)
	{
		break;
	}

	$template->adds_block('TOP', array(	'USERNAME' => $value['name'],
						'COUNT' => $value['count']));
	$i++;
}

$getpost = "SELECT * FROM phpbb_posts ORDER BY post_id DESC LIMIT 0,5";
$getpost2 = mysql_query($getpost) or die($getpost);
$i=0;
while ($getpost3[$i] = mysql_fetch_array($getpost2))
{
	$getuser = "SELECT * FROM phpbb_users WHERE user_id = " . $getpost3[$i]['poster_id'];
	$getuser2 = mysql_query($getuser) or die($getuser);
	$getuser3 = mysql_fetch_array($getuser2);

	$template->adds_block('FOURM', array(	'SUBJECT' => $getpost3[$i]['post_subject'],
						'TOPIC' => $getpost3[$i]['topic_id'],
						'POST' => $getpost3[$i]['post_id'],
						'USERNAME' => $getuser3['username']));
}

$getpopular = "SELECT * FROM updates ORDER BY popularity DESC LIMIT 0,5";
$getpopular2 = mysql_query($getpopular);
$i=0;
while ($getpopular3[$i] = mysql_fetch_array($getpopular2))
{
	$template->adds_block('POPULAR', array(	'CODED' => $getpopular3[$i]['slug'],
						'TITLE' => doAprilFoolsDay(htmlspecialchars($getpopular3[$i]['title']))));
	$i++;
}

$template->add('REVISION', exec('hg -R "' . $_SERVER['DOCUMENT_ROOT'] . '" tip --template {rev}'));

$gettags = "SELECT DISTINCT tag FROM tags WHERE post_type = \"published\"";
$gettags2 = mysql_query($gettags);
$i=0;
while ($gettags3[$i] = mysql_fetch_array($gettags2))
{
        $cnttag = "SELECT COUNT(*) FROM tags WHERE tag = \"" . $gettags3[$i]['tag'] . "\" AND post_type = \"published\"";
        $cnttag2 = mysql_query($cnttag);
        $cnttag3 = mysql_fetch_array($cnttag2);

        $counts[$gettags3[$i]['tag']] = $cnttag3[0];

        $i++;
}

$min_count = min($counts);
$spread = max($counts) - $min_count;
$spread = ($spread <= 0) ? 1 : $spread;
$font_step = 8 / $spread;
foreach ($counts as $tag => $count)
{
        if ($count != $min_count)
        {
                $template->adds_block('TAGCLOUD', array(        'TAG' => $tag,
                                                                'SIZE' => (8 + (($count - $min_count) * $font_step)),
                                                                'COUNT' => $count));
        }
}

if (!isset($noRightbar))
{
	$template->adds_block('RIGHTBAR', array('exi'=>1));
}

$template->add('ME', getRewriteURL());

$template->add('CONTENT', $content);

ob_start();
$template->display();
$document = ob_get_contents();
ob_end_clean();

$document = doAprilFoolsDay($document);
$document = str_replace(doAprilFoolsDay($content), $content, $document);
$document = str_replace("id=\"fridaym\"", "id=\"fourm\"", $document);
$document = str_replace("id=\"fridayipedia\"", "id=\"fouripedia\"", $document);
$document = str_replace('CLASS="fridaym none fridaym-none"', 'CLASS="fourm none fourm-none"', $document);
echo($document);

?>
