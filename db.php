<?php
if (! defined('MOE_AMAZON')) exit;

class db
{
  public $resource;
  
  function __construct()
  {
    require_once('tools.class.php');
    $this->tools = new tru_tools();
    
    require_once('config.inc.php');
    $conf = new config;
    
    $this->resource = new mysqli($conf->dbHost, $conf->dbUser, $conf->dbPwd, $conf->dbName);
    $this->resource->set_charset("utf8");
  }
  
  function query($sql)
  {
    if($ret = $this->resource->query($sql)) {
      return $ret;
    } else {
      $this->tools->monitor($this->resource->error);
      return false;
    }
  }
  
  function multi_query($sql)
  {
    if($ret = $this->resource->multi_query($sql)) {
      return $ret;
    } else {
      $this->tools->monitor($this->resource->error);
      return false;
    }
  }
  
  function getArray($sql)
  {
    $ret = array();
    if ($result = $this->resource->query($sql))
    {
      while($array = $result->fetch_array(MYSQLI_ASSOC))
      {
        $ret[] = $array;
      }
    } else {
      $this->tools->monitor("Das folgende SQL-Statement ist fehlgeschlagen:\n".$sql);
      $this->tools->monitor($this->resource->error_list);
      return false;
    }
    return $ret;
  }
  
  function getFieldsFromTable($Table) {
    $sSql = "DESCRIBE ".$Table;
    return $this->getArray($sSql);
  }
  
  function close()
  {
    $this->resource->close();
  }
}
/*
$ArtNr = "05356003";
$db = new db();
print_r($db->buildArtikel($ArtNr));

$db->close();
*/

?>