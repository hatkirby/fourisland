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
4::::::::::::::::4  pages/post.php
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

include('includes/recaptchalib.php');

if (!isset($_POST['id']))
{
	generateError('404');
} else {
	if ($_POST['comment'] == "")
	{
		die('I\'m sorry, but you didn\'t enter a comment!');
	} else {
		if (!isLoggedIn())
		{
			if ($_POST['username'] == "")
			{
				die('You forgot to enter a username.');
			} else {
				if (preg_match('/^[A-Za-z0-9!#$&\'*+-\/=?^_`{|}~]+@[-A-Za-z0-9]+(\.[-A-Za-z0-9]+)+[A-Za-z]$/', $_POST['email']))
				{
					$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
					if (!$resp->is_valid)
					{
						die('The reCAPTCHA wasn\'t entered correctly. Go back and try it again.');
					} else {
						$getanon = "SELECT * FROM anon_commenters WHERE username = \"" . $_POST['username'] . "\"";
						$getanon2 = mysql_query($getanon);
						$getanon3 = mysql_fetch_array($getanon2);

						if ($getanon3['username'] == $_POST['username'])
						{
							if ($getanon3['email'] == $_POST['email'])
							{
								$setcomment = "INSERT INTO comments SET page_id = \"" . $_POST['id'] . "\", user_id = " . $getanon3['id'] . ", comment = \"" . $_POST['comment'] . "\", is_anon = 1";
								$setcomment2 = mysql_query($setcomment);
								$cid = mysql_insert_id();

								$page_id = $_POST['id'];
								$comType = substr($page_id,0,strpos($page_id,'-'));
								$comID = substr($page_id,strpos($page_id,'-')+1);
								if ($comType == 'updates')
								{
									recalcPop($comID);
								}

								$template = new FITemplate('new-comment');
								$template->add('ID', $cid);
								$template->add('CODEDEMAIL', md5(strtolower($getanon3['email'])));
								$template->add('TEXT', stripslashes($_POST['comment']));
								$template->add('USERNAME', $getanon3['username']);
								$template->add('DATE', date("F jS Y \a\\t g:i:s a"));
								$template->display();

								exit;
							} else {
								die('I\'m sorry, but this anonymous username is already in use. If this is in fact you, please verify that you have entered the same email address that you entered the first time you commented here.');
							}
						} else {
							$setcomment = "INSERT INTO moderation SET page_id = \"" . $_POST['id'] . "\", author = \"" . $_POST['username'] . "\", email = \"" . $_POST['email'] . "\", comment = \"" . $_POST['comment'] . "\", website = \"" . $_POST['website'] . "\"";
							$setcomment2 = mysql_query($setcomment);

							die('Thank you for posting your valuable comment!<br />However, as you aren\'t logged in, your comment will have to be verified by a moderator before it appears. Sorry!');
						}
					}
				} else {
					die('I\'m sorry, but you\'ve entered an invalid email address.');
				}
			}
		} else {
			$setcomment = "INSERT INTO comments SET page_id = \"" . $_POST['id'] . "\", user_id = " . getSessionUserID() . ", comment = \"" . $_POST['comment'] . "\", is_anon = 0";
			$setcomment2 = mysql_query($setcomment);
			$cid = mysql_insert_id();

			$page_id = $_POST['id'];
			$comType = substr($page_id,0,strpos($page_id,'-'));
			$comID = substr($page_id,strpos($page_id,'-')+1);
			if ($comType == 'updates')
			{
				recalcPop($comID);
			}

			$getuser = "SELECT * FROM phpbb_users WHERE user_id = " . getSessionUserID();
			$getuser2 = mysql_query($getuser);
			$getuser3 = mysql_fetch_array($getuser2);

			$template = new FITemplate('new-comment');
			$template->add('ID', $cid);
			$template->add('CODEDEMAIL', md5(strtolower($getuser3['user_email'])));
			$template->add('TEXT', stripslashes($_POST['comment']));
			$template->add('USERNAME', getSessionUsername());
			$template->add('DATE', date("F jS Y \a\\t g:i:s a"));
			$template->display();

			exit;
		}
	}
}

?>
