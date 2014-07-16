<?php

	/*
	
	PersianArt
	---------------------------------------------------------------------
	Includes all of important function and features of the theme
	---------------------------------------------------------------------
	
	*/
	
	// Create dashboard options
	include_once( 'includes/theme-option.php' );	// create option for admin panel
	include_once( 'includes/custom-option.php' );	// create option for custom field
	
	// Include custom widget
	include_once( 'includes/widgets/persian-art-recent-posts-widget.php' );
	include_once( 'includes/widgets/persian-art-contact-widget.php' );
	include_once( 'includes/widgets/persian-art-comments-widget.php' );
	include_once( 'includes/widgets/persian-art-post-cycle-widget.php' );
	include_once( 'includes/widgets/persian-art-testimonial-widget.php' );
	include_once( 'includes/widgets/persian-art-flickr-wigdet.php' );
	include_once( 'includes/widgets/persian-art-twitter-wigdet.php' );
	include_once( 'includes/widgets/persian-art-side-menu-widget.php' );
	
	// Add miscellaneous function, features, scripts
	include_once( 'includes/misc/theme-function.php' );	// theme functions
	include_once( 'includes/misc/theme-init.php' );	// frontend and backend script
	include_once( 'includes/misc/shortcode.php' );	// generate shortcodes
	include_once( 'includes/misc/pagination.php' );	// create pagination
	include_once( 'includes/misc/breadcrumbs.php' );	// create breadcrumb
	include_once( 'includes/misc/twitteroauth.php' );	// create twitteroauth
	include_once( 'includes/misc/recaptchalib.php' );	// create recaptcha
	
	// Assign what type of css should be used on your server,
	// if your changes i.e. coloring in admin panel did not work set it to false
	global $cssstatic;
	$cssstatic = 'true'; // false
	
	// Set theme language
	load_theme_textdomain( 'my_framework', get_template_directory().'/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory()."/languages/$locale.mo";
	
	function persianart_theme_setup() {
	/* Add filters, actions, and theme-supported features. */
		
		global $content_width;
		// This feature set the maximum allowed width for any content in the theme Since 2.6
		if (!isset($content_width)) $content_width = 940;
	
		// Allows theme developers to link a custom stylesheet file to the TinyMCE visual editor
		add_editor_style();

		// This feature enables Post Thumbnails support for a Theme Since 2.9
		add_theme_support('post-thumbnails');
	
		// This feature enables post and comment RSS feed links to head Since 3.0
		add_theme_support('automatic-feed-links');
	
		// Add custom menu
		add_theme_support( 'menus' );

		add_filter('excerpt_length', 'custom_excerpt_length', 999);
		add_filter('get_comments_number', 'comment_count', 0);
		add_filter('excerpt_more', 'custom_excerpt_more');
		add_filter('excerpt_more', 'no_more_jumping');
		add_filter('widget_text', 'do_shortcode');	// Shortcodes works in widget text
		add_action('wp_enqueue_scripts', 'persianart_fonts');
		
		// Google analytics
		if (get_option('mytheme_trackingcodeonoff')=='true') {
			add_action('wp_footer', 'add_trackingcode');
		}
		add_action('init', 'custom_menus');
	}
	add_action( 'after_setup_theme', 'persianart_theme_setup' );
		
	// Add menu locations
	function custom_menus() {
		register_nav_menus(
			array(
			  'top_menu' => 'Top Menu',
			  'main_menu' => 'Main Menu',
			  'footer_menu' => 'Footer Menu'
			)
		);
	}

	// Custom excerpt length (55 by default) Since 2.8
	function custom_excerpt_length($length) {
		return 200;
	}

	// Removes trackbacks from the comment count
	function comment_count($count) {
		if (!is_admin()) {
			global $id;
			$all_comments = get_comments('status=approve&post_id=' . $id);
			$comments_by_type = separate_comments($all_comments);
			return count($comments_by_type['comment']);
		} else {
			return $count;
		}
	}

	// Custom excerpt more string (55 by default) Since 2.9
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}

	// No more jumping for read more link
	function no_more_jumping($post) {
		return '...';
	}

	// Enqueue theme google fonts.
	function persianart_fonts() {
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'mytheme-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" );
		wp_enqueue_style( 'mytheme-robotocondensed', "$protocol://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700,300italic,400italic,700italic" );
		wp_enqueue_style( 'mytheme-ptsans', "$protocol://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic" );
	}

	// Google analytics
	if (get_option('mytheme_trackingcodeonoff')=='true') {
		function add_trackingcode(){
			echo stripcslashes(get_option('mytheme_trackingcode'));
		}
	}
	
	
	// Custom menu url output
	class description_walker extends Walker_Nav_Menu {
		
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
			
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
			
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? (get_post_meta($item->object_id, 'onhomeonoff', true)=='true' ? ' href="'.site_url().'/#'. esc_attr((get_post( $item->object_id )->post_name)) .'"' : ' href="' . esc_attr( $item->url ) .'"') : '';
			
			$prepend = '';
			$append = '';
			$description  = ! empty( $item->description ) ? '<span class="menu-description">'.esc_attr( $item->description ).'</span>' : '';
			
			if($depth != 0) { $description = $append = $prepend = ""; }
			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	
	// Reorder pages based on menu order
	function get_pages_basedon_menu() {
			
		global $wpdb;
		$menu_name = 'main_menu';
		if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
			
			$menu = wp_get_nav_menu_object($locations[$menu_name]);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			foreach((array) $menu_items as $key => $menu_item) {
				$page_id = $menu_item->object_id;
				$new_order = $menu_item->menu_order;
				$wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET menu_order = %d WHERE id = %d", $new_order, $page_id));
			}
		}
	}
	add_action('wp_update_nav_menu', 'get_pages_basedon_menu', 999);


	// Theme color picker
	class MyTheme_Customize {

	   public static function register ( $wp_customize ) {
		  //1. Define a new section (if desired) to the Theme Customizer
		  $wp_customize->add_section( 'theme_colors', 
			 array(
				'title' => __( 'Colors', 'mytheme' ), //Visible title of section
				'priority' => 35, //Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => __('Please wait a few seconds for page refresh after color change to see new color.', 'mytheme'), //Descriptive tooltip
			 ) 
		  );

		  //2. Register new settings to the WP database...
		  $wp_customize->add_setting( 'theme_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			 array(
				'default' => '#f1b717', //Default setting/value to save
				'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			 ) 
		  );      
	
		  //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		  $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			 $wp_customize, //Pass the $wp_customize object (required)
			 'mytheme_theme_color', //Set a unique ID for the control
			 array(
				'label' => __( 'Theme Color', 'mytheme' ), //Admin-visible name of the control
				'section' => 'theme_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'theme_color', //Which setting to load and manipulate (serialized is okay)
				'priority' => 10, //Determines the order this control appears in for the specified section
			 ) 
		  ) );

	   }

	   public static function header_output() {

		  ?>
		  <!--Customizer CSS--> 
		  <style type="text/css">
			   <?php self::generate_css('*::selection', 'background-color', 'theme_color'); ?>
			   <?php self::generate_css('*::-moz-selection', 'background-color', 'theme_color'); ?>
			   <?php self::generate_css('*::-webkit-input-placeholder', 'color', 'theme_color'); ?>
			   <?php self::generate_css('*::-moz-placeholder', 'color', 'theme_color'); ?>
			   <?php self::generate_css('.sf-menu a:hover,.sf-menu > li > a:hover,.sf-menu > li:hover > a,.sf-menu > li.sfHover > a,.sf-menu > li.current-menu-item > a,a,a.reverse:hover,h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,.skin-color,.h-wrapper .icon,.social-icon a:hover,#footer-wrapper a:hover,.sidebar a,.sidebar .widget ul li a:hover,#footer-wrapper .widget ul li a:hover,.sidebar .widget_calendar caption,#footer-wrapper div[id|="calendar"] caption,.sidebar .widget.widget_persianart_sidemenu li a,.author-info h3 a,.older-newer a:hover,.posts .related .related-date,.ports .related .related-date,.blockquote .sign-wrapper .icon-left,.blockquote .sign-wrapper .icon-right,.normal-button.dark-button,.contact-info.color > li > .icon,.counter-number,.personnel-shortcode.dark:hover .personnel-post,.personnel-shortcode .social-icon a:hover,.post-shortcode-item:hover .normal-button,.post-shortcode-item .post-time,.progress-bar-meter .icon:before,.service-3.color:hover .icon,.service-3.color:hover .normal-button,.twitter-shortcode .sign-wrapper .sign:before,.twitter-shortcode .prev,.twitter-shortcode .next', 'color', 'theme_color'); ?>
			   <?php self::generate_css('.menu-container.color,.menu-container.color .sf-menu li ul,.sf-menu li li a:hover,.sf-menu li li.sfHover > a,.sf-menu li li.current-menu-item > a,.social-icon a.opened:hover,.sliderNav #nav ul li.showPage a,.sidebar .tagcloud a:hover,#footer-wrapper .tagcloud a:hover,.sidebar .widget_persianart_sidemenu li a:hover,#pagination .current,.portfolio-item:hover .zoom-icon,.featured-thumbnail:hover .zoom-icon,.gallery-wrapper li,.accordion-head:hover,
.toggle-head:hover,.active .accordion-head:hover,.active .toggle-head:hover,.normal-button:hover,.normal-button.small:hover,.normal-button.larg:hover,.normal-button.xlarg:hover,input[type="submit"]:hover,button:hover,.normal-button.reverse,.normal-button.small.reverse,.normal-button.larg.reverse,.normal-button.xlarg.reverse,.shortcode-button,.price-item.active .top,.progress-bar-meter,.service-3.color:hover,.service-3.color .icon,.step-item:hover .step-number,
.stunningtext a,.stunningtext.dark .normal-button:hover,.stunningtext.dark a:hover,.pa-tabs li a.active,.pa-tabs li a:hover,.table th,.table tfoot td', 'background-color', 'theme_color'); ?>
			   <?php self::generate_css('.sf-menu li ul,.sidebar #widget-contact-form input[type="text"]:focus,.sidebar #widget-contact-form textarea:focus,#footer-wrapper #widget-contact-form input[type="text"]:focus,#footer-wrapper #widget-contact-form textarea:focus,#footer-wrapper .flickr-widget a:hover,.flickr-widget a:hover,.portfolio-item-wrapper li:hover .portfolio-item-context,#contact-form-wrapper input[type="text"]:focus,#contact-form-wrapper textarea:focus,#respond input[type="text"]:focus,#respond textarea:focus,.searchform input.text:focus,.active .accordion-head,.active .toggle-head,.normal-button.dark-button,
.contact-info.color > li > .icon,.counter-icon,.counter-number,.personnel-shortcode:hover .personnel-name,.personnel-shortcode.dark:hover .personnel-name,.progress-bar-meter .icon,.service-3,.service-3.color:hover,.service-3.color .icon:before,.step-item:hover .step-number,.stunningtext', 'border-color', 'theme_color'); ?>
		  </style> 
		  <!--/Customizer CSS-->
		  <?php
	   }

		public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		  $return = '';
		  $mod = get_theme_mod($mod_name);
		  if ( ! empty( $mod ) ) {
			 $return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			 );
			 if ( $echo ) {
				echo $return;
			 }
		  }
		  return $return;
		}
	}

	add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );
	add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );