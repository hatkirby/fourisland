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

$pageCategory = 'home';
$pageAID = 'archive';

include('includes/recaptchalib.php');
$privatekey = "6LfgvgEAAAAAAD0_UVLp57MU7tqcypsbZPS9qTnr";

$template = new FITemplate('msg');
$template->add('BACK','the previous page');

if (!isset($_GET['id']))
{
	$template->add('MSG','I\'m sorry, but there\'s no page-id set here, so sadly you can\'t comment yet. Why not contact the administratior (link on the HatBar) and tell her that you saw this error?');
} else {
	if ($_POST['comment'] == "")
	{
		$template->add('MSG','I\'m sorry, but you didn\'t enter a comment!');
	} else {
		if (!isLoggedIn())
		{
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			if (!$resp->is_valid)
			{
				$template->add('MSG',"The reCAPTCHA wasn't entered correctly. Go back and try it again. (reCAPTCHA said: " . $resp->error . ")");
			} else {
				if (preg_match('/^[A-Za-z0-9!#$&\'*+-\/=?^_`{|}~]+@[-A-Za-z0-9]+(\.[-A-Za-z0-9]+)+[A-Za-z]$/', $_POST['email']))
				{
					$getanon = "SELECT * FROM anon_commenters WHERE username = \"" . $_POST['username'] . "\"";
					$getanon2 = mysql_query($getanon);
					$getanon3 = mysql_fetch_array($getanon2);

					if ($getanon3['username'] == $_POST['username'])
					{
						if ($getanon3['email'] == $_POST['email'])
						{
							$setcomment = "INSERT INTO comments SET page_id = \"" . $_GET['id'] . "\", username = \"" . $_POST['username'] . "\", comment = \"" . $_POST['comment'] . "\"";
							$setcomment2 = mysql_query($setcomment);

							$page_id = $_GET['id'];
							$comType = substr($page_id,0,strpos($page_id,'-'));
							$comID = substr($page_id,strpos($page_id,'-')+1);
							if ($comType == 'updates')
							{
								recalcPop($comID);
							}

							$template->add('MSG',"Thank you, " . $getanon3['username'] . ", for posting your valuable comment!");
						} else {
							$template->add('MSG',"I'm sorry, but this anonymous username is already in use. If this is in fact you, please verify that you have entered the same email address that you entered the first time you commented here.");
						}
					} else {
						$setcomment = "INSERT INTO moderation SET page_id = \"" . $_GET['id'] . "\", author = \"" . $_POST['username'] . "\", email = \"" . $_POST['email'] . "\", comment = \"" . $_POST['comment'] . "\", website = \"" . $_POST['website'] . "\"";
						$setcomment2 = mysql_query($setcomment);

						mail('hatkirby@fourisland.com', 'New comment to moderate on Four Island', 'Some one has anonymously left a comment on Four Island and it will require moderation.');

						$template->add('MSG',"Thank you for posting your valuable comment!<P>However, as you aren't logged in, your comment will have to be verified by a moderator before it appears. Sorry!");
					}
				} else {
					$template->add('MSG',"I'm sorry, but you've entered an invalid email address.");
				}
			}
		} else {
			$setcomment = "INSERT INTO comments SET page_id = \"" . $_GET['id'] . "\", username = \"" . sess_get('uname') . "\", comment = \"" . $_POST['comment'] . "\"";
			$setcomment2 = mysql_query($setcomment);

			mail('hatkirby@fourisland.com', 'New comment on Four Island!', sess_get('uname') . ' has posted a comment on Four Island under the "page id" ' . $_GET['id']);

			$page_id = $_GET['id'];
			$comType = substr($page_id,0,strpos($page_id,'-'));
			$comID = substr($page_id,strpos($page_id,'-')+1);
			if ($comType == 'updates')
			{
				recalcPop($comID);
			}

			$template->add('MSG',"Thank you, " . sess_get('uname') . ", for posting your valuable comment!");
		}
	}
}

$template->display();

?>
