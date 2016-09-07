<?php get_header(); ?>

<main id="main" class="archive__wrapper  " role="main">

	<div class="main-inner">

		<?php
		$args = array(
			'name'        => 'collaborations',
			'post_type'   => 'page',
			'post_status' => 'private',
			'numberposts' => 1
		);
		$get_collaborations_page = get_posts( $args );
		if ( $get_collaborations_page ) : ?>

			<?php $exchange = BaseController::exchange_factory( $get_collaborations_page[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' ); ?>

		<?php else: ?>

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

		<?php endif; ?>

		<?php if (have_posts()) : ?>

		<?php get_template_part( 'parts/content', 'archive-map'); ?>

		<div class="archive__interface section--blue-1-web section--coloured">

			<div class="archive__interface-inner">

			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>

			<?php get_template_part( 'parts/content', 'archive-filters'); ?>

			<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

			<?php exchange_page_navi(); ?>

			</div><!-- archive__interface-inner-->

			<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
		</div><!--archive__interface-->

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">


				</div>

			</section>

		</footer>

	</div> <!-- end .main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
