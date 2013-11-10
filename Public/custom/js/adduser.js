define(function(require, exports, module) {
	'use strict';
	var $ = window.$;
	require('./helpers');
	$("#submit").click(function() {
		console.log($.myvalidate("#adduserform", "require"));
		if ($.myvalidate("#adduserform", "require")) {
			var dataarray = $("#adduserform").serializeArray();
			console.log(dataarray);
			$.ajax({
				url:$.siteUrl("Projmgr","adduser"),
				type:'POST',
				dataType:'JSON',
				data:dataarray,
				success:function(data){
					if(data['error']) {
						$.notice("错误",data['error']);
					}else if(data['res']){
						$.notice("成功","用户密码为: "+data['passwd']);
					}
				},
			});
		}
	});
});