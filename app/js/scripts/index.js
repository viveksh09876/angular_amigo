 $(document).ready(function () {
	 "use strict";
	$('.img_container .box').hover(function(){
		$(this).toggleClass('active');	
	});
	
	$('.toggle').click(function(){
		
		$('.left_container').toggleClass("more");	
		$('.right_container').toggleClass("less");	
	});
	$('.overlay').click(function(){
		$('.left_container').removeClass("more");	
		$('.right_container').removeClass("less");	
	});
	
	$('.overlay, .toggle').click(function(){
		$('.head-sec').toggleClass('sort');
	});
	
	//$('.categorybox input:radio').jqTransRadio();
	
	
	/*$(function($){
		var $container = $('.img_container');
		
		$container.imagesLoaded(function(){
			$container.masonry({
			itemSelector: '.img_container .box',
			columnWidth: 10,
			isAnimated:true,
			animationOptions: {
			duration: 500,
			easing:'linear',
			queue :false
			}
			});
		});	
		});*/

	});
