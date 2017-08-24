<section class="story__section">
	<div class="section-inner">
		<figure class="section__slice section__image">
			<?php
				$img_root = get_template_directory() . '/assets/images/';
				global $post;
				$all_pages = BaseController::get_all_from_type( 'page' );
				$programmes = get_page_children( $post->ID, $all_pages );
				foreach ( $programmes as $page_obj ) {
					if ( ! $page_obj instanceof WP_Post
						|| 'publish' !== $page_obj->post_status
						|| ! exchange_has_active_programme_round( $page_obj ) ) {
						continue;
					} else {
						$active_programmes[] = $page_obj;
					}
				} ?>
				<div id="programmes" class="active<?php echo esc_attr( count( $active_programmes ) ); ?>">
				<?php 
				foreach( $active_programmes as $active_programme ) {
					$anchor = exchange_create_link( BaseController::exchange_factory( $active_programme ), false );
					$slug = array_search( $active_programme->post_title, $GLOBALS['EXCHANGE_PLUGIN_CONFIG']['IMAGES']['programme-logos'] );
					if ( ! empty( $slug ) ) {
						echo $anchor . exchange_build_svg( $img_root . 'svg/T_logo_' . $slug . '_WEB.svg', true ) . '</a>';
					}
				}
			?>
			</div>
			<?php if ( class_exists( 'Caption' ) ) {
					$caption_text = '<p>Building it together. Illustration copyright &copy; Erica Brisson, 2014-15</p>';
					$modifiers = array( 'classes' => array( 'text-right' ) );
					$caption = new Caption( $caption_text, 'image' );
					$caption->publish();
				}
			?>
		</figure>
	</div>
</section>
