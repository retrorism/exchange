/*
These functions make sure WordPress
and Foundation play nice together.
*/

jQuery(document).ready(function() {

	var focus_img_containers = document.querySelectorAll('.focus');
	for ( var i = 0; i < focus_img_containers.length; i++ ) {
  		var img_container = focus_img_containers[i];
		img = img_container.getElementsByClassName('image--main')[0];
		if ( ! img.classList.contains( 'lazy' ) ) {
			//console.log('no lazy image detected');
			doFocusTranslate( img );
		}
	}

	var floated_elements = document.querySelectorAll('.floated');
	for (var ii = 0; ii < floated_elements.length; ii++ ) {
		var equal_element = floated_elements[ii].nextElementSibling,
		h = floated_elements[ii].offsetHeight,
		equal_h = equal_element.offsetHeight;
		// console.log( floated_elements[ii] );
		// console.log( equal_element );
		// console.log( 'neighbour: ' + equal_h + ' px');
		if ( h > equal_h ) {
			equal_element.style.height = h + 'px';
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
