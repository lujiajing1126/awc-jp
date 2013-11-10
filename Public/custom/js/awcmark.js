define(function(require, exports, module) {
	var $ = window.$;
	require('./common');
	require('./helpers');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Awcmark","index",$("#selectpro").select2("val"));
	});
	$(document).on("click.mark",'[data-toggle="modal"]',function(){
		$this = $(this);
		var pid = $("input#pid").val(),uid = $("input#uid").val(),
		aid=$this.parent().parent().find(".awcaid").html(),
		aname=$this.parent().parent().find(".awcname").html();
		$.getJSON($.siteUrl("Awcmark","getScore",aid),function(data){
			if(data!==null){
				$.notice('错误','您已经评过该社团');
			}else{
				$("h3#assnname").html(aname);
				$('#myModal').modal();
				$('#aid').val(aid);
			}
		});
	});
});