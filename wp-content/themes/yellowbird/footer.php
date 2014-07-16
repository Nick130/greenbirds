<?php

	// set options
	$footerstyle = get_option('mytheme_footerstyle');
	$footernav = get_option('mytheme_copyrightnav');
	$footernavarg = array(
		'menu_id' => 'footer-menu',
		'before' => '<span class="separate">/</span>',
		'theme_location' => 'footer_menu'
	);

	if ( is_page() || ( class_exists('Woocommerce') && is_woocommerce() ) ) {
		$pagefooterstyleonoff = get_post_meta($post->ID, 'pagefooterstyleonoff', true);
		if ( class_exists('Woocommerce') && is_woocommerce() ) {
			$pagefooterstyleonoff = get_post_meta(woocommerce_get_page_id('shop'), 'pagefooterstyleonoff', true);
		}
	}
?>

			</div><!-- #main -->

			<?php // start footer
			if (get_option('mytheme_footeronoff')!='false') {  ?>

			<!-- Footer
			================================================== -->
			<footer id="footer-wrapper">

				<?php // widget section
				if (get_option('mytheme_footerstyleonoff')!='false') { if (empty($pagefooterstyleonoff) || $pagefooterstyleonoff!='false') { ?>
				<div class="footer-top-wrapper">
					<div class="container_12">
						<div class="footer-item <?php if ($footerstyle == "style1" || $footerstyle == "style3" || $footerstyle == "style4") { echo "grid_3"; } elseif ($footerstyle == "style2") { echo "grid_6"; } elseif ($footerstyle == "style5" || $footerstyle == "style7") { echo "grid_4"; } elseif ($footerstyle == "style6") { echo "grid_8"; } else { echo "grid_12"; } ?>">
						  <?php if (!dynamic_sidebar('footer-1')) : ?>
							 <!-- widgetized footer 1 -->
						  <?php endif ?>
						</div>

						<div class="footer-item <?php if ($footerstyle == "style1" || $footerstyle == "style2" || $footerstyle == "style3") { echo "grid_3"; } elseif ($footerstyle == "style4") { echo "grid_6"; } elseif ($footerstyle == "style5" || $footerstyle == "style6") { echo "grid_4"; } elseif ($footerstyle == "style7") { echo "grid_8"; } else { echo "display-none"; } ?>">
						  <?php if (!dynamic_sidebar('footer-2')) : ?>
							 <!-- widgetized footer 2 -->
						  <?php endif ?>
						</div>

						<div class="footer-item <?php if ($footerstyle == "style1" || $footerstyle == "style2" || $footerstyle == "style4") { echo "grid_3"; } elseif ($footerstyle == "style3") { echo "grid_6"; } elseif ($footerstyle == "style5") { echo "grid_4"; } else { echo "display-none"; } ?>">
						  <?php if (!dynamic_sidebar('footer-3')) : ?>
							 <!-- widgetized footer 3 -->
						  <?php endif ?>
						</div>

						<div class="footer-item <?php if ($footerstyle == "style1") { echo "grid_3"; } else { echo "display-none"; } ?>">
						  <?php if (!dynamic_sidebar('footer-4')) : ?>
							 <!-- widgetized footer 4 -->
						  <?php endif ?>
					   </div>
					</div>
				</div><!-- #footer-top-wrapper -->
				<?php } } ?>

				<?php // copyright section
				if (get_option('mytheme_copyrightonoff')!='false') {  ?>

				<!-- Copyright
				================================================== -->
				<div class="footer-bot-wrapper">
					<div id="copyright" class="container_12">

					<?php if (get_option('mytheme_copyright')=='middle') { /* set middle or left-right style */?>
					<div class="copmiddle grid_12">
						<?php echo do_shortcode(stripcslashes(get_option('mytheme_copyrightmiddle')));
						// get menu
						if ( $footernav == 'middle' ) { wp_nav_menu( $footernavarg ); } ?>
					</div>
					<?php } else { ?>
					<div class="copleft">
						<?php echo do_shortcode(stripcslashes(get_option('mytheme_copyrightleft')));
						// get menu
						if ( $footernav == 'left' ) { wp_nav_menu( $footernavarg ); } ?>
					</div>
					<div class="copright">
						<?php echo do_shortcode(stripcslashes(get_option('mytheme_copyrightright')));
						// get menu
						if ( $footernav == 'right' ) { wp_nav_menu( $footernavarg ); } ?>
					</div>
					<?php } ?>

					</div>
				</div><!-- #footer-bot-wrapper -->
				<?php } ?>

			</footer><!-- #footer-wrapper -->
			<?php } ?>

			<?php if ( get_option('mytheme_backtotoponoff') != 'false' ) {  ?>

			<!-- Back-to-top
			================================================== -->
			<div id="backtotop">
				<span class="icon icon-arrow-up10"></span>
			</div>
			<?php } ?>

		</div><!-- .body-wrapper -->
	</div><!-- .body-background -->

	<?php wp_footer(); ?>

</body>
</html>