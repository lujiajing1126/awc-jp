define(function(require, exports, module) {
	'use strict';
	$.siteUrl = function(mod,act,param){
		return "http://"+location.host+"/awc-jp/index.php/"+mod+"/"+act+"/"+param;
	};
});