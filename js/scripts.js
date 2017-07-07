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

})(jQuery, this); //Everything after this loads before the page

var map_theme = [{"featureType":"all","elementType":"all","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":-30}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#353535"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#656565"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#505050"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"color":"#808080"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#454545"}]}];

var myMapOptions = {
			zoom: 13,
			mapTypeControl: true,
			scrollwheel: false,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles : map_theme
		};


	function get_map($location, $element){

		var mapcontainer =  $element;
				mapcontainer.css({
						width : '100%',
						height : 370
				})


				geocoder = new google.maps.Geocoder();
				var address = $location;

				var map = new google.maps.Map(mapcontainer.get(0), myMapOptions);



				geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					console.log(results);
					map.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location,
							title: 'PFTU'
					});
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}
				});

	}
