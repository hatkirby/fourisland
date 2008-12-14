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
4::::::::::::::::4  pages/login.php
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

$pageCategory = 'log';

if (!isset($_GET['submit']))
{
	$template = new FITemplate('login');
	$template->add('REDIRECT',$_GET['redirect']);
} else {
	if (verifyUser($_POST['username'], $_POST['password']))
	{
		sess_set('uname',$_POST['username']);
		header('Location: ' . rawurldecode($_POST['redirect']));
		exit;
	} else {
		$template = new FITemplate('login');
		$template->add('REDIRECT',$_POST['redirect']);
		$template->adds_block('ERROR',array('MSG' => "The username/password pair didn't resolve to a real user. Try logging on again, spelling the password right, or making sure you actually have an a account."));
	}
}

$template->display();

?>
