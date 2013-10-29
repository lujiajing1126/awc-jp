define(function(require, exports, module) {
	var $ = window.$;
	require('./common.js');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Mark","index",$("#selectpro").select2("val"));
	});
	$(document).on("click.mark",'[data-toggle="modal"]',function(){
		$this = $(this);
		var pid = $("p#pid").html(),uid = $("p#uid").html(),
		aid=$this.parent().parent().find(".awcaid").html();
		$.getJSON($.siteUrl("Mark","getScore",pid+"/"+aid),function(data){
			if(data!==null){
				alert("您已经评过分");
			}else{
				$('#myModal').modal();
			}
		});
	});
});