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
$headtags = '<LINK REL="stylesheet" HREF="/theme/css/quotes.css" />';

$template = new FITemplate('quotes/header');
$template->display();

if (isset($_GET['id']))
{
	$quote_num = $_GET['id'];
}

if ((!isset($_GET['act'])) || ($_GET['act'] == 'latest'))
{
	$query = "SELECT id, quote, rating, flag FROM rash_quotes ORDER BY id DESC LIMIT 50";
	quote_generation($query, "Latest", -1);
} else if ($_GET['act'] == 'add')
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
		include('includes/comments.php');
	} else {
		generateError('404');
	}
}

?>
