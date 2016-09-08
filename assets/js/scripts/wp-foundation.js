/*
These functions make sure WordPress
and Foundation play nice together.
*/
function handleScroll() {
	var previousScroll = pageYOffset;
	jQuery(window).scroll(function(){
		var currentScroll = jQuery(this).scrollTop();
		if (currentScroll > previousScroll){
			//console.log('down');
		} else {
			//console.log('up');
		}
		previousScroll = currentScroll;
		if ( pageYOffset < 100 ) {
			//console.log( 'hiding' );
			jQuery('.breadcrumbs-bar').removeClass('scrolled');
		} else {
			//console.log( 'showing' );
			jQuery('.breadcrumbs-bar').addClass('scrolled');
		}

	});
}

jQuery(document).ready(function() {

	// jQuery(document).on('open.zf.reveal', function() {
	// 	jQuery(document).foundation('orbit', 'reflow');
	// });

	var focus_img_containers = document.querySelectorAll('.focus');
	for ( var i = 0; i < focus_img_containers.length; i++ ) {
		var img_container = focus_img_containers[i],
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

	jQuery( 'a[data-open=story__modal--gallery]' ).on( 'click', function( e ) {
		e.preventDefault();
		var id = jQuery(this).data('img_id'),
		target = jQuery('#' + id);
		jQuery('.orbit').foundation( 'changeSlide', true, target );
	});

	jQuery( '#token-form__submit' ).on( 'click', function( e ) {
		e.preventDefault();
		jQuery(this).prop('disabled',true);
		var selection = jQuery( '.token-form__collab-select option:selected' ),
		grid = jQuery('.grid--form-options');
		if ( undefined !== selection ) {
			var data = {
					action: 'exchange_token_form',
					cid : selection.val(),
					prid : selection.data('programme-round'),
					security : jQuery( '.token-form__nonce' ).val()
			};
			jQuery('.loader-pointer').remove();
			jQuery('.loader-wrapper').addClass('go');
			grid.html('');
			jQuery.ajax( {
				'url':    exchange_ajax.ajax_url,
				'method': 'POST',
				'data':   data
			} ).done( function ( response ) {
				grid.html( response );
				jQuery('.loader-wrapper').removeClass('go');
				jQuery(this).removeProp('disabled');

			} );
		};
	} );


/* 	jQuery('#gform_6 #input_6_7').change(function(){
    var attendees = jQuery(this).val();
    gfRepeater_setRepeater(6, 1, attendees);
}); */

	jQuery('.translatedparagraph--has_translations').each( function() {
		var select = jQuery( this ).find('.translation-select');
		select.on('change', function() {
			var lang = 'paragraph--' + this.value;
			function doLanguageSwitch( lang ) {
				return function( index, element) {
					jQuery( this ).removeClass('show');
					if ( jQuery( this ).hasClass( lang ) ) {
						jQuery( this ).addClass('show');
					}
				}
			};
			var wrapper = jQuery( this ).parent().parent('.translatedparagraph--has_translations');
			paragraphs = wrapper.children('.translatedparagraph__paragraph');
			paragraphs.each( doLanguageSwitch( lang ) );
		});
	});

	jQuery('.image--main').each( function() {
		//console.log( jQuery(this).height() );
	});

	if ( jQuery('body').hasClass('single') || jQuery('body').hasClass('page-child') ) {
		jQuery('#main').on('scrollme.zf.trigger',handleScroll);
	}

	// Remove empty P tags created by WP inside of Accordion and Orbit
	jQuery('.accordion p:empty, .orbit p:empty').remove();

	// Makes sure last grid item floats left
	jQuery('.archive__grid .columns', 'relatedgrid .columns').last().addClass( 'end' );

	// Adds Flex Video to YouTube and Vimeo Embeds
	jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
		if ( jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5 ) {
			jQuery(this).wrap("<div class='widescreen flex-video'/>");
		} else {
			jQuery(this).wrap("<div class='flex-video'/>");
		}
	});

});
