define(function(require, exports, module) {
	'use strict';
	require('./helpers');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Projmgr","showrec",$("#selectpro").select2("val"));
	});
	$(document).on('click.remove',".awc-del",function(){
		var $this = $(this);
		var $rid = $this.parent().parent().find(".pwid").html();
		if(confirm("是否确认删除第"+$rid+"号记录！？"))  {
			$.ajax({
				url:$.siteUrl("Projmgr","delrec"),
				type:'POST',
				data:'rid='+$rid,
				dataType:'json',
				success:function(data){
					if(data['res'])  {
						$.notice("成功","已删除记录！");
					}else  {
						$.notice("失败","请检查该记录是否存在！");
					}
				},
			});
		}
	})
});