<?php

	$featured_stories = get_post_meta( $exchange->post_id, 'featured_stories' )[0];

	if ( is_home() ) {
		$prefix = 'home';
	} elseif ( is_post_type_archive('story') ) {
		$prefix = 'story-archive';
	}

	// Add class when 3 or more featured stories are selected.
	$three_plus = 3 <= count( $featured_stories ) ? '--three-or-more ' : '';

	if ( ! empty( $featured_stories ) ) : ?>
		<section class="featured-stories<?php echo $three_plus; ?> <?php echo $prefix; ?>__featured-stories section--featured-stories ">
			<div class="section-inner">
				<div class="section__featuredgrid">
				<?php
					$length = count( $featured_stories );
					for ( $i = 0; $i < $length ; $i++ ) {
						$griditem = BaseController::exchange_factory( $featured_stories[$i],'griditem' );
						if ( $i === 0 && $length !== 2 ) {
							$modifiers = array(
								'grid_width' => 'grid_full',
								'grid_width_num' => 12,
							);
						} else {
							if ( $length === 3 ) {
								$modifiers = array(
									'grid_width' => 'grid_half',
									'grid_width_num' => 6,
								);
							} elseif ( $length === 4 ) {
								$modifiers = array(
									'grid_width' => 'grid_third',
									'grid_width_num' => 4,
								);
							} elseif ( $length === 2 ) {
								$modifiers = array(
									'grid_width' => 'grid_half',
									'grid_width_num' => 6,
								);
							}
						}
						if ( $i === 1 || $length === 2 ) {
							echo '<div class="row" data-equalizer>';
						}
						Exchange::publish_grid_featured( $griditem, 'featuredgrid', $modifiers );
					}
					if ( $length > 0 ) {
						echo '</div>';
					} ?>

				</div>
			</div>
		</section>
		<?php endif; ?>
