<section class="story__section">
	<div class="section-inner">
		<figure class="section__slice section__image">
			<div id="programmes">
			<?php
				$img_root = get_template_directory() . '/assets/images/';
				$programmes = array(
					'C_P' => 'Tandem C & P',
					'Turkey' => 'Tandem Turkey',
					'Ukraine' => 'Tandem Ukraine',
					'Europe' => 'Tandem Europe',
					'Shaml' => 'Tandem Shaml',
				);
				foreach ( $programmes as $slug => $title ) {
					$page_id = get_page_by_title( $title );
					$anchor = '<a href="#">';
					if ( ! empty( $page_id ) ) {
						$anchor = exchange_create_link( BaseController::exchange_factory( $page_id ), false );
					}
					echo $anchor;
					echo exchange_build_svg( $img_root . 'svg/T_logo_' . $slug . '_WEB.svg', true );
					echo '</a>';
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
