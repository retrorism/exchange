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

$story = new Story( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">

	<header class="article-header story__header">

		<?php if ( $story->has_header_image ) {
			$story->publish_header_image();
		 } ?>

		<div class="story__header__introduction">

			<div class="story__title-wrapper">

				<h1 class="entry-title story__title" itemprop="headline"><?php the_title(); ?></h1>

			</div>

			<?php if ( $story->has_editorial_intro ) {
				$story->publish_intro();
			} ?>

		</div>

	</header> <!-- end .story__header -->
	<div class="asides-wrapper">
		<div class="story__meta-wrapper" data-sticky-container>
			<aside class="article-meta story__meta sticky" data-sticky data-sticky-on="xlarge" data-anchor="article-body">
				<div class="story__meta-inner">
					<section class="story__meta__category"><?php echo $story->category; ?></section>
					<section class="story__meta__date"><?php echo mysql2date('F jS, Y', $story->date ); ?></section>
					<section class="story__meta__tags"><?php $story->publish_tags('story__meta') ?></section>
				</div>
			</aside>
		</div>
	</div>


	<div id="article-body" class="entry-content story__content" itemprop="articleBody">

		<?php
		// Loop through sections.
		$story->publish_sections();
		?>
	</div> <!-- end article -->

	<footer class="article-footer story__footer">
		<?php $story->publish_byline( 'story__footer' ); ?>
		<?php $story->publish_tags( 'story__footer' ); ?>

		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'exchange' ) . '</span> ', ', ', ''); ?></p>
	</footer> <!-- end article footer -->

</article> <!-- end article -->

<div class="article-related-content story__extras">
	<?php $story->publish_related_content('story'); ?>
</div>

