<?php
	$story = is_post_type_archive('story');

	$featured_stories = $story
		? get_option( 'options_featured_stories' )
		: get_field( 'featured_stories', $post->ID );

	if ( is_home() ) {
		$prefix = 'home';
	} elseif ( $story ) {
		$prefix = 'story-archive';
	} else {
		$prefix = $post->post_name;
	}
	if ( ! empty( $featured_stories ) ) : ?>
		<section class="<?php echo $prefix; ?>__featured-stories section--featured-stories">
			<div class="section-inner">
				<div class="section__featuredgrid">
				<?php
					$length = count( $featured_stories );
					for ( $i = 0; $i < $length ; $i++ ) {
						$exchange = BaseController::exchange_factory( $featured_stories[$i], 'griditem' );
						if ( $i === 0 ) {
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
									'grid_width' => 'grid_full',
									'grid_width_num' => 12,
								);
							}
						}
						if ( $i === 1 ) {
							echo '<div class="row" data-equalizer>';
						}
						Exchange::publish_grid_featured( $exchange, 'featuredgrid', $modifiers );
					}
					if ( $length > 0 ) {
						echo '</div>';
					} ?>

				</div>
			</div>
		</section>
		<?php endif; ?>
