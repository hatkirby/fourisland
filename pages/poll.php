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

if (!isset($_GET['id']))
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
							'QUESTION' => htmlentities($question),
							'WEEK' => date('F jS Y', strtotime($getpolls3[$i]['week'])),
							'EVEN' => (($i % 2 == 1) ? ' class="even"' : '')));
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

	$template->add('POTW', getPollOfTheWeek());
	$template->display();
} else {
	$template = new FITemplate('poll');

	$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $_GET['id'];
	$getpoll2 = mysql_query($getpoll);
	$getpoll3 = mysql_fetch_array($getpoll2);

	if ($getpoll3['id'] == $_GET['id'])
	{
		$template->add('QUESTION', htmlentities($getpoll3['question']));

		if ($getpoll3['text'] != '')
		{
			$template->adds_block('COMPLETE', array(	'RSS' => parseText($getpoll3['text']),
									'AUTHOR' => $getrss3['author'],
									'DATE' => date("F jS Y \a\\t g:i:s a",strtotime($getpoll3['week'])),
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

		$template->add('POTW', getPollOfTheWeek($_GET['id']));
		$template->display();

		$page_id = 'polloftheweek-' . $getpoll3['id'];
		include('includes/comments.php');

		displayRelated($getpoll3['question']);
	} else {
		generateError('404');
	}
}

?>
