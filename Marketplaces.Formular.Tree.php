<link rel="stylesheet" href="js/jquery.treeview/jquery.treeview.css" />
<!-- <link rel="stylesheet" href="js/jquery.treeview/demo/screen.css" /> -->


<script type="text/javascript" src="js/jquery.treeview/jquery.treeview.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript">
  $(function() {
    $("#tree").treeview({
      collapsed: true,
      animated: "medium",
      control:"#sidetreecontrol",
      persist: "cookie",
    });
  })
</script>

<?php
// $Marketplaces->tools->monitor($Marketplaces->getAllDbArticle());
$Marketplaces->getHtmlTree($Marketplaces->getAllDbArticle(), 'tree');
