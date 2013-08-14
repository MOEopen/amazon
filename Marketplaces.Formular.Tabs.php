<div id="TreeBox">
<?php require_once('Marketplaces.Formular.Tree.php'); ?>
</div>

<link rel="stylesheet" href="/amazon/js/jquery.tools/tabs-no-images.css" type="text/css" media="screen" />

<div id="Content">
 
  <ul class="css-tabs">
    <li><a id="t1" href="#tab1">Attribute</a></li>
    <li><a id="t2" href="#tab2">Status</a></li>
    <li><a id="t3" href="#tab3">Einzelner Artikel verknüpfen</a></li>
    <li><a id="t4" href="#tab4">Artikelgrößen aus Oxid holen & verknüpfen</a></li>
  </ul>
  <!-- panes -->
  <div class="css-panes">

    <div>
      <?php require_once('Marketplaces.Formular.Attributes.php'); ?>
    </div>

    <div>
      <?php require_once('Marketplaces.Formular.Status.php'); ?>
    </div>

    <div>
      <?php require_once('Marketplaces.Formular.LinkArticle.php'); ?>
    </div>
    
    <div>
      <?php require_once('Marketplaces.Formular.LinkArticleFormOxid.php'); ?>
    </div>
  </div>

</div>

<script>
  $(function() {
    var CoockieName = 'TabIndex';
    // Index des aktiven Tabs aus Coockie holen
    var ActTab = $.cookie(CoockieName);
    // Inhalt in eine Zahl umwandeln
    ActTab = parseInt(ActTab);
    var mytab = $("#Content ul.css-tabs").tabs(".css-panes > div", { 
      initialIndex: ActTab,
      onClick: function() { $.cookie(CoockieName, this.getIndex()); }
    });
  });
  

</script>