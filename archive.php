<?php get_header(); ?>


<main id="main" class="archive__wrapper section--blue-1-web" role="main">
	<div class="main-inner">
		<?php get_template_part( 'parts/content', 'archive-header'); ?>

	    <?php if (have_posts()) : ?>

			<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

			<?php exchange_page_navi(); ?>

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>
	</div> <!-- end .main-inner -->
</main> <!-- end #main -->

<?php get_footer(); ?>
