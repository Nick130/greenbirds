<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<!-- Basic meta tags
	================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="keywords" content="<?php wp_title(); echo ' , '; bloginfo('name'); echo ' , '; bloginfo('description'); ?>" />
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo('description'); ?>" />
	<meta name="author" content="" />
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
	
	<title><?php // Create page title based page content
	if ( is_tag() ) { echo 'Tag Archive for &quot;'.$tag.'&quot; | '; bloginfo('name');
	} elseif ( is_archive() ) { wp_title(); echo ' Archive | '; bloginfo('name');
	} elseif ( is_search() ) { echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo('name');
	} elseif ( is_home() ) { bloginfo( 'name' ); echo ' | '; bloginfo('description');
	} elseif ( is_404() ) { echo 'Error 404 Not Found | '; bloginfo('name');
	} else { echo wp_title( ' | ', false, 'right' ); bloginfo('name');
	} ?></title>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- Favicon
	================================================== -->
	<?php $faviconimageonoff = get_option('mytheme_faviconimageonoff'); $favicon = wp_get_attachment_image_src(get_option('mytheme_faviconimage'), 'full'); ?>
	<link rel="shortcut icon" href="<?php if ($faviconimageonoff=='true' && $favicon) echo $favicon[0]; else echo get_template_directory_uri().'/favicon.ico'; ?>" type="image/x-icon" />
	
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>
	<div class="body-background">
		<div class="body-wrapper<?php if (get_option('mytheme_themestyle')=='boxed') { echo ' boxed'; } ; ?>">
			<header id="header">

				<!-- Top bar
				================================================== -->
				<div id="topbar-wrapper" class="row">
					<div class="container_12">
						<?php if (get_option('mytheme_topbaronoff')=='true') { ?>
						<div id="topbar" class="grid_12">
							<?php if (get_option('mytheme_topbarnavonoff')=='true') { ?><div class="floatleft"><?php wp_nav_menu( array( 'menu_id' => 'top-nav', 'before' => '<span class="separate">|</span>', 'theme_location' => 'top_menu' )); ?></div><?php } ?>
							<?php if (get_option('mytheme_topbartext')) { ?><div class="floatright"><?php echo get_option('mytheme_topbartext'); ?></div><?php } ?>
						</div>
						<?php } ?>
					</div>
				</div><!-- #top-bar-wrapper -->
      
				<div class="row menu-container <?php echo get_option('mytheme_mainnavclass'); ?>">
					<div class="container_12">
						<div class="grid_12">

							<!-- Logo
							================================================== -->
							<div id="logo-wrapper" class="floatleft">
								<?php // get logo
								$logoimage = get_option('mytheme_logoimage');
								$logowidth = get_option('mytheme_logowidth');
								$logoheight = get_option('mytheme_logoheight');
								if (!empty($logoimage)) { 
									if ($logowidth!='' && $logoheight!='') $logoimage = wp_get_attachment_image_src($logoimage, $logowidth.'x'.$logoheight); 
									else $logoimage = wp_get_attachment_image_src($logoimage, 'full');
									$logoimage = $logoimage[0];
								}
								if(get_option('mytheme_logoimageonoff')=='true' && !empty($logoimage)){ ?>
								<a href="<?php echo site_url(); ?>"><img src="<?php echo $logoimage; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } ?>
							</div><!-- #logo-wrapper -->

							<!-- Menu
							================================================== -->
							<div id="menu-wrap">
								<nav id="menu-wrapper">
									<div class="<?php echo get_option('mytheme_mainnavmenualign'); ?>">
									<?php // get menu
									if (has_nav_menu('main_menu')) {
										wp_nav_menu( array(
										'container'       => 'ul', 
										'menu_class'      => 'sf-menu', 
										'menu_id'         => 'main-nav',
										'depth'           => 0,
										'link_before'     => '',
										'link_after'      => '',
										'theme_location'  => 'main_menu',
										'walker'          => new description_walker(),
										)); 
									} ?>
									</div>
								</nav><!-- #menu-wrapper -->
							</div><!-- #menu-wrap -->
	
						</div>
					</div>
				</div>
			
			</header><!-- #header -->
			
			<?php // get slogan 
			if (is_page() || (class_exists('Woocommerce') && is_woocommerce())) {
				$pagesloganonoff = get_post_meta($post->ID, 'pagesloganonoff', true);
				if (class_exists('Woocommerce') && is_woocommerce()) {
					$pagesloganonoff = get_post_meta(woocommerce_get_page_id('shop'), 'pagesloganonoff', true);
				}
			}
			if (get_option('mytheme_sloganonoff')=='true') { if (empty($pagesloganonoff) || ($pagesloganonoff!='false')) { ?>

			<!-- Slogan
			================================================== -->
			<div id="slogan-wrapper">
				<div id="slogan" class="container_12">
					<?php if (get_option('mytheme_slogancontrolonoff')=='true') { ?>
					<div class="slogan-control">
						<div class="slogan-next"></div><div class="slogan-prev"></div>
					</div>
					<?php } ?>
					<div class="slogan grid_12">
						<ul>
						<?php $slogans = explode("|",get_option('mytheme_slogan'));
						if ($slogans) {
							foreach ( $slogans as $slogan ) { echo '<li>'.stripslashes($slogan).'</li>'; }
						} ?>
						</ul>
					</div>
				</div>
			</div><!-- #slogan-wrapper -->
			<?php } } ?>
			
			<?php // get breadcrumb
			if (is_page() || (class_exists('Woocommerce') && is_woocommerce())) {
				$pagebreadcrumbonoff = get_post_meta($post->ID, 'pagebreadcrumbonoff', true);
				if (class_exists('Woocommerce') && is_woocommerce()) {
					$pagebreadcrumbonoff = get_post_meta(woocommerce_get_page_id('shop'), 'pagebreadcrumbonoff', true);
				}
			}
			if (get_option('mytheme_breadcrumbonoff')=='true') { if (empty($pagebreadcrumbonoff) || ($pagebreadcrumbonoff!='false')) { ?>
			
			<!-- Breadcrumb
			================================================== -->
			<div id="breadcrumb-wrapper">
				<div id="breadcrumb" class="container_12 <?php echo get_option('mytheme_breadcrumbalign'); ?>">
				<?php if (class_exists('Woocommerce')) do_action( 'my_woocommerce_breadcrumb'); elseif (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
				</div>
			</div><!-- #breadcrumb-wrapper -->
			<?php } } ?>
			
			<?php // get slider.php when it is under menu
			$slider = main_slider();
			if ($slider[0]!='bgstretcher') get_template_part('slider'); ?>
			
			<div id="main"<?php if (is_page() && get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-one.php' ) echo 'class="pt0"'; ?>>