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
4::::::::::::::::4  xmlrpc.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('headerproc.php');

include('../security/config.php');
include('includes/db.php');
include('includes/xmlrpc/xmlrpc.inc');
include('includes/xmlrpc/xmlrpcs.inc');
include('includes/functions.php');

function ping($xmlrpcmsg)
{
	$from = $xmlrpcmsg->getParam(0)->scalarVal();
	$to = $xmlrpcmsg->getParam(1)->scalarVal();

	if (preg_match('/^http:\/\/w?w?w?\.?fourisland\.com\/blog\/([-a-z0-9]+)\/$/',$to))
	{
		$slug = preg_replace('/^http:\/\/w?w?w?\.?fourisland\.com\/blog\/([-a-z0-9]+)\/$/','$1',$to);

		$getpost = "SELECT * FROM updates WHERE slug = \"" . $slug . "\"";
		$getpost2 = mysql_query($getpost);
		$getpost3 = mysql_fetch_array($getpost2);

		if ($getpost3['slug'] == $slug)
		{

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $from);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_HEADER, false);
			$page_data = curl_exec($c);
			curl_close($c);

			if (stripos($page_data,$to) !== FALSE)
			{
				if (preg_match('/<TITLE>([^>]+)<\/TITLE>/i',$page_data,$matches))
				{
					$title = $matches[1];
				} else {
					$title = $from;
				}

				$getping = "SELECT * FROM pingbacks WHERE post_id = " . $getpost3['id'] . " AND url = \"" . mysql_real_escape_string($from) . "\"";
				$getping2 = mysql_query($getping);
				$getping3 = mysql_fetch_array($getping2);

				if ($getping3['url'] == $from)
				{
					return new xmlrpcresp(0, 48, "Target uri cannot be used as target");
				} else {
					$insping = "INSERT INTO pingbacks (post_id,title,url) VALUES (" . $getpost3['id'] . ",\"" . mysql_real_escape_string($title) . "\",\"" . mysql_real_escape_string($from) . "\")";
					$insping2 = mysql_query($insping);
					recalcPop($getpost3['id']);

					return new xmlrpcresp(new xmlrpcval("YAY! Your Pingback has been registered!", "string"));
				}
			} else {
				return new xmlrpcresp(0, 17, "Source uri does have link to target uri");
			}
		} else {
			return new xmlrpcresp(0, 32, "Target uri does not exist");
		}
	} else {
		return new xmlrpcresp(0, 33, "Target uri cannot be used as target");
	}
}

$s = new xmlrpc_server(array(
			"pingback.ping" => array("function" => "ping")));

?>
