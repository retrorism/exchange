<?php

	$featured_stories = get_post_meta( $exchange->post_id, 'featured_stories', true );

	// Add class when 3 or more featured stories are selected.
	$three_plus = 3 <= count( $featured_stories ) ? '--three-or-more ' : '';

	if ( ! empty( $featured_stories ) ) : ?>


		<div class="featured-stories featured-stories<?php echo esc_attr( $three_plus ); ?>">

			<section class="section--has-grid section--featured-grid">

				<div class="section-inner">

					<div class="row" data-equalizer>

					<?php $length = count( $featured_stories );
					for ( $i = 0; $i < $length; $i++ ) {

						$griditem = BaseController::exchange_factory( $featured_stories[ $i ],'griditem' );

						if ( 0 === $i && 2 !== $length ) {
							$modifiers = array(
								'grid_width' => 'grid_full',
								'grid_width_num' => 12,
							);
						} else {
							if ( 3 === $length ) {
								$modifiers = array(
									'grid_width' => 'grid_half',
									'grid_width_num' => 6,
								);
							} elseif ( 4 === $length ) {
								$modifiers = array(
									'grid_width' => 'grid_third',
									'grid_width_num' => 4,
								);
							} elseif ( 2 === $length ) {
								$modifiers = array(
									'grid_width' => 'grid_half',
									'grid_width_num' => 6,
								);
							}
						}
						if ( 1 === $i && 2 < $length ) {
							echo '</div><!-- end row --><div class="row" data-equalizer>';
						}
						Exchange::publish_grid_featured( $griditem, 'featuredgrid', $modifiers );
					}

					if ( $length > 0 ) {
						echo '</div>';
					} ?>

				</div><!-- section-inner-->

			</section><!-- section--has-grid-->

		</div>

	<?php endif; ?>
