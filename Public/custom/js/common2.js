define(function(require, exports, module) {
	'use strict';
	var uptonum = require('./awcmark.json');
	$.validateForm2 = function(data){
		if($.isArray(data)){
			if(data.length <= 100){
				var x;
				// data数组的大小是14
				for(x in data)  {
					if(data[x]['name']!=="pid" && data[x]['name']!=="uid" && data[x]['name']!=="aid"){
					if(parseInt(data[x]['value']) == null||data[x]['value'] == ""){
						$.notice('Error!','请填写 '+uptonum[data[x]['name']]["name"]);
						return false;
					}
					if(parseInt(data[x]['value']) > uptonum[data[x]['name']]["value"]||parseInt(data[x]['value']) < 0){
						$.notice('Error!',"\""+uptonum[data[x]['name']]["name"]+'\" 分值范围错误');
						return false;
					}
				}
				}
				return true;
			}
		}else {
			alert("传入参数不是数组");
		}
	};

});