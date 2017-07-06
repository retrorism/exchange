<?php 
	$map_active = '';
	$grid_active = ' is-active';
	if ( is_post_type_archive( 'collaboration' ) ) {
		$map_active = ' is-active'; 
		$grid_active = '';
	}
?>
<div class="archive__view__toggle">
	<?php if ( ! is_post_type_archive( 'story' ) ) : ?>
	<ul class="controls" data-tabs id="facet-tabs">
		<li class="tabs-title<?php echo esc_attr( $grid_active ); ?>">
			<a href="#facets-grid" title="<?php _e('Switch to view items on a map','exchange' ); ?>">
				<?php echo exchange_build_svg( get_stylesheet_directory() . '/assets/images/svg/T_grid_WEB.svg', true ); ?>
				<label for="facets-grid"><span><?php _e( 'GRID', 'exchange' ); ?></span></label>
			</a>
		</li>
		<li class="tabs-title<?php echo esc_attr( $map_active ); ?>">
			<a href="#facets-map" title="<?php _e('Switch to view items in a grid','exchange' ); ?>">
				<?php echo exchange_build_svg( get_stylesheet_directory() . '/assets/images/svg/T_globe_WEB.svg', true ); ?>
				<label for="facets-map"><span><?php _e( 'MAP', 'exchange' ); ?></span></label>
			</a>
		</li>
	</ul>
	<?php endif; ?>
</div>