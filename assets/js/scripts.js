

jQuery(document).foundation();
// Speed up calls to hasOwnProperty
var hasOwnProperty = Object.prototype.hasOwnProperty,
baseUrl = location.origin,
mapInitial = 1,
map,
routeLayer;

if (! location.origin) {
	baseUrl = location.protocol + "//" + location.host;
}

if ( location.origin == 'http://localhost' ) {
  baseUrl = location.origin + "/tandem";
}

function isEmpty(obj) {
    if (obj == null) {
		return true;
	}
    if (obj.length > 0) {
		return false;
	}
    if (obj.length === 0) {
		return true;
	}
    if (typeof obj !== "object") {
		return true;
	}
    for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) {
			return false;
		}
    }
    return true;
}

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

	// console.log( 'image height: ' + h );
	// console.log( 'focus point on ' + ( img_data.focus_h * h ) );
	// console.log( 'container center ' + ( container_h / 2 ) );
	// console.log( 'number of pixels to move: ' + px_translate );
	// console.log( 'number of percents to move: ' + translate );
	// console.log( 'max percent to move: ' + max_translate );
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

function createRoute(arr_m,arr_l,arr_c) {
	var iconUrl = leaflet_vars.markerUrl,
	exchange_icon = L.icon({
		iconUrl: iconUrl,
		iconSize:     [14, 14], // size of the icon
		shadowSize:   [0, 0], // size of the shadow
		iconAnchor:   [7, 7], // point of the icon which will correspond to marker's location
		shadowAnchor: [4, 62],  // the same for the shadow
		popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
	}),
	route = L.featureGroup({snakingPause: 500 });
	if ( arr_m.length > 0 && arr_l.length > 0 ) {
		for ( i = 0; i < arr_l.length; i++ ) {
			var marker = L.marker( arr_m[i], {
				icon : new L.DivIcon({
					className: 'map__marker',
					html:   '<img class="map__marker__image" src="' + iconUrl + '">'+
							'<span class="map__marker__label">'+arr_c[i]+'</span>'
						})
			});
			var line = L.polyline( arr_l[i], {
				color : leaflet_vars.yellowTandem,
				className: 'map__line',
				weight : 6,
				opacity : 0.9,
				dashArray : '12, 10',
				lineJoin: 'round',
				snakingSpeed: 200
			} );
			route.addLayer( marker ).addLayer( line );
		}
		if ( arr_l.length == 1 ) {
				var marker2 = L.marker( arr_m[i], {
					icon : new L.DivIcon({
						className: 'map__marker',
						html:   '<img class="map__marker__image" src="' + iconUrl + '">'+
								'<span class="map__marker__label">'+arr_c[i]+'</span>'
							})
				} );
				marker2.bindPopup(arr_c[i]);
			route.addLayer( marker2 );
		}
	}
	return route;
};

function createArchiveRoute(collab,arr_m,arr_l,arr_c) {
	var iconUrl = leaflet_vars.markerUrl,
	exchange_icon = L.icon({
		iconUrl: iconUrl,
		iconSize:     [14, 14], // size of the icon
		shadowSize:   [0, 0], // size of the shadow
		iconAnchor:   [7, 7], // point of the icon which will correspond to marker's location
		shadowAnchor: [4, 62],  // the same for the shadow
		popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
	}),
	route = L.featureGroup({snakingPause: 500 });
	if ( arr_m.length > 0 && arr_l.length > 0 ) {
		for ( i = 0; i < arr_l.length; i++ ) {
			var marker = L.marker( arr_m[i], {
				icon : new L.DivIcon({
					className: 'map__marker',
					html:   '<img class="map__marker__image" src="' + iconUrl + '">'
						})
			});
			var line = L.polyline( arr_l[i], {
				color : leaflet_vars.yellowTandem,
				className: 'map__line',
				weight : 6,
				opacity : 0.9,
				dashArray : '12, 10',
				lineJoin: 'round',
				snakingSpeed: 200
			} );
			route.addLayer( marker ).addLayer( line );
		}
		if ( arr_l.length == 1 ) {
				var marker2 = L.marker( arr_m[i], {
					icon : new L.DivIcon({
						className: 'map__marker',
						html:   '<img class="map__marker__image" src="' + iconUrl + '">'
							})
				} );
				marker2.bindPopup(arr_c[i]);
			route.addLayer( marker2 );
		}
		route.bindPopup('<a href="' + collab.link + '">' + collab.name + '</a>');
	}
	return route;
};

function getQueryTag( data, option ) {
	var tag = document.createElement('a'),
	item = document.createElement('li'),
	text = document.createTextNode( data.name );
	tag.setAttribute( 'data-term_id',data.id );
	tag.setAttribute( 'data-slug',data.slug );
	tag.setAttribute( 'data-tax',data.tax );
	tag.setAttribute( 'title',data.name );
	tag.setAttribute( 'href','#' );
	tag.addEventListener('click',function( event ) {
		event.preventDefault();
		option.removeAttr('selected');
		this.parentNode.remove();
		fetchCollaborations();
	})
	tag.className = 'tag query-tag' + ' ' + data.tax;
	tag.appendChild(text);
	item.appendChild(tag);
	return item;
}

