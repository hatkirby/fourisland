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
4::::::::::::::::4  includes/specialdates.php
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

/* REMEMBER!
Months: Jan=1-Dec=12
Dates: 1=1-...=...
Days: Mon=1-Sun=7 */

$specialdates = array();

$j=0;
for ($j=0;$j<(365+sd_isLeapYear());$j++)
{
	$specialdates[$j] = '';
}

sd_solar_annual('New Years Day',1,1); //BG Pic; DateFinder
sd_lunar_annual('Martin Luther King Day',1,1,3); //BG Pic; DateFinder
sd_solar_annual('Groundhog Day',2,2); //BG Pic; DateFinder
sd_lunar_annual('Presidents Day',2,1,3); //DateFinder
sd_solar_annual('Valentines Day',2,14); //BG Pic; DateFinder
sd_solar_multiannual('Leap Day',2,29,4,2004); //DateFinder
sd_solar_annual('St Patricks Day',3,17); //DateFinder
sd_solar_annual('April Fools Day',4,1); //Awesome
sd_solar_annual('Tri\'s CIEday',4,22); //DateFinder
sd_solar_annual('Silence Day',4,25); //DateFinder
sd_solar_annual('WCA Day',5,5); //DateFinder
sd_lunar_annual('Mothers Day',5,7,2); //BG Pic; DateFinder; Header Pic
sd_lunar_annual('Memorial Day',5,1,5); //BG Pic; DateFinder; Header Pic
sd_easter(); //BG Pic; DateFinder
sd_solar_annual('Flag Day',6,14); //BG Pic; DateFinder
sd_solar_annual('Hatkirbys B-Day',6,17); //BG Pic; DateFinder; Header Pic
sd_lunar_annual('Fathers Day',6,7,3); //BG Pic; DateFinder
sd_solar_annual('CTNH',6,17); //Header Pic; DateFinder
sd_solar_annual('Independance Day',7,4); //BG Pic; DateFinder
sd_lunar_annual('SysAdminDay',7,5,4); //DateFinder
sd_solar_annual('Opposite Day',8,25); //Yet to be implemented
sd_lunar_annual('Labor Day',9,1,1); //Yet to be implemented
sd_solar_annual('Four Island A',9,22); //BG Pic; DateFinder; Header Pic
sd_lunar_annual('Columbus Day',10,1,2); //BG Pic; DateFinder
sd_solar_annual('Halloween',10,31); //BG Pic; DateFinder
sd_solar_annual('Veterans Day',11,11); //BG Pic; DateFinder
sd_lunar_annual('Thanksgiving',11,4,4); //DateFinder
sd_kirbyWeek(); //BG Pic; DateFinder
sd_solar_annual('Christmas Eve',12,24); //BG Pic; DateFinder
sd_solar_annual('Christmas Day',12,25); //BG Pic; DateFinder
sd_solar_annual('New Years Eve',12,31); //BG Pic; DateFinder

function sd_solar_annual($id,$month,$date)
{
	$did = sd_getMonthStart($month-1);
	$did += ($date-1);
	sd_addDateIn($id,$did);
}

function sd_solar_monthly($id,$date)
{
	$i=0;
	for ($i=0;$i<12;$i++)
	{
		sd_solar_annual($id,$i+1,$date);
	}
}

function sd_lunar_annual($id,$month,$dotw,$wn)
{
	$did = sd_getMonthStart($month-1);
	$ys = sd_clearDate();
	$ys+=(60*60*24*$did);
	if (sd_date('N',$ys)>$dotw)
	{
		$ys+=(((7-sd_date('N',$ys))+$dotw)*60*60*24);
	} else {
		$ys+=(($dotw-sd_date('N',$ys))*60*60*24);
	}
	$ys+=(($wn-1)*60*60*24*7);
	$did = sd_getMonthStart(sd_date('m',$ys)-1);
	$did += (sd_date('j',$ys)-1);
	sd_addDateIn($id,$did);
}

function sd_getMonthStart($month)
{
	if ($month==0)
	{
		return 0;
	} else {
		$c = sd_daysInMonth($month-1)+sd_getMonthStart($month-1);

		return ($c);
	}
}

function sd_daysInMonth($month)
{
	switch ($month)
	{
		case 0: return 31;
		case 1: return (28+sd_isLeapYear());
		case 2: return 31;
		case 3: return 30;
		case 4: return 31;
		case 5: return 30;
		case 6: return 31;
		case 7: return 31;
		case 8: return 30;
		case 9: return 31;
		case 10: return 30;
		case 11: return 31;
		default: throw new Exception('Invalid month ID');
	}
}

