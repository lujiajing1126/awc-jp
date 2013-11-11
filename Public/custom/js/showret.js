define(function(require, exports, module) {
	'use strict';
	require('./helpers');
	$("#chpro").click(function(){
		window.location = $.siteUrl("Projmgr","showresult",$("#selectpro").select2("val"));
	});
});