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
4::::::::::::::::4  rss.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('headerproc.php');

include('../security/config.php');
include('includes/db.php');
include('includes/bbcode.php');

header('Content-type: application/rss+xml');

echo('<?xml version="1.0" encoding="UTF-8"?>');

?>
<rss version="2.0">
	<channel>
		<title>Four Island<?php
if (isset($_GET['mode']))
{
	switch ($_GET['mode'])
	{
		case 'blog':
			if (isset($_GET['blog']))
			{
				switch ($_GET['blog'])
				{
					case 'author':
?> Blog Posts by <?php
						echo($_GET['author']);
						break;
					case 'tag':
?> Blog Posts tagged with <?php
						echo($_GET['tag']);
						break;
				}
			} else {
?> Blog Posts<?php
			}
			break;
		case 'quotes':
?> Quotes<?php
			break;
		case 'poll':
?> Polls<?php
			break;
		case 'comments':
?> Comments<?php
			break;
	}
}
?></title>

		<description><?php
if (isset($_GET['mode']))
{
	switch ($_GET['mode'])
	{
		case 'blog':
			if (isset($_GET['blog']))
			{
				switch ($_GET['blog'])
				{
					case 'author':
?>An archive of all Four Island blog posts written by <?php
						echo($_GET['author']);
						break;
					case 'tag':
?>An archive of all Four Island blog posts tagged with <?php
						echo($_GET['tag']);
						break;
				}
			} else {
?>An archive of all Four Island blog posts<?php
			}
			break;
		case 'quotes':
?>An archive of all Four Island quotes<?php
			break;
		case 'poll':
?>An archive of all of the Four Island POTWs<?php
			break;
		case 'comments':
?>An archive of all of the comments people have left on Four Island<?php
			break;
	}
} else {
?>All the wonderfour going-ons on Four Island<?php
}
?></description>

		<language>en</language>

<?php

$i=0;

if (!isset($_GET['mode']) || ($_GET['mode'] == 'blog'))
{
	if ($_GET['blog'] == 'author')
	{
		$getposts = "SELECT * FROM updates WHERE author = \"" . $_GET['author'] . "\" ORDER BY id DESC";
	} else if ($_GET['blog'] == 'tag')
	{
		$getposts = "SELECT * FROM updates AS u, tags AS t WHERE u.id = t.post_id AND t.post_type = \"published\" AND t.tag = \"" . $_GET['tag'] . "\" ORDER BY u.id DESC";
	} else if (!isset($_GET['blog'])) {
		$getposts = "SELECT * FROM updates ORDER BY id DESC";
	}
	$getposts2 = mysql_query($getposts);

	while (($items[$i] = mysql_fetch_array($getposts2)))
	{
		$items[$i]['sortDate'] = strtotime($items[$i]['pubDate']);
		$items[$i]['itemType'] = 'post';
		$i++;
	}
}

if (!isset($_GET['mode']) || ($_GET['mode'] == 'quotes'))
{
	$getquotes = "SELECT * FROM rash_quotes";
	$getquotes2 = mysql_query($getquotes);

//	$si = $i;

	while (($items[$i] = mysql_fetch_array($getquotes2)))
	{
		$items[$i]['sortDate'] = $items[$i]['date'];
		$items[$i]['itemType'] = 'quote';
		$i++;
	}
}

if ($_GET['mode'] == 'poll')
{
	$getpolls = "SELECT * FROM polloftheweek";
	$getpolls2 = mysql_query($getpolls);
	while (($items[$i] = mysql_fetch_array($getpolls2)) && ($i < ($si+10)))
	{
		$items[$i]['sortDate'] = strtotime($items[$i]['week']);
		$items[$i]['itemType'] = 'poll';
		$i++;
	}
}

if (!isset($_GET['mode']) || ($_GET['mode'] == 'comments'))
{
	$getcomments = "SELECT * FROM comments ORDER BY id DESC LIMIT 0,10";
	$getcomments2 = mysql_query($getcomments);
	while ($items[$i] = mysql_fetch_array($getcomments2))
	{
		$items[$i]['sortDate'] = strtotime($items[$i]['posttime']);
		$items[$i]['itemType'] = 'comment';

		$page_id = $items[$i]['page_id'];
		$comType = substr($page_id,0,strpos($page_id,'-'));
		$comID = substr($page_id,strpos($page_id,'-')+1);

		switch ($comType)
		{
			case 'updates':
				$getpost = "SELECT * FROM updates WHERE id = " . $comID;
				$getpost2 = mysql_query($getpost);
				$getpost3 = mysql_fetch_array($getpost2);

				$items[$i]['title'] = $getpost3['title'];
				$items[$i]['url'] = 'blog/' . $getpost3['slug'] . '/';
				break;
			case 'poll':
				$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $comID;
				$getpoll2 = mysql_query($getpoll);
				$getpoll3 = mysql_fetch_array($getpoll2);

				$items[$i]['title'] = $getpoll3['question'];
				$items[$i]['url'] = 'poll/' . $getpoll3['id'] . '.php';
				break;
			case 'quote':
				$getquote = "SELECT * FROM rash_quotes WHERE id = " . $comID;
				$getquote2 = mysql_query($getquote);
				$getquote3 = mysql_fetch_array($getquote2);

				$items[$i]['title'] = '#' . $getquote3['id'];
				$items[$i]['url'] = 'quotes/' . $getquote3['id'] . '.php';
				break;
		}
		$i++;
	}
}

function sortItems($a, $b)
{
	if ($a['sortDate'] < $b['sortDate'])
	{
		return 1;
	} else if ($a['sortDate'] == $b['sortDate'])
	{
		return 0;
	} else if ($a['sortDate'] > $b['sortDate'])
	{
		return -1;
	}
}

uasort($items,"sortItems");

$j=0;
foreach ($items as $key => $value)
{
	switch ($value['itemType'])
	{
		case 'post':
?>
		<item>
			<title><?php echo($value['title']); ?></title>

			<link>http://fourisland.com/blog/<?php echo($value['slug']); ?>/</link>

			<description><?php echo(stripslashes(htmlentities(parseBBCode($value['text'])))); ?></description>

			<pubDate><?php echo(date('D, d M Y H:i:s O',$value['sortDate'])); ?></pubDate>
		</item>
<?php
			break;
		case 'quote':
?>
		<item>
			<title>Quote #<?php echo($value['id']); ?></title>

			<link>http://fourisland.com/quotes/<?php echo(urlencode($value['id'])); ?>.php</link>

			<description><?php echo(htmlentities(nl2br($value['quote']))); ?></description>

			<pubDate><?php echo(date('D, d M Y H:i:s O',$value['sortDate'])); ?></pubDate>
		</item>
<?php
			break;
		case 'poll':
			break;
		case 'comment':
?>
		<item>
			<title>Comment on <?php echo($value['title']); ?> by <?php echo($value['username']); ?></title>

			<link>http://fourisland.com/comments/<?php echo($value['id']); ?>/</link>

			<description><?php echo(stripslashes(htmlentities(parseBBCode($value['comment'])))); ?></description>

			<pubDate><?php echo(date('D, d M Y H:i:s O',$value['sortDate'])); ?></pubDate>
		</item>
<?php
			break;
	}
	$j++;
	if ($j==9)
	{
		break;
	}
}

?>
	</channel>
</rss>
