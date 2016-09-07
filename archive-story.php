<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main">

	<div class="main-inner">

		<?php
		$args = array(
			'name'        => 'stories',
			'post_type'   => 'page',
			'post_status' => 'private',
			'numberposts' => 1
		);
		$get_stories_page = get_posts( $args );
		if ( $get_stories_page ) :
			$exchange = BaseController::exchange_factory( $get_stories_page[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' );
			include_once( get_stylesheet_directory() . '/parts/loop-featured-stories.php' ); ?>

		<?php else: ?>

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<div class="archive__interface section--has_grid section--blue-1-web section--coloured">
			<?php echo BasePattern::build_edge_svg( 'top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>

				<div class="archive__interface-inner">

				<?php get_template_part( 'parts/content', 'archive-filters' ); ?>

				<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

				<?php exchange_page_navi(); ?>

				</div><!-- end .archive__interface-inner -->

			<?php echo BasePattern::build_edge_svg( 'bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
			</div><!-- end .archive__interface-->

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">

					<?php get_template_part( 'parts/content','story-share-cta' ); ?>

				</div>

			</section>

		</footer>

	</div> <!-- end .main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
