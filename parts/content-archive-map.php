<div class="archive__map">

		<?php
			$map_input = array(
				'map_style' => 'network',
				'map_size' => 'full',
				'map_zoom_level' => '4',
			);
			$map = BasePattern::pattern_factory( $map_input, 'simple_map', 'archive__map', true );
			$map->publish();
		?>

</div>
