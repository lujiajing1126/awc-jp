define(function(require, exports, module) {
	'use strict';
	var $ = window.$;
	require('./helpers');
	$("#submit").click(function() {
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
						$.refresh(2000);
					}
				},
			});
		}
	});
	$(document).on("click.chgpasswd",".chgpwd",function(){
		var $this = $(this),$uid = $this.parent().parent().find(".userid").html();
		$('#myModal2 #username').val($uid);
		$('#myModal2 #uid').val($uid);
		$('#myModal2').modal('show');
	});
	$("#submit2").click(function() {
		if ($.myvalidate("#chpasswdform", "require")) {
			var dataarray = $("#chpasswdform").serializeArray();
			console.log(dataarray);
			$.ajax({
				url:$.siteUrl("Projmgr","chuser"),
				type:'POST',
				dataType:'JSON',
				data:dataarray,
				success:function(data){
					console.log(data);
					if(data['error']) {
						$.notice("错误",data['error']);
					}else if(data['passwd'] && data['res']){
						$.notice("成功","用户密码为: "+data['passwd']);
						if(data['redirect']==1){
							$.refresh(2000,$.siteUrl("Auth","logout"));
						}else{
							$.refresh(2000);
						}
					}else  {
						$.notice("成功","用户角色修改成功！");
						$.refresh(1500);
					}
				},
			});
		}
	});
});