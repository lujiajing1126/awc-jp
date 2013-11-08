define(function(require, exports, module) {
	'use strict';
	require("./helpers");
	$("#submit").click(function(){
		alert("!!!");
		var dataarray = $("form#addsch").serializeArray(),
		data = $("form#addsch").serialize();
		console.log(dataarray);
		$.ajax({
			url:$.siteUrl("Projmgr","addschedule"),
			data:dataarray,
			type:'POST',
			dataType:'JSON',
			success:function(data){
				console.log(data);
				if(data['res']=="success"){
					$.notice('成功','成功添加计划表');
					$.refresh(10000);
				}else if(data['error']){
					$.notice('错误',data['error']);
				}
			},
		});
	});
});