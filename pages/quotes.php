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
			$insquote = "INSERT INTO rash_queue (quote) VALUES(\"" . mysql_real_escape_string(htmlspecialchars($_POST['rash_quote'])) . "\")";
		} else {
			$today = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			$insquote = "INSERT INTO rash_quotes (quote, rating, flag, date) VALUES (\"" . mysql_real_escape_string($_POST['rash_quote']) . "\", 0, 0, \"" . $today . "\")";
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

function quote_generation($query, $origin, $page = 1, $quote_limit = 50, $page_limit = 10)
{
	$template = new FITemplate('quotes/browse');
	if ($page != -1)
	{
		$template->adds_block('PAGENUMBERS',array('exi'=>1));
		page_numbers($template, $origin, $quote_limit, $page, $page_limit);
		$up_lim = ($quote_limit * $page);
		$low_lim = $up_lim - $quote_limit;
		$query .= "LIMIT $low_lim,$quote_limit";
	}
	$template->add('ORIGIN',$origin);

	$getquotes2 = mysql_query($query);
	$i=0;
	while ($getquotes3[$i] = mysql_fetch_array($getquotes2))
	{
		$template->adds_block('QUOTES',array(	'NUMBER' => $getquotes3[$i]['id'],
							'RATING' => $getquotes3[$i]['rating'],
							'QUOTE' => parseSmilies(nl2br(stripslashes($getquotes3[$i]['quote'])))));
		
		$i++;
	}

	$template->display();
}

function page_numbers($template, $origin, $quote_limit, $page_default, $page_limit)
{
	$numrows = countRows('rash_quotes');
	$testrows = $numrows;
	$pagenum = (($testrows + 1) / ($quote_limit > 0 ? $quote_limit : 1));

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

function user_quote_status($where, $quote_num, $template)
{
	$tracking_verdict = ip_track($where, $quote_num);
	if ($where != 'flag')
	{
		switch ($tracking_verdict)
		{
			case 1:
				$template->add('TRACKING',"Quote has been modified, and data of your action has been recorded in the database.");
				break;
			case 2:
				$template->add('TRACKING',"Quote has been modified, your IP has been logged, and data of your action has been recorded in the database.");
				break;
			case 3:
				$template->add('TRACKING',"You have already voted on this quote, please try again later.");
				break;
		}
	}
	return $tracking_verdict;
}

function ip_track($where, $quote_num)
{
	switch ($where)
	{
		case 'flag':
			$where2 = 'vote';
			break;
		case 'vote':
			$where2 = 'flag';
			break;
	}
	
	$getip = "SELECT * FROM rash_tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$getip2 = mysql_query($getip);
	$getip3 = mysql_fetch_array($getip2);

	if ($getip3['ip'] == $_SERVER['REMOTE_ADDR'])
	{
		$quote_array = explode(",", $getip3['quote_id']);
		$quote_place = array_search($quote_num, $quote_array);
		if (in_array($quote_num, $quote_array))
		{
			$where_result = explode(",", $getip3[$where]);
			if (!isset($where_result[$quote_place]))
			{
				$where_result[$quote_place] = 1;
				$where_result = implode(",", $where_result);
				$setip = "UPDATE rash_tracking SET " . $where . " = \"" . $where_result . "\" WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
				$setip2 = mysql_query($getip);
				return 1;
			} else {
				return 3;
			}
		} else {
			$setip = "UPDATE rash_tracking SET " . $where . " = CONCAT(" . $where . ",\",1\"), " . $where2 . " = CONCAT(" . $where2 . ",\",0\"), quote_id = CONCAT(quote_id,\"," . $quote_num . "\") WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
			$setip2 = mysql_query($setip);
			return 1;
		}
	} else {
		$insip = "INSERT INTO rash_tracking (ip, quote_id, " . $where . ", " . $where2 . ") VALUES (\"" . $_SERVER['REMOTE_ADDR'] . "\", \"" . $quote_num . "\", 1, 0)";
		$insip2 = mysql_query($insip);
		return 2;
	}
}

function verify_int($subject)
{
	$ymax = strlen($subject);
	$y = 0;
	while($y < $ymax)
	{
		if ((is_int((int)($subject{$y})) && (int)($subject{$y})) || (int)($subject{$y}) === 0 )
		{
			$y++;
		} else {
			return false;
		}
	}
	return true;
}

?>
