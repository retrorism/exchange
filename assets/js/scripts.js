function handleScroll() {
	var previousScroll = pageYOffset;
	jQuery(window).scroll( function(){
		var currentScroll = jQuery(this).scrollTop();
		previousScroll = currentScroll;
		if ( pageYOffset < 100 ) {
			jQuery('.breadcrumbs-bar').removeClass('scrolled');
		} else {
			jQuery('.breadcrumbs-bar').addClass('scrolled');
		}

	} );
}

function getArchiveMap( maps ) {

    for ( var hashedMap in maps ) {
        if ( maps.hasOwnProperty( hashedMap ) ) {
            archiveMap = maps[hashedMap];
            archiveMap.hash = hashedMap.slice( 4 );
            break;
        }
    }
    if ( archiveMap ) {
		return archiveMap;
    }
}

function getUrlVars() {
    var vars = [], 
    	hash,
    	hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for ( var i = 0; i < hashes.length; i++ ) {
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

	return translate > max_translate ? max_translate : translate;
}

function doFocusTranslate( img ) {
	var img_placeholder = img.parentNode,
		translate = getFocusTranslate( img_placeholder, img );
	// Keep the negative, add minus if necessary
	if ( translate ) {
		var translateNeg = translate > 0 ? -1 * translate : translate,
		transform = 'transform: translateY(' + translateNeg + '%);';
		img.setAttribute( 'style', transform );
	}
}

function processFloatedElements() {
	var floated_elements = document.querySelectorAll('.floated');
	if ( ! floated_elements.length > 0 ) {
		return;
	}
	for (var ii = 0; ii < floated_elements.length; ii++ ) {
		var equal_element = floated_elements[ii].nextElementSibling,
		h = floated_elements[ii].offsetHeight,
		equal_h = equal_element.offsetHeight;
		if ( h > equal_h ) {
			equal_element.style.height = h + 'px';
		}
	}
}

function addFacetMarker( facet ) {
	var accordion = jQuery('.accordion').find('li[data-facet-type=' + facet + ']');
	if ( ! accordion.hasClass('is-active') ) {
		accordion.find('span.filter-count').html(' &#x2714');
	}
}

function removeFacetMarker( facet ) {
	var accordion = jQuery('.accordion').find('li[data-facet-type=' + facet + ']');
	accordion.find('span.filter-count').html('');
}

function handleFacetsOnMap() {

	// Look for leaflet map.
	archiveMap = getArchiveMap( Exchange.PluginExtensions.LMP.maps );

	if ( archiveMap === undefined ) {
		return;
	}

	// Map functions (will not run when archiveMap is undefined);
	var allObjects = window['leaflet_objects_' + archiveMap.hash];

	if ( allObjects === undefined || allObjects.map_polylines.length === 0 || FWP.settings.matches.length === 0 ) {
		return;
	}

	console.log( FWP.settings.matches );

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
}

function processFacetsUI() {
	// Define variables
	var facetHeader = '',
		facetString = '',
		facetList = {
			'count': 0,
			'facets': []
		},
		archiveUrl = [location.protocol, '//', location.host, location.pathname].join(''),
		items = ' results';

	// If there are no search facets and no selected facets, return;
	if ( undefined === FWP.facets && undefined === FWP.settings.selected_facets ) {
		return;
	}

	// Track and process search field data
	if ( undefined !== FWP.facets ) {
		if ( FWP.facets.search.length > 0 ) {
			facetList.facets.push( {
				'name': 'search',
				'terms': ['"' + FWP.facets.search + '"'],
			} );
			jQuery('.facetwp-search').val( FWP.facets.search );
			facetList.count++;
			facetString += '<ul class="term-list" data-facet-type="search">';
			facetString += '<li class="term tag search">"' + FWP.facets.search + '" <a href="#" title="Remove this search query" class="remove-facet-value">&#10005;</a></li>';
			facetString += '</ul>';
		}
		for ( var taxFacet in FWP.facets ) {
			if ( FWP.facets[taxFacet].length === 0 ) {
				removeFacetMarker( taxFacet );
			}
		}
	}

	// Use selected_facets variable to create tag lists with pretty names
	if ( undefined !== FWP.settings.selected_facets ) {
		for ( var facet in FWP.settings.selected_facets ) {
			var tax = FWP.settings.selected_facets[facet];
			if ( tax.length > 0 ) {
				addFacetMarker( facet );
				facetList.facets.push( {
					'name': facet,
					'terms': tax,
				} );
				facetLabel = ( undefined !== FWP.settings.labels[facet] ) ? FWP.settings.labels[facet] : '';
				if ( facetList.count < 6 ) {
					facetString += '<ul class="term-list" data-facet-type="' + facet + '">';
				}
				for ( var i = 0; tax.length > i && tax.length < 6; i++ ) {
					if ( FWP.facets[facet].indexOf(tax[i].slug) > -1 ) {
						facetList.count++;
						if ( facetList.count < 6 ) {
							var facetUrl = archiveUrl + '?fwp_' + facet + '=' + encodeURIComponent( tax[i].slug );
							vacetUrl = '#'
							//facetString += '<li><a href="' + facetUrl + '" class="tag ' + facet + '" title="' + facetLabel + ': ' + tax[i].name + '">' + tax[i].name + '</a></li>';
							facetString += '<li class="tag ' + facet + '" data-facet-value="' + tax[i].slug + '">' + tax[i].name + ' <a href="' + facetUrl + '" class="remove-facet-value" title="Remove this ' + facetLabel.toLowerCase() + ': ' + tax[i].name + '">&#10005;</a></li>';
						}
					}
				}
				if ( facetList.count < 6 ) {
					facetString += '</ul>';
				}
			}
		}
		if ( facetList.count > 5 ) {
			facetString += facetList.count === 6 ? '<span class="other-terms"> and 1 other tag</span>' : '<span class="other-terms">and ' + ( facetList.count - 5 ) + ' other tags.</span>';
		}
	}

	// Update the header and help text
	if ( ! FWP.loaded ) {
		facetHeader = '<h5>Loading...</h5>';
	}
	if ( undefined !== FWP.settings.pager && FWP.settings.pager.total_rows >= 0 ) {
		if ( FWP.settings.pager.total_rows === 0 ) {
			facetHeader = '<h5>No' + items + ' found</h5>';
		} else {
			items = FWP.settings.pager.total_rows === 1 ? ' result' : ' results';
			if ( jQuery('body').hasClass('post-type-archive-story') ) {
				items = FWP.settings.pager.total_rows === 1 ? ' story' : ' stories';
			}
			if ( jQuery('body').hasClass('post-type-archive-collaboration') ) {
				items = FWP.settings.pager.total_rows === 1 ? ' collaboration' : ' collaborations';
			} 
			facetHeader = '<h5>Showing ' + FWP.settings.pager.total_rows + items + '</h5>';
		}
		if ( facetList.count === 0 ) {
			facetHeader +='<small class="no-terms">This is everything! You can use filters <span class="hide-for-small-only">to the left </span>to refine the results.</small>';
		}
	}
	if ( facetList.count > 0 ) {
		jQuery('#main').addClass('facets-active');
		jQuery('.archive__active-facet-summary').html( facetHeader.replace('</h5>', ' for:</h5>') + facetString );
	} else {
		jQuery('.archive__active-facet-summary').html( facetHeader );
	}
}

var archiveMap,
	$grid,
	masonryOptions = { 
		"percentPosition": true, 
		"columnWidth": ".masonry__grid-sizer", 
		"gutter": ".masonry__gutter-sizer", 
		"itemSelector": ".archive__grid__griditem"
	},
	masonryIsActive = false;


jQuery(document).foundation();

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

	// Handle facet handling ( on archive pages );
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

		handleFacetsOnMap();
		
	});

	// Handle facet refresh
	$(document).on('facetwp-refresh', function() {
		jQuery('.archive__active-facet-summary').html('<h5>Loading...</h5>');
		if ( ! FWP.loaded ) {
			FWP.paged = 1;
		}
	});

	// Handle map updates ( on archive pages );
	$(document).on('lmp-loaded', function() {

		if ( ! $('body').hasClass( 'post-type-archive-collaboration' ) ) {
			return;
		}

		if ( undefined === Exchange || undefined === Exchange.PluginExtensions || undefined === Exchange.PluginExtensions.LMP ) {
			return;
		}

		// Initiate Leaflet map
		Exchange.PluginExtensions.LMP.init();

		if ( undefined === Exchange.PluginExtensions.LMP.maps ) {
			return;
		}

		handleFacetsOnMap();

	});

})(jQuery);


