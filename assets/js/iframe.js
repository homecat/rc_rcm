//模拟客户、真实客户iframe自适应高度


$(window.parent.document).find("#iframepage").load(function(){
	
	var main = $(window.parent.document).find("#iframepage");
	
	var thisheight = $(document).height();
	
	main.height(thisheight);
	
});

