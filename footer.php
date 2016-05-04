		<footer id="footer" role="contentinfo">
			<div class="inner-footer">
				<nav role="navigation">
					<?php exchange_footer_links(); ?>
				</nav>
			</div>
			<div class="copyright-footer">
				<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
			</div>
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