<?php if ( $story->has_gallery ) : ?>
 	<a data-open="story__modal--gallery">Gallery</a>
	<section class="story__modal--gallery full reveal" role="dialog" id="story__modal--gallery" aria-describedby="description" data-reveal>
		<button class="modal__button--close" data-close aria-label="Close reveal" type="button">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 63.149948 63.15"><defs><clipPath id="a"><path d="M-100-100L350.05 0h.05L320 300 0 40z"/></clipPath></defs><g clip-path="url(#a)" transform="matrix(.88 .88 .88 -.88 -153.68 -144.55)"><path d="M179.8807 6.7076s-.0345-.572.196-.785c.1825-.1686.6512-.2922.776-.5302.1366-.2606.4985-.3114.725-.4625.2408-.161.8322-.25.8322-.25.344-.153.94-.1224 1.56-.1194.16.018.3606-.4884.4806-.1204.338.1.31-.1705.6-.1205.295-.015.5762-.0175.7192.1205.097-.023.1197-.1205.2397-.1205.022-.136.1204-.066.1204.001.28-.003.3533.2055.7203.1195.277-.04.46.0204.6.1204.335-.144.8272-.1324 1.3202-.1204.277.04.46-.0205.6-.1205.05-.178.1532.047.3602 0l.359.001c.022-.136.1205-.068.1205-.001h.7203c-.087-.195.5645-.195.4795 0 .214-.015.2527.1475.4807.1205.036-.163.2995-.0994.4795-.1194.214.015.2515-.1485.4795-.1215.405.033.689.1904 1.201.1204.015-.018.3895-.2273.4795-.1193.005.007-.007.1193 0 .1193.198.018.4-.012.6.001.47.07.695-.1037.959-.2407.28.04.4964.1447.7214.2397h1.7987c.052.174.1048-.012.2408 0 .003.117.146.0935.24.1205.338-.1.7393-.1398 1.0793-.2398l.8408-.001c.028-.15.237-.119.24.001h.36c.366.087.3513-.2074.7193-.1204.052.175.106-.013.241 0 .096-.022.1196-.1205.2396-.1205.107.036.229.0582.3502.0807-.0028-.0062-.0038-.0138-.0067-.02-.103-.384.1898-.3718.2398-.5998.04-.28-.0193-.463-.1193-.601-.034-.195.1144-.206.1204-.359-.023-.098-.1204-.12-.1204-.24 0-.24.3267-.1535.2397-.4805-.14-.02-.0993-.2203-.1193-.3603-.023-.098-.1204-.1197-.1204-.2397-.334.053.0942-.655-.2398-.6-.003-.284.2063-.3543.1193-.7203-.14-.02-.0993-.2202-.1193-.3602l-.001-.359c-.018-.098-.1264-.121-.1194-.241 0 .015.1153-.0453.1193-.1193.002-.03-.0118-.0954.0012-.1204.025-.055.2198-.0774.2398-.1205.03-.067-.023-.1686 0-.2386-.326.085.0862-.5676-.2398-.4806v-.7203c.3-.018.035-.4065 0-.4795l-.001-.6c-.07-.432.1408-.5796.2408-.8396-.005-.396-.2023-.5986-.1193-1.0806-.118-.144-.0832-.207-.0012-.359.028-.052.2198-.0775.2398-.1205.03-.067-.023-.1708 0-.2408-.02-.34-.2186-.4997-.2386-.8397-.096-.417.1793-.4617.1193-.8397-.126-.276-.0758-.725-.2398-.96-.1-.34.1693-.3132.1193-.6012.178-.054-.047-.153.0012-.359-.214-.09-.017-.22 0-.36l-.0012-.9602c.02-.14-.0264-.2138-.1204-.2398.093-.107.1305-.2726.1205-.4806-.095-.108-.1263-.2715-.1193-.4795.007-.216.1293-.2546.1193-.4796.02-.3-.1877-.372-.2397-.6-.122-.158-.1168-.443-.2398-.6.13-.43.186-.9332.359-1.3202.016-.217-.1452-.2535-.1192-.4795.093-.108.1304-.2726.1204-.4806.087-.368-.2074-.3532-.1204-.7192.01-.17.0196-.3413-.1204-.3613-.02-.14.0264-.2147.1204-.2397.087-.368.1495-.1515.2365-.5175.01-.17.3618-.0188.3618-.0188.01-.0685.6552-.0436.6353-.0826l.6704.3834.3978.6122.4032.2412.296.5.359.443c.153.344.1234.939.1204 1.559-.018.16.4874.3596.1194.4796-.1.338.1704.31.1204.6.015.295.0176.5784-.1204.7214.023.097.1204.1198.1204.2398.136.022.067.1193 0 .1193.003.28-.2053.3533-.1193.7203.04.277-.0204.46-.1204.6.144.335.1314.826.1194 1.319-.04.277.0204.46.1204.6.178.05-.047.1532 0 .3602v.3602c.136.022.066.1204-.001.1204l.001.7194c.195-.087.194.5656-.001.4806.015.214-.1464.2515-.1194.4795.163.036.1004.3006.1204.4806-.015.214.1464.2516.1194.4796-.033.405-.1894.688-.1194 1.2.018.015.2285.3905.1205.4805-.007.005-.1216-.007-.1216 0-.018.198.014.4.001.6-.07.47.103.6962.24.9602-.04.28-.145.4942-.24.7192v1.801c-.174.052.011.1037-.001.2397-.117.003-.0912.1458-.1182.2398.1.338.1387.7406.2387 1.0806V2.1c.15.028.121.2368.001.2398V2.7c-.087.366.2064.3524.1194.7204-.175.052.013.1036 0 .2386.022.096.1193.121.1193.241-.007.0208-.009.047-.0156.0684.0115-.0025.0198-.0082.0332-.009.17.01.3402.0208.3602-.1192.295.015.5772.0176.7192-.1204h1.0806c.106-.093.2695-.1293.4795-.1193.03.13.2378.0817.2398.2397.133-.04.3067-.1877.4807-.2397.11-.033.246.023.359-.001.097-.02.121-.1194.241-.1195.298.1.6413.1575 1.0793.1205.77-.15 1.7648-.0752 2.3998-.3602.444-.085.514.2054.96.1204l.6-.001c.052-.107.1048-.2138.2398-.2398.002.116.1468.0922.2408.1192-.023.102.0465.1144.1205.1204.19.01.4554-.0566.4784.1204.19.01.4577-.0575.4807.1205.17-.01.3402-.0207.3602.1193.192.034.206-.1123.36-.1193.194-.01.2052.0933.3602.1193.47-.013.8477-.1904 1.4397-.1204.035.004.2196-.024.2396.001.005.007-.007.1194 0 .1194.088.01.126-.1193.241-.1193.096 0 .1185.1373.2385.1193.288.05.2612-.2193.6012-.1193.078.36.2545-.115.4795 0-.022-.26.425-.0545.6-.1205.176.14.2994.14.4794 0 .288.05.2612-.2193.6012-.1193.028-.212.2055-.2738.4795-.2408.028-.21.2056-.273.4806-.24.096-.104.327-.0697.359-.2397l1.201-.001c.075-.244.56-.079.6-.359.295.016.5762.0174.7192-.1206.297-.018.37.1898.6.2398.223.016.4006.0797.4806.2397.366-.086.4353.1235.7193.1205.326-.087.2406.2377.4807.2397-.006.205.0897.3113.2397.3613-.017.296-.0196.5773.1204.7193-.032.37-.262.5397-.36.8397.008.408-.354.447-.6.6-.055.346-.517.2838-.6.5998-.104.097-.0738.3282-.2408.3602-.03.13-.2397.0818-.2397.2398-.426.055-.694.2678-1.2.2408-.28-.038-.4598.0205-.5998.1205-.107-.094-.2715-.1316-.4795-.1216-.02.14-.2202.1036-.3602.1216-.02.14-.2202.1013-.3602.1193-.245.035-.2355.3243-.4795.3603-.268-.093-.4708-.2518-.8408-.2398-.373-.012-.5737.1457-.8397.2387-.217 0-.2525-.1264-.4795-.1194-.193.006-.2102.0814-.3602.1194-.408-.113-.8802-.1598-1.3202-.2398-.555-.044-.692-.148-1.2 0-.33.087-.2435-.2377-.4805-.2397-.216.016-.2535-.1454-.4795-.1194h-.7203c.085.194-.5666.194-.4796 0-.29-.05-.26.2205-.6.1205.085.326-.5665-.0874-.4795.2386-.38.058-.2724-.3666-.7204-.2386l-.8407-.001c-.384.103-.372-.19-.6-.24-.34.1-.3098-.1703-.5998-.1203-.548-.068-.7483.2134-1.3203.1204.02.26-.426.0542-.599.1192-.216-.016-.2545.1465-.4805.1205h-1.6794c-.41.11-.8598.18-1.1998.36l-.4806.0012c-.14.02-.214-.0275-.24-.1205-.2515-.0026-.3462.1506-.6164.1282v.2917c-.034.193.1134.205.1204.359-.01.17-.0207.3402.1193.3602-.015.295-.0186.5784.1194.7204l.001 1.0794c.093.106.1305.2706.1205.4806-.13.03-.0817.2378-.2397.2398.04.133.1877.3066.2397.4806.033.11-.025.246-.001.359.02.097.1203.1198.1203.2398-.1.298-.1563.6426-.1193 1.0806.15.77.074 1.7658.359 2.4008.085.444-.2042.513-.1192.959v.601c.107.052.2137.105.2397.2398-.116.002-.0934.1458-.1204.2398-.102-.023-.1133.0453-.1193.1193-.01.19.0565.4576-.1205.4806-.01.19.0587.4566-.1193.4796.01.17.0196.3413-.1204.3613-.034.192.1134.205.1204.359.01.194-.0944.204-.1204.359.013.47.1893.8488.1193 1.4408-.004.035.0262.2198.0012.2398-.007.005-.1204-.006-.1204.001-.01.088.1204.1248.1204.2398 0 .096-.1384.1198-.1204.2398-.05.288.2204.26.1204.6-.36.078.115.2544 0 .4794.26-.022.0533.426.1193.601-.14.176-.14.2996 0 .4796-.05.288.2205.26.1205.6.212.028.2727.2065.2397.4805.21.028.2728.2034.2398.4784.104.096.0697.3294.2397.3614v1.2c.244.075.0813.5598.3613.5998-.016.295-.0187.5774.1193.7204.018.297-.1897.37-.2397.6-.016.223-.0808.3994-.2408.4794.086.366-.1223.4364-.1193.7204.087.326-.239.2395-.241.4795-.205-.006-.309.0897-.359.2397-.296-.017-.5784-.0207-.7204.1193-.37-.032-.5408-.261-.8408-.359-.408.008-.447-.354-.6-.6-.346-.055-.284-.517-.6-.6-.097-.104-.327-.0727-.359-.2397-.13-.03-.0817-.2398-.2397-.2398-.055-.426-.2678-.6938-.2408-1.1998.038-.28-.0193-.461-.1193-.601.094-.107.1292-.2716.1192-.4796-.14-.02-.1013-.22-.1193-.36-.14-.02-.1025-.2192-.1205-.3592-.035-.245-.323-.2366-.359-.4806.093-.268.2517-.4708.2397-.8408.012-.373-.148-.5737-.241-.8397 0-.217.1275-.2536.1205-.4806-.006-.193-.0824-.209-.1204-.359.113-.408.1598-.8802.2398-1.3202.044-.555.148-.692 0-1.2-.087-.33.239-.2424.241-.4794-.016-.216.1463-.2546.1203-.4806l-.001-.7193c-.194.085-.193-.5676.001-.4806.05-.29-.2204-.26-.1204-.6-.326.085.085-.5666-.241-.4796-.058-.38.369-.2723.241-.7203v-.8396c-.103-.384.1897-.372.2397-.6-.1-.34.1704-.31.1204-.6.068-.548-.2133-.7482-.1203-1.3202-.26.02-.0555-.427-.1205-.6.016-.216-.1453-.2534-.1193-.4794v-1.6816c-.11-.41-.1803-.86-.3603-1.2V8.82c-.02-.14.0275-.2137.1205-.2397.003-.284-.2065-.3532-.1205-.7192.0206-.0902.0196-.16.0144-.2243-.2174.0363-.4274.0816-.5987.1635-.384.103-.372-.1897-.6-.2397-.28-.04-.4608.0193-.5988.1193-.195.034-.2072-.1133-.3602-.1193-.098.023-.121.1193-.2408.1193-.24 0-.1526-.3257-.4796-.2387-.02.14-.2202.0993-.3602.1193-.098.023-.1198.1204-.2398.1204.053.334-.655-.0942-.6.2398-.284.003-.3532-.2075-.7192-.1205-.02.14-.2213.1005-.3613.1205l-.359-.0012c-.098.018-.1198.1275-.2398.1205.015 0-.0464-.1165-.1204-.1205-.03-.002-.0955.0142-.1205.0012-.055-.025-.0763-.221-.1193-.241-.067-.03-.1708.023-.2408 0 .085.326-.5666-.085-.4796.241h-.7202c-.018-.3-.4065-.035-.4795 0l-.6-.0012c-.432.07-.5808-.1397-.8408-.2397-.396.005-.5974.2034-1.0794.1204-.144.118-.208.082-.36 0-.052-.028-.0775-.2197-.1205-.2397-.067-.03-.1687.023-.2387 0-.34.02-.5008.2197-.8408.2397-.417.096-.4616-.1793-.8396-.1193-.276.126-.7252.0758-.9602.2398-.34.1-.312-.1705-.6-.1205-.054-.178-.154.048-.36 0-.09.214-.2203.017-.3603 0h-.959c-.14-.02-.215.0253-.241.1193-.107-.093-.2715-.1293-.4795-.1193-.108.095-.2726.1275-.4806.1205-.216-.007-.2557-.1305-.4807-.1205-.3-.02-.372.1878-.6.2398-.158.122-.4428.1167-.5998.2397-.43-.13-.9322-.1872-1.3192-.3602-.217-.016-.2547.1465-.4807.1205-.108-.093-.2715-.1293-.4795-.1193-.368-.087-.3542.2063-.7202.1193-.17-.01-.339-.0196-.359.1204-.14.02-.216-.0253-.241-.1193-.368-.087-.3543.2062-.7203.1192-.17-.01-.308-.3765-.328-.2365-.371-.2304-.207-.357-.078-.5614.12-.1898.175-.664.1572-.6547z" fill="#ffc400" fill-rule="evenodd"/></g></svg>
  		</button>
		<div class="orbit" role="region" aria-label="<?php printf( esc_html__('Gallery for "%s"', 'exchange' ), get_the_title() ); ?>" data-orbit data-auto-play="false">
			<?php $story->publish_gallery( 'lightbox' ); ?>
		</div>
	</section>
<?php endif; ?>
