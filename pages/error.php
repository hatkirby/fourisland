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
4::::::::::::::::4  pages/error.php
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

if (!isset($errorid) && isset($_GET['id']))
{
	$errorid = $_GET['id'];
}

if ($errorid == '404')
{
	header("HTTP/1.0 404 Not Found");
	
	$template = new FITemplate('errors/404');

	$strReferer = strtolower($_SERVER['HTTP_REFERER']);

	if (strlen($strReferer) == 0)
	{
		$template->adds_block('NOREFERER',array('exi'=>1));
	} else {
		if ((strpos($strReferer,".looksmart.co")>0) || (strpos($strReferer,".ifind.freeserve")>0) || (strpos($strReferer,".ask.co")>0) || (strpos($strReferer,"google.co")>0) || (strpos($strReferer,"altavista.co")>0) || (strpos($strReferer,"msn.co")>0) || (strpos($strReferer,"yahoo.co")>0))
		{
			$arrSite = explode("/",$strReferer);
			$arrParams = explode("?",$strReferer);
			$strSearchTerms = $arrParams[1];
			$arrParams = explode("&",$strSearchTerms);
			$strSite = $arrSite[2];
			$sQryStr="";
			$arrQueryStrings = array("q=","p=","ask=","key=");

			for ($i=0;$i<count($arrParams);$i++)
			{
				for ($q=0;$q<count($arrQueryStrings);$q++)
				{
					$sQryStr = $arrQueryStrings[$q];
					if (strpos($arrParams[$i],$sQryStr) === 0)
					{
						$strSearchTerms = $arrParams[$i];
						$strSearchTerms = explode($sQryStr,$strSearchTerms);
						$strSearchTerms = $strSearchTerms[1];
						$strSearchTerms = str_replace("+"," ",$strSearchTerms);

						break;
					}
				}
			}
			$template->adds_block('SEARCHREF',array(	'REF' => $strReferer,
									'SITE' => $strSite,
									'TERMS' => $strSearchTerms));
		} else {
			$strSite = $strReferer;
			$strSite = split("/",$strSite);
			$strSite = $strSite[2];

			if (preg_match('/fourisland\.com/',$strSite) == 1)
			{
				$template->adds_block('OURBAD',array('exi'=>1));
			}
			$template->adds_block('NORMALREF',array(	'REF' => $strReferer,
									'SITE' => $strSite));
		}
	}

	$template->display();
}
