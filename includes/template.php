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
4::::::::::::::::4  includes/template.php
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

class FITemplate
{

	var $file;
	var $tags;
	var $blocks;
	var $refs;

	function FITemplate($filename)
	{
		$tfn = 'theme/' . $filename . '.tpl';
		if (file_exists($tfn))
		{
			$this->file = $tfn;
		} else {
			throw new Exception($tfn . ' does not exist');
		}
	}

	function add($name, $value)
	{
		$this->tags[$name] = $value;
	}

	function adds($tagarr)
	{
		foreach ($tagarr as $name => $value)
		{
			$this->add($name,$value);
		}
	}

	function adds_block($block, $tagarr)
	{
		if (!isset($this->blocks[$block]))
		{
			$this->blocks[$block] = array('count' => 1);
		}
		foreach ($tagarr as $name => $value)
		{
			$this->blocks[$block][$this->blocks[$block]['count']][$name] = $value;
		}
		$this->blocks[$block]['count']++;
	}

	function add_ref($id, $block, $tagarr)
	{
		$this->adds_block($block,$tagarr);
		$this->refs[$id] = &$this->blocks[$block][$this->blocks[$block]['count']-1];//'$this->blocks[\'' . $block . '\'][' . ($this->blocks[$block]['count']-1) . ']';
	}

	function adds_ref($id, $tagarr)
	{
		foreach ($tagarr as $name => $value)
		{
			$this->refs[$id][$name] = $value;
		}
	}
	function adds_ref_sub($id, $block, $tagarr)
	{
		if (!isset($this->refs[$id][$block]))
		{
			$this->refs[$id][$block] = array('count' => 1);
		}
		foreach ($tagarr as $name => $value)
		{
			$this->refs[$id][$block][$this->refs[$id][$block]['count']][$name] = $value;
		}
		$this->refs[$id][$block]['count']++;
	}

	function display()
	{
		$template = file_get_contents($this->file);
		while (preg_match('/<!--INCLUDE ([^>]*)-->/',$template) == 1)
		{
			preg_match('/<!--INCLUDE ([^>]*)-->/',$template,$mat);
			$fname = $mat[1];
			$itmp = new FITemplate($fname);
			$template = str_replace('<!--INCLUDE ' . $fname . '-->',file_get_contents($itmp->file),$template);
		}
		if (isset($this->tags))
		{
			foreach ($this->tags as $name => $value)
			{
				$template = str_replace('<!--' . $name . '-->',$value,$template);
			}
		}
		if (isset($this->blocks))
		{
			foreach ($this->blocks as $bname => $block)
			{
				$this->parseBlock($template, $bname, $block);
			}
		}
		while (preg_match('/<!--BEGIN ([^>]*)-->/',$template) == 1)
		{
			preg_match('/<!--BEGIN ([^>]*)-->/',$template,$mat);
			$bname = $mat[1];
			$start = strpos($template,'<!--BEGIN ' . $bname . '-->');
			$end = strpos($template,'<!--END ' . $bname . '-->');
			$template = str_replace(substr($template,$start,$end-$start+strlen($bname)+11),'',$template);
		}
		$template = preg_replace('/<!--([^>]*)-->/','',$template);

		echo($template);
	}

	function parseBlock(&$template, $bname, $block)
	{
		while (strpos($template,'<!--BEGIN ' . $bname . '-->') !== FALSE)
		{
			$start = strpos($template,'<!--BEGIN ' . $bname . '-->');
			$end = strpos($template,'<!--END ' . $bname . '-->');
			$gencont = substr($template,$start+strlen($bname)+13,$end-$start-strlen($bname)-13);
			$blockcont = '';
			foreach ($block as $lname => $blocktags)
			{
				if ($lname != 'count')
				{
					$scrcont = $gencont;
					foreach ($blocktags as $name => $value)
					{
						if (!is_array($value))
						{
							$scrcont = str_replace('<!--' . $bname . '.' . $name . '-->',$value,$scrcont);
						} else {
							$this->parseBlock($scrcont, $bname . '.' . $name, $value);
						}
					}
					$blockcont .= $scrcont;
				}
			}
			$template = str_replace(substr($template,$start,$end-$start+strlen($bname)+11),$blockcont,$template);
		}
	}

}

?>
