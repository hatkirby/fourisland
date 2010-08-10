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

$pageCategory = 'quotes';

$hatNav = array(	array(	'title' => 'Latest',
							'url' => '/quotes/latest.php',
							'icon' => '16-star-hot'
					),
					array(	'title' => 'Best',
							'url' => '/quotes/top.php',
							'icon' => 'medal_gold_1'
					),
					array(	'title' => 'Worst',
							'url' => '/quotes/bottom.php',
							'icon' => '16-message-warn'
					),
					array(	'title' => 'Browse All',
							'url' => '/quotes/browse.php',
							'icon' => '16-file-archive'
					),
					array(	'title' => 'Random',
							'url' => '/quotes/random.php',
							'icon' => '16-clock'
					),
					array(	'title' => 'Add',
							'url' => '/quotes/add.php',
							'icon' => '16-em-pencil'
					),
					array(	'title' => 'Search',
							'url' => '/quotes/search.php',
							'icon' => 'book_open'
					));

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$quote_num = $_GET['id'];
}

if (isset($_GET['id']) && !(is_numeric($_GET['id'])))
{
	generateError('404');
} else if ((!isset($_GET['act'])) || ($_GET['act'] == 'latest'))
{
	$query = "SELECT * FROM rash_quotes ORDER BY id DESC LIMIT 50";
	quote_generation($query, "Latest", -1);
} else if ($_GET['act'] == 'add')
{
	$template = new FITemplate('quotes/add');
	if (isset($_GET['submit']))
	{
		$template->adds_block('SUBMITTED',array('QUOTE' => str_replace("\n","<br />",htmlspecialchars(stripslashes($_POST['rash_quote'])))));
		if (!isLoggedIn())
		{
			$insquote = "INSERT INTO rash_queue (quote) VALUES(\"" . mysql_real_escape_string(htmlspecialchars($_POST['rash_quote'])) . "\")";
		} else {
			$insquote = "INSERT INTO rash_quotes (quote, rating, flag, date) VALUES (\"" . mysql_real_escape_string($_POST['rash_quote']) . "\", 0, 0, \"" . time() . "\")";
		}
		$insquote2 = mysql_query($insquote);
	}
	$template->display();
} elseif ($_GET['act'] == 'bottom')
{
	$query = "SELECT * FROM rash_quotes WHERE rating < 0 ORDER BY rating ASC LIMIT 50";
	quote_generation($query, "Bottom", -1);
} elseif ($_GET['act'] == 'browse')
{
	$query = "SELECT * FROM rash_quotes ORDER BY id ASC ";
	quote_generation($query, "Browse", (isset($_GET['page']) ? $_GET['page'] : 1), 10, 5);
} elseif ($_GET['act'] == 'flag')
{
	$getfla = "SELECT * FROM rash_quotes WHERE id = " . $quote_num . " LIMIT 0,1";
	$getfla2 = mysql_query($getfla);
	$getfla3 = mysql_fetch_array($getfla2);

	if ($getfla3['flag'] == 2)
	{
		die('0');
	} else {
		$setfla = "UPDATE rash_quotes SET flag = 1 WHERE id = " . $quote_num;
		$setfla2 = mysql_query($setfla);

		die('1');
	}
} elseif ($_GET['act'] == 'random')
{
	$query = "SELECT * FROM rash_quotes ORDER BY rand() LIMIT 50";
	quote_generation($query, "Random", -1);
} elseif ($_GET['act'] == 'random2')
{
	$query = "SELECT * FROM rash_quotes WHERE rating > 1 ORDER BY rand() LIMIT 50";
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
		$getquotes = "SELECT * FROM rash_quotes WHERE quote LIKE \"%" . $_POST['search'] . "%\" ORDER BY " . $_POST['sortby'] . " " . $how . " LIMIT 0," . $_POST['number'];
		quote_generation($getquotes, "Query Results", -1);
	}
	$template = new FITemplate('quotes/search');
	$template->display();
} elseif ($_GET['act'] == 'top')
{
	$query = "SELECT * FROM rash_quotes WHERE rating > 0 ORDER BY rating DESC LIMIT 50";
	quote_generation($query, "Top", -1);
} elseif ($_GET['act'] == 'vote')
{
	$gettrack = "SELECT * FROM rash_tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$gettrack2 = mysql_query($gettrack);
	$gettrack3 = mysql_fetch_array($gettrack2);

	$trackArr = explode(',',$gettrack3['vote']);

	if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($quote_num,$trackArr) === FALSE))
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

		if ($gettrack3['ip'] == $_SERVER['REMOTE_ADDR'])
		{
			$settrack = "UPDATE rash_tracking SET vote = \"" . $gettrack3['vote'] . "," . $quote_num . "\" WHERE id = " . $gettrack3['id'];
		} else {
			$settrack = "INSERT INTO rash_tracking (ip,vote) VALUES (\"" . $_SERVER['REMOTE_ADDR'] . "\",\"" . $quote_num . "\")";
		}
		$settrack2 = mysql_query($settrack) or die($settrack);

		$getquote = "SELECT * FROM rash_quotes WHERE id = " . $quote_num;
		$getquote2 = mysql_query($getquote);
		$getquote3 = mysql_fetch_array($getquote2);

		die($getquote3['rating']);
	} else {
		die;
	}
} else if (is_numeric($_GET['act']))
{
	$getquote = "SELECT * FROM rash_quotes WHERE id = " . $_GET['act'];
	$getquote2 = mysql_query($getquote);
	$getquote3 = mysql_fetch_array($getquote2);

	if ($getquote3['id'] == $_GET['act'])
	{
		quote_generation($getquote, "#" . $_GET['act'], -1);

		$page_id = 'quote-' . $_GET['act'];
		include('includes/comments.php');
	} else {
		generateError('404');
	}
} else {
	generateError('404');
}

