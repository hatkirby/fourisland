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
4::::::::::::::::4  includes/functions.php
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

function isLoggedIn()
{
	return sess_exists('uname');
}

function getUserlevel()
{
	if (isLoggedIn())
	{
		$getuser = "SELECT * FROM users WHERE username = \"" . sess_get('uname') . "\"";
		$getuser2 = mysql_query($getuser);
		$getuser3 = mysql_fetch_array($getuser2);
		return $getuser3['user_group'];
	} else {
		return 4;
	}
}

function countRows($table, $extra = '')
{
	$cntrows = "SELECT * FROM " . $table . " " . $extra;
	$cntrows2 = mysql_query($cntrows);
	$i=0;
	while ($cntrows3[$i] = mysql_fetch_array($cntrows2))
	{
		$i++;
	}
	return $i;
}

function generateError($error)
{
	ob_end_clean();
	ob_start();
	$errorid = $error;
	include('pages/error.php');
}

function echoLogData()
{
	if (!isLoggedIn()) {
		return('Login');
	} else {
		return('Logout');
	}
}

function dispIfNotOld($datTim)
{
	if (($datTim+604800) >= time())
	{
		return('<IMG SRC="/theme/images/icons/new.png" ALT="New!" BORDER="0" WIDTH=16 HEIGHT=16 STYLE="vertical-align: middle;">');
	} else {
		return;
	}
}

function getpercent($getpoll3,$num)
{
	$maxper = ($getpoll3['clicks1'] + $getpoll3['clicks2'] + $getpoll3['clicks3'] + $getpoll3['clicks4']);
	$percent = round(($getpoll3['clicks' . $num] / $maxper) * 100);
	return($percent);
}

function generateSlug($title,$table)
{
	$title = preg_replace('/[^A-Za-z0-9]/','-',$title);
	$title = preg_replace('/-{2,}/','-',$title);
	if (substr($title,0,1) == '-')
	{
		$title = substr($title,1);
	}
	if (substr($title,strlen($title)-1,1) == '-')
	{
		$title = substr($title,0,strlen($title)-1);
	}
	$title = strtolower($title);

	$getprevs = "SELECT COUNT(*) FROM " . $table . " WHERE slug = \"" . $title . "\" OR slug LIKE \"" . $title . "-%\"";
	$getprevs2 = mysql_query($getprevs);
	@$getprevs3 = mysql_fetch_array($getprevs2);
	if ($getprevs3[0] > 0)
	{
		$title .= '-' . ($getprevs3[0]+1);
	}

	return($title);
}

function postBlogPost($title,$author,$tag1,$tag2,$tag3,$content)
{
	$slug = generateSlug($title,'updates');

	$inspost = "INSERT INTO updates (title,slug,author,tag1,tag2,tag3,text) VALUES (\"" . $title . "\",\"" . $slug . "\",\"" . $author . "\",\"" . $tag1 . "\",\"" . $tag2 . "\",\"" . $tag3 . "\",\"" . addslashes($content) . "\")";
	$inspost2 = mysql_query($inspost);

	$upconf = "UPDATE config SET value = \"" . date('md') . "\" WHERE name = \"lastUpdate\"";
	$upconf2 = mysql_query($upconf);

	preg_match_all('|<a\s[^>]*href="([^"]+)"|i', parseBBCode($content), $matches);

	foreach ($matches[1] as $link)
	{
		if ($all_links[$link])
		{
			continue;
		}

		$all_links[$link] = true;

		if (preg_match('/^https{0,1}:/i', $link))
		{
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $link);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_HEADER, false);
			$page_data = curl_exec($c);
			curl_close($c);

			if (preg_match('/<LINK REL="pingback" HREF="([^"]+)"/i',$page_data,$server))
			{
				$client = new xmlrpc_client($server[1]);
				$msg = new xmlrpcmsg("pingback.ping", array(	new xmlrpcval('http://www.fourisland.com/blog/' . $slug . '/', 'string'),
										new xmlrpcval($link, 'string')));
				$client->send($msg);
			}
		}
	}

	$client = new xmlrpc_client('http://rpc.pingomatic.com');
	$msg = new xmlrpcmsg("weblogUpdates.ping", array(	new xmlrpcval('Four Island', 'string'),
								new xmlrpcval('http://www.fourisland.com/', 'string')));
	$client->send($msg);
}

