<?php
/*
 * Template name: Archive
 */

get_header(); ?>

<main id="main" class="archive-wrapper" role="main" data-toggler=".facets-active">

	<div class="main-inner">

		<div class="archive__interface">

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

			<?php if ( function_exists( 'facetwp_display' ) ) : ?>

				<?php get_template_part( 'parts/nav', 'facets' ); ?>

			<?php endif; ?>
		
			<?php get_template_part( 'parts/nav', 'archive-view-toggle') ; ?>

		    <?php if (have_posts()) : ?>

				<?php get_template_part( 'parts/content', 'archive-interface' ); ?>

			<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

			<?php endif; ?>

		</div><!-- end archive__interface -->

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">

					<?php get_template_part( 'parts/content','get-involved-cta' ); ?>

				</div>

			</section>

		</footer>

	</div><!-- end main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
