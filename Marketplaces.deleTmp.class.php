<?php
if (! defined('MOE_AMAZON')) exit;

class tru_DeleteTmp {
	const CACHE    = 'CACHE';
	const EXPORTE  = 'EXPORTE';
	const ALLCACHE = 'ALLCACHE';
  
  public function printOptions() {
		echo "
			<b>delete...</b><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".self::CACHE."'>Cache</a><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".self::EXPORTE."'>Exporte</a><br />
			<a href='{$_SERVER['PHP_SELF']}?Job=DelCache&w=".self::ALLCACHE."'>Alles</a><br />
		";
  }
  
  public function clearCache($w) {
    if ($w == '')
    {
      return 'Zuwenig Argumente';
    } else {
      $sDir = $_SERVER['DOCUMENT_ROOT'].'/amazon/tmp';
      $sDir = str_replace('//', '/', $sDir);
      $oDir = dir($sDir);
      $i = 0;
      
      while ($sEntry = $oDir->read())
      {
        if ($sEntry == '.' || $sEntry == '..') continue;
        switch ($w)
        {
          case self::CACHE:
            if (strpos($sEntry, 'Cache') !== false){
              unlink($sDir.'/'.$sEntry);
              $i++;
            }
          break;
          
          case self::EXPORTE:
            if (strpos($sEntry, 'Amazon_Export') !== false){
              unlink($sDir.'/'.$sEntry);
              $i++;
            }
          break;
          
          case self::ALLCACHE: 
            unlink($sDir.'/'.$sEntry); 
            $i++; 
          break;
          default: header('LOCATION: '.$_SERVER['PHP_SELF']);
        }
      }
      
      return "$i files deleted in $sDir !";
    }
  }

}