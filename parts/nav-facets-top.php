		
<div class="archive__facets--top">
	<nav>
		<div class="archive__facets__search">
			<?php echo facetwp_display( 'facet', 'search' ); ?>
			<div class="archive__facets__search__toggler">
				<a class="show-filters" data-toggle="main"><?php _e( 'Show Filters','exchange'); ?></a>
				<a class="hide-filters" data-toggle="main"><?php _e( 'Hide Filters','exchange'); ?></a>
			</div>
		</div>
		<ul class="archive__facets__view-switcher" data-tabs id="facet-tabs">
			<li class="tabs-title is-active"><a href="#facets-grid" aria-selected="true">Tab 1</a></li>
			<li class="tabs-title"><a href="#facets-map">Tab 2</a></li>
		</ul>
	</nav>
</div>