function getRandomProgrammeRound() {
	var termOptions = jQuery('.archive__filter').find('.archive__filter__tax-datalist[data-tax=post_tag]').find('option');
	if ( termOptions.length ) {
		var randomTotal = termOptions.length,
		randomN = Math.floor(Math.random() * randomTotal);
		console.log(randomN);
		prog = jQuery( termOptions[randomN] );
		return prog.data('slug');
	}
}

function fetchCollaborationsQuery() {
	var tags = jQuery('.archive__filter__query-tags').find('a.tag');
	console.log( tags );
	var filters = {
		'object' : 'collaborations',
		'taxquery': {},
	};
	if ( tags.length ) {
		for ( var i = 0; i < tags.length; i++ ) {
			var tag = jQuery( tags[i] );
			var k = tag.data('tax'),
			v = tag.data('slug');
			if ( ( typeof k === 'string' || k instanceof String )
			 	&& ( typeof v === 'string' || v instanceof String ) ) {
				filters.taxquery[k] = v;
			}
		}
	} else {
		if ( mapInitial == 1 ) {
			var post_tag = getRandomProgrammeRound();
			filters.taxquery = {
				'tag' : post_tag
			}
			mapInitial = 0;
		}
	}
	var queryFilters = '',
	taxquery = filters.taxquery;
	if ( isEmpty(taxquery) ) {
		return null;
	} else {
		for (var key in filters.taxquery) {
			if (taxquery.hasOwnProperty(key)) {
				queryFilters += '&filter[' + key + ']=' + taxquery[key];
			}
		}
		var restFilters = '?filter[post_status]=publish' + queryFilters + '&filter[orderby]=date&filter[order]=desc',
		restBase = '/wp-json/wp/v2/' + filters.object,
		restUrl = baseUrl + restBase + restFilters;
		console.log( filters );
		return restUrl;
	}
}

function fetchCollaborations() {
	var restUrl = fetchCollaborationsQuery();
	if ( restUrl === null ) {
		console.log( 'emptying map' );
		map.removeLayer(routeLayer);
	} else {
		console.log('called with ' + restUrl );
		jQuery.when(
			jQuery.ajax({
				url: restUrl,
				method: 'GET',
				crossDomain: true,
				contentType: 'application/json',
			})
		).then(
			function( data, status, request ) {
				// console.log( 'X-WP-Total: ' + request.getResponseHeader('X-WP-Total') );
				// console.log( 'X-WP-TotalPages: ' + request.getResponseHeader('X-WP-TotalPages') );
				var dataLength = data.length,
				collection = [];
				if ( dataLength > 0 ) {
					for ( var k = 0; k < dataLength; k++ ) {
						collection.push( data[k].exchange_basics.data );
					}
					collectionLength = collection.length;
					routes = [];
					for ( var l = 0; l < collectionLength; l++ ) {
						var route = prepareCollaborationMarkers( collection[l] );
						if ( route !== null ) {
							routes.push(route);
						}
					}
					console.log( routes );
					if ( routeLayer !== undefined ) {
						map.removeLayer(routeLayer);
					}
					if ( routes.length > 0 ) {
						routeLayer = L.layerGroup(routes).addTo(map);
					}
				}
			}
		)
	}
}

function prepareCollaborationMarkers( obj ) {
	console.log( obj );
	var locations = [],
	markers = [],
	cities = [],
	lines = [],
	collab = {
		'name' : obj.title,
		'link' : obj.link
	};
	if ( isEmpty( obj.locations ) ) {
		return null;
	}
	for (var participant_id in obj.locations ) {
		if ( obj.locations.hasOwnProperty(participant_id) ) {
			var participant = obj.locations[participant_id],
			latlngs = []
			if ( jQuery.isNumeric( participant.org_lat ) ) {
				latlngs.push( participant.org_lat );
			}
			if ( jQuery.isNumeric( participant.org_lng ) ) {
				latlngs.push( participant.org_lng );
			}
			if ( latlngs.length == 2 ) {
				locations.push( latlngs );
			}
			if ( '' != participant.org_city ) {
				cities.push( participant.org_city );
			}
		}
	}
	var length = locations.length;
	// Adding markers and lines to their respective arrays.
	for ( var j = 0; j < length; j++ ) {
		markers.push( locations[j] );
		if ( j === length - 1 ) {
			if ( length > 2 ) {
				lines.push( [ locations[j], locations[0] ] );
			}
		} else {
			lines.push( [ locations[j], locations[j+1] ] );
		}
	}
	if ( length == 2 ) {
		markers.push( locations[1] );
	}
	var route = createArchiveRoute(collab,markers,lines,cities);
	return route;

}

jQuery(document).foundation();
/*
These functions make sure WordPress
and Foundation play nice together.
*/

