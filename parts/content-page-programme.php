	<div class="section-inner">
		<figure class="section__slice section__image section__image--programme-logo">
			<?php
				$programme = array_search( $post->post_title, $GLOBALS['EXCHANGE_PLUGIN_CONFIG']['IMAGES']['programme-logos'] );
				$img_root = get_template_directory() . '/assets/images/';
				if ( ! empty( $programme ) ) {
					echo exchange_build_svg( $img_root . 'svg/T_logo_' . $programme . '_WEB.svg', true );
				}
			?>
		</figure>
	</div>
