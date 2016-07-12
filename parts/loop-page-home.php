<?php
/**
 * Page Loop Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 10/04/2016
 *
 * @package Exchange Plugin
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
};

$story = new Story( $post );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">
	<div id="article-body" class="entry-content story__content" itemprop="articleBody">

<?php
	$featured_stories = get_field( 'featured_stories', $post->ID );
	if ( ! empty( $featured_stories ) ) : ?>
		<section class="home__featured-stories">
			<div class="section-inner">
				<div class="section__featuredgrid">
				<?php
					$length = count( $featured_stories );
					for ( $i = 0; $i < $length ; $i++ ) {
						$exchange = BaseController::exchange_factory( $featured_stories[$i] );
						if ( $i === 0 ) {
							$modifiers = array('grid_width' => 'grid_full');
						} else {
							if ( $length === 3 ) {
								$modifiers = array('grid_width' => 'grid_half');
							} elseif ( $length === 4 ) {
								$modifiers = array('grid_width' => 'grid_third');
							} elseif ( $length === 2 ) {
								$modifiers = array('grid_width' => 'grid_full');
							}
						}
						$story->publish_grid_featured( $exchange, 'featuredgrid', $modifiers );
					} ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php $story->publish_sections(); ?>
	</div> <!-- end article -->

</article> <!-- end article -->

<div class="article-related-content story__extras">
	<?php $story->publish_related_content('story'); ?>
</div>
