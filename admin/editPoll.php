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
4::::::::::::::::4  admin/editPoll.php
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
$pageaid = 'quotes';

$template = new FITemplate('admin/writePoll');
$template->add('TITLE', 'Edit Poll');
$template->add('ACTION', '/admin/editPoll.php?id=' . $_GET['id'] . '&amp;submit=');

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

		$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $_GET['id'];
		$getpoll2 = mysql_query($getpoll);
		$getpoll3 = mysql_fetch_array($getpoll2);

		$template->add('QUESTIONVALUE', $_POST['question']);
		$template->add('OPTION1VALUE', $_POST['option1']);
		$template->add('OPTION2VALUE', $_POST['option2']);
		$template->add('OPTION3VALUE', $_POST['option3']);
		$template->add('OPTION4VALUE', $_POST['option4']);
		$template->add('TEXTVALUE', $_POST['text']);
        } else {
		$inspoll = "UPDATE polloftheweek SET question = \"" . mysql_real_escape_string($_POST['question']) . "\", option1 = \"" . mysql_real_escape_string($_POST['option1']) . "\", option2 = \"" . mysql_real_escape_string($_POST['option2']) . "\", option3 = \"" . mysql_real_escape_string($_POST['option3']) . "\", option4 = \"" . mysql_real_escape_string($_POST['option4']) . "\", text = \"" . mysql_real_escape_string($_POST['text']) . "\" WHERE id = " . $_GET['id'];
		$inspoll2 = mysql_query($inspoll);

		$template->add('QUESTIONVALUE', $_POST['question']);
		$template->add('OPTION1VALUE', $_POST['option1']);
		$template->add('OPTION2VALUE', $_POST['option2']);
		$template->add('OPTION3VALUE', $_POST['option3']);
		$template->add('OPTION4VALUE', $_POST['option4']);
		$template->add('TEXTVALUE', $_POST['text']);

		$template->adds_block('FLASH', array('TEXT' => 'Your poll has been sucessfully edited. <a href="/poll/' . $_GET['id'] . '.php">View poll</a>.'));
	}
} else {
	$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $_GET['id'];
	$getpoll2 = mysql_query($getpoll);
	$getpoll3 = mysql_fetch_array($getpoll2);

	$template->add('QUESTIONVALUE', $getpoll3['question']);
	$template->add('OPTION1VALUE', $getpoll3['option1']);
	$template->add('OPTION2VALUE', $getpoll3['option2']);
	$template->add('OPTION3VALUE', $getpoll3['option3']);
	$template->add('OPTION4VALUE', $getpoll3['option4']);
	$template->add('TEXTVALUE', $getpoll3['text']);
}

$template->display();

?>
