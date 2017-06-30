

jQuery(document).foundation();
var archiveMap,
$grid;

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

	});
}

function getArchiveMap() {
	if ( undefined === Exchange || undefined === Exchange.PluginExtensions || undefined === Exchange.PluginExtensions.LMP || undefined === Exchange.PluginExtensions.LMP.maps ) {
		return;
	}
    for ( var hashedMap in Exchange.PluginExtensions.LMP.maps ) {
        if ( Exchange.PluginExtensions.LMP.maps.hasOwnProperty( hashedMap ) ) {
            archiveMap = Exchange.PluginExtensions.LMP.maps[hashedMap];
            archiveMap.hash = hashedMap.slice( 4 );
            break;
        }
    }
    if ( archiveMap ) {
        return archiveMap;
    }
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for( var i = 0; i < hashes.length; i++ ) {
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

function openFacets() {
	var facetsActive = false;
	var facetList = [];
	jQuery('.accordion-item').each( function() {
		var parent = jQuery( this ),
			facet = parent.find('a.accordion-title'),
			content = parent.children('.accordion-content'),
			boxes = content.children().children('.facetwp-checkbox'),
			parentFilterCount = 0;
			if ( facet ) {
				var facetTax = facet.clone().children().remove().end().text().trim();
				facetList.push( {
					'name' : facetTax, 
					'terms' : [] 
				} );
				boxes.each( function() {
					if ( jQuery(this).hasClass('checked') ) {
						facetsActive = true;
						parent.addClass('.is-active');
						parentFilterCount++;
						var lastItem = facetList[ facetList.length - 1 ];
						lastItem.terms.push( jQuery(this).clone().children().remove().end().text().trim() );
					}
				} );
			}
		parent.find('span.filter-count').html('');
		if ( parentFilterCount > 0 ) {
			parent.find('span.filter-count').html(' (' + parentFilterCount + ')' );
		}
	} );
	if ( facetsActive ) {
		jQuery('#main').addClass('facets-active');
	}
	if ( facetList ) {
		var facetString = '';
		if ( facetsActive ) {
			facetString += '<h4>Showing results for:</h4>';
		}
		facetList.map( function( tax ) {
			if ( tax.terms.length > 0 ) {
				//facetString += '<span class="facet-list-title">' + tax.name + ': </span>';
				facetString += '<ul class="term-list" data-value="' + tax.name + '">';
				for ( var i = 0; tax.terms.length > i; i++ ) {
					facetString += '<li class="term" title="' + tax.name + ': ' + tax.terms[i] + '">' + tax.terms[i] + '</li>'
				}
				facetString += '</ul>';
			}
		} );
		jQuery('.archive__active-facet-summary').html( facetString );
	}
}

var masonryOptions = { 
			"percentPosition": true, 
			"columnWidth": ".masonry__grid-sizer", 
			"gutter": ".masonry__gutter-sizer", 
			"itemSelector": ".archive__grid__griditem"
};

var masonryIsActive = false;

( function( $ ){

	$( document ).ready( function() {

		var $body = $('body');

		if ( $grid === undefined ) {
			$grid = $('.archive__grid__masonry');
		}

		if ( 'object' == typeof FWP ) { 
		    wp.hooks.addFilter('facetwp/template_html', function(resp, params) {
		        if ( FWP.is_load_more ) {
		            FWP.is_load_more = false;
		            $('.facetwp-template').append( params.html );
		            return true;
		        }
		        return resp;
		    });
		} else {
			console.log( 'FWP is not defined yet' );
		}

		$('.focus').each( function() {
			var img = $(this).find('.image--main');
			img.on('load', function( e ){
				doFocusTranslate(e.target);
			});
		});

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
		});

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

		if ( $body.hasClass('single') || $body.hasClass('page-child') ) {
			$('#main').on('scrollme.zf.trigger', handleScroll);
		}

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

	 $(document).on('click', '.fwp-load-more', function() {

        $('.fwp-load-more').html('Loading...');
        FWP.is_load_more = true;
        FWP.paged = parseInt( FWP.settings.pager.page ) + 1;
        FWP.soft_refresh = true;
        FWP.refresh();

    });

	$(document).on('facetwp-loaded', function() {
		
		openFacets();

		$grid = $('.archive__grid__masonry');

		if ( masonryIsActive ) {
		    $grid.masonry('destroy'); // destroy
		}

		$grid.masonry( masonryOptions ); // re-initialize
		
		masonryIsActive = true;

		// if ( undefined !== FWP_HTTP.archive_args ) {
		// 	$('#main').addClass('facets-active');
		// 	FWP.facets[FWP_HTTP.archive_args.taxonomy] = [FWP_HTTP.archive_args.term];
		// 	$('div[data-value="' + FWP_HTTP.archive_args.term + '"]').addClass('checked');
		// }

		if ( FWP.settings.pager.page < FWP.settings.pager.total_pages ) {
		    $('.fwp-load-more').show();
		} else {
		    $('.fwp-load-more').hide();
		}

		if ( FWP.settings.pager.page > 1 ) {
			$('html, body').animate( {
	            scrollTop: $('.archive__grid__masonry').offset().bottom
	        }, 1000);
        }


		archiveMap = getArchiveMap();
		
		if ( archiveMap === undefined ) {
			return;
		}
		
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

    $(document).on('facetwp-refresh', function() {
        if ( ! FWP.loaded ) {
            FWP.paged = 1;
        }
    });

})(jQuery);