function sd_isLeapYear()
{
	return sd_date('L');
}

function sd_isSpecialDay($id)
{
	global $specialdates;
	$did = sd_getMonthStart(sd_date('n')-1);
	$did += (sd_date('j')-1);
	if ($specialdates[$did] == $id)
	{
		return 1;
	} else {
		return 0;
	}
}

function sd_ifNoSpecialDay()
{
	global $specialdates;
	$did = sd_getMonthStart(sd_date('n')-1);
	$did += (sd_date('j')-1);
	if ($specialdates[$did] == '')
	{
		return 1;
	} else {
		return 0;
	}
}

function sd_kirbyWeek()
{
	$did = sd_getMonthStart(11);
	$ys = sd_clearDate();
	$ys+=(60*60*24*24);
	$ys+=(60*60*24*$did);
	$tWD=sd_date('N',$ys);
	if ($tWD==7) {$tWD=0;}
	$ys-=($tWD*60*60*24);
	$ys-=(60*60*24*7);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys));
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+1);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+2);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+3);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+4);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+5);
	sd_solar_annual('Kirby Week',12,sd_date('j',$ys)+6);
}

function sd_easter()
{
	$nYear = sd_date('Y');
	$nCent = $nYear/100;
	$nRemain19 = $nYear%19;
	$n1 = ($nCent-15)/2+202-11*$nRemain19;
	if ($nCent>20)
	{
		if ($nCent>26) {$n1--;}
		if ($nCent>38) {$n1--;}
		if ($nCent==21 || $nCent==24 || $nCent==25 || $nCent==33 || $nCent==36 || $nCent==37) {$n1--;}
	}
	$n1%=30;
	if ($n1==29 || ($n1 && $nRemain19>10)) {$n1--;}
	$ys = sd_clearDate();
	if ($n1>10)
	{
		$ys+=(60*60*24*sd_getMonthStart(3));
		$ys+=(60*60*24*($n1-10-1));
	} else {
		$ys+=(60*60*24*sd_getMonthStart(2));
		$ys+=(60*60*24*($n1+21-1));
	}
	$nWD = sd_date('N',$ys);
	if ($nWD==7) {$nWD=0;}
	$ys+=(60*60*24*(7-$nWD));
	sd_solar_annual('Easter',sd_date('m',$ys),sd_date('j',$ys));
	$ys-=(60*60*24*47);
	sd_solar_annual('Mardi Gras',sd_date('m',$ys),sd_date('j',$ys));
	$ys+=(60*60*24);
	sd_solar_annual('Ash Wednesday',sd_date('m',$ys),sd_date('j',$ys));
	$ys+=(60*60*24*39);
	sd_solar_annual('Palm Sunday',sd_date('m',$ys),sd_date('j',$ys));
	$ys+=(60*60*24*5);
	sd_solar_annual('Good Friday',sd_date('m',$ys),sd_date('j',$ys));
}

function sd_findDay($id)
{
	global $specialdates;
	$i=0;
	for ($i=0;$i<(365+sd_isLeapYear());$i++)
	{
		if ($specialdates[$i] == $id)
		{
			return $i;
		}
	}
	throw new Exception('Specified holiday does not exist');
}

function sd_findNextDay()
{
	global $specialdates;
	$did = sd_getMonthStart(sd_date('n')-1);
	$did += (sd_date('j')-1);
	$i=0;
	for ($i=$did;$i<(365+sd_isLeapYear());$i++)
	{
		if ($specialdates[$i] != '')
		{
			return $i;
		}
	}
	throw new Exception('No more holidays this year');
}

function sd_getCurrentDay()
{
	global $specialdates;
	$did = sd_getMonthStart(sd_date('n')-1);
	$did += (sd_date('j')-1);
	return $specialdates[$did];
}

function sd_solar_multiannual($id,$month,$date,$years,$sy)
{
	global $specialdates;
	$cy = sd_date('Y');
	$cy -= $sy;
	if ($cy==0 || $cy%$years==0)
	{
		$did = sd_getMonthStart($month-1);
		$did += ($date-1);
		$specialdates[$did] = $id;
	}
}

function sd_solar_once($id,$month,$date,$year)
{
	if ($year == sd_date('Y'))
	{
		sd_solar_annual($id,$month,$date);
	}
}

