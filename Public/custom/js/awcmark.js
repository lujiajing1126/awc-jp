define(function(require, exports, module) {
	var $ = window.$;
	require('./common2');
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
	$("#markform").on("submit",function(){
		event.preventDefault();
		var data_array = $("#markform").serializeArray();
		if($.validateForm2(data_array)){
			console.log(data_array);
			$.notice('成功','通过验证，正在提交...');
			$.ajax({
				url:$.siteUrl("Awcmark","addAdminScore"),
				cache:false,
				data:data_array,
				type:'POST',
				dataType:'JSON',
				success:function(data){
					if(data['res']==="success"){
						$.notice('成功','评分提交成功！');
						$.refresh(1000);
					}
				}
			});
		}

	});
});