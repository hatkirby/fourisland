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

if (isset($extraSidebars))
{
	$template->adds_block('EXTRA', array('SIDEBARS' => $extraSidebars));
}

if (isset($onFourm))
{
	$template->adds_block('ONFOURM',array('exi'=>1));
}

if (!isset($noRightbar))
{
	$template->adds_block('RIGHTBAR',array('exi'=>1));

	if (!isset($noHatNav))
	{
		$cnthatnav = "SELECT COUNT(*) FROM hatnav WHERE category = \"" . $pageCategory . "\"";
		$cnthatnav2 = mysql_query($cnthatnav);
		$cnthatnav3 = mysql_fetch_array($cnthatnav2);

		if ($cnthatnav3['COUNT(*)'] > 0)
		{
			$template->adds_block('USEHATNAV', array('exi'=>1));
			if (!isset($genHatNav))
			{
				$gethnis = 'SELECT * FROM hatnav WHERE category = "' . $pageCategory . '"';
				$gethnis2 = mysql_query($gethnis);
				$i=0;
				while ($gethnis3[$i] = mysql_fetch_array($gethnis2))
				{
					$template->adds_block('HATNAV', array(	'AID' => 	$gethnis3[$i]['AID'],
										'HREF' => $gethnis3[$i]['href'],
										'IMAGE' => '/theme/images/icons/' . $gethnis3[$i]['image'] . '.png',
										'TEXT' => $gethnis3[$i]['text'],
										'NEW' => dispIfNotOld($gethnis3[$i]['lastEdit'])));
					$i++;
				}
			} else {
				$i=0;
				while ($i < $genHatNavNum)
				{
					$template->adds_block('HATNAV', array(	'AID' => 	'post',
										'HREF' => $genHatNav[$i]['href'],
										'IMAGE' => '/theme/images/blue.PNG',
										'TEXT' => $genHatNav[$i]['text'],
										'NEW' => ''));
					$i++;
				}
			}
		}
	}

	include('pages/polloftheweek.php');

	$getpopular = "SELECT * FROM updates ORDER BY popularity DESC LIMIT 0,5";
	$getpopular2 = mysql_query($getpopular);
	$i=0;
	while ($getpopular3[$i] = mysql_fetch_array($getpopular2))
	{
		$template->adds_block('POPULAR', array(	'CODED' => $getpopular3[$i]['slug'],
							'TITLE' => stripslashes($getpopular3[$i]['title'])));
		$i++;
	}

	$getcomments = "SELECT * FROM comments WHERE page_id LIKE \"updates-%\" OR page_id LIKE \"quote-%\" ORDER BY id DESC LIMIT 0,5";
	$getcomments2 = mysql_query($getcomments);
	$i=0;
	while ($getcomments3[$i] = mysql_fetch_array($getcomments2))
	{
		$getuser = "SELECT * FROM users WHERE username = \"" . $getcomments3[$i]['username'] . "\"";
		$getuser2 = mysql_query($getuser);
		$getuser3 = mysql_fetch_array($getuser2);

		if ($getuser3['username'] == $getcomments3[$i]['username'])
		{
			$username = $getuser3['username'];
			$website = $getuser3['website'];
		} else {
			$getanon = "SELECT * FROM anon_commenters WHERE username = \"" . $getcomments3[$i]['username'] . "\"";
			$getanon2 = mysql_query($getanon);
			$getanon3 = mysql_fetch_array($getanon2);

			if ($getanon3['username'] == $getcomments3[$i]['username'])
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
									'AUTHOR' => (($website != '') ? '<A HREF="http://' . $website . '">' . $username . '</A>' : $username)));
			$i++;
		} else if (strpos($getcomments3[$i]['page_id'], 'quote') !== FALSE)
		{
			$num = substr($getcomments3[$i]['page_id'],strpos($getcomments3[$i]['page_id'],'-')+1);

			$template->adds_block('COMMENTS', array(	'ID' => $getcomments3[$i]['id'],
									'AREA' => 'quotes',
									'CODED' => $num,
									'ENDING' => '.php',
 									'TITLE' => 'Quote #' . $num,
									'AUTHOR' => (($website != '') ? '<A HREF="http://' . $website . '">' . $username . '</A>' : $username)));
			$i++;			
		}
	}

	$getusers = "SELECT DISTINCT username FROM comments";
	$getusers2 = mysql_query($getusers);
	$i=0;
	while ($getusers3[$i] = mysql_fetch_array($getusers2))
	{
		$getcount = "SELECT COUNT(*) FROM comments WHERE username = \"" . $getusers3[$i]['username'] . "\"";
		$getcount2 = mysql_query($getcount);
		$getcount3 = mysql_fetch_array($getcount2);

		$getuser = "SELECT * FROM users WHERE username = \"" . $getusers3[$i]['username'] . "\"";
		$getuser2 = mysql_query($getuser);
		$getuser3 = mysql_fetch_array($getuser2);

		if ($getuser3['username'] == $getusers3[$i]['username'])
		{
			$username = $getuser3['username'];
			$website = $getuser3['website'];
		} else {
			$getanon = "SELECT * FROM anon_commenters WHERE username = \"" . $getusers3[$i]['username'] . "\"";
			$getanon2 = mysql_query($getanon);
			$getanon3 = mysql_fetch_array($getanon2);

			if ($getanon3['username'] == $getusers3[$i]['username'])
			{
				$username = $getanon3['username'] . ' (Guest)';
				$website = $getanon3['website'];
			}
		}

		$name = (($website != '') ? '<A HREF="http://' . $website . '">' . $username . '</A>' : $username);
		$users[$name] = $getcount3[0];

		$i++;
	}

	arsort($users);
	$i=0;
	foreach ($users as $name => $count)
	{
		if ($i == 5)
		{
			break;
		}

		$template->adds_block('TOP', array(	'USERNAME' => $name,
							'COUNT' => $count));
		$i++;
	}

	$gethits = "SELECT * FROM config WHERE name = \"hits\"";
	$gethits2 = mysql_query($gethits);
	$gethits3 = mysql_fetch_array($gethits2);
	$template->add('HITS', $gethits3['value']);

	$gethits = "SELECT * FROM config WHERE name = \"todayHits\"";
	$gethits2 = mysql_query($gethits);
	$gethits3 = mysql_fetch_array($gethits2);
	$template->add('TODAY', $gethits3['value']);

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
			$template->adds_block('TAGCLOUD', array(	'TAG' => $tag,
									'SIZE' => (8 + (($count - $min_count) * $font_step)),
									'COUNT' => $count));
		}
	}
}

$template->add('REVISION', exec('hg tip --template {rev}'));

$template->display();

?>
