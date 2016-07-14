<?php
/**
 * Story Loop Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 10/04/2016
 *
 * @package Exchange Plugin
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
};
$collab = new Collaboration( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<?php $image_class = $collab->has_header_image ? 'has-image' : 'no-image'; ?>
	<header class="article-header collaboration__header collaboration__header--<?php echo $image_class; ?>" data-equalizer data-equalize-on="large">
		<?php $collab->publish_header_image();?>
			<div class="collaboration__header__desc" data-equalizer-watch>
				<div class="collaboration__header__desc-inner">
					<h1 class="entry-title collaboration__title" itemprop="headline"><?php the_title(); ?></h1>
					<?php if ( $collab->description_length > 0 ) {
							$collab->description->publish('collaboration');
						} ?>
					<?php if ( ! empty( $collab->website ) ) : ?>
							<a class="button button--large" href="<?php echo esc_url( $collab->website ); ?>"><?php _e('project website','exchange'); ?></a>
							<hr>
						<?php endif; ?>
					<section class="collaboration__tags"><?php $collab->publish_tags('collaboration'); ?></section>
				</div>
			</div><!-- end description -->
		</div><!-- end description-wrapper -->
	</header> <!-- end article header -->
	<div class="entry-content collaboration__content" itemprop="articleBody">

	<?php if ( $collab->has_participants ) : ?>

		<section class="collaboration__participants">
			<div class="section-inner">

			<?php $participants = $collab->participants; ?>
			<?php foreach( $participants as $p_obj ) : ?>
				<?php include( locate_template( 'parts/content-participant.php' ) ); ?>
		 	<?php endforeach; ?>

			</div><!-- section-inner -->
		</section><!-- collaboration__participants -->

	<?php endif; ?>
	<section class="collaboration__map">
		<div class="section-inner">
		<?php $collab->publish_collab_map(); ?>
		</div>
	</section>
	<?php if ( $collab->has_gallery ) : ?>
		<section class="section collaboration__gallery">
				<div class="orbit" role="region" aria-label="<?php printf( esc_html__('Gallery for "%s"', 'exchange' ), get_the_title() ); ?>" data-orbit data-auto-play="false">
					<?php $collab->publish_gallery('collaboration'); ?>
				</div>
		</section>
	<?php endif; ?>
	<?php if ( $collab->has_participants && count ( $collab->participants ) > 1 ) : ?>

	<?php endif; ?>

	<?php if ( $collab->has_video ) : ?>
		<section class="section collaboration__video section--blue-1-web">
			<svg class="section__edge--top" viewBox="0 0 840 20" preserveAspectRatio="none"><polygon points=" 0,20,0 10,13 12,22 13,27 11,27 12,31 12,37 10,46 13,46 12,54 12,62 13,70 12,77 13,86 10,89 11,91 11,98 11,106 13,106 12,115 13,119 10,128 11,128 10,135 11,136 12,142 12,149 13,156 12,156 13,157 13,159 11,166 11,167 13,174 13,183 13,191 12,191 12,200 10,207 13,212 13,216 11,224 10,233 13,241 10,246 13,255 11,261 11,268 13,274 10,279 10,288 13,289 10,292 10,296 11,301 12,309 12,314 11,319 12,321 10,328 11,334 13,339 12,343 11,346 11,347 12,355 10,362 11,364 11,366 10,371 10,371 11,372 10,372 12,374 11,380 12,381 10,384 11,391 11,400 13,404 11,410 11,413 11,417 10,426 13,430 10,437 10,444 12,444 12,451 13,456 11,459 11,467 10,475 11,482 11,487 10,496 10,500 13,506 12,510 13,519 13,523 10,526 12,527 10,531 11,538 11,544 12,544 10,544 10,545 10,548 12,548 10,551 12,552 10,554 11,562 11,566 11,569 12,573 10,575 13,584 13,592 11,601 12,607 12,612 11,615 11,624 12,631 12,634 12,637 11,641 12,649 11,650 11,652 13,652 13,656 10,661 13,668 10,670 10,676 10,680 13,684 12,687 13,691 10,692 11,696 11,698 10,704 13,708 10,709 11,711 11,714 12,715 12,717 10,724 13,725 10,732 12,740 10,740 13,740 10,747 13,751 10,751 12,752 10,752 10,761 13,762 12,769 10,778 12,778 11,783 12,788 12,796 10,804 12,804 13,811 12,814 10,820 10,821 10,821 11,825 12,834 11,838 10,844 20,850 20" fill="#dceff0"></polygon></svg>
			<div class="section-inner">
				<div class="section__sectionheader">
					<div class="sectionheader-inner">
						<h4><?php _e( 'Collaboration video','exchange' ); ?></h4>
					</div>
				</div>
				<?php $collab->publish_video(); ?>
			</div>
		</section>
	<?php endif; ?>
	<section class="collaboration__stories">
		<?php $collab->publish_related_stories(); ?>
	</section>

		<?php
		// Loop through sections.
		$collab->publish_sections();
		?>
	</div> <!-- end articleBpdy -->


	<footer class="article-footer collaboration__footer">

	</footer> <!-- end article footer -->

</article> <!-- end article -->
<div class="article-related-content collaboration__extras">
	<?php $collab->publish_related_content('collaboration'); ?>
</div>