jQuery(document).ready(function() {

	// var baseUrl = location.origin;
	//
	// if (! location.origin) {
	// 	baseUrl = location.protocol + "//" + location.host;
	// }
	//
	// if ( location.origin == 'http://localhost' ) {
	//   baseUrl = location.origin + "/tandem";
 //  	}

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
	for (var j = 0; j < floated_elements.length; j++ ) {
		var equal_element = floated_elements[j].nextElementSibling,
		h = floated_elements[j].offsetHeight,
		equal_h = equal_element.offsetHeight;
		// console.log( floated_elements[j] );
		// console.log( equal_element );
		// console.log( 'neighbour: ' + equal_h + ' px');
		if ( h > equal_h ) {
			equal_element.style.height = h + 'px';
		}
	}

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
		console.log( jQuery(this).height() );
	});

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

  // Archive functions
	if ( jQuery('body').hasClass('archive') ) {
		var $archiveGrid = jQuery('.archive__grid').masonry({
		  "itemSelector": ".archive__grid__griditem"
		});

		jQuery('.archive__filter__button').each(function() {
			jQuery(this).on('click', function() {
				var tax = jQuery(this).data('tax'),
				termList = jQuery(this).parent().find('.archive__filter__datalist'),
				term = termList.val();
				if ( term !== null && term !== undefined && term !== '' ) {
					var termOption = jQuery('.archive__filter').find('.archive__filter__tax-datalist[data-tax=' + tax + ']').find('option[value="' + term + '"]:not(:selected)');
					if ( termOption.length ) {
						var termData = termOption.data();
						termData.name = term;
						termData.tax = tax;
						// Pass term option element object, so it can be removed on click
						var tag = getQueryTag(termData, termOption),
						tagBox = jQuery('.archive__filter__query-tags ul');
						tagBox.empty().append( tag );
						termOption.attr('selected','selected');
						fetchCollaborations();
					}
					termList.val('');
				}
			})
		})

		jQuery('.archive__button').on('click',function( e ) {
			e.preventDefault();
			var $moreButton = jQuery(this),
			paged = $moreButton.data('paged'),
			max_num_pages = $moreButton.data('max_num_pages'),
			object = $moreButton.data('object'),
			posts_per_page = $moreButton.data('posts_per_page'),
			tax_query = $moreButton.data('tax_query');
			if ( tax_query ) {
				restBase = '/wp-json/exchange/v1/' + object + '/' + tax_query;
				filters = '?page=' + ( paged + 2 ) + '&posts_per_page=' + posts_per_page;
			} else {
				restBase = '/wp-json/wp/v2/' + object;
				filters = '?filter[post_status]=publish&filter[posts_per_page]=' + posts_per_page + '&page=' + ( paged + 2 ) + '&filter[orderby]=date&filter[order]=desc';
			}
			var restUrl = baseUrl + restBase + filters;
			if ( ( paged + 1 ) < max_num_pages ) {
				jQuery.ajax({
					url: restUrl,
					method: 'GET',
					crossDomain: true,
					contentType: 'application/json',
					success: function( data, status, request ) {
						// console.log( 'X-WP-Total: ' + request.getResponseHeader('X-WP-Total') );
						// console.log( 'X-WP-TotalPages: ' + request.getResponseHeader('X-WP-TotalPages') );
						console.log( restUrl );
						var pagelength = data.length,
							items = '';
						for ( var i = 0; i < pagelength; i++ ) {
							items = items + data[i].exchange_basics.griditem;
						}
						var $items = jQuery( items );
						$archiveGrid.append( $items ).masonry( 'appended',$items ).masonry();
						paged = paged + 1;
						$moreButton.data('paged', paged );
						if ( paged + 1 == max_num_pages ) {
							$moreButton.hide();
						}
					},
					error: function( error ) {
						console.log( error );
					}
				});
			}
		});
	}
	if ( jQuery('body').hasClass('post-type-archive-collaboration') ) {

		var baseMapUrl = 'https://api.mapbox.com/styles/v1/retrorism/cio2pv2ft001ybvm8qb4da6f9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmV0cm9yaXNtIiwiYSI6IlhRWTE0d2cifQ.-Wi_jReZU4Wz_owPnVZDwQ',
		base = L.tileLayer(baseMapUrl, {subdomains: '1234'});
		map = L.map('leaflet-archive-map',{
			layers: [base],
			maxZoom: 20,
			minZoom: 0,
			zoomControl: 1,
			scrollWheelZoom: 0,
			attributionControl: false
		}).setView([48, 16], 4);
		var attControl = L.control.attribution({prefix:false}).addTo(map);attControl.addAttribution('Tiles Courtesy of <a href="http://www.mapbox.com/" target="_blank">MapBox</a> © <a href="http://www.openstreetmap.org/">OpenStreetMap</a> contributors');
		fetchCollaborations();
		// route = createRoute([[41.0082376,28.9783589],[45.8609375,25.7885796],[45.8609375,25.7885796]],[[[41.0082376,28.9783589],[45.8609375,25.7885796]]],["Istanbul","Sfantu Gheorghe",""]);
		// route.bindPopup('<a class=\"\" href=\"http://localhost/tandem/collaborations/looking-forat-the-invisible/\" title=\"Navigate to Looking For/At The Invisible\">Looking For/At The Invisible</a>');
		// route.addTo( map );
		// map.fitBounds( route.getBounds().pad(0.033) );
		// route.snakeIn();
	}


});
