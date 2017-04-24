<div class="archive__interface">

	<div class="" data-tabs-content="facet-tabs">
		
		<?php 
			$map_active = '';
			$grid_active = ' is-active';
			if ( is_post_type_archive( 'collaboration' ) ) {
				$map_active = ' is-active'; 
				$grid_active = '';
			}
		?>

		<section class="tabs-panel <?php echo esc_attr( $grid_active ); ?> section--blue-1-web section--coloured" id="facets-grid">
			
			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
			
			<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

			<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>

		</section>
		
		<?php if ( ! is_post_type_archive( 'story' ) ) : ?>

			<section class="tabs-panel <?php echo esc_attr( $map_active ); ?> section--coloured" id="facets-map">
				
				<?php echo BasePattern::build_edge_svg('bottom', '#ffffff' ); ?>
				
				<?php get_template_part( 'parts/content', 'archive-map'); ?>
				
				<?php echo BasePattern::build_edge_svg('top', '#ffffff' ); ?>

			</section>

		<?php endif; ?>

	</div>

</div><!--archive__interface-->