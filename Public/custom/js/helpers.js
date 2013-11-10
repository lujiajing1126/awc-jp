define(function(require, exports, module) {
	'use strict';
	$.notice = function(title, msg) {
		if ($.gritter) {
			$.gritter.add({
				title : title,
				text : msg,
			});
		}else {
			alert(title+" : "+msg);
		}
	};
	$.refresh = function(sec) {
		sec = sec || '0';
		setTimeout(function(){window.location = window.location;}, sec);
	};
	$.siteUrl = function(mod, act, param) {
		if (typeof param === "undefined" || param === null || param === "") {
			return "http://" + location.host + "/awc-jp/index.php/" + mod + "/"
					+ act;
		}
		return "http://" + location.host + "/awc-jp/index.php/" + mod + "/"
				+ act + "/" + param;
	};
	$.myvalidate = function(selector,rule){
		var errorflg = 0;
		if(rule === "require"){
			$(selector).find(".require").each(function(){
				var $this = $(this);
				if($this.val() == null || $this.val() == ""){
					$.notice("错误","请完整填写表单");
					errorflg = 1;
					return false;
				}
			});
			if(errorflg === 0)
				return true;
		}
	};
});