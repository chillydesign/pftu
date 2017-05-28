(function ($, root, undefined) {

	$(function () {

		'use strict';


				var $search_opener = $('#search_opener');
				var $search_form = $('#search_form');
				var $close_search_form = $('#close_search_form');
				$search_opener.on('click', function(){
					$search_form.addClass('search_form_visible');
				});
				$close_search_form.on('click', function(){
					$search_form.removeClass('search_form_visible');
				});




				var $navigation_menu = $('#navigation_menu');
				var $menu_button = $('#menu_button');

				$menu_button.on('click', function(){

					$navigation_menu.toggleClass('menu_visible');

				});

				// if press escape key, hide menu
				$(document).on('keydown', function(e){

					if(e.keyCode == 27 ){
						$navigation_menu.removeClass('menu_visible');

						$search_form.removeClass('search_form_visible');


					}

				})


	});

})(jQuery, this);
