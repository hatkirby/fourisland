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
4::::::::::::::::4  pages/poll.php
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

$pageCategory = 'poll';

if (isset($_GET['submit']))
{
	$setip = "INSERT INTO didpollalready SET ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$setip2 = mysql_query($setip);
	$getpoll = "SELECT * FROM polloftheweek ORDER BY id DESC LIMIT 0,1";
	$getpoll2 = mysql_query($getpoll);
	$getpoll3 = mysql_fetch_array($getpoll2);
	$setpoll = "UPDATE polloftheweek SET clicks" . $_POST['options'] . " = " . ($getpoll3['clicks' . $_POST['options']]+1) . " WHERE id = " . $getpoll3['id'];
	$setpoll2 = mysql_query($setpoll);

	$template = new FITemplate('msg');

	$template->add('MSG','<H2>' . $getpoll3['question'] . '</H2><P>Thank you for voting on the Poll of the Week!<BR><A HREF="poll.php?id=' . $getpoll3['id'] . '">Click here to visit the page for this poll.');

	$template->display();
} else if (!isset($_GET['id']))
{
	$template = new FITemplate('pollIndex');

	if (isset($_GET['start']))
	{
		$start = $_GET['start'] * 10;
	} else {
		$start = 0;
	}

	$getpolls = "SELECT * FROM polloftheweek ORDER BY id DESC LIMIT " . $start . ",10";
	$getpolls2 = mysql_query($getpolls);
	$i=0;
	while ($getpolls3[$i] = mysql_fetch_array($getpolls2))
	{
		$question = strip_tags($getpolls3[$i]['question']);
		if (strlen($question) > 50)
		{
			$question = substr($question, 0, 50);
			while (substr($question, strlen($question)-1) != ' ')
			{
				$question = substr($question, 0, strlen($question)-1);
			}

			$question = substr($question, 0, strlen($question)-1);
			$question .= '....';
		}
		$template->adds_block('POLL', array(	'ID' => $getpolls3[$i]['id'],
							'QUESTION' => $question,
							'WEEK' => date('F jS Y', strtotime($getpolls3[$i]['week'])),
							'EVEN' => (($i % 2 == 1) ? ' CLASS="even"' : '')));
		$i++;
	}

	if ($i==0)
	{
		generateError('404');
		exit;
	}

	$start /= 10;
	if ($start > 0)
	{
		$template->adds_block('PREVIOUS', array('ID' => ($start-1)));
	}

	$cntpolls = "SELECT COUNT(*) FROM polloftheweek";
	$cntpolls2 = mysql_query($cntpolls);
	$cntpolls3 = mysql_fetch_array($cntpolls2);
	if ($start < floor($cntpolls3['COUNT(*)'] / 10))
	{
		$template->adds_block('NEXT', array('ID' => ($start+1)));
	}

	include('pages/polloftheweek.php');

	$template->display();
} else {
	$template = new FITemplate('poll');

	$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $_GET['id'];
	$getpoll2 = mysql_query($getpoll);
	$getpoll3 = mysql_fetch_array($getpoll2);

	$template->add('QUESTION', $getpoll3['question']);

	$getrss = "SELECT * FROM pollrss WHERE id = " . $_GET['id'];
	$getrss2 = mysql_query($getrss);
	$getrss3 = mysql_fetch_array($getrss2);

	if ($getrss3['id'] == $_GET['id'])
	{
		$template->adds_block('COMPLETE', array(	'RSS' => parseBBCode($getrss3['rss']),
								'AUTHOR' => $getrss3['author'],
								'DATE' => date("F dS Y \a\\t g:i:s a",strtotime($getrss3['date'])),
								'OPTION1' => $getpoll3['option1'],
								'OPTION2' => $getpoll3['option2'],
								'OPTION3' => $getpoll3['option3'],
								'OPTION4' => $getpoll3['option4'],
								'CLICKS1' => $getpoll3['clicks1'],
								'CLICKS2' => $getpoll3['clicks2'],
								'CLICKS3' => $getpoll3['clicks3'],
								'CLICKS4' => $getpoll3['clicks4']));
	} else {
		$template->adds_block('INCOMPLETE', array('exi'=>1));
	}

	$forceDisplay = $_GET['id'];
	include('pages/polloftheweek.php');
	unset($forceDisplay);

	$template->display();

	$page_id = 'polloftheweek-' . $getpoll3['id'];
	include('includes/comments.php');

	displayRelated($getpoll3['question']);
}

?>
