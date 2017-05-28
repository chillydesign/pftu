(function ($, root, undefined) {

	$(function () {

		'use strict';


		// SEARCH BOX
		var $search_opener = $('#search_opener');
		var $search_form = $('#search_form');
		var $close_search_form = $('#close_search_form');
		$search_opener.on('click', function(){
			$search_form.addClass('search_form_visible');
		});
		$close_search_form.on('click', function(){
			$search_form.removeClass('search_form_visible');
		});



		//NAVIGATION ON MOBILE
		var $nav_ul = $('#nav ul');
		var $mobile_nav_button = $('#mobile_nav_button');

		$mobile_nav_button.on('click', function(){

			$nav_ul.toggleClass('menu_visible');

		});

		// if press escape key, hide menu or hide search box
		$(document).on('keydown', function(e){

			if(e.keyCode == 27 ){
				$nav_ul.removeClass('menu_visible');
				$search_form.removeClass('search_form_visible');
			}

		})



		$('#partners_slider').bxSlider({
			minSlides: 3,
			maxSlides: 5,
			slideWidth: 300,
			slideMargin: 10,
			auto: true,
			controls: true,
			autoControls: false,
			pager: false
		});





	});

})(jQuery, this);
