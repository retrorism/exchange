<figure id="programmes">
	<?php
		$img_root = get_template_directory() . '/assets/images/';
		$programmes = array(
			'C_P' => 'Tandem C & P',
			'Turkey' => 'Tandem Turkey',
			'Ukraine' => 'Tandem Ukraine',
			'Europe' => 'Tandem Europe',
			'Shaml' => 'Tandem Shaml',
		);
		foreach ( $programmes as $slug => $title ) {
			$page_id = get_page_by_title( $title );
			$anchor = '<a href="#">';
			if ( ! empty( $page_id ) ) {
				$anchor = exchange_create_link( BaseController::exchange_factory( $page_id ), false );
			}
			echo $anchor;
			include_once( $img_root . 'svg/T_logo_' . $slug . '_WEB.svg' );
			echo '</a>';
		} ?>

</figure>
