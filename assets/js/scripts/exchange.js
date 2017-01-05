var getFocusTranslate = function( img_placeholder, img ) {
	img_data = img_placeholder.parentNode.dataset;
	if ( ! img_data ) {
		return false;
	}
	console.log( img );
	console.log( img_placeholder );
	var h = img.clientHeight,
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
	//If the center of the container is below the focus point, don't move.
	//Or: if the translation is downwards, don't move (we're working from top).
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
