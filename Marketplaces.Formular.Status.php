<?php
if (! defined('MOE_AMAZON')) exit;

if ( !empty($_REQUEST['Status']) AND $_REQUEST['Subjob'] == 'StatusSave')  $Marketplaces->editStatus($_REQUEST['Status']);

if ( !empty($_REQUEST['ArtKey']) ) {

  $sLinkStatus       = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?Job=Edit&ArtKey='.$_REQUEST['ArtKey'].'&Level='.$_REQUEST['Level'];
  $sLinkStatusChange = '&Subjob=StatusChange';
  $sLinkStatusSave   = '&Subjob=StatusSave';
  $sLinkStatusInsert = '&Subjob=StatusInsert';
  // $Marketplaces->tools->monitor($_REQUEST);
  // $Marketplaces->tools->monitor($GLOBALS);

    $aArticleStatus = $Marketplaces->getArticleStatus($_REQUEST['ArtKey']);
    // $Marketplaces->tools->monitor($aArticleStatus[$_REQUEST['ArtKey']]);

    echo '<form action="'.$sLinkStatus.$sLinkStatusSave.'" method="post">';
    echo '<input type="hidden" name="Status[OrgOXID]" value="'.$_REQUEST['ArtKey'].'">';
    echo "<table>";
    foreach ( $aArticleStatus[$_REQUEST['ArtKey']] AS $sStatusKey => $sStatusValue ) {
      if ( $sStatusKey != 'OXID' AND $sStatusKey != 'PARENTID' ) {
        echo "<tr>";
        echo "<td>";
        echo $sStatusKey;
        echo "</td>";
        echo "<td>";
        echo '<input name="Status['.$sStatusKey.']" type="text" value="'.$sStatusValue.'">';
        echo "</td>";
        echo "</tr>";
      }
    }
    echo '<tr>';
    echo '<td>';
    if ($_REQUEST['Level'] == 2) echo '<input type="checkbox" name="Status[Vererbung]" value="true">Auch Größen ändern<br>';
    echo '</td>';
    echo '<td align="right"><input type="submit" name="Status[Subjob]" value="StatusSave"></td>';
    echo '</tr>'; 
    echo "</table>";
    echo "</form>";
    
}