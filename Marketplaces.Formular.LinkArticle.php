<?php
if (! defined('MOE_AMAZON')) exit;

if ( !empty($_REQUEST['Status']) AND $_REQUEST['Subjob'] == 'StatusInsertSave')  $Marketplaces->editStatus($_REQUEST['Status']);

if ( !empty($_REQUEST['ArtKey']) ) {

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
      if ( $aStatusValue['Field'] != 'PARENTID' ) {
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
    echo '<input type="hidden" name="Subjob" value="StatusInsertSave">';
    echo '<input type="submit" name="Status[Subjob]" value="StatusInsertSave">'; 
    echo "</form>";

} else {
  $sLinkStatus       = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?Job=Edit';
  $sLinkStatusInsert = '&Subjob=StatusInsert';
  // $Marketplaces->tools->monitor($_REQUEST);

    echo '<form action="'.$sLinkStatus.$sLinkStatusInsert.'" method="post">';
    echo "<table>";
    foreach ( $Marketplaces->DB->getFieldsFromTable($Marketplaces->Tbl_Article_Status) AS $aStatusValue) {
      echo "<tr>";
      echo "<td>";
      echo $aStatusValue['Field'];
      echo "</td>";
      echo "<td>";
      echo '<input name="Status['.$aStatusValue['Field'].']" type="text" value="">';
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo '<input type="hidden" name="Subjob" value="StatusInsertSave">';
    echo '<input type="submit" name="Status[Subjob]" value="StatusInsertSave">'; 
    echo "</form>";

}

echo "Hier können einzelne untergeordnete Elemente erzeugt werden. Nur sinnvoll auf Modell und Artikelebene.<br>\n";