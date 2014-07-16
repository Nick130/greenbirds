<?php

/*-----------------------------------------------------------------------------------*/
/*	Add scripts to theme
/*-----------------------------------------------------------------------------------*/


if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
	
	if ( ! is_admin() ) {
		
		// register scripts for front-end
		function custom_front_end_script() {
	
			global $cssstatic, $inline_css;
			$slider = main_slider();
			
			wp_enqueue_style('reset', get_template_directory_uri().'/css/reset.css', false, null);
			wp_enqueue_style('960', get_template_directory_uri().'/css/960.css', false, null);
			wp_enqueue_style('superfish', get_template_directory_uri().'/css/superfish.css', false, null);
			wp_enqueue_style('prettyPhoto', get_template_directory_uri().'/css/prettyPhoto.css', false, null);
			wp_enqueue_style('tipsy', get_template_directory_uri().'/css/tipsy.css', false, null);
			wp_enqueue_style('icomoon', get_template_directory_uri().'/css/icomoon.css', false, null);
			wp_enqueue_style('style', get_stylesheet_uri(), false, null);
			
			if ( get_option('mytheme_themeskin') != '' ) {
				wp_enqueue_style('themeskin', get_template_directory_uri().'/css/skins/'.get_option('mytheme_themeskin').'.css', false, null);
			}
			if ( get_option('mytheme_responsiveonoff') == 'true' ) {
				wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css', false, null);
			}
			if ( $cssstatic == 'true' ) {
				wp_enqueue_style('options', get_template_directory_uri().'/css/options.css', false, null);
			} else {
				wp_enqueue_style('options', get_template_directory_uri().'/includes/misc/options.php', false, null);
			}
			
			// add inline styles
			wp_add_inline_style('style', $inline_css);
			
				
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('hoverIntent');
			wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), null, true);
			wp_enqueue_script('supersubs', get_template_directory_uri().'/js/supersubs.js', array('jquery'), null, true);
			wp_enqueue_script('prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), null, true);
			wp_enqueue_script('nivo', get_template_directory_uri().'/js/jquery.nivo.slider.pack.js', array('jquery'), null, true);
			
			if ( $slider[0] == 'nivo' ) {
				wp_localize_script('nivo', 'nivo_setting', main_slider_options());
			} elseif ( $slider[0] == 'kwicks' ) {
				wp_enqueue_script('kwicks', get_template_directory_uri().'/js/jquery.kwicks-1.5.1.js', array('jquery'), null, true);
				wp_localize_script('kwicks', 'kwicks_setting', main_slider_options());
			} elseif ( $slider[0] == 'showcase' ) {
				wp_enqueue_script('showcase', get_template_directory_uri().'/js/jquery.aw-showcase.min.js', array('jquery'), null, true);
				wp_localize_script('showcase', 'showcase_setting', main_slider_options());
			} elseif ( $slider[0] == 'cycle' ) {
				wp_enqueue_script('cycle', get_template_directory_uri().'/js/jquery.cycle.all.js', array('jquery'), null, true);
				wp_localize_script('cycle', 'cycle_setting', main_slider_options());
			} elseif ( $slider[0] == 'roundabout' ) {
				wp_enqueue_script('roundabout', get_template_directory_uri().'/js/jquery.roundabout.min.js', array('jquery'), null, true);
				wp_enqueue_script('roundabout-shapes', get_template_directory_uri().'/js/jquery.roundabout-shapes.min.js', array('jquery'), null, true);
				wp_localize_script('roundabout', 'roundabout_setting', main_slider_options());
			} elseif ( $slider[0] == 'liteaccordion' ) {
				wp_enqueue_script('liteaccordion', get_template_directory_uri().'/js/liteaccordion.jquery.min.js', array('jquery'), null, true);
				wp_localize_script('liteaccordion', 'liteaccordion_setting', main_slider_options());
			} elseif ( $slider[0] == 'tm' ) {
				wp_enqueue_script('tm', get_template_directory_uri().'/js/tms-0.4.1.js', array('jquery'), null, true);
				wp_localize_script('tm', 'tm_setting', main_slider_options());
			} elseif ( $slider[0] == 'bgstretcher' ) {
				wp_enqueue_script('bgstretcher', get_template_directory_uri().'/js/bgstretcher.js', array('jquery'), null, true);
				wp_localize_script('bgstretcher', 'bgstretcher_setting', main_slider_options());
			}
			
			wp_enqueue_script('Masonry', get_template_directory_uri().'/js/jquery.masonry.min.js', array('jquery'), null, true);
			wp_enqueue_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'), null, true);
			wp_enqueue_script('carouFredSel', get_template_directory_uri().'/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), null, true);
			wp_enqueue_script('parallax', get_template_directory_uri().'/js/jquery.parallax-1.1.3.js', array('jquery'), null, true);
			wp_enqueue_script('placeholder', get_template_directory_uri().'/js/jquery.html5-placeholder-shim.js', array('jquery'), null, true);
			wp_enqueue_script('countTo', get_template_directory_uri().'/js/jquery.countTo.js', array('jquery'), null, true);
			wp_enqueue_script('tipsy', get_template_directory_uri().'/js/jquery.tipsy.js', array('jquery'), null, true);
			wp_enqueue_script('custom', get_template_directory_uri().'/js/jquery.custom.js', array('jquery'), null, true);
			if ( get_option('mytheme_mainnavstickyonoff') == 'true' ) {
				wp_enqueue_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), null, true);
			}
			wp_enqueue_script('cufon', get_template_directory_uri().'/js/cufon-yui.js', array('jquery'), null, true);
			
			// variable needed for javascripts
			wp_localize_script('custom', 'the_ajax_script', array('ajaxurl'=>admin_url('admin-ajax.php')));
			wp_localize_script('custom', 'slogan_setting', array('speed'=>get_option('mytheme_sloganspeed')));
			wp_localize_script('custom', 'superfish_setting', array('maxwidth'=>get_option('mytheme_mainnavsupersubsmaxwidth'),'delay'=>get_option('mytheme_mainnavdelay'),'speed'=>get_option('mytheme_mainnavspeed'),'autoarrows'=>get_option('mytheme_mainnavarrowonoff')));
			wp_localize_script('custom', 'onepage_menu', array('sticky'=>get_option('mytheme_mainnavstickyonoff')));

			// Comment Script
			if ( is_singular() ) wp_enqueue_script('comment-reply');
		
		}
		add_action( 'wp_enqueue_scripts', 'custom_front_end_script');
		
	} else {
		
		// register scripts for post/portfolio/gallery post in admin panel
		function custom_admin_script($hook) {
			global $post_type;
			if ( ( $post_type=='post' || $post_type=='portfolio' || $post_type=='gallery' ) && ( 'post.php' == $hook || 'post-new.php' == $hook ) ) {
			
			wp_enqueue_script('imagepicker', get_template_directory_uri().'/includes/js/imagepicker.js', array('jquery'), null, true);
				
			}
		}
		add_action( 'admin_enqueue_scripts', 'custom_admin_script');
		
		// register scripts for all page in admin panel
		function all_admin_scripts() {
			
			wp_enqueue_script('jquery');
			
			if ( function_exists( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			} else {
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
			}
			
			wp_enqueue_style('themeoption-css', get_template_directory_uri().'/includes/css/themeoption.css', false, null);
			wp_enqueue_style('jquery-confirm-css', get_template_directory_uri().'/includes/css/jquery.confirm.css', false, null);
			wp_enqueue_style('jquery-colorpicker-css', get_template_directory_uri().'/includes/css/colorpicker.css', false, null);
			wp_enqueue_style('icomoon', get_template_directory_uri().'/css/icomoon.css', false, null);
			
			wp_enqueue_script('jquery-custom', get_template_directory_uri().'/includes/js/jquery.custom.js',  array('jquery'), null, true);
			wp_enqueue_script('jquery-confirm', get_template_directory_uri().'/includes/js/jquery.confirm.js',  array('jquery'), null, true);
			wp_enqueue_script('jquery-colorpicker', get_template_directory_uri().'/includes/js/colorpicker.js',  array('jquery'), null, true);
			wp_enqueue_script('jquery-livequery', get_template_directory_uri().'/includes/js/jquery.livequery.js',  array('jquery'), null, true);
			wp_enqueue_script('cufon-yui', get_template_directory_uri().'/js/cufon-yui.js',  array('jquery'), null, true);
		}
		add_action('admin_enqueue_scripts', 'all_admin_scripts');

	}
}


