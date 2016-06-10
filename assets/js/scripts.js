var getFocusTranslate = function( img_placeholder, img ) {
	img_data = img_placeholder.parentNode.dataset;
	if ( ! img_data ) {
		return false;
	}
	var h = img.offsetHeight,
	container_h =  img_placeholder.offsetHeight,
	px_translate = ( img_data.focus_h * h ) - ( container_h / 2 ),
	max_translate = ( ( h - container_h ) / h ) * 100,
	translate = ( px_translate / h ) * 100;

	console.log( 'image height: ' + h );
	console.log( 'focus point on ' + ( img_data.focus_h * h ) );
	console.log( 'container center ' + ( container_h / 2 ) );
	console.log( 'number of pixels to move: ' + px_translate );
	console.log( 'number of percents to move: ' + translate );
	console.log( 'max percent to move: ' + max_translate );
	// If the center of the container is below the focus point, don't move.
	// Or: if the translation is downwards, don't move (we're working from top).
	if ( px_translate < 0 || translate < 0 ) {
		//alert( 'translation smaller than 0' );
		return false;
	}

	if ( translate > max_translate ) {
		return max_translate;
	} else {
		return translate;
	}
};

var doFocusTranslate = function( img ) {
	var img_placeholder = img.parentNode;
	translate = getFocusTranslate( img_placeholder, img );
	// Keep the negative, add minus if necessary
	if ( translate ) {
		var translateNeg = translate > 0 ? -1 * translate : translate,
		transform = 'transform: translateY(' + translateNeg + '%);';
		img.setAttribute( 'style', transform );
	}
};

jQuery(document).foundation();
/*
These functions make sure WordPress
and Foundation play nice together.
*/

jQuery(document).ready(function() {
	var myLazyLoad = new LazyLoad({
		elements_selector: "img.lazy",
		show_while_loading: true,
	    callback_load: function( element ) {
			doFocusTranslate( element );
			//
		}
	});

	var focus_img_containers = document.querySelectorAll('.focus');
	for (var i = 0; i < focus_img_containers.length; i++) {
  		var img_container = focus_img_containers[i];
		img = img_container.getElementsByClassName('image--main')[0];
		if ( ! img.classList.contains( 'lazy' ) ) {
			console.log('no lazy image detected');
			doFocusTranslate( img );
		}
	}

	jQuery('.image--main').each( function() {
		console.log( jQuery(this).height() );
	});

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

	 // Makes sure last grid item floats left
	jQuery('.archive-grid .columns').last().addClass( 'end' );

	// Adds Flex Video to YouTube and Vimeo Embeds
  jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
    if ( jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5 ) {
      jQuery(this).wrap("<div class='widescreen flex-video'/>");
    } else {
      jQuery(this).wrap("<div class='flex-video'/>");
    }
  });

});
