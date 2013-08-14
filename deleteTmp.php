<?php 
if (! defined('MOE_AMAZON')) exit;

	define('CACHE', md5('CACHE'));
	define('EXPORTE', md5('EXPORTE'));
	define('ALLCACHE', md5('ALLCACHE'));
  
		echo "
			<b>delete...</b><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".CACHE."'>Cache</a><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".EXPORTE."'>Exporte</a><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".ALLCACHE."'>Alles</a><br />
		";  

	if ($_GET['w'] == '')
	{

	} else {
    $sDir = $_SERVER['DOCUMENT_ROOT'].'/amazon/tmp';
		$sDir = str_replace('//', '/', $sDir);
		$oDir = dir($sDir);
		$i = 0;
		
    while ($sEntry = $oDir->read())
		{
			if ($sEntry == '.' || $sEntry == '..') continue;
			switch ($_GET['w'])
			{
				case CACHE:
					if (strpos($sEntry, 'Cache') !== false){
						unlink($sDir.'/'.$sEntry);
						$i++;
					}
				break;
				
				case EXPORTE:
					if (strpos($sEntry, 'Amazon_Export') !== false){
						unlink($sDir.'/'.$sEntry);
						$i++;
					}
				break;
				
				case ALLCACHE: 
					unlink($sDir.'/'.$sEntry); 
					$i++; 
				break;
				default: header('LOCATION: '.$_SERVER['PHP_SELF']);
			}
		}
		
		echo "$i files deleted in $sDir !";
	}