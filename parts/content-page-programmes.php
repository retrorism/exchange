<section class="story__section">
	<div class="section-inner">
		<figure class="section__slice section__image">
			<div id="programmes">
			<?php
				$img_root = get_template_directory() . '/assets/images/';
				global $post;
				$all_pages = BaseController::get_all_from_type( 'page' );
				$programmes = get_page_children( $post->ID, $all_pages );
				foreach ( $programmes as $page_obj ) {
					$anchor = '<a href="#">';
					if ( ! $page_obj instanceof WP_Post || 'publish' !== $page_obj->post_status ) {
						continue;
					} else {
						$anchor = exchange_create_link( BaseController::exchange_factory( $page_obj ), false );
						$slug = array_search( $page_obj->post_title, $GLOBALS['EXCHANGE_PLUGIN_CONFIG']['IMAGES']['programme-logos'] );
						if ( ! empty( $slug ) ) {
							echo $anchor . exchange_build_svg( $img_root . 'svg/T_logo_' . $slug . '_WEB.svg', true ) . '</a>';
						}

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
