		
<div class="archive__facets-wrapper-outer">
	<div class="archive__facets-wrapper-inner">
		<nav class="archive__facets--top">
			<div class="archive__facets__search">
				<?php echo facetwp_display( 'facet', 'search' ); ?>
				<div class="archive__facets__search__toggler">
					<a class="show-filters" data-toggle="main"><?php _e( 'Show Filters','exchange'); ?></a>
					<a class="hide-filters" data-toggle="main"><?php _e( 'Hide Filters','exchange'); ?></a>
				</div>
			</div>
		</nav>
		<nav class="archive__facets--extra">
			<ul class="accordion" data-accordion data-allow-all-closed="true">
			<?php $facets = array();

				if ( is_search() ) {
					$facets[ 'type' ] = 'Type';
				}

				if ( ! is_post_type_archive( 'collaboration' ) ) {
					$facets[ 'category' ] = 'Category';
					// $facets[ 'language' ] = 'Language';
				}

				$facets = array_merge( $facets, array( 
					'post_tag'        => 'Programme Round',
					'topic'           => 'Topic', 
					'discipline'      => 'Discipline', 
					'methodology'     => 'Methodology',	
					'output_type'     => 'Output Type', 
					'location'        => 'Location',
				) );

				// if ( is_post_type_archive( 'story' ) ) {
				// 	$facets[ 'language' ] = 'Language';
				// }

				foreach( $facets as $facet_key => $facet_name ) : ?>

					<?php $accordion_title = $facet_key === 'post_tag' ? 'accordion-item is-active' : 'accordion-item'; ?>

					<li class="<?php echo esc_attr( $accordion_title ); ?>" data-accordion-item>
			    		<!-- Accordion tab title -->
			    		<a href="#" class="accordion-title"><?php echo esc_html( $facet_name ); ?></a>
					    <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
					    <div class="accordion-content" data-tab-content>
					      <?php echo facetwp_display( 'facet', $facet_key ); ?>
					    </div>
					</li>

				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</div>