define(function(require, exports, module) {
	'use strict';
	var uptonum = new Array();
	uptonum["cwgl"] = new Array(),
	uptonum["zzgj"] = new Array(),
	uptonum["zdlscy"] = new Array(),
	uptonum["stqlpg"] = new Array(),
	uptonum["xxhjs"] = new Array(),
	uptonum["yzzqhd"] = new Array(),
	uptonum["hdyxl"] = new Array(),
	uptonum["hdwczl"] = new Array(),
	uptonum["hdcg"] = new Array(),
	uptonum["xnjl"] = new Array(),
	uptonum["xwjl"] = new Array();
	uptonum["cwgl"]["name"]="财务管理";
	uptonum["cwgl"]["value"]=15;
	uptonum["zzgj"]["name"]="组织架构";
	uptonum["zzgj"]["value"]=5;
	uptonum["zdlscy"]["name"]="指导老师参与";
	uptonum["zdlscy"]["value"]=5;
	uptonum["stqlpg"]["name"]="社团潜力评估";
	uptonum["stqlpg"]["value"]=5;
	uptonum["xxhjs"]["name"]="信息化建设";
	uptonum["xxhjs"]["value"]=5;
	uptonum["yzzqhd"]["name"]="与宗旨契合度";
	uptonum["yzzqhd"]["value"]=5;
	uptonum["hdyxl"]["name"]="活动影响力";
	uptonum["hdyxl"]["value"]=15;
	uptonum["hdwczl"]["name"]="活动完成质量";
	uptonum["hdwczl"]["value"]=15;
	uptonum["hdcg"]["name"]="活动成果";
	uptonum["hdcg"]["value"]=15;
	uptonum["xnjl"]["name"]="社团与校内社团、组织交流合作情况";
	uptonum["xnjl"]["value"]=10;
	uptonum["xwjl"]["name"]="社团与校外社团、组织交流合作情况及影响力";
	uptonum["xwjl"]["value"]=5;
	$.siteUrl = function(mod,act,param){
		return "http://"+location.host+"/awc-jp/index.php/"+mod+"/"+act+"/"+param;
	};
	$.validateForm1 = function(data){
		if($.isArray(data)){
			if(data.length <= 11){
				var x;
				//data数组的大小是11
				for(x in data)  {
					if(parseInt(data[x]['value']) == null||data[x]['value'] == ""||parseInt(data[x]['value']) == ""){
						$.gritter.add({
							// (string | mandatory) the heading of the notification
							title: 'Error!',
							// (string | mandatory) the text inside the notification
							text: '请填写 '+uptonum[data[x]['name']]["name"],
						});
						return false;
					}
					if(parseInt(data[x]['value']) > uptonum[data[x]['name']]["value"]||parseInt(data[x]['value']) < 0){
						$.gritter.add({
							// (string | mandatory) the heading of the notification
							title: 'Error!',
							// (string | mandatory) the text inside the notification
							text: "\""+uptonum[data[x]['name']]["name"]+'\" 分值范围错误，请检查后重新输入！'
						});
						return false;
					}
				}
				return true;
			}
		}else {
			alert("传入参数不是数组");
		}
	};
});