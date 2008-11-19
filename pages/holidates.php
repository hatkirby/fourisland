<TABLE WIDTH="100%" CLASS="webmail"><TR><TH>ID</TH><TH>Date</TH><TH>Holidate</TH></TR><?php

foreach ($specialdates as $num => $val)
{
	$date = sd_clearDate();
	$date += ($num*60*60*24);
	echo('<TR' . (($num % 2 == 0) ? ' CLASS="even"' : '') . '><TD>' . $num . '</TD><TD>' . date('F jS',$date) . '</TD><TD>' . $val . '</TD></TR>');
}

?></TABLE>
