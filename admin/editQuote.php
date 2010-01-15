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
4::::::::::::::::4  admin/editQuote.php
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

$category = 'quotes';
$pageaid = 'quotes';

$template = new FITemplate('admin/writeQuote');
$template->add('TITLE', 'Edit Quote');
$template->add('ACTION', '/admin/editQuote.php?id=' . $_GET['id'] . '&amp;submit=');

if (isset($_GET['submit']))
{
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

		$template->add('QUOTEVALUE', $_POST['quote']);
        } else {
		$insquote = "UPDATE rash_quotes SET quote = \"" . mysql_real_escape_string($_POST['quote']) . "\" WHERE id = " . $_GET['id'];
		$insquote2 = mysql_query($insquote);

		$template->add('QUOTEVALUE', $_POST['quote']);

		$template->adds_block('FLASH', array('TEXT' => 'Your quote has been sucessfully edited. <a href="/quotes/' . $_GET['id'] . '.php">View quote</a>.'));
	}
} else {
	$getquote = "SELECT * FROM rash_quotes WHERE id = " . $_GET['id'];
	$getquote2 = mysql_query($getquote);
	$getquote3 = mysql_fetch_array($getquote2);

	$template->add('QUOTEVALUE', $getquote3['quote']);
}

$template->display();

?>
