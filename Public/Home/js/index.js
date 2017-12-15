$("#webBody li a").on("mouseover", function(){
	$(this).animate({left:"5px"}, "fast");
});

$("#webBody li a").on("mouseout", function(){
	$(this).animate({left:"0"}, 300);
});
function resize(){
	//当内容部分的高度不足撑开页面时，给足高度
	var secondBody = $("#secondBody");
	var windowHeight = $(window).height()*0.8;
	if( secondBody.height() < windowHeight ){
		secondBody.height(windowHeight);
	}
}
	
$(window).on('resize',resize).trigger('resize');