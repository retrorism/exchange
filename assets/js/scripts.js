jQuery(document).foundation();
/*
These functions make sure WordPress
and Foundation play nice together.
*/

/**
 * This function returns the percentage that a header image needs to be translated upwards
 * when the focus-point is not centered in it's container.
 *
 * @TODO : only do this when the header image crop size is *not* available.
 *
 */
var getFocusTranslate = function( header_img_container ) {
	header_img = header_img_container.childNodes[1],
	header_img_data = header_img_container.dataset;
	if ( ! header_img_data ) {
		return false;
	}
	var h = header_img.offsetHeight,
	container_h =  header_img_container.offsetHeight,
	px_translate = ( header_img_data.focus_h * h ) - ( container_h / 2 ),
	max_translate = ( ( container_h / 2 ) / h ) * 100,
	translate = ( px_translate / h ) * 100;
	// If the center of the container is below the focus point, don't move.
	// Or: if the translation is downwards, don't move (we're working from top).
	if ( px_translate < 0 || translate < 0 ) {
		console.log( px_translate );
		return false;
	}
	// console.log( 'image height: ' + h );
	// console.log( 'container center ' + ( container_h / 2 ) );
	// console.log( 'focus point on ' + ( header_img_data.focus_h * h ) );
	// console.log( 'number of pixels to move: ' + px_translate );
	// console.log( 'number of percents to move: ' + translate );
	// console.log( 'max percent to move: ' + max_translate );
	if ( translate > max_translate ) {
		return max_translate;
	} else {
		return translate;
	}
}

jQuery(document).ready(function() {

	var header_img_container = document.querySelector('.story__header__image'),
	header_img = header_img_container.childNodes[1],
	translate = getFocusTranslate( header_img_container );
	if ( translate ) {
		header_img.setAttribute( 'style', 'transform: translateY(-' + translate + '%');
	}


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
