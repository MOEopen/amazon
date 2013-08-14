<?php
if (! defined('MOE_AMAZON')) exit;

if ( !empty($_REQUEST['Status']) AND $_REQUEST['Subjob'] == 'StatusInsertSaveFormOxid')  $Marketplaces->editStatus($_REQUEST['Status']);

if ( !empty($_REQUEST['ArtKey']) AND $_REQUEST['Level'] == 2 ) {

  $sLinkStatus       = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?Job=Edit&ArtKey='.$_REQUEST['ArtKey'].'&Level='.$_REQUEST['Level'];
  $sLinkStatusChange = '&Subjob=StatusChange';
  $sLinkStatusSave   = '&Subjob=StatusSave';
  $sLinkStatusInsert = '&Subjob=StatusInsert';
  // $Marketplaces->tools->monitor($_REQUEST);
  // $Marketplaces->tools->monitor();

    echo '<form action="'.$sLinkStatus.$sLinkStatusInsert.'" method="post">';
    echo '<input type="hidden" name="Status[PARENTID]" value="'.$_REQUEST['ArtKey'].'">';
    echo "<table>";
    foreach ( $Marketplaces->DB->getFieldsFromTable($Marketplaces->Tbl_Article_Status) AS $aStatusValue) {
      if ( $aStatusValue['Field'] != 'PARENTID' AND $aStatusValue['Field'] != 'OXID' AND $aStatusValue['Field'] != 'COPYFROM' AND $aStatusValue['Field'] != 'ALIAS') {
        echo "<tr>";
        echo "<td>";
        echo $aStatusValue['Field'];
        echo "</td>";
        echo "<td>";
        echo '<input name="Status['.$aStatusValue['Field'].']" type="text" value="">';
        echo "</td>";
        echo "</tr>";
      }
    }
    echo "</table>";
    echo '<input type="hidden" name="Subjob" value="StatusInsertSaveFormOxid">';
    echo '<input type="submit" name="Status[Subjob]" value="StatusInsertSaveFormOxid">'; 
    echo "</form>";

} else {
  echo "Die Funktion steht nur auf Farbebene zur Verfügung.<br>\n";
}

echo "Holt auf Farbebene die untergordneten Größen und verlinkt diese zum Bearbeiten.<br>\n";
