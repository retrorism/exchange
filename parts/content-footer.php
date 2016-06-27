<?php
/**
 * Footer Content Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 24/05/2016
 *
 * @package Exchange Plugin
 **/
// Exit if accessed directly.
?>
<div class="page__footer__widgets-inner">
	<?php if ( is_active_sidebar('footer-1' ) ) : ?>
		<div class="footer__widget-wrapper">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar('footer-2' ) ) : ?>
		<div class="footer__widget-wrapper col">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar('footer-3' ) ) : ?>
		<div class="footer__widget-wrapper">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar('footer-4' ) ) : ?>
		<div class="footer__widget-wrapper">
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>
	<?php endif; ?>
</div>
