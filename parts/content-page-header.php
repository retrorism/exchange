<?php
/**
 * Page Header Content Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 15/08/2016
 *
 * @package Exchange Plugin
 **/
// Exit if accessed directly.
?>
<header class="article-header story__header">

	<?php if ( $exchange->has_header_image ) {
		$exchange->publish_header_image('story__header');
	 } ?>

	<div class="story__header__introduction">

		<div class="story__title-wrapper">
			<?php
				$hide_title_class = '';
				if ( 'Programmes' !== $exchange->title ) {
					$programmes = get_page_by_title( 'Programmes' );
					if ( $post->post_parent === $programmes->ID ) {
						get_template_part( 'parts/content', 'page-programme' );
						$hide_title_class = ' show-for-sr';
					};
				}; ?>
			<h1 class="entry-title story__title<?php echo $hide_title_class; ?>" itemprop="headline"><?php echo $exchange->title; ?></h1>

		</div>

		<?php if ( $exchange->has_editorial_intro ) {
			$exchange->publish_intro();
		} ?>

		<?php
			if ( $exchange->title === 'Programmes' ) {
				get_template_part( 'parts/content', 'page-programmes' );
			} ?>

	</div>

</header> <!-- end .story__header -->