function sd_getDay($id)
{
	global $specialdates;
	return $specialdates[$id];
}

function sd_lunar_monthly($id,$dotw,$wn)
{
	$i=1;
	for ($i=1;$i<13;$i++) {
		sd_lunar_annual($id,$i,$dotw,$wn);
	}
}

function sd_date($format,$timestamp = 0)
{
	if ($timestamp == 0) {$timestamp = time();}
	return date($format,$timestamp);
}

function sd_clearDate()
{
	$ys = strtotime('January 1 ' . date('Y'));
	return $ys;
}

function sd_addDateIn($id,$dateid)
{
	global $specialdates;
	$specialdates[$dateid] = $id;
}

function sd_dateFinder()
{
	if (sd_ifNoSpecialDay())
	{
		$did = sd_getMonthStart(date('n')-1);
		$did += (date('j')-1);
		$did = sd_findNextDay() - $did;
		return ($did . ' more days until the next holiday!');
	} else {
		switch (sd_getCurrentDay())
		{
			case 'New Years Day': return 'Happy new years!';
			case 'Martin Luther King Day': return 'Happy Martin Luther King Day!';
			case 'Groundhog Day': return 'It\'s groundhog day? Will he see his shadow?';
			case 'Presidents Day': return 'Happy President\'s Day!';
			case 'Valentines Day': return 'Happy Valentines Day! Will you be mine?';
			case 'St Patricks Day': return 'Happy St. Patrick\'s Day! If you\'re not wearing green, I\'ll pinch you!';
			case 'Mothers Day': return 'Happy Mothers Day!';
			case 'Memorial Day': return 'Remember...';
			case 'Easter': return 'Happy Easter! Where are those eggs?';
			case 'Mardi Gras': return 'Happy Mardi Gras! Time to get fat!';
			case 'Ash Wednesday': return 'Happy Ash Wednesday! Did you get your ashes?';
			case 'Palm Sunday': return 'Happy Palm Sunday!';
			case 'Holy Thursday': return 'Happy Holy Thursday!';
			case 'Hatkirbys B-Day': return 'Happy Birthday to me! Happy Birthday to me! Happy Birthday dear Hatkirby! Happy Birthday to me!';
			case 'Flag Day': return 'Happy Flag Day!';
			case 'Fathers Day': return 'Happy Fathers Day!';
			case 'Independance Day': return 'Happy 4th of July!';
			case 'Labor Day': return 'Happy Labor Day!';
			case 'Four Island A': return ('Happy birthday Four Island! Four Island is ' . (date('Y')-2007) . ' years old!');
			case 'Columbus Day': return 'Happy Columbus Day!';
			case 'Halloween': return 'Happy Halloween!';
			case 'Veterans Day': return 'Only 2 minutes of silence. Remember... remember...';
			case 'Thanksgiving': return 'Happy Thanksgiving! Gobble gobble gobble gobble!';
			case 'Kirby Week': return 'It\'s Kirby Week! Not only is it a time of celebreation and fun on Four Island, it\'s only a week before Christmas!';
			case 'Christmas Eve': return '"1 Day Left" says Fourie!';
			case 'Christmas Day': return 'Merry Christmas! Time for presents!';
			case 'New Years Eve': return '5... 4... 3... 2...';
			case 'SysAdminDay': return '<A HREF="http://www.sysadminday.com">If you can read this, thank your <I><B>sysadmin</B></I></A>';
			case 'WCA Day': return '<A HREF="http://wca2001.keenspace.com">Webcomic Appreciation Day!</A> Stare in wonder at all of your favorite webcomics! Like Pillowcase, for instance!';
			case 'Leap Day': return 'What day is it? LEAP DAY? This only happens once every four years! LET\'S LEAP IN JOY!';
			case 'Tris CIEday': return 'This is the day that shei came.';
			case 'Silence Day': return 'Support LGBT people by keeping the silence until 5 PM.';
			case 'CTNH': return '<A HREF="/fuhsdiufgsadiufgaisfioas.php">It never happened.</A>';
			case 'April Fools Day': return 'Long live the three!';
		}
	}
}

function doAprilFoolsDay($text)
{
	if (sd_isSpecialDay('April Fools Day'))
        {
                $text = str_replace('four', 'three', $text);
                $text = str_replace('Four', 'Three', $text);
                //$text = str_replace('4', '3', $text);
                $text = str_replace('FOUR', 'THREE', $text);
        }
        
        return $text;
}

?>
