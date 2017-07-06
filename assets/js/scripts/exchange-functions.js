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