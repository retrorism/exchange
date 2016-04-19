<?php
/*
Tandem programme_round template
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="large-8 medium-8 columns first" role="main">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loop', 'programme_round' ); ?>

		    <?php endwhile; else : ?>

		   		<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
