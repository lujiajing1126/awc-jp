define(function(require, exports, module) {
	'use strict';
	require('./helpers');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Projmgr","showresult",$("#selectpro").select2("val"));
	});
	$(document).on("click.export","#export",function(){
		var $pid = $("#curr_pid").val();
		if($pid !== null || $pid!== ""){
			window.location = $.siteUrl("Api","exportfile","pid/"+$pid);
		}else{
			alert("请重试！");
		}
	});
});