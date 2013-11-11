define(function(require, exports, module) {
	'use strict';
	var uptonum = new Array();
	uptonum["dxtshd"] = new Array(),
	uptonum["xxhd"] = new Array(),
	uptonum["cghd"] = new Array(),
	uptonum["njsc"] = new Array(),
	uptonum["cxda"] = new Array(),
	uptonum["cwcwfzr"] = new Array(),
	uptonum["cwcwfb"] = new Array(),
	uptonum["njsczm"] = new Array(),
	uptonum["wlxxh"] = new Array(),
	uptonum["szdh"] = new Array(),
	uptonum["szsl"] = new Array();
	uptonum["qtbmhz"] = new Array();
	uptonum["tshdcg"] = new Array();
	uptonum["pjdbh"] = new Array();
	uptonum["qxdy"] = new Array();
	uptonum["fgbmpf"] = new Array();
	uptonum["szpf"] = new Array();
	uptonum["dxtshd"]["name"]="大型、特色活动";
	uptonum["dxtshd"]["value"]=15;
	uptonum["xxhd"]["name"]="小型活动";
	uptonum["xxhd"]["value"]=15;
	uptonum["cghd"]["name"]="常规活动";
	uptonum["cghd"]["value"]=15;
	uptonum["njsc"]["name"]="年鉴手册";
	uptonum["njsc"]["value"]=10;
	uptonum["cxda"]["name"]="诚信档案";
	uptonum["cxda"]["value"]=10;
	uptonum["cwcwfzr"]["name"]="社团财务场务负责人设置及制度评分";
	uptonum["cwcwfzr"]["value"]=10;
	uptonum["cwcwfb"]["name"]="社团部财务场务副部评分";
	uptonum["cwcwfb"]["value"]=10;
	uptonum["njsczm"]["name"]="社团年鉴手册账目评分";
	uptonum["njsczm"]["value"]=10;
	uptonum["wlxxh"]["name"]="社团网络信息化建设或社团之家网上平台建设";
	uptonum["wlxxh"]["value"]=5;
	uptonum["szdh"]["name"]="社长大会";
	uptonum["szdh"]["value"]=2;
	uptonum["szsl"]["name"]="社长沙龙";
	uptonum["szsl"]["value"]=2;
	uptonum["qtbmhz"]["name"]="以及与其他部门合作情况";
	uptonum["qtbmhz"]["value"]=1;
	uptonum["tshdcg"]["name"]="社团特色活动成果";
	uptonum["tshdcg"]["value"]=10;
	uptonum["pjdbh"]["name"]="社团评精答辩会";
	uptonum["pjdbh"]["value"]=30;
	uptonum["qxdy"]["name"]="全校调研";
	uptonum["qxdy"]["value"]=10;
	uptonum["fgbmpf"]["name"]="分管部门评分";
	uptonum["fgbmpf"]["value"]=10;
	uptonum["szpf"]["name"]="社长评分";
	uptonum["szpf"]["value"]=5;
	$.validateForm2 = function(data){
		if($.isArray(data)){
			if(data.length <= 100){
				var x;
				// data数组的大小是14
				for(x in data)  {
					if(data[x]['name']!=="pid" && data[x]['name']!=="uid" && data[x]['name']!=="aid"){
					if(parseInt(data[x]['value']) == null||data[x]['value'] == ""||parseInt(data[x]['value']) == ""){
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