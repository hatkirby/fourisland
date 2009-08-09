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
4::::::::::::::::4  includes/footer.php
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

$template = new FITemplate('footer');

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
								'TITLE' => stripslashes($getpost3['title']),
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
	} else if (strpos($getcomments3[$i]['page_id'], 'polloftheweek') !== FALSE)
	{
		$getpotw = "SELECT * FROM polloftheweek WHERE id = " . substr($getcomments3[$i]['page_id'],strpos($getcomments3[$i]['page_id'],'-')+1);
		$getpotw2 = mysql_query($getpotw);
		$getpotw3 = mysql_fetch_array($getpotw2);

		$template->adds_block('COMMENTS', array(	'ID' => $getcomments3[$i]['id'],
								'AREA' => 'poll',
								'CODED' => $getpotw3['id'],
								'ENDING' => '.php',
								'TITLE' => 'Poll "' . $getpotw3['question'] . '"',
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
						'TITLE' => stripslashes($getpopular3[$i]['title'])));
	$i++;
}

$template->add('REVISION', exec('hg -R "' . $_SERVER['DOCUMENT_ROOT'] . '" tip --template {rev}'));

$template->display();

?>
