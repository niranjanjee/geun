$(document).ready(function(){
	$("a.delete-action").click(function(){
		var confm = confirm("Do you want to delete?");
		if(confm)
		{
			window.location.href = $.trim($(this).attr("rel"));
		}
	});
	$("a.change-status").click(function(){
		var confm = confirm("Do you want to change status?");
		if(confm)
		{
			window.location.href = $.trim($(this).attr("rel"));
		}
	});
});