function quote_generation($query, $origin, $page = 1, $quote_limit = 50, $page_limit = 10)
{
	global $xhtml;

	$template = new FITemplate('quotes/browse');
	$template->add('IFXAMP', $xhtml ? '&amp;' : '&');

	if ($page != -1)
	{
		$template->adds_block('PAGENUMBERS',array('exi'=>1));
		page_numbers($template, $origin, $quote_limit, $page, $page_limit);
		$up_lim = ($quote_limit * $page);
		$low_lim = $up_lim - $quote_limit;
		$query .= "LIMIT $low_lim,$quote_limit";
	}
	$template->add('ORIGIN',$origin);

	$gettrack = "SELECT * FROM rash_tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$gettrack2 = mysql_query($gettrack);
	$gettrack3 = mysql_fetch_array($gettrack2);

	$trackArr = explode(',',$gettrack3['vote']);

	$getquotes2 = mysql_query($query);
	$i=0;
	while ($getquotes3[$i] = mysql_fetch_array($getquotes2))
	{
		if (!isset($curID))
		{
			$curID = 0;
		} else {
			$curID++;
		}

		$cntcomments = "SELECT COUNT(*) FROM comments WHERE page_id = \"quote-" . $getquotes3[$i]['id'] . "\"";
		$cntcomments2 = mysql_query($cntcomments);
		$cntcomments3 = mysql_fetch_array($cntcomments2);

		if ($cntcomments3['COUNT(*)'] == 0)
		{
			$comments = '';
		} else if ($cntcomments3['COUNT(*)'] == 1)
		{
			$comments = '1 Comment';
		} else {
			$comments = $cntcomments3['COUNT(*)'] . ' Comments';
		}

		$template->add_ref($curID,'QUOTES',array(	'NUMBER' => $getquotes3[$i]['id'],
								'RATING' => $getquotes3[$i]['rating'],
								'DATE' => ($getquotes3[$i]['date'] != 0 ? date('F jS Y \a\\t g:i:s a', $getquotes3[$i]['date']) : ''),
								'QUOTE' => doAprilFoolsDay(str_replace("\n","<br />",htmlspecialchars(stripslashes($getquotes3[$i]['quote'])))),
								'COMMENTS' => $comments));

		if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($getquotes3[$i]['id'],$trackArr) === FALSE))
		{
			$template->adds_ref_sub($curID, 'CANVOTE', array('exi'=>1));
		} else {
			$template->adds_ref_sub($curID, 'NOVOTE', array('exi'=>1));
		}

		if ($getquotes3[$i]['flag'] == 0)
		{
			$template->adds_ref_sub($curID, 'CANFLAG', array('exi'=>1));
		} else {
			$template->adds_ref_sub($curID, 'NOFLAG', array('exi'=>1));
		}
		
		$i++;
	}

	$template->display();
}

function page_numbers($template, $origin, $quote_limit, $page_default, $page_limit)
{
	$numrows = countRows('rash_quotes');
	$testrows = $numrows;
	$pagenum = floor(($testrows + 1) / ($quote_limit > 0 ? $quote_limit : 1));

	if (($page_limit % 2))
	{
		$page_limit++;
	}
	if (($page_limit < 2) || (!$page_limit))
	{
		$page_limit = 5;
	}

	$pagebase = 0;
	do
	{
		$pagebase++;
		$page_limit -= 2;
	} while ($page_limit > 1);

	$template->add('LORIGIN',strtolower($origin));
	$template->add('MINUSTEN',(($page_default - 10) > 1) ? ($page_default - 10) : 1);
	
	if ($page_default - $pagebase > 1)
	{
		$template->add('BDDD','...');
	}

	$i = $page_default - $pagebase;
	do
	{
		if ($i > 0)
		{
			$template->adds_block('BPAGES',array('PAGENUM' => $i));
		}
		$i++;
	} while ($i < $page_default);

	$template->add('CURPAGE',$page_default);

	$i = $page_default + 1;
	do
	{
		if ($i <= $pagenum)
		{
			$template->adds_block('APAGES',array('PAGENUM' => $i));
		}
		$i++;
	} while ($i < ($page_default + $pagebase + 1));

	if (($page_default + $pagebase) < $pagenum)
	{
		$template->add('ADDD','...');
	}

	$template->add('PLUSTEN',(($page_default + 10) < $pagenum) ? ($page_default + 10) : $pagenum);
	$template->add('LASTPAGE',$pagenum);
}

?>
