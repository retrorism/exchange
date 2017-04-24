<section class="archive__grid section--has-grid section--archive-grid">
	<div class="section-inner">

		<div class="archive__grid__masonry">
			
			<div class="masonry__grid-sizer"></div>
			<div class="masonry__gutter-sizer"></div>
			
			<?php if ( is_post_type_archive( 'collaboration' ) ) : ?>

				<?php echo facetwp_display( 'template', 'collaborations_filtered' ); ?> 
			
			<?php elseif ( is_post_type_archive( 'story' ) ) : ?>

				<?php echo facetwp_display( 'template', 'stories_filtered' ); ?> 

			<?php else : ?>
				
				<?php echo facetwp_display( 'template', 'archive_filtered' ); ?>

			<?php endif; ?>
		<div class="archive__grid__load-more">
			<button type="button" class="button button--large fwp-load-more"><?php _e( 'Load more...', 'exchange' ); ?></button>
		</div>
		</div><!-- end archive__grid__masonry -->

	</div>
</section>
