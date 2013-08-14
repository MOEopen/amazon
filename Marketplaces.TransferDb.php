<?php
if (! defined('MOE_AMAZON')) exit;

ini_set("display_errors",true);
ini_set("error_reporting",E_ALL);

class tru_Import {
  const USER         = 'W0c0MFdi01Zb6f6W76A1';
  const PASSWORT     = '>a37Xg=B1Rl<ja#';
  
  public $DbHost     = "127.0.0.1";
  public $DbUser     = "appblcsk4";
  public $DbPasswort = "k386u9ry";
  public $DbName     = "usrdb_appblcsk4";
  
  public $MySQLPath  = "/usr/local/mysql5/bin/mysql";
  
  const HTMLEOL      = "<br />\n"; // HTML Zeilenumbruch
 
  
  private $URI = 'https://ssl.truman.de/?cl=truoxiddbdump&fnc=getDBDump&IncTables[]=oxarticles&IncTables[]=oxartextends&FileType=sql&FileName=DbTableDump';
  // private $URI = 'http://www.truman.de/?cl=truoxiddbdump&fnc=getDBDump&IncTables[]=oxactions&FileType=sql&FileName=DbTableDump';
  // private $URI = 'https://ssl.truman.de/?cl=truoxiddbdump&fnc=getDBDump&IncTables[]=oxactions&FileType=sql&FileName=DbTableDump';
  
  // private $URI = 'http://dev17.truman.de.server917-han.de-nserver.de/?cl=truoxiddbdump&fnc=getDBDump&IncTables[]=oxarticles&Date=2013-02-19';
  // private $URI = 'http://dev17.truman.de.server917-han.de-nserver.de/?cl=truoxiddbdump&fnc=getDBDump&IncTables[]=oxactions&Date=2013-02-19';
  private $sql;
  private $TmpPath = "tmp";
  
  public function run() {
    $this->getDbFiles();
    $this->SaveDbFileToTmp();
    $this->ImportDbFileInDb();
  }

  public function getDbFiles() {
   $pass_headers = array(
      'Accept'          => 'HTTP_ACCEPT',
      //'Accept-Charset'  => 'HTTP_ACCEPT_CHARSET',
      //'Accept-Encoding' => 'HTTP_ACCEPT_ENCODING',
      'Accept-Language' => 'HTTP_ACCEPT_LANGUAGE',
      'User-Agent'      => 'HTTP_USER_AGENT',
    );    
    foreach($pass_headers as $header_key => $server_key) {
        $curl_request_headers[] = $header_key.': '.$_SERVER[$server_key];
    }

    // erzeuge einen neuen cURL-Handle
    $ch = curl_init();

    // setze die URL und andere Optionen
    curl_setopt($ch, CURLOPT_URL, $this->URI);
    curl_setopt($ch, CURLOPT_VERBOSE, 1); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_request_headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_PORT , 443); 
    curl_setopt($ch, CURLOPT_USERPWD, self::USER.':'.self::PASSWORT);

    // führe die Aktion aus und gebe die Daten die Variable weiter
    $this->sql = curl_exec($ch);

    // schließe den cURL-Handle und gebe die Systemresourcen frei
    curl_close($ch);
    return $this->sql;
  }
  
  public function SaveDbFileToTmp() {
    $tmpPath = $this->getPath( $this->TmpPath );
    $tmpPath = $this->getValidatePath($tmpPath);
    // echo $tmpPath;
    // die('Welt');
    
    // file container where all texts are to be written
    $this->FileName = $tmpPath.'TransferSQL_'.strftime("%Y-%m-%d_%H-%M-%S", time()).'.sql';
    // open the said file
    $filePointer = fopen($this->FileName,"w+");
    // below is where the log message has been written to a file.
    fputs($filePointer, $this->sql);
    // close the open said file after writing the text
    fclose($filePointer);
    return $this->FileName;
  }
  
  public function ImportDbFileInDb() {
    $sMySql = "{$this->MySQLPath} --user={$this->DbUser} --password={$this->DbPasswort} --host={$this->DbHost} {$this->DbName} < ".$this->FileName; 
    $sSystemOutput = system($sMySql, $MyResult);
    if ($MyResult != 0) {
      echo 'Fehler bei dem Erzeugen des MySqlDumps'.self::HTMLEOL;
      echo "Systemmeldungen: ".$sSystemOutput.self::HTMLEOL;        
      echo 'Import Command: '.$sMySql.self::HTMLEOL;
      // return;
    } else {
      // $this->downloadFile($out, $this->FileName, $this->FileType);
    }

    if(!unlink($this->FileName))
    {
      echo 'Fehler beim Löschen des MySqlDumps';
    }
  }

  
  function getPath($Path) {
    if (empty($Path)) die("Bei dem Aufruf der Funktion getParam() wurde kein Wert übergeben");
    
    // Versuche konischen (absoluten) Pfad zu erzeugen, falls der Pfad nicht existiert wird false zurückgegeben
    $_sPath = realpath($Path);
    
    // Wenn false, dann soll neuer Pfad angelegt werden. Falls das nicht möglich ist wird das Script abgebrochen
    if(!$_sPath)
    {
      if (!mkdir($Path, 0777, true)) die("<b>Fehler:</b> Das Importverzeichniss ".$Path." ist nicht vorhanden und kann nicht angelegt werden.");
      $_sPath = realpath($Path);
    }
    if(substr($Path, 0, 6) == '/home/' AND substr($_sPath, 0 , 6) != '/home/')
    {
      $_sPath = '/home'.$_sPath;
    }
    return $_sPath;
  }
  
  function getValidatePath($Path) {
    //if (substr($Path, 0, 1) == "/")  $Path = substr($Path, 1, strlen($Path));
    if (substr($Path, -1) != "/") $Path = $Path."/";
    return $Path;
  }

}