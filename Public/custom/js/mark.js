define(function(require, exports, module) {
	var $ = window.$;
	require('./common.js');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Mark","index",$("#selectpro").select2("val"));
	});
	$(document).on("click.mark",'[data-toggle="modal"]',function(){
		$this = $(this);
		var pid = $("p#pid").html(),uid = $("p#uid").html(),
		aid=$this.parent().parent().find(".awcaid").html(),
		aname=$this.parent().parent().find(".awcname").html();
		$.getJSON($.siteUrl("Mark","getScore",pid+"/"+aid),function(data){
			if(data!==null){
				alert("您已经评过分");
			}else{
				$("h3#assnname").html(aname);
				$('#myModal').modal();
			}
		});
	});
	$("#markform").on("submit",function(){
		event.preventDefault();
		var data_array = $("#markform").serializeArray();
		if($.validateForm1(data_array)){
			console.log(data_array);
			var data = $("#markform").serialize();
			console.log(data);
			alert("通过验证，正在提交...");
		}

	});
});
