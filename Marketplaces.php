<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title></title>
<style type="text/css">
<!--
#TreeBox       { float:left; width:175px; margin:10px 0 0 0;}
#Content       { float:left; margin:10px 0 0 20px; }
#AttributesBox { float:left; margin:20px; }
span.FieldNames { display:inline-block; width:200px; }
.TableAttributeCol1 { width:250px; }
.TableAttributeCol2 { width:500px; }
.TableAttributeCol2 input { width:500px; }
.FormAttributes { margin-bottom:0; }
#tree a { padding:1px 1px 1px 4px; display: block; font-size: 15px;}
#tree a.Level-1 { width: 152px; }
#tree a.Level-2 { width: 136px; }
#tree a.Level-3 { width: 120px; }
#tree a.STATUS-2 { background-color:#E0E0E0; }
#tree a.hover   { background-color: yellow; }
#tree a.Aktiv  { background-color: red; }
input.Icon { width: 20px; height: 20px; text-decoration: none; display: block; background-repeat:no-repeat; background: url('img/diagona.png'); }
input.Delete { background-position: -18px -258px; }
input.Save   { background-position: -246px -232px; }

-->
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
  </head>
  <body>
    <div style="margin-bottom:10px;">
      <a href="Marketplaces.php?Job=Export" style="border:1px solid black; padding:5px 20px; margin-right:20px; background-color:#E0E0E0;">Daten exportieren</a>
      <a href="Marketplaces.php?Job=Edit" style="border:1px solid black; padding:5px 20px; margin-right:20px; background-color:#E0E0E0;">Daten bearbeiten</a>
      <a href="Marketplaces.php?Job=DelCache" style="border:1px solid black; padding:5px 20px; margin-right:20px; background-color:#E0E0E0;">Cache l&ouml;schen</a>
      <a href="Marketplaces.php?Job=TransDb" style="border:1px solid black; padding:5px 20px; margin-right:20px; background-color:#E0E0E0;">Transfer Db</a>
    </div>
    <?php
      define('MOE_AMAZON', true);
      ini_set("display_errors",true);
      ini_set("error_reporting",E_ALL);
      $EOL = "<br />\n";
      
      require_once('Marketplaces.class.php');
      $Marketplaces = new tru_Marketplaces();
      
      if( !empty($_REQUEST['Job'] )) {
        $sJob = $_REQUEST['Job'];
      } else {
        $sJob = '';
      }
      switch ($sJob) {
        case 'Export':
          $Marketplaces->Export();

          // $Marketplaces->tools->monitor($Marketplaces->struktur->getMasterStruktur());
          // $Marketplaces->tools->monitor($Marketplaces->aAllProducts);
          // echo "<pre>";
          // echo $Marketplaces->CsvOutput;
          // echo "</pre>";
          if (!empty($Marketplaces->Filename)) {
            echo "<a href=\"{$Marketplaces->Filename}\">Download</a>";
          }
          break;
        case 'Edit':
          require_once('Marketplaces.Formular.Tabs.php');
          break;
        case 'Status':
          
          break;
        case 'DelCache':
          $Marketplaces->DeleteTmp->printOptions();
          if ( !empty($_GET['w']) ) echo $Marketplaces->DeleteTmp->clearCache($_GET['w']);
          // require_once('deleteTmp.php');
          break;
        case 'TransDb':
          require_once('Marketplaces.TransferDb.php');
          $import = new tru_Import;
          $import->run();
          echo "Transfer Ende";
          break;
      }
      
    ?>
  </body>
</html>