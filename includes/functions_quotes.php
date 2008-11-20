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
4::::::::::::::::4  includes/functions_quotes.php
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
							'QUOTE' => nl2br(stripslashes($getquotes3[$i]['quote']))));
		
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