/*-----------------------------------------------------------------------------------*/
/*	Register sidebars
/*-----------------------------------------------------------------------------------*/


function pa_widgets_init() {
	
	// Custom Sidebar
	$sidebaradd = get_option('mytheme_sidebaraddvalues');
	$custom = array();
	if ( $sidebaradd != '' ) {
		$sidebaradd = explode( '|', substr( $sidebaradd, 0, -1 ) );
		foreach( $sidebaradd as $key => $value ) {
			$custom[ 'custom-'.$value ] = $value;
		}
	}
	
	$widgets = array( 
		__('Located at the right side of pages.', 'my_framework') => array(
			'sidebar-right' => 'Sidebar Right',
		),
		__('Located at the left side of pages.', 'my_framework') => array(
			'sidebar-left' => 'Sidebar Left',
		),
		__('Located at the bottom of pages.', 'my_framework') => array(
			'footer-1' => 'First Footer Widget Area',
			'footer-2' => 'Second Footer Widget Area',
			'footer-3' => 'Third Footer Widget Area',
			'footer-4' => 'Fourth Footer Widget Area',
		),
		__('Located at the site map page.', 'my_framework') => array(
			'sitemap-1' => 'First Site Map',
			'sitemap-2' => 'Second Site Map',
			'sitemap-3' => 'Third Site Map',
		),
		__('Located at the right or left side of pages.', 'my_framework') => $custom,
	);
		
	foreach( $widgets as $desc => $widget ) {
		foreach( $widget as $id => $name ) {
			register_sidebar( array(
				'name'          => ucfirst( $name ),
				'id'            => $id,
				'description'   => $desc,
				'before_widget' => '<section class="widget_section"><div id="%1$s" class="%2$s widget">',
				'after_widget'  => '</div></section>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			));
		}
	}
}
add_action( 'widgets_init', 'pa_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/*	Register post types (portfolio, gallery, testimonial, slider)
/*-----------------------------------------------------------------------------------*/


// register portfolio post_type
function pa_post_type_portfolio() {

	$labels = array(
		'name' => _x('Portfolio', 'Portfolio Name', 'my_framework'),
		'singular_name' => _x('Portfolio', 'Portfolio Singular Name', 'my_framework'),
		'add_new' => _x('Add New', 'Add New Portfolio Name', 'my_framework'),
		'add_new_item' => __('Add New Portfolio', 'my_framework'),
		'edit_item' => __('Edit Portfolio', 'my_framework'),
		'new_item' => __('New Portfolio', 'my_framework'),
		'view_item' => __('View Portfolio', 'my_framework'),
		'search_items' => __('Search Portfolio', 'my_framework'),
		'not_found' =>  __('Nothing found', 'my_framework'),
		'not_found_in_trash' => __('Nothing found in Trash', 'my_framework'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	); 
	  
	register_post_type( 'portfolio', $args );
	
	register_taxonomy(
		'portfolio-category', array('portfolio'), array(
			'hierarchical' => true,
			'label' => 'Categories', 
			'singular_label' => 'Category', 
			'rewrite' => true ));
	register_taxonomy_for_object_type('portfolio-category', 'portfolio');
	
	register_taxonomy(
		'portfolio-tag', array('portfolio'), array(
			'hierarchical' => false, 
			'label' => 'Tags', 
			'singular_label' => 'Tag', 
			'rewrite' => true ));
	register_taxonomy_for_object_type('portfolio-tag', 'portfolio');
	
	flush_rewrite_rules();
		
}
add_action('init', 'pa_post_type_portfolio');

function portfolio_column( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'author' => 'Author',
		'portfolio-category' => 'Categories',
		'portfolio-tags' => 'Tags',
		'date' => 'date');
	return $columns;
}
add_filter('manage_portfolio_posts_columns', 'portfolio_column');

function portfolio_custom_columns( $column ) {
	global $post;
	switch ( $column ) {
		case 'portfolio-category':
		echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' );
		break;
		
		case 'portfolio-tags':
		echo get_the_term_list( $post->ID, 'portfolio-tag', '', ', ', '' );
		break;
	}
}
add_action('manage_posts_custom_column','portfolio_custom_columns');


// register gallery post_type
function pa_post_type_gallery() {

	$labels = array(
		'name' => _x('Gallery', 'Gallery Name', 'my_framework'),
		'singular_name' => _x('Gallery', 'Gallery Singular Name', 'my_framework'),
		'add_new' => _x('Add New', 'Add New Gallery Name', 'my_framework'),
		'add_new_item' => __('Add New Gallery', 'my_framework'),
		'edit_item' => __('Edit Gallery', 'my_framework'),
		'new_item' => __('New Gallery', 'my_framework'),
		'view_item' => __('View Gallery', 'my_framework'),
		'search_items' => __('Search Gallery', 'my_framework'),
		'not_found' =>  __('Nothing found', 'my_framework'),
		'not_found_in_trash' => __('Nothing found in Trash', 'my_framework'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	  ); 
	  
	register_post_type( 'gallery', $args );
	
	register_taxonomy(
		'gallery-category', array('gallery'), array(
			'hierarchical' => true,
			'label' => 'Categories', 
			'singular_label' => 'Category', 
			'rewrite' => true ));
	register_taxonomy_for_object_type('gallery-category', 'gallery');
	
	flush_rewrite_rules();
		
}
add_action('init', 'pa_post_type_gallery');

function gallery_column( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'author' => 'Author',
		'gallery-category' => 'Categories',
		'date' => 'date');
	return $columns;
}
add_filter('manage_gallery_posts_columns', 'gallery_column');

function gallery_custom_columns( $column ) {
	global $post;
	switch ( $column ) {
		case 'gallery-category':
		echo get_the_term_list( $post->ID, 'gallery-category', '', ', ', '' );
		break;
	}
}
add_action('manage_posts_custom_column','gallery_custom_columns');


// register testimonial post_type
function pa_post_type_testimonial() {

	$labels = array(
		'name' => _x('Testimonial', 'Testimonial Name', 'my_framework'),
		'singular_name' => _x('Testimonial', 'Testimonial Singular Name', 'my_framework'),
		'add_new' => _x('Add New', 'Add New Testimonial Name', 'my_framework'),
		'add_new_item' => __('Add New Testimonial', 'my_framework'),
		'edit_item' => __('Edit Testimonial', 'my_framework'),
		'new_item' => __('New Testimonial', 'my_framework'),
		'view_item' => __('View Testimonial', 'my_framework'),
		'search_items' => __('Search Testimonial', 'my_framework'),
		'not_found' =>  __('Nothing found', 'my_framework'),
		'not_found_in_trash' => __('Nothing found in Trash', 'my_framework'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'exclude_from_search' => true,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	  ); 
	  
	register_post_type( 'testimonial', $args );
	
	register_taxonomy(
		'testimonial-category', array('testimonial'), array(
			'hierarchical' => true,
			'label' => 'Categories', 
			'singular_label' => 'Categories', 
			'rewrite' => true ));
	register_taxonomy_for_object_type('testimonial-category', 'testimonial');
	
	flush_rewrite_rules();
		
}
add_action('init', 'pa_post_type_testimonial');

function testimonial_column( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'author' => 'Author',
		'testimonial-category' => 'Categories',
		'date' => 'date');
	return $columns;
}
add_filter('manage_testimonial_posts_columns', 'testimonial_column');

function testimonial_custom_columns( $column ) {
	global $post;
	switch ( $column ) {
		case 'testimonial-category':
		echo get_the_term_list( $post->ID, 'testimonial-category', '', ', ', '' );
		break;
	}
}
add_action('manage_posts_custom_column','testimonial_custom_columns');


// register slider post_type
function pa_post_type_slider() {

	$labels = array(
		'name' => _x('Slider', 'Slider Name', 'my_framework'),
		'singular_name' => _x('Slider', 'Slider Singular Name', 'my_framework'),
		'add_new' => _x('Add New', 'Add New Slider Name', 'my_framework'),
		'add_new_item' => __('Add New Slider', 'my_framework'),
		'edit_item' => __('Edit Slider', 'my_framework'),
		'new_item' => __('New Slider', 'my_framework'),
		'view_item' => __('View Slider', 'my_framework'),
		'search_items' => __('Search Slider', 'my_framework'),
		'not_found' =>  __('Nothing found', 'my_framework'),
		'not_found_in_trash' => __('Nothing found in Trash', 'my_framework'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'exclude_from_search' => true,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	  ); 
	  
	register_post_type( 'slider', $args );
	
	register_taxonomy(
		'slider-category', array('slider'), array(
			'hierarchical' => true,
			'label' => 'Categories', 
			'singular_label' => 'Categories', 
			'rewrite' => true ));
	register_taxonomy_for_object_type('slider-category', 'slider');
	
	flush_rewrite_rules();
		
}
add_action('init', 'pa_post_type_slider');

function slider_column( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'author' => 'Author',
		'slider-category' => 'Categories',
		'date' => 'date');
	return $columns;
}
add_filter('manage_slider_posts_columns', 'slider_column');

function slider_custom_columns( $column ) {
	global $post;
	switch ( $column ) {
		case 'slider-category':
		echo get_the_term_list( $post->ID, 'slider-category', '', ', ', '' );
		break;
	}
}
add_action('manage_posts_custom_column','slider_custom_columns');