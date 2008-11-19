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
4::::::::::::::::4  pages/quotes.php
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

include('includes/functions_quotes.php');

$pageCategory = 'quotes';

if (isset($_GET['id']))
{
	$quote_num = $_GET['id'];
}

if ($_GET['act'] == 'add')
{
	$template = new FITemplate('quotes/add');
	if (isset($_GET['submit']))
	{
		$template->adds_block('SUBMITTED',array('QUOTE' => (nl2br(htmlspecialchars($_POST['rash_quote'])) . "\n")));
		if (!isLoggedIn())
		{
			$insquote = "INSERT INTO rash_queue (quote) VALUES(\"" . addslashes(htmlspecialchars($_POST['rash_quote'])) . "\")";
		} else {
			$today = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			$insquote = "INSERT INTO rash_quotes (quote, rating, flag, date) VALUES (\"" . addslashes($_POST['rash_quote']) . "\", 0, 0, \"" . $today . "\")";
		}
		$insquote2 = mysql_query($insquote);
	}
	$template->display();
} elseif ($_GET['act'] == 'bottom')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes WHERE rating < 0 ORDER BY rating ASC LIMIT 50";
	quote_generation($query, "Bottom", -1);
} elseif ($_GET['act'] == 'browse')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes ORDER BY id ASC ";
	quote_generation($query, "Browse", (isset($_GET['page']) ? $_GET['page'] : 1), 10, 5);
} elseif ($_GET['act'] == 'flag')
{
	$template = new FITemplate('msg');
	$tracking_verdict = user_quote_status('flag', $quote_num, $template);
	if ($tracking_verdict < 3)
	{
		$getfla = "SELECT flag FROM rash_quotes WHERE id = " . $quote_num . " LIMIT 0,1";
		$getfla2 = mysql_query($getfla);
		$getfla3 = mysql_fetch_array($getfla2);

		if ($getfla3['flag'] == 2)
		{
			$template->add('MSG',"This quote has been flagged and rechecked by a moderator already.");
		} elseif ($getfla3['flag'] == 1)
		{
			$template->add('MSG',"This quote is currently pending deletion.");
		} else {
			$template->add('MSG',"You have marked this quote for deletion.");
			$setfla = "UPDATE rash_quotes SET flag = 1 WHERE id = " . $quote_num;
			$setfla2 = mysql_query($setfla);
		}
	}
	$template->add('BACK','Quote #' . $quote_num);
	$template->display();
} elseif ($_GET['act'] == 'latest')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes ORDER BY id DESC LIMIT 50";
	quote_generation($query, "Latest", -1);
} elseif ($_GET['act'] == 'random')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes ORDER BY rand() LIMIT 50";
	quote_generation($query, "Random", -1);
} elseif ($_GET['act'] == 'random2')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes WHERE rating > 1 ORDER BY rand() LIMIT 50";
	quote_generation($query, "Random2", -1);
} elseif ($_GET['act'] == 'search')
{
	if (isset($_GET['fetch']))
	{
		if ($_POST['sortby'] == 'rating')
		{
			$how = 'desc';
		} else {
			$how = 'asc';
		}
		$getquotes = "SELECT id, quote, rating, flag FROM rash_quotes WHERE quote LIKE \"%" . $_POST['search'] . "%\" ORDER BY " . $_POST['sortby'] . " " . $how . " LIMIT 0," . $_POST['number'];
		quote_generation($getquotes, "Query Results", -1);
	}
	$template = new FITemplate('quotes/search');
	$template->display();
} elseif ($_GET['act'] == 'top')
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes WHERE rating > 0 ORDER BY rating DESC LIMIT 50";
	quote_generation($query, "Top", -1);
} elseif ($_GET['act'] == 'vote')
{
	$template = new FITemplate('msg');
	$tracking_verdict = user_quote_status('vote', $quote_num,$template);
	$template->add('BACK','Quote #' . $quote_num);
	$template->display();
	if ($tracking_verdict < 3)
	{
		if ($_GET['dir'] == "plus")
		{
			$setquote = "UPDATE rash_quotes SET rating = rating+1 WHERE id = " . $quote_num;
			$setquote2 = mysql_query($setquote);
		} elseif($_GET['dir'] == "minus")
		{
			$setquote = "UPDATE rash_quotes SET rating = rating-1 WHERE id = " . $quote_num;
			$setquote2 = mysql_query($setquote);
		}
	}
} else {
	if ((is_int($_GET['act']) || ($_GET['act'] != false)) && (verify_int($_GET['act'])))
	{
		$query = "SELECT id, quote, rating, flag FROM rash_quotes WHERE id = " . $_GET['act'];
		quote_generation($query, "#" . $_GET['act'], -1);
		$page_id = 'quote-' . $_GET['act'];
	} else {
		$template = new FITemplate('post');
		$template->adds_block('INTERNAL',array('exi'=>1));

		$getpost = "SELECT * FROM updates WHERE tag1 = \"quotes\" OR tag2 = \"tag2\" OR tag3 = \"tag3\" ORDER BY id DESC LIMIT 0,1";
		$getpost2 = mysql_query($getpost);
		$getpost3 = mysql_fetch_array($getpost2);

		$title = $getpost3['title'] . ' - Blog Archive';

		$template->adds_block('POST', array(	'ID' => $getpost3['id'],
							'YEARID' => ((date('Y',strtotime($getpost3['pubDate']))-2006) % 4),
							'DATE' => date('F dS Y \a\\t g:i:s a',strtotime($getpost3['pubDate'])),
							'MONTH' => date('M',strtotime($getpost3['pubDate'])),
							'DAY' => date('d',strtotime($getpost3['pubDate'])),
							'CODED' => urlencode($getpost3['title']),
							'TITLE' => $getpost3['title'],
							'AUTHOR' => $getpost3['author'],
							'TAG1' => $getpost3['tag1'],
							'TAG2' => $getpost3['tag2'],
							'TAG3' => $getpost3['tag3'],
							'TEXT' => parseBBCode($getpost3['text'])));

		$template->display();
		$page_id = 'updates-' . $getpost3['id'];
	}
	include('includes/comments.php');
}

?>
