<?php
/**
 * Story Loop Template
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
$exchange = new Collaboration( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<?php $image_class = $exchange->has_header_image ? 'has-image' : 'no-image'; ?>
	<header class="article-header collaboration__header collaboration__header--<?php echo $image_class; ?>" data-equalizer data-equalize-on="large">
		<?php $exchange->publish_header_image();?>
			<div class="collaboration__header__desc" data-equalizer-watch>
				<div class="collaboration__header__desc-inner">
					<h1 class="entry-title collaboration__title" itemprop="headline"><?php the_title(); ?></h1>
					<?php if ( $exchange->description_length > 0 ) {
							$exchange->description->publish('collaboration');
						} ?>
					<?php if ( ! empty( $exchange->website ) ) : ?>
							<a class="button button--large" href="<?php echo esc_url( $exchange->website ); ?>"><?php _e('project website','exchange'); ?></a>
							<hr>
						<?php endif; ?>
					<section class="collaboration__tags"><?php $exchange->publish_tags('collaboration'); ?></section>
				</div>
			</div><!-- end description -->
		</div><!-- end description-wrapper -->
	</header> <!-- end article header -->
	<div class="entry-content collaboration__content" itemprop="articleBody">


		<!-- PARTICIPANTS -->
		<?php if ( $exchange->has_participants ) : ?>
			<section class="collaboration__participants">
				<div class="section-inner">
				<?php $participants = $exchange->participants; ?>
				<?php foreach( $participants as $p_obj ) : ?>
					<?php include( locate_template( 'parts/content-participant.php' ) ); ?>
			 	<?php endforeach; ?>

				</div><!-- section-inner -->
			</section><!-- collaboration__participants -->
		<?php endif; ?>


		<!-- MAP -->
		<?php if ( $exchange->has_participants && count ( $exchange->participants ) > 1 ) : ?>
			<section class="collaboration__map collaboration__section section--blue-1-web section--coloured">
				<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
				<div class="section-inner">
				<?php $exchange->publish_collab_map(); ?>
				</div>
				<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
			</section>

		<?php endif; ?>

		<!-- STORY SECTIONS -->
		<?php $exchange->publish_sections(); ?>

		<!-- GALLERY -->
		<?php if ( $exchange->has_gallery ) : ?>
			<section class="collaboration__section collaboration__gallery section--blue-1-web section--coloured">
				<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
				<div class="section-inner">
					<?php $exchange->publish_collab_media_gallery('collaboration'); ?>
				</div><!-- section-inner-->
				<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
			</section>
		<?php endif; ?>

		<!-- SHARED STORIES -->
		<?php if ( $exchange->has_stories ) : ?>
			<section class="collaboration__section collaboration__stories section--salmon-1-web section--coloured">
				<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
				<div class="section-inner">
					<?php $exchange->publish_related_stories(); ?>
				</div><!--section-inner-->
				<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
			</section>
		<?php endif; ?>


	</div> <!-- end articleBpdy -->


	<footer class="article-footer collaboration__footer">
		<?php include_once( get_stylesheet_directory() . '/parts/content-sharing-footer.php' ); ?>
	</footer> <!-- end article footer -->

</article> <!-- end article -->
<div class="article-related-content collaboration__section collaboration__extras section--salmon-1-web section--coloured">
	<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
		<?php $exchange->publish_related_content('collaboration'); ?>
	<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
</div>
