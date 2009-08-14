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
4::::::::::::::::4  admin/newPoll.php
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

$category = 'polls';
$pageaid = 'newpoll';

$template = new FITemplate('admin/writePoll');

if (isset($_GET['submit']))
{
	if (empty($_POST['question']))
	{
		$errors[] = array(      'field' => 'question',
                                        'text' => 'Question is a required field');
	}

	if (empty($_POST['option1']))
	{
		$errors[] = array(      'field' => 'option1',
                                        'text' => 'Option 1 is a required field');
	}

	if (empty($_POST['option2']))
	{
		$errors[] = array(      'field' => 'option2',
                                        'text' => 'Option 2 is a required field');
	}

	if (empty($_POST['option3']))
	{
		$errors[] = array(      'field' => 'option3',
                                        'text' => 'Option 3 is a required field');
	}

	if (empty($_POST['option4']))
	{
		$errors[] = array(      'field' => 'option4',
                                        'text' => 'Option 4 is a required field');
	}

        if (isset($errors))
        {
                $template->adds_block('ISERROR',array('exi'=>1));

                $eid = 0;
                foreach ($errors as $error)
                {
                        $template->adds_block('ERROR', array(   'ID' => $eid,
                                                                'TEXT' => $error['text']));
                        $template->add('IS' . strtoupper($error['field']) . 'ERROR', ' error');
                        $template->adds_block(strtoupper($error['field']) . 'ERROR', array(     'ID' => $eid,
                                                                                                'TEXT' => $error['text']));

                        $eid++;
                }

		$template->add('TITLE', 'New Poll');
		$template->add('ACTION', '/admin/newPoll.php?submit=');
        } else {
		$inspoll = "INSERT INTO polloftheweek (question,option1,option2,option3,option4,text) VALUES (\"" . mysql_real_escape_string($_POST['question']) . "\",\"" . mysql_real_escape_string($_POST['option1']) . "\",\"" . mysql_real_escape_string($_POST['option2']) . "\",\"" . mysql_real_escape_string($_POST['option3']) . "\",\"" . mysql_real_escape_string($_POST['option4']) . "\",\"" . mysql_real_escape_string($_POST['text']) . "\")";
		$inspoll2 = mysql_query($inspoll);

		$id = mysql_insert_id();

		$cleardid = "TRUNCATE TABLE didpollalready";
		$cleardid2 = mysql_query($cleardid);

		$template->add('QUESTIONVALUE', $_POST['question']);
		$template->add('OPTION1VALUE', $_POST['option1']);
		$template->add('OPTION2VALUE', $_POST['option2']);
		$template->add('OPTION3VALUE', $_POST['option3']);
		$template->add('OPTION4VALUE', $_POST['option4']);
		$template->add('TEXTVALUE', $_POST['text']);

		$template->add('TITLE', 'Edit Poll');
		$template->add('ACTION', '/admin/editPoll.php?id=' . $id . '&amp;submit=');
		$template->adds_block('FLASH', array('TEXT' => 'Your poll has been sucessfully created. <a href="/poll/' . $id . '.php">View poll</a>.'));
	}
} else {
	$template->add('TITLE', 'New Poll');
	$template->add('ACTION', '/admin/newPoll.php?submit=');
}

$template->display();

?>
