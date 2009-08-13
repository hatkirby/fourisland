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
4::::::::::::::::4  admin/modquotes.php
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
require_once('Pager.php');

$category = 'quotes';
$pageaid = 'modquotes';

if (isset($_GET['action']))
{
	if (($_GET['action'] == 'deny') || ($_GET['action'] == 'approve'))
	{
		if (is_numeric($_POST['id']))
		{
			$getpending = "SELECT * FROM rash_queue WHERE id = " . $_POST['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_POST['id'])
			{
				if ($_GET['action'] == 'deny')
				{
					$delpending = "DELETE FROM rash_queue WHERE id = " . $_POST['id'];
					$delpending2 = mysql_query($delpending);

					$flashmsg = 'The selected quote has been deleted.';
				} else if ($_GET['action'] == 'approve')
				{
					$insquote = "INSERT INTO rash_quotes (quote,date) VALUES (\"" . mysql_real_escape_string($getpending3['quote']) . "\",\"" . time() . "\")";
					$insquote2 = mysql_query($insquote);

					$delpending = "DELETE FROM rash_queue WHERE id = " . $_POST['id'];
					$delpending2 = mysql_query($delpending);

					$flashmsg = 'The selected quote has been approved.';
				}
			}
		}
	} else if (($_GET['action'] == 'denys') || ($_GET['action'] == 'approves'))
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$getcomment = "SELECT * FROM rash_queue WHERE id = " . $id;
				$getcomment2 = mysql_query($getcomment);
				$getcomment3 = mysql_fetch_array($getcomment2);

				if ($getcomment3['id'] == $id)
				{
					if ($_GET['action'] == 'denys')
					{
						$delpending = "DELETE FROM rash_queue WHERE id = " . $id;
						$delpending2 = mysql_query($delpending);

						$flashmsg = 'The selected quote has been deleted.';
					} else if ($_GET['action'] == 'approves')
					{
						$insquote = "INSERT INTO rash_quotes (quote,date) VALUES (\"" . mysql_real_escape_string($getpending3['quote']) . "\",\"" . time() . "\")";
						$insquote2 = mysql_query($insquote);

						$delpending = "DELETE FROM rash_queue WHERE id = " . $id;
						$delpending2 = mysql_query($delpending);

						$flashmsg = 'The selected quote has been approved.';
					}
				}
			}
		}
	}
}

$template = new FITemplate('admin/modquotes');

$getpendingq = "SELECT * FROM rash_queue ORDER BY id ASC";
$getpendingq2 = mysql_query($getpendingq);
$i=0;
while ($getpendingq3[$i] = mysql_fetch_array($getpendingq2))
{
	$i++;
}

if ($i != 0)
{
	$template->adds_block('AVAIL',array('exi'=>1));
} else {
	$template->adds_block('NOTAVAIL',array('exi'=>1));
}

$pager = &Pager::factory(array(	'mode' => 'Sliding',
				'perPage' => 20,
				'delta' => 2,
				'itemData' => $getpendingq3));

$j=0;

foreach ($pager->getPageData() as $quote)
{
	if (!empty($quote))
	{
		$template->adds_block('QUOTE', array(	'TEXT' => str_replace("\n","<br />",htmlentities(stripslashes($quote['quote']))),
							'ID' => $quote['id'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
