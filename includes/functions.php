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
	if (!isLoggedIn())
	{
		return('in');
	} else {
		return('out');
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

	if (empty($title))
	{
		$title = 'special-characters';
	}

	$getprevs = "SELECT COUNT(*) FROM " . $table . " WHERE slug = \"" . $title . "\" OR slug LIKE \"" . $title . "-%\"";
	$getprevs2 = mysql_query($getprevs);
	@$getprevs3 = mysql_fetch_array($getprevs2);
	if ($getprevs3[0] > 0)
	{
		$title .= '-' . ($getprevs3[0]+1);
	}

	return($title);
}

function postBlogPost($title,$author,$tags,$content)
{
	$slug = generateSlug($title,'updates');

	$inspost = "INSERT INTO updates (title,slug,author,text) VALUES (\"" . mysql_real_escape_string($title) . "\",\"" . $slug . "\",\"" . $author . "\",\"" . mysql_real_escape_string($content) . "\")";
	$inspost2 = mysql_query($inspost);

	$id = mysql_insert_id();
	addTags($id, $tags);

	$upconf = "UPDATE config SET value = \"" . date('md') . "\" WHERE name = \"lastUpdate\"";
	$upconf2 = mysql_query($upconf);

	preg_match_all('|<a\s[^>]*href="([^"]+)"|i', parseText($content), $matches);

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
				$msg = new xmlrpcmsg("pingback.ping", array(	new xmlrpcval('http://fourisland.com/blog/' . $slug . '/', 'string'),
										new xmlrpcval($link, 'string')));
				$client->send($msg);
			}
		}
	}

	$client = new xmlrpc_client('http://rpc.pingomatic.com');
	$msg = new xmlrpcmsg("weblogUpdates.ping", array(	new xmlrpcval('Four Island', 'string'),
								new xmlrpcval('http://fourisland.com/', 'string')));
	$client->send($msg);

	return $id;
}

function recalcPop($id)
{
	$getpost = "SELECT * FROM updates WHERE id = " . $id;
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);
	$popularity = $getpost3['home_views'];
	$popularity += ($getpost3['views']*2);
	$popularity += ($getpost3['rating']*5);

	$getcomments = "SELECT COUNT(*) FROM comments WHERE page_id = \"updates-" . $id . "\"";
	$getcomments2 = mysql_query($getcomments);
	$getcomments3 = mysql_fetch_array($getcomments2);
	$popularity += ($getcomments3[0] * 10);

	$getpings = "SELECT COUNT(*) FROM pingbacks WHERE post_id = " . $id;
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

function getTags($id, $type = 'published')
{
	$gettags = "SELECT * FROM tags WHERE post_id = " . $id . " AND post_type = \"" . $type . "\"";
	$gettags2 = mysql_query($gettags);
	$i=0;
	$tags = array();
	while ($gettags3[$i] = mysql_fetch_array($gettags2))
	{
		$tags[] = $gettags3[$i]['tag'];
		$i++;
	}

	return $tags;
}

function addTags($id, $tags, $type = 'published')
{
	foreach ($tags as $tag)
	{
		$instag = "INSERT INTO tags (post_id,post_type,tag) VALUES (" . $id . ",\"" . $type . "\",\"" . $tag . "\")";
		$instag2 = mysql_query($instag);
	}
}

function removeTags($id, $type = 'published')
{
	$deltags = "DELETE FROM tags WHERE post_id = " . $id . " AND post_type = \"" . $type . "\"";
	$deltags2 = mysql_query($deltags);
}

if (!function_exists('unique_id'))
{
	function unique_id()
	{
		static $dss_seeded = false;

		$getconfig = "SELECT * FROM config WHERE name = \"rand_seed\"";
		$getconfig2 = mysql_query($getconfig);
		$getconfig3 = mysql_fetch_array($getconfig2);

	        $val = $getconfig3['value'] . microtime();
	        $val = md5($val);
	        $rand_seed = md5($getconfig3['value'] . $val . $extra);

		$getconfig = "SELECT * FROM config WHERE name = \"rand_seed_last_update\"";
		$getconfig2 = mysql_query($getconfig);
		$getconfig3 = mysql_fetch_array($getconfig2);
	        if ($dss_seeded !== true && ($getconfig3['value'] < time() - rand(1,10)))
	        {
			$setconfig = "UPDATE config SET value = \"" . $rand_seed . "\" WHERE name = \"rand_seed\"";
			$setconfig2 = mysql_query($setconfig);

			$setconfig = "UPDATE config SET value = \"" . time() . "\" WHERE name = \"rand_seed_last_update\"";
			$setconfig2 = mysql_query($setconfig);

	                $dss_seeded = true;
	        }

	        return substr($val, 4, 16);
	}
}

function getCommentUrl($getcomment3)
{
	$page_id = $getcomment3['page_id'];
	$comType = substr($page_id,0,strpos($page_id,'-'));
	$comID = substr($page_id,strpos($page_id,'-')+1);

	if ($comType == 'updates')
	{
		$getupdate = "SELECT * FROM updates WHERE id = " . $comID;
		$getupdate2 = mysql_query($getupdate);
		$getupdate3 = mysql_fetch_array($getupdate2);

		return '/blog/' . $getupdate3['slug'] . '/';
	} else if ($comType == 'quote')
	{
		return '/quotes/' . $comID . '.php';
	}
}

function getTagColor($i)
{
	switch ($i % 7)
	{
		case 0: return 'blue';
		case 1: return 'green';
		case 2: return 'orange';
		case 3: return 'pink';
		case 4: return 'purple';
		case 5: return 'red';
		case 6: return 'yellow';
	}
}

function getLayout()
{
	if (!isset($_COOKIE['layout']))
	{
		return '7';
	} else {
		return $_COOKIE['layout'];
	}
}

function getRewriteURL()
{
	if (!isset($_GET['area']))
	{
		if (strpos($_SERVER['PHP_SELF'], 'wiki') !== false)
		{
			return $_SERVER['PHP_SELF'];
		} else {
			return '/';
		}
	} else {
		if ($_GET['area'] == 'blog')
		{
			if (isset($_GET['post']))
			{
				return '/blog/' . $_GET['post'] . '/';
			} else {
				return '/';
			}
		} else if ($_GET['area'] == 'archive')
		{
			if (isset($_GET['author']))
			{
				return '/blog/author/' . $_GET['author'] . '.php';
			} else if (isset($_GET['tag']))
			{
				return '/blog/tag/' . $_GET['tag'] . '.php';
			} else {
				return '/blog/';
			}
		} else if ($_GET['area'] == 'quotes')
		{
			if (isset($_GET['act']))
			{
				return '/quotes/' . $_GET['act'] . '.php';
			} else {
				return '/quotes/';
			}
		} else if ($_GET['area'] == 'error')
		{
			if (isset($_GET['id']))
			{
				return '/error/' . $_GET['id'] . '.php';
			} else {
				return '/error/';
			}
		} else {
			return '/' . $_GET['area'] . '/';
		}
	}
}

?>
