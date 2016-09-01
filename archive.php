<?php get_header(); ?>


<main id="main" class="archive__wrapper section--blue-1-web" role="main">
	<div class="main-inner">
		<?php get_template_part( 'parts/content', 'archive-header'); ?>

    	<?php if (have_posts()) : ?>
			<div class="archive__grid">

				<div class="masonry">
				<?php while (have_posts()) : the_post(); ?>

					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive-grid' ); ?>

				<?php endwhile; ?>
				</div>

				<div class="button-wrapper">
					<?php exchange_create_archive_button(); ?>
				</div>
				<?php //exchange_page_navi();// ?>

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>
	</div><!-- end .archive__grid -->
	</div> <!-- end .main-inner -->
</main> <!-- end #main -->

<?php get_footer(); ?>
