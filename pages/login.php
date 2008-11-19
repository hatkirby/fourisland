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

$noMembers=1;

include('includes/recaptchalib.php');
$publickey = "6LfgvgEAAAAAAG_BJMkWk8sNcT1nBaGoXKJYb-JT";
$privatekey = "6LfgvgEAAAAAAD0_UVLp57MU7tqcypsbZPS9qTnr";

if (!isset($_GET['submit']))
{
	$template = new FITemplate('login');
	$template->add('REDIRECT',$_GET['redirect']);

	$template->add('RECAPTCHA',recaptcha_get_html($publickey));
} else {
	$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	if (!$resp->is_valid)
	{
		$template = new FITemplate('login');
		$template->add('REDIRECT',$_GET['redirect']);
		$template->adds_block('ERROR',array('msg' => "The reCAPTCHA wasn't entered correctly. Go back and try it again. (reCAPTCHA said: " . $resp->error . ")"));

		$template->add('RECAPTCHA',recaptcha_get_html($publickey));
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

			$template->add('RECAPTCHA',recaptcha_get_html($publickey));
		}
	}
}

$template->display();

?>
