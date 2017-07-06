( function( $ ){

	$( document ).ready( function() {

		processFloatedElements();

		var $body = $('body');

		if ( $grid === undefined ) {
			$grid = $('.archive__grid__masonry');
		}

		// Load more button for FWP
		if ( 'object' == typeof FWP ) { 
		    wp.hooks.addFilter('facetwp/template_html', function(resp, params) {
		        if ( FWP.is_load_more ) {
		            FWP.is_load_more = false;
		            $('.facetwp-template').append( params.html );
		            return true;
		        }
		        return resp;
		    });
		}

		// Proces images that have a focus property
		$('.focus').each( function() {
			var img = $(this).find('.image--main');
			img.on('load', function( e ){
				doFocusTranslate(e.target);
			});
		});
		
		// Open gallery when clicking an image
		$( 'a[data-open=story__modal--gallery]' ).on( 'click', function( e ) {
			e.preventDefault();
			var id = $(this).data('img_id'),
			targetjQ = $('#story__modal--gallery').find('#' + id);
			$('.orbit').foundation( 'changeSlide', true, targetjQ );
		});

		// Token form submission
		$( '#token-form__submit' ).on( 'click', function( e ) {
			e.preventDefault();
			$(this).prop( 'disabled',true );
			var selection = $( '.token-form__collab-select option:selected' ),
			grid = $('.grid--form-options'),
			prToken = getUrlVars().pr;
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

				});
			}
		});

		// Switch for translated paragraphs
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
				}
				var wrapper = $( this ).parent().parent('.translatedparagraph--has_translations');
				paragraphs = wrapper.children('.translatedparagraph__paragraph');
				paragraphs.each( doLanguageSwitch( lang ) );
			});
		});

		// Scroll-handler for breadcrumbs.
		if ( $body.hasClass('single') || $body.hasClass('page-child') ) {
			$('#main').on('scrollme.zf.trigger', handleScroll);
		}

		// Archive functions (get map, activate masonry).
		if ( $body.hasClass( 'archive' ) || $body.hasClass( 'page-template-archive' ) || $body.hasClass( 'search' ) || $('.featuredgrid__masonry').length === 1 ) {
			if ( $body.hasClass( 'post-type-archive-participant') ) {
				if ( archiveMap === undefined ) {
					archiveMap = getArchiveMap();
				}
				if ( archiveMap ) {				
					archiveMap.map.fitBounds( archiveMap.clusterLayer.getBounds() );
				}
			}
			if ( $grid !== undefined ) {
				$grid.masonry( masonryOptions ); // re-initialize
				masonryIsActive = true;
			}
		}

		// Tab switcher
    	$('#facet-tabs').on( 'change.zf.tabs', function() {
			if ( archiveMap === undefined ) {
				archiveMap = getArchiveMap();
			}
			if ( archiveMap.map !== undefined ) {
				archiveMap.map.invalidateSize().fitBounds( archiveMap.clusterLayer.getBounds() );
			}
			if ( $grid !== undefined ) {
				$grid.masonry( masonryOptions ); // re-initialize
				masonryIsActive = true;
			}
		});

    	// Facet switcher
		$('#facet-switch').on( 'click', function() {
			('#main').foundation('toggle');
		});

		// Remove empty P tags created by WP inside of Accordion and Orbit
		$('.accordion p:empty, .orbit p:empty').remove();

		// Makes sure last grid item floats left
		$('.archive__grid .columns', 'relatedgrid .columns').last().addClass( 'end' );

		// Adds Flex Video to YouTube and Vimeo Embeds
		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each( function() {
			if ( $(this).innerWidth() / $(this).innerHeight() > 1.5 ) {
				$(this).wrap("<div class='widescreen flex-video'/>");
			} else {
				$(this).wrap("<div class='flex-video'/>");
			}
		});
	});

	// Handle Load More click ( on archive pages );
	$(document).on('click', '.fwp-load-more', function() {
        $('.fwp-load-more').html('Loading...');
        FWP.is_load_more = true;
        FWP.paged = parseInt( FWP.settings.pager.page ) + 1;
        FWP.soft_refresh = true;
        FWP.refresh();
    });

	// Handle search click ( on archive pages );
	$(document).on('click', '.facetwp-facet-search .facetwp-btn--exchange', function( e ) {
		e.preventDefault();
		var inputVal = $('.facetwp-search').val().trim(),
			keyEvent = $.Event('keydown');
		keyEvent.which = 50;
		keyEvent.keyCode = 50;
		FWP.facets.search = inputVal;
		FWP.refresh();
	} );

	// Handle remove-facet click ( on archive pages );
	$(document).on('click', '.remove-facet-value', function( e ) {
		e.preventDefault();
		var facetTag = $(this).parent();
			facetType = facetTag.parent().data('facet-type'),
			facetValue = facetTag.data('facet-value');
		if ( 'search' === facetType ) {
			jQuery('.facetwp-search').val('');
			jQuery('ul[data-facet-type="search"]').first().remove();
		} else {
			var facetIndex = FWP.facets[facetType].indexOf(facetValue);
			if ( facetIndex > -1 ) {
				FWP.facets[facetType].splice(facetIndex, 1);
				$('div[data-value="' + facetValue + '"]').first().removeClass('checked');
			}
		}
		FWP.refresh();
	} );

})(jQuery);

( function( $ ){
	$(document).on('facetwp-loaded', function() {
		processFacetsUI();
		$('.no-terms').show();

		// Destroy and re-initialise grid.
		$grid = $('.archive__grid__masonry');
		if ( masonryIsActive ) {
		    $grid.masonry('destroy'); // destroy
		}
		$grid.masonry( masonryOptions ); // re-initialise
		masonryIsActive = true;

		// Update Load-more button.
		if ( FWP.settings.pager.page < FWP.settings.pager.total_pages ) {
			$('.fwp-load-more').html('Load more');
		    $('.fwp-load-more').show();
		} else {
		    $('.fwp-load-more').hide();
		}

		// Scroll down to display new results
		if ( FWP.settings.pager.page > 1 ) {
			$('html, body').animate( {
	            scrollTop: $('.archive__grid__masonry').offset().bottom
	        }, 1000);
	    }
		
		// Look for leaflet map.
		archiveMap = getArchiveMap();
		if ( archiveMap === undefined ) {
			return;
		}
		
		// Map functions (will not run when archiveMap is undefined);
		var allObjects = window['leaflet_objects_' + archiveMap.hash];
		
		if ( allObjects === undefined || allObjects.map_polylines.length === 0 || FWP.settings.matches.length === 0 ) {
			return;
		}
		if ( allObjects.map_polylines.length > 0 && FWP.settings.matches.length > 0 ) {
			var matchedPolylines = allObjects.map_polylines.filter( function( p ) {
				if (  FWP.settings.matches.includes( p.id ) ) {
					return true;
				}
			});
			if ( matchedPolylines.length > 0 ) {
				var refreshObjects = {
					map_polylines : matchedPolylines
				};
				archiveMap.renderObjects( refreshObjects );
			}
		}
	});
})(jQuery);

( function( $ ){
    $(document).on('facetwp-refresh', function() {
    	jQuery('.archive__active-facet-summary').html('<h5>Loading...</h5>');
        if ( ! FWP.loaded ) {
            FWP.paged = 1;
        }
    });
})(jQuery);
