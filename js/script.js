// JavaScript Document
$(document).ready(function(){
	$("#rateit").bind('over', function(event, value){
		$(this).attr('title', value);
	});
});