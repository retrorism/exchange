<div class="archive__grid-wrapper">
	<div class="archive__grid section__archive-grid masonry"  data-masonry='{ "percentPosition": true, "columnWidth": ".masonry__grid-sizer", "gutter": ".masonry__gutter-sizer", "itemSelector": ".archive__grid__griditem" }'>
		<div class="masonry__grid-sizer"></div>
		<div class="masonry__gutter-sizer"></div>
	<?php while (have_posts()) : the_post(); ?>

		<?php include( get_stylesheet_directory() . '/parts/loop-archive-grid.php' ); ?>

	<?php endwhile; ?>
	</div>
</div>
