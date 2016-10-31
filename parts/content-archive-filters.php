<section class="archive__filter">
	<div class="section-inner">

		<aside class="archive__filter__fieldset" id="archive__filters" data-toggler=".hide">
			<div class="archive__filter__query-tags">
				<ul>
				</ul>
			</div>
					<?php
						if ( is_post_type_archive( 'story' ) ) {
							$post_type = 'story';
						} elseif ( is_post_type_archive( 'collaboration' ) ) {
							$post_type = 'collaboration';
						} else {
							$post_type = array('story','collaboration');
						}
						$taxonomies = get_object_taxonomies( $post_type );
						foreach( $taxonomies as $taxonomy ) {
							exchange_create_tax_dropdown( $taxonomy, 'archive__filter' );
						}
						foreach( $taxonomies as $taxonomy ) {
							exchange_create_query_store( $taxonomy );
						}
					?>
			<nav id="archive__filter__callout" class="archive__filter__box" data-toggler=".hide">
			</nav>
		</aside>
		<div class="archive__filter__toggle">
			<small><a data-toggle="archive__filters"><?php _e('Hide / Show filters', EXCHANGE_PLUGIN ); ?></a></small>
		</div>

	</div>
</section>
