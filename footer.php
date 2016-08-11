		<footer class="page__footer" id="footer" role="contentinfo">
			<section class="page__footer__nav">
				<nav role="navigation">
					<?php exchange_footer_links(); ?>
				</nav>
			</section>
			<section class="page__footer__widgets">
				<svg class="section__edge--top" viewBox="0 0 840 20" preserveAspectRatio="none"><polygon points=" 0,20,0 10,13 12,22 13,27 11,27 12,31 12,37 10,46 13,46 12,54 12,62 13,70 12,77 13,86 10,89 11,91 11,98 11,106 13,106 12,115 13,119 10,128 11,128 10,135 11,136 12,142 12,149 13,156 12,156 13,157 13,159 11,166 11,167 13,174 13,183 13,191 12,191 12,200 10,207 13,212 13,216 11,224 10,233 13,241 10,246 13,255 11,261 11,268 13,274 10,279 10,288 13,289 10,292 10,296 11,301 12,309 12,314 11,319 12,321 10,328 11,334 13,339 12,343 11,346 11,347 12,355 10,362 11,364 11,366 10,371 10,371 11,372 10,372 12,374 11,380 12,381 10,384 11,391 11,400 13,404 11,410 11,413 11,417 10,426 13,430 10,437 10,444 12,444 12,451 13,456 11,459 11,467 10,475 11,482 11,487 10,496 10,500 13,506 12,510 13,519 13,523 10,526 12,527 10,531 11,538 11,544 12,544 10,544 10,545 10,548 12,548 10,551 12,552 10,554 11,562 11,566 11,569 12,573 10,575 13,584 13,592 11,601 12,607 12,612 11,615 11,624 12,631 12,634 12,637 11,641 12,649 11,650 11,652 13,652 13,656 10,661 13,668 10,670 10,676 10,680 13,684 12,687 13,691 10,692 11,696 11,698 10,704 13,708 10,709 11,711 11,714 12,715 12,717 10,724 13,725 10,732 12,740 10,740 13,740 10,747 13,751 10,751 12,752 10,752 10,761 13,762 12,769 10,778 12,778 11,783 12,788 12,796 10,804 12,804 13,811 12,814 10,820 10,821 10,821 11,825 12,834 11,838 10,844 20,850 20" fill="#f4c522"></polygon></svg>
				<?php get_template_part( 'parts/content', 'footer' ); ?>
				<svg class="section__edge--bottom" viewBox="0 0 840 20" preserveAspectRatio="none"><polygon points=" 0,20,0 10,13 12,22 13,27 11,27 12,31 12,37 10,46 13,46 12,54 12,62 13,70 12,77 13,86 10,89 11,91 11,98 11,106 13,106 12,115 13,119 10,128 11,128 10,135 11,136 12,142 12,149 13,156 12,156 13,157 13,159 11,166 11,167 13,174 13,183 13,191 12,191 12,200 10,207 13,212 13,216 11,224 10,233 13,241 10,246 13,255 11,261 11,268 13,274 10,279 10,288 13,289 10,292 10,296 11,301 12,309 12,314 11,319 12,321 10,328 11,334 13,339 12,343 11,346 11,347 12,355 10,362 11,364 11,366 10,371 10,371 11,372 10,372 12,374 11,380 12,381 10,384 11,391 11,400 13,404 11,410 11,413 11,417 10,426 13,430 10,437 10,444 12,444 12,451 13,456 11,459 11,467 10,475 11,482 11,487 10,496 10,500 13,506 12,510 13,519 13,523 10,526 12,527 10,531 11,538 11,544 12,544 10,544 10,545 10,548 12,548 10,551 12,552 10,554 11,562 11,566 11,569 12,573 10,575 13,584 13,592 11,601 12,607 12,612 11,615 11,624 12,631 12,634 12,637 11,641 12,649 11,650 11,652 13,652 13,656 10,661 13,668 10,670 10,676 10,680 13,684 12,687 13,691 10,692 11,696 11,698 10,704 13,708 10,709 11,711 11,714 12,715 12,717 10,724 13,725 10,732 12,740 10,740 13,740 10,747 13,751 10,751 12,752 10,752 10,761 13,762 12,769 10,778 12,778 11,783 12,788 12,796 10,804 12,804 13,811 12,814 10,820 10,821 10,821 11,825 12,834 11,838 10,844 20,850 20" fill="#f4c522"></polygon></svg>
			</section>
			<section class="page__footer__copyright">
				<p class="source-org copyright">&copy; <?php echo date('Y'); ?>
					<?php bloginfo('name');
						$page = get_option('options_imprint_page_link' );
						if ( ! empty( $page ) ) {
							echo '| ' . exchange_create_link( $page );
						} ?>
				</p>
			</section>
		</footer> <!-- end .footer -->
		<?php wp_footer(); ?>
		<script>
		(function( w ){
		if( w.document.documentElement.className.indexOf( "fonts-loaded" ) > -1 ){
			return;
		}
		var font1 = new w.FontFaceObserver( "Open Sans", {
		    weight: 300
		});
		var font2 = new w.FontFaceObserver( "Open Sans", {
		    weight: 300,
		    style: "italic"
		});
		var font3 = new w.FontFaceObserver( "Open Sans", {
			weight: 400
		});
		var font4 = new w.FontFaceObserver( "Open Sans", {
			weight: 400,
			style: "italic"
		});
		var font5 = new w.FontFaceObserver( "Open Sans", {
			weight: 600
		});
		var font6 = new w.FontFaceObserver( "Open Sans", {
			weight: 600,
			style: "italic"
		});
		var font7 = new w.FontFaceObserver( "Open Sans", {
			weight: 700
		});
		var font8 = new w.FontFaceObserver( "Open Sans", {
			weight: 700,
			style: "italic"
		});

		w.Promise
		    .all([
				font1.check(),
				font2.check(),
				font3.check(),
				font4.check(),
				font5.check(),
				font6.check(),
				font7.check(),
				font8.check()
			]).then(function(){
		        w.document.documentElement.className += " fonts-loaded";
		    });
		}( this ));
		</script>
	</body>
</html> <!-- end page -->
