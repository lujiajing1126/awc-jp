define(function(require, exports, module) {
	var $ = window.$;
	require('./helpers');
	$("#submit").click(function() {
		if ($.myvalidate("#newproject", "require") !== false) {
			var arraydate = $("#newproject").serializeArray();
			console.log(arraydate);
			$.ajax({
				url : $.siteUrl("Projmgr", "addproject"),
				data : arraydate,
				type : 'POST',
				dataType : 'JSON',
				success : function(data) {
					if (data['error']) {
						$.notice('错误', data['error']);
					} else if (data['res']) {
						$.notice('成功', data['res']);
					} else {
						alert("返回数据类型错误！");
					}
				}
			});
		}
	});
});