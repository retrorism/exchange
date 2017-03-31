function handleScroll() {
	var previousScroll = pageYOffset;
	jQuery(window).scroll(function(){
		var currentScroll = jQuery(this).scrollTop();
		if (currentScroll > previousScroll){
		} else {
		}
		previousScroll = currentScroll;
		if ( pageYOffset < 100 ) {
			jQuery('.breadcrumbs-bar').removeClass('scrolled');
		} else {
			jQuery('.breadcrumbs-bar').addClass('scrolled');
		}

	});
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getFocusTranslate( img_placeholder, img ) {
	img_data = img_placeholder.parentNode.dataset;
	if ( ! img_data ) {
		return false;
	}
	var h = img.clientHeight,
	container_h =  img_placeholder.offsetHeight,
	px_translate = ( img_data.focus_h * h ) - ( container_h / 2 ),
	max_translate = ( ( h - container_h ) / h ) * 100,
	translate = ( px_translate / h ) * 100;

	//If the center of the container is below the focus point, don't move.
	//Or: if the translation is downwards, don't move (we're working from top).
	if ( px_translate < 0 || translate < 0 ) {
		return false;
	}

	if ( translate > max_translate ) {
		return max_translate;
	} else {
		return translate;
	}
}

function doFocusTranslate( img ) {
	var img_placeholder = img.parentNode;
	translate = getFocusTranslate( img_placeholder, img );
	// Keep the negative, add minus if necessary
	if ( translate ) {
		var translateNeg = translate > 0 ? -1 * translate : translate,
		transform = 'transform: translateY(' + translateNeg + '%);';
		img.setAttribute( 'style', transform );
	}
}

var masonryOptions = { 
			"percentPosition": true, 
			"columnWidth": ".masonry__grid-sizer", 
			"gutter": ".masonry__gutter-sizer", 
			"itemSelector": ".archive__grid__griditem"
};

var masonryIsActive = false;

(function($){

	$(document).ready(function() {

		$('.focus').each(function() {
			var img = $(this).find('.image--main');
			img.on('load', function(e){
				doFocusTranslate(e.target);
			});
		})

		var floated_elements = document.querySelectorAll('.floated');
		for (var ii = 0; ii < floated_elements.length; ii++ ) {
			var equal_element = floated_elements[ii].nextElementSibling,
			h = floated_elements[ii].offsetHeight,
			equal_h = equal_element.offsetHeight;
			if ( h > equal_h ) {
				equal_element.style.height = h + 'px';
			}
		}

		$( 'a[data-open=story__modal--gallery]' ).on( 'click', function( e ) {
			e.preventDefault();
			var id = $(this).data('img_id'),
			targetjQ = $('#story__modal--gallery').find('#' + id);
			$('.orbit').foundation( 'changeSlide', true, targetjQ );
		})

		$( '#token-form__submit' ).on( 'click', function( e ) {
			e.preventDefault();
			$(this).prop('disabled',true);
			var selection = $( '.token-form__collab-select option:selected' ),
			grid = $('.grid--form-options'),
			prToken = getUrlVars()['pr'];
			if ( undefined !== selection ) {
				var data = {
					action: 'exchange_token_form',
					update_id : selection.val(),
					prid : selection.data('programme-round'),
					token : prToken,
					security : $( '.token-form__nonce' ).val()
				};
				$('.loader-pointer').remove();
				$('.loader-wrapper').addClass('go');
				grid.html('');
				$.ajax( {
					'url':    exchange_ajax.ajax_url,
					'method': 'POST',
					'data':   data
				} ).done( function ( response ) {
					grid.html( response );
					$('.loader-wrapper').removeClass('go');
					$(this).removeProp('disabled');

				} );
			};
		} );


		$('.translatedparagraph--has_translations').each( function() {
			var select = $( this ).find('.translation-select');
			select.on('change', function() {
				var lang = 'paragraph--' + this.value;
				function doLanguageSwitch( lang ) {
					return function( index, element) {
						$( this ).removeClass('show');
						if ( $( this ).hasClass( lang ) ) {
							$( this ).addClass('show');
						}
					}
				};
				var wrapper = $( this ).parent().parent('.translatedparagraph--has_translations');
				paragraphs = wrapper.children('.translatedparagraph__paragraph');
				paragraphs.each( doLanguageSwitch( lang ) );
			});
		});

		if ( $('body').hasClass('single') || $('body').hasClass('page-child') ) {
			$('#main').on('scrollme.zf.trigger',handleScroll);
		}

		if ($('body').hasClass('archive') ) {
			$('.archive__grid__masonry').masonry(masonryOptions);
			masonryIsActive = true;
			$('#facet-tabs').on('change.zf.tabs', function() {
			})
			$('#facet-switch').on('click', function() {
				('#main').foundation('toggle');
			})
	     }

		// Remove empty P tags created by WP inside of Accordion and Orbit
		$('.accordion p:empty, .orbit p:empty').remove();

		// Makes sure last grid item floats left
		$('.archive__grid .columns', 'relatedgrid .columns').last().addClass( 'end' );

		// Adds Flex Video to YouTube and Vimeo Embeds
		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
			if ( $(this).innerWidth() / $(this).innerHeight() > 1.5 ) {
				$(this).wrap("<div class='widescreen flex-video'/>");
			} else {
				$(this).wrap("<div class='flex-video'/>");
			}
		});

	})

	$(document).on('facetwp-loaded', function() {
		$('.facetwp-facet').each(function() {
            var facet_name = $(this).attr('data-name');
            var facet_label = FWP.settings.labels[facet_name];
            if ($('.facet-label[data-for="' + facet_name + '"]').length < 1) {
                $(this).before('<label class="facet-label" data-for="' + facet_name + '"><strong>' + facet_label + '</strong></label>');
            }
        });
		var $grid = $('.archive__grid__masonry');
		if ( masonryIsActive ) {
			console.log('destroy');
		    $grid.masonry('destroy'); // destroy
		}
		$grid.masonry( masonryOptions ); // re-initialize
		masonryIsActive = true;
		if ( FWP_JSON !== undefined ) {
			console.log( FWP_JSON );
		}
	})

})(jQuery);
