<?php
if (! defined('MOE_AMAZON')) exit;

$aMasterStruktur = $Marketplaces->struktur->getMasterStruktur();

if ( !empty($_REQUEST['Attribute']) )  $Marketplaces->editAttribute($_REQUEST['Attribute']);
if ( !empty($_REQUEST['Status']) AND $_REQUEST['Subjob'] == 'StatusSave')  $Marketplaces->editStatus($_REQUEST['Status']);
if ( !empty($_REQUEST['Status']) AND $_REQUEST['Subjob'] == 'StatusInsertSave')  $Marketplaces->editStatus($_REQUEST['Status']);


// echo '<div id="TreeBox2">';
// require_once('Marketplaces.Formular.Tree2.php');
// echo "</div>";


echo '<div id="TreeBox">';
require_once('Marketplaces.Formular.Tree.php');
echo "</div>";

// $Marketplaces->tools->monitor($Marketplaces);

if ( !empty($_REQUEST['ArtKey']) ) {
  echo '<div id="StatusBox">';
  require_once('Marketplaces.Formular.Status.php');
  echo "</div>";
  
  echo '<div id="AttributesBox">';
  require_once('Marketplaces.Formular.Attributes.php');
  echo "</div>";
}