function recalcPop($id)
{
	$getpost = "SELECT * FROM updates WHERE id = " . $id;
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);
	$popularity = $getpost3['home_views'];
	$popularity += ($getpost3['views']*2);
	$popularity += ($getpost3['rating']*5);

	$getcomments = "SELECT COUNT(*) FROM comments WHERE page_id = \"updates-" . $id . "\" AND username <> \"Pingback\"";
	$getcomments2 = mysql_query($getcomments);
	$getcomments3 = mysql_fetch_array($getcomments2);
	$popularity += ($getcomments3[0] * 10);

	$getpings = "SELECT COUNT(*) FROM comments WHERE page_id = \"updates-" . $id . "\" AND username = \"Pingback\"";
	$getpings2 = mysql_query($getpings);
	$getpings3 = mysql_fetch_array($getpings2);
	$popularity += ($getpings3[0] * 25);

	$setpost = "UPDATE updates SET popularity = " . $popularity . " WHERE id = " . $id;
	$setpost2 = mysql_query($setpost);
}

function updatePop($id, $area, $plus=1)
{
	$gettrack = "SELECT * FROM tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$gettrack2 = mysql_query($gettrack);
	$gettrack3 = mysql_fetch_array($gettrack2);

	$trackArr = explode(',',$gettrack3[$area]);

	if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($id,$trackArr) === FALSE))
	{
		$setpost = "UPDATE updates SET " . $area . " = " . $area . "+" . $plus . " WHERE id = " . $id;
		$setpost2 = mysql_query($setpost);
		recalcPop($id);

		if ($gettrack3['ip'] == $_SERVER['REMOTE_ADDR'])
		{
			$settrack = "UPDATE tracking SET " . $area . " = \"" . $gettrack3[$area] . "," . $id . "\" WHERE id = " . $gettrack3['id'];
		} else {
			$settrack = "INSERT INTO tracking (ip," . $area . ") VALUES (\"" . $_SERVER['REMOTE_ADDR'] . "\",\"" . $id . "\")";
		}
		$settrack2 = mysql_query($settrack) or die($settrack);
		return 1;
	} else {
		return 0;
	}
}

function verifyUser($username, $password)
{
	$getuser = 'SELECT * FROM users WHERE username = "' . $username . '" AND user_password = "' . md5($password) . '"';
	$getuser2 = mysql_query($getuser);
	$getuser3 = mysql_fetch_array($getuser2);
	return (($_POST['username'] != '') && ($getuser3['username'] == $_POST['username']));
}

function updateCommentPop($id, $plus=1)
{
	$gettrack = "SELECT * FROM tracking_comments WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$gettrack2 = mysql_query($gettrack);
	$gettrack3 = mysql_fetch_array($gettrack2);

	$trackArr = explode(',',$gettrack3['comment_id']);

	if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($id,$trackArr) === FALSE))
	{
		$setcomment = "UPDATE comments SET rating = rating+" . $plus . " WHERE id = " . $id;
		$setcomment2 = mysql_query($setcomment);

		if ($gettrack3['ip'] == $_SERVER['REMOTE_ADDR'])
		{
			$settrack = "UPDATE tracking SET rating = \"" . $gettrack3['comment_id'] . "," . $id . "\" WHERE id = " . $gettrack3['id'];
		} else {
			$settrack = "INSERT INTO tracking (ip,rating) VALUES (\"" . $_SERVER['REMOTE_ADDR'] . "\",\"" . $id . "\")";
		}
		$settrack2 = mysql_query($settrack) or die($settrack);
		return 1;
	} else {
		return 0;
	}
}

?>
