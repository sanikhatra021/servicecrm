<?php
	
	function removespecialchar($par1)	
	{		
		/*return preg_replace('/[^A-Za-z0-9\-]/',' ', $par1);*/		
		return trim(preg_replace('/[\x00-\x1F\x80-\xFF\'\"]/', '', $par1));	
	}

?>