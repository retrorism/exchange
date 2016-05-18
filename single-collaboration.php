<?php
/*
Tandem story template
*/
?>

<?php get_header(); ?>

<main id="main" role="main">

	<div class="main-inner">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loop', 'collaboration' ); ?>

		    <?php endwhile; else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</div> <!-- end .main-inner -->

	</main> <!-- end #main -->


</div> <!-- end #content -->

<?php get_footer(); ?>
