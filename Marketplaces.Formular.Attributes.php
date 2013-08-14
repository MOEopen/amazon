<?php
if (! defined('MOE_AMAZON')) exit;

if ( !empty($_REQUEST['Attribute']) )  $Marketplaces->editAttribute($_REQUEST['Attribute']);

if ( !empty($_REQUEST['ArtKey']) ) {
  $aMasterStruktur = $Marketplaces->struktur->getMasterStruktur();

  $aAttributes = $Marketplaces->getSingleArticleAttributes($_REQUEST['ArtKey']);
  // $Marketplaces->tools->monitor($aAttributes);
  // @$Marketplaces->tools->monitor($_REQUEST['Attribute']);
  // @$Marketplaces->tools->monitor($_REQUEST);
  // $Marketplaces->tools->monitor($Marketplaces);
  // $Marketplaces->tools->monitor($_SERVER);
  // $Marketplaces->tools->monitor($Marketplaces->struktur['aMasterStruktur']['Fields']);
  // $Marketplaces->tools->monitor($Marketplaces->struktur->aMasterStruktur['Fields']);

  echo '<table><tr><td>';

  $sFormAction = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
  echo '<form action="'.$sFormAction.'" method="post">';
  echo '<input type="hidden" name="Attribute[OXID]" value="'.$_REQUEST['ArtKey'].'">';
  echo '<input type="hidden" name="Attribute[OXSHOPID]" value="'.$Marketplaces->OXSHOPID.'">';
  echo '<input type="hidden" name="Attribute[OXLOCATION]" value="'.$Marketplaces->OXLOCATION.'">';
  echo '<input type="hidden" name="Attribute[Subjob]" value="Einfuegen">';
  echo '<input type="hidden" name="Attribute[Value]" value="">';
  echo "<table>";

  echo '<tr>';
  echo '<td class="TableAttributeCol1">';
  echo '<select name="Attribute[Key]" size="1">';
  foreach ( $Marketplaces->struktur->aMasterStruktur['Fields'] AS $Key => $Value ) {
    echo '<option>'.$Key.'</option>';
  }
  echo '</select>';
  echo '</td>';
  echo '<td class="TableAttributeCol2">';
  echo '<input type="submit" value="Neues Attribut anlegen" style="width:150px;">';
  // echo '<input name="Attribute[Value]" type="text">';
  echo '</td>';
  echo '</tr>';
  echo '<tr><td align="right" colspan="2">';
  // echo '<input type="submit" value="Neues Attribut anlegen">';
  echo '</td></tr>';
  echo '</table>';
  echo '</form>';

  echo '</td></tr>';


  if ( !empty($aAttributes) ) {
    foreach ( $aAttributes AS $Key => $Value ) {
      echo '<tr><td>';
      echo '<form action="'.$sFormAction.'" method="post" class="FormAttributes" accept-charset="UTF-8">';
      echo '<input type="hidden" name="Attribute[OXID]" value="'.$_REQUEST['ArtKey'].'">';
      echo '<input type="hidden" name="Attribute[OXSHOPID]" value="'.$Marketplaces->OXSHOPID.'">';
      echo '<input type="hidden" name="Attribute[OXLOCATION]" value="'.$Marketplaces->OXLOCATION.'">';
      echo '<input type="hidden" name="Attribute[TYPE]" value="'.$Key.'">';
      echo '<input type="hidden" name="Attribute[Value]" value="'.$Value.'">';
      echo "<table><tr>";
      
      echo '<td class="TableAttributeCol1">'.$Key.'</td>';
      echo '<td class="TableAttributeCol2">';
      if ( !empty($Value) ) {
        echo '<input name="Attribute[ValueNew]" type="text" value="'.$Value.'">';
      } else {
        // $Marketplaces->tools->monitor($Marketplaces->struktur->aMasterStruktur['Fields'][$Key]);
        if ( !empty($Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['Options']) ) {
          echo '<select name="Attribute[ValueNew]" size="1">';
          foreach ( $Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['Options'] AS $Option ) {
            echo "<option";
            if ( $_REQUEST['Level'] == 1 AND !empty($Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['DefaultParent']) AND $Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['DefaultParent'] == $Option ) echo ' selected';
            if ( $_REQUEST['Level'] >= 2 AND !empty($Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['DefaultChild']) AND $Marketplaces->struktur->aMasterStruktur['Fields'][$Key]['DefaultChild'] == $Option ) echo ' selected';
            echo ">{$Option}</option>";
          }
          echo '</select>';
        } else {
          echo '<input name="Attribute[ValueNew]" type="text" value="'.$Value.'">';
        }
      }
      
      echo '</td>';
      
      // echo '<td class="TableAttributeCol3"><input type="image" src="img/1pixel.png" alt="edit" name="Attribute[Job]" value="edit" class="Icon Save"></td>';
      // echo '<td class="TableAttributeCol4"><input type="image" src="img/1pixel.png" alt="delete" name="Attribute[Job]" value="delete" class="Icon Delete"></td>';
      // echo '<td class="TableAttributeCol3"><input type="image" src="img/b_edit.png" alt="edit" value="edit" name="Subjob"></td>';
      // echo '<td class="TableAttributeCol4"><input type="image" src="img/b_drop.png" alt="delete" name="Attribute[Subjob]" value="delete"></td>';
      echo '<td class="TableAttributeCol3"><input type="submit" name="Attribute[Subjob]" value="Speichern"></td>';
      echo '<td class="TableAttributeCol3"><input type="submit" name="Attribute[Subjob]" value="Loeschen"></td>';
      
      echo "</tr></table>";
      echo '</form>';
      echo '</td></tr>';
    }
  }


  echo '</td></tr></table>';
}
