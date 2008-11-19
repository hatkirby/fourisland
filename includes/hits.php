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
4::::::::::::::::4  includes/hits.php
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

/* Notice:

   This is an old module for counting hits
    taken directly from the old Four Island.
   Because of this, it may contain unforseen
    bugs.
*/

$getlreset = "SELECT * FROM config WHERE name = 'lastReset'";
$getlreset2 = mysql_query($getlreset);
$getlreset3 = mysql_fetch_array($getlreset2);
if ((floor(time()/86400))>($getlreset3['value']))
{
	$sethits = "UPDATE config SET value = " . (floor(time()/86400)) . " WHERE name = 'lastReset'";
	$sethits2 = mysql_query($sethits);
	$getips = "SELECT * FROM hits";
	$getips2 = mysql_query($getips);
	$i=0;
	while ($getips3[$i] = mysql_fetch_array($getips2))
	{
		$ttime = strtotime($getips3[$i]['lasttime']);
		$delip = "DELETE FROM hits WHERE id = " . $getips3[$i]['id'];
		$delip2 = mysql_query($delip);
		$i++;
	}
	$sethits6 = "UPDATE config SET value = 0 WHERE name = 'todayHits'";
	$sethits7 = mysql_query($sethits6);
}
$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
$user_ip = $client_ip;
$getip = "SELECT * FROM hits WHERE ip = '" . $user_ip . "'";
$getip2 = mysql_query($getip);
$getip3 = mysql_fetch_array($getip2);
if ($getip3['ip'] != $user_ip)
{
	$gethits = "SELECT * FROM config WHERE name = 'hits'";
	$gethits2 = mysql_query($gethits);
	$gethits3 = mysql_fetch_array($gethits2);
	$sethits = "UPDATE config SET value = " . ($gethits3['value']+1) . " WHERE name = 'hits'";
	$sethits2 = mysql_query($sethits);
	$gethits4 = "SELECT * FROM config WHERE name = 'todayHits'";
	$gethits5 = mysql_query($gethits4);
	$gethits6 = mysql_fetch_array($gethits5);
	$sethits4 = "UPDATE config SET value = " . ($gethits6['value']+1) . " WHERE name = 'todayHits'";
	$sethits5 = mysql_query($sethits4);
	$gethits7 = "SELECT * FROM config WHERE name = 'imHits'";
	$gethits8 = mysql_query($gethits7);
	$gethits9 = mysql_fetch_array($gethits8);
	$setip = "INSERT INTO hits SET ip = '" . $user_ip . "'";
	$setip2 = mysql_query($setip);
	if (isset($_SERVER['HTTP_REFERER']))
	{
		$page = $_SERVER['HTTP_REFERER'];
	} else {
		$page = '';
	}
	$ipdetails = str_pad($client_ip,15,' ') . ' - ' . str_pad($page,61,' ') . ' - ' . str_pad($_SERVER['REQUEST_URI'],27,' ') . ' - ' . time() . chr(13) . chr(10);
	$milestones = array(100,500,1000,1337,4444,5000,10000,15000,50000,75000,100000,150000,250000,500000,750000,1000000);
	$i=0;
	for ($i=0; $i<15; $i++) {
		if (($gethits3['value']+1)==$milestones[$i]) {
			$setmst = 'UPDATE config SET value = "' . time() . '" WHERE name = "milestonetime"';
			$setmst2 = mysql_query($setmst);
			$setms = 'UPDATE config SET value = "' . ($gethits3['value']+1) . '" WHERE name = "milestone"';
			$setms2 = mysql_query($setms);
			include('includes/header.php');
?>
<FONT SIZE="6" COLOR="RED">CONGRADULATIONS! You are the <?php echo($gethits3['value']+1); ?>th person to visit this site! Refresh the page to return to the page you were visiting.</FONT>
<?php
			include('includes/footer.php');
			exit;
		}
	}
}

?>
