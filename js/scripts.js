(function ($, root, undefined) {

	$(function () {

		'use strict';

		var $window  = $(window);


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




		var $slide_count = Math.floor( $window.width() / 260  );
		$('#partners_slider').bxSlider({
			minSlides: $slide_count,
			maxSlides: $slide_count,
			slideWidth: 260,
			slideMargin: 10,
			auto: true,
			controls: true,
			autoControls: false,
			pager: false
		});


		$('#news_slider').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			auto: false,
			controls: true,
			autoControls: false,
			pager: false
		});

        var $read_more_partages = $('.read_more_partage');
        var $long_descs = $('.long_desc');
        var $short_descs = $('.short_desc');
        $long_descs.hide();
        $short_descs.show();
        $read_more_partages.on('click', function(e){
            e.preventDefault();
            var $this = $(this);
            $this.parent().hide();
            var $long = $this.data('long');
            $($long).show();

            doMatchHeights();
        })




        doMatchHeights();

        function doMatchHeights() {
            $('.section_two_thirds_one_third').each(function(){
    			$(this).find('.thirdscol').matchHeight();
    		})
        }



	});

})(jQuery, this);
