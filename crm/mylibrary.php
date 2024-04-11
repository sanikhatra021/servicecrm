<?php

	//echo "Connected successfully";
	function checkvalidstring($par1)	
	{		
		/*return preg_replace('/[^A-Za-z0-9\-]/',' ', $par1);*/		
		return trim(preg_replace('/[\x00-\x1F\x80-\xFF\'\"]/', '', $par1));	
	}
	function removespecialchar($str)
	{
		/*return preg_replace('/[^A-Za-z0-9\-]/',' ', $par1);*/
		return trim(preg_replace('/[\x00-\x09\x0B-\x1F\x80-\xFF\'\"]/', '', $str));
		/* //preg_replace('/[\x00-\x1F\x7F\xA0\'\"]/u', '', $string); */
	}
?>