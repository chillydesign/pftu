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


        function uniqueArray2(arr) {
            var a = [];
            for (var i=0, l=arr.length; i<l; i++)
                if (a.indexOf(arr[i]) === -1 && arr[i] !== '')
                    a.push(arr[i]);
            return a;
        }

        function choices_arent_numbered_correctly(){
            var $choices_rows = $('#choices_rows');
            var $choices = $('input.choice_number', $choices_rows);
            var $numbers = [];
            for (var i = 0; i < $choices.length; i++) {
                var $choice = $choices[i];
                var $number = parseInt($choice.value, 10);
                if (  $number > 0 ){
                  $numbers.push(  $number  );
                }

            }

            var $unique_numbers = uniqueArray2($numbers);




            console.log( $numbers.length, $choices.length, $unique_numbers.length   );

            return ($numbers.length == $choices.length  &&
                    $unique_numbers.length == $numbers.length      );

        }


        // INSCRIPTION FORM
        var $inscription_submit_button = $('#inscription_submit_button');
        var $inscription_form = $('#inscription_form');
        var $input_first_name = $('#input_first_name');
        var $input_last_name = $('#input_last_name');
        var $input_email = $('#input_email');
        var $form_alert = $('#form_alert').hide();


        if ($inscription_form.length > 0) {

            $inscription_submit_button.prop("disabled", true  );


            // disable form if email, or name is blank
            $('input', $inscription_form).on('keyup change', function(){

                var $carc = choices_arent_numbered_correctly();
                // are all the numbers filled and unique

                if ( $input_first_name.val() == '' ||
                    $input_last_name.val() == '' ||
                    $input_email.val() == '' ||
                    $carc == false
                ) {
                    $inscription_submit_button.prop("disabled", true  );
                    $form_alert.show();
                } else {
                    $inscription_submit_button.prop("disabled", false  );
                    $form_alert.hide();
                }
            });




        }
        // END OF INSCRIPTION FORM




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


        var latlng = $location.split(',');
        if (latlng.length > 1) {
            var latitude = latlng[0];
            var longitude = latlng[1];
            var latlng = new google.maps.LatLng(  latitude , longitude);
            var map = new google.maps.Map(mapcontainer.get(0), myMapOptions);

            map.setCenter(latlng);
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                title: 'PFTU'
            });

        }


        // var geocoder = new google.maps.Geocoder();
        // var address = $location;
        // var map = new google.maps.Map(mapcontainer.get(0), myMapOptions);
        // geocoder.geocode( { 'address': address}, function(results, status) {
        //     if (status == google.maps.GeocoderStatus.OK) {
        //         console.log(results);
        //         map.setCenter(results[0].geometry.location);
        //         var marker = new google.maps.Marker({
        //             map: map,
        //             position: results[0].geometry.location,
        //             title: 'PFTU'
        //         });
        //     } else {
        //         console.log('Geocode was not successful for the following reason: ' + status);
        //     }
        //
        // });

	}
