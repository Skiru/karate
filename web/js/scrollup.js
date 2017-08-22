jQuery(function($){
	//zresetuj scrolla
	$.scrollTo(0);
	$('#link1').click(function(){$.scrollTo($('#zapisy'),1000);});
	$('.scrollup').click(function(){$.scrollTo($('body'),1000);});
});
//POKAŻ PODCZAS PRZEIWJANIA
$(window).scroll(function(){
	if($(this).scrollTop()>500) $('.scrollup').fadeIn();
	else $('.scrollup').fadeOut();
});


$(document).ready(function(e){
	$('.has-sub').click(function(){
		$(this).toggleClass('tap');
	});
});
  