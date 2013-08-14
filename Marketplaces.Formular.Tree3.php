<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://static.jstree.com/v.1.0pre/jquery.cookie.js"></script>
<script type="text/javascript" src="http://static.jstree.com/v.1.0pre/jquery.hotkeys.js"></script>
<script type="text/javascript" src="js/jquery.jstree/jquery.jstree.js"></script>


<div id="demo2" class="demo"></div>
<script type="text/javascript" class="source">
$(function () {
	$("#demo2").jstree({ 
		"json_data" : {
			"ajax" : {
				"url" : "js/jquery.jstree/_json_data.json",
				"data" : function (n) { 
					return { id : n.attr ? n.attr("id") : 0 }; 
				}
			}
		},
		"plugins" : [ "themes", "json_data" ]
	});
});
</script>