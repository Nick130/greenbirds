<?php

	// Create a box to the main column on the post edit screens.
	function pa_add_custom_option() {

		$types = array( 'post', 'page', 'portfolio', 'testimonial', 'gallery', 'slider' );

		foreach ( $types as $type ) {
			add_meta_box( 'pa-custom-option', ucwords( $type ) . __( ' Option', 'my_framework' ), 'pa_custom_option_box', $type, 'normal', 'high', array( 'type' => $type ) );
		}
	}
	add_action( 'add_meta_boxes', 'pa_add_custom_option' );

	// Prints the box content.
	function pa_custom_option_box( $post, $metabox ) {

		$type = $metabox['args']['type'];
		$option_element = 'option_element_' . $type;

		global $$option_element;

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'pa_custom_option_' . $type , 'security' );
	
		echo '<div class="custom-form">';

		if ( 'page' == $type ) {
		echo '<ul id="pageheadernav" class="pa-option tabs">
				<li><a href="#pageoption-section" class="general">' . __('General Option', 'my_framework') . '</a></li>
				<li><a href="#blogpageoption-section">' . __('Blog Option', 'my_framework') . '</a></li>
				<li><a href="#portfoliopageoption-section">' . __('Portfolio Option', 'my_framework') . '</a></li>
				<li><a href="#contactpageoption-section">' . __('Contact Option', 'my_framework') . '</a></li>
				<li><a href="#gallerypageoption-section">' . __('Gallery Option', 'my_framework') . '</a></li>
			</ul>';
		}
			
		create_pa_option_elements( $$option_element );
	
		echo '</div><!-- .custom-form -->';
	}

	// Prints the box elements.
	function create_pa_option_elements( $sections ) {

		global $post;

		echo '<ul>';

		foreach( $sections as $section => $elements ) {

			echo '<li id="' . $section . '-section">
					<h2></h2>';

			foreach( $elements as $title => $element ) {

				echo '<div class="pa-option"><h4>' . $title . '</h4>';

					foreach( $element as $key => $values ) {

						if( ! empty( $values['name'] ) ) {
							$values['value'] = get_post_meta( $post->ID, $values['name'], true );
							$values['default'] = ( isset( $values['default'] ) ) ? $values['default'] : '';
						}

						switch( $values['type'] ) {

							case 'inputtext' : pa_panel_inputtext( $values ); break;
							case 'longtext' : pa_panel_longtext( $values ); break;
							case 'textarea': pa_panel_textarea( $values ); break;
							case 'combobox' : pa_panel_combobox( $values ); break;
							case 'checkbox' : pa_panel_checkbox( $values ); break;
							case 'radio' : pa_panel_radio( $values ); break;
							case 'addsidebar' : pa_panel_addsidebar( $values ); break;
							case 'selectsidebar' : pa_panel_selectsidebar( $values ); break;
							case 'addfont': pa_panel_addfont( $values ); break;
							case 'setfont': pa_panel_setfont( $values ); break;
							case 'colorpicker': pa_panel_colorpicker( $values); break;
							case 'setslider': pa_panel_setslider( $values); break;
							case 'category': pa_panel_category( $values ); break;
							case 'uploadimage' : pa_panel_uploadimage( $values ); break;
							case 'icon' : pa_panel_icon ( $values ); break;
							case 'hidden' : pa_panel_hidden( $values ); break;
						}
					}
				echo '</div>';
			}
			echo '</li><!-- #' . $section . '-section -->';
		}
		echo '</ul>';
	}

	// When the post is saved, saves our custom data.
	function pa_save_custom_option( $post_id ) {

		$type = get_post_type( $post_id );
		$option_element = 'option_element_' . $type;

		global $$option_element;

		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.
		if ( isset( $_POST['security'] ) && ! wp_verify_nonce( $_POST['security'], 'pa_custom_option_' . $type ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $type ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		// OK, its safe for us to save the data now.
		if ( is_array( $$option_element ) ) {

			foreach( $$option_element as $elements ) {
	
				foreach( $elements as $element ) {
	
					foreach( $element as $key => $values ) {
						if ( isset( $_REQUEST[ $values['name'] ] ) ) {
							update_post_meta( $post_id, $values['name'], $_POST[ $values['name'] ] );
						}
					}
				}
			}
		}

	}
	add_action( 'save_post', 'pa_save_custom_option' );





	// Page option elements
	$option_element_page = array(
		'pageoption' => array(
			__('Icon', 'my_framework') => array(
				array(
					'type' => 'icon',
					'name' => 'pageicon',
				),
			),
			__('Sub title', 'my_framework') => array(
				array(
					'type' => 'longtext',
					'name' => 'pagesubtitle',
				),
			),
			__('Display on home', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'onhomeonoff',
					'description' => __('use this option for show page on main page in singlepage mode.<br />works on "Default", "blog", "Contact" template only.', 'my_framework'),
				),
			),
			__('Content wrapper width', 'my_framework') => array(
				array(
					'type' => 'radio',
					'name' => 'pagelength',
					'options' => array(
						'normal',
						'fullsize',
					),
					'default' => 'normal',
					'rowclass' => 'pagelength-wrapper',
					'class' => 'length-',
				),
			),
			__('Select Sidebar', 'my_framework') => array(
				array(
					'type' => 'radio',
					'name' => 'pagesidebar',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'no',
					'class' => 'setsidebar sidebar',
				),
				array(
					'type' => 'selectsidebar',
					'name' => 'pagesidebarright',
					'side' => 'right',
					'description' => __('select custom <strong>"right sidebar"</strong> for this page.', 'my_framework'),
				),
				array(
					'type' => 'selectsidebar',
					'name' => 'pagesidebarleft',
					'side' => 'left',
					'description' => __('select custom <strong>"left sidebar"</strong> for this page.', 'my_framework'),
				),
			),
			__('Page background', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pageimageonoff',
					'description' => __('<strong>"show or hide"</strong> your desired background.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'pageimageparallax',
					'description' => __('add <strong>"parallax effect"</strong> to background image. (work on onepage only)', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'pageimage',
					'description' => __('choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'pageimageleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'pageimagetop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'pageimagerepeat',
					'options' => array(
						'repeat' => 'repeat',
						'repeat-x' => 'repeat horizontally',
						'repeat-y' => 'repeat vertically',
						'no-repeat' => 'no repeat',
					),
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'pageimagefix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Display title', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pagetitleonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide page title.', 'my_framework'),
				),
			),
			__('Show Slider', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'pageslider',
					'options' => array(
						'notset' => 'not set',
						'false' => 'no slider',
						'revolution' => 'revolution',
						'nivo' => 'nivo',
						'bgstretcher' => 'bgstretcher',
					),
					'description' => __('show or hide slider for this page.', 'my_framework'),
				),
				array(
					'type' => 'category',
					'name' => 'pageslidercat',
					'posttype' => 'slider',
					'description' => __('select <strong>"slider category"</strong> to disply on slider.', 'my_framework'),
				),
			),
			__('Page slogan status', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pagesloganonoff',
					'description' => __('disable "slogan" for this page.<br />usefull for create <strong>"Front Page"</strong>.', 'my_framework'),
				),
			),
			__('Page breadcrumb status', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pagebreadcrumbonoff',
					'description' => __('disable "breadcrumb" for this page.<br />usefull for create <strong>"Front Page"</strong>.', 'my_framework'),
				),
			),
			__('Page footer widgets status', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pagefooterstyleonoff',
					'description' => __('disable "footer widgets section" for this page.<br />usefull for create <strong>"Front Page"</strong>.', 'my_framework'),
				),
			),
		),
		'blogpageoption' => array(
			__('Select display style', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'blogstyle',
					'options' => array(
						'full' => 'full style',
						'half' => 'half style',
					),
					'description' => __('use desired style.', 'my_framework'),
				),
			),
			__('Category of post', 'my_framework') => array(
				array(
					'type' => 'category',
					'name' => 'blogcat',
					'posttype' => 'blog',
					'description' => __('select category to disply on page.', 'my_framework'),
				),
			),
			__('Blog item per page', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'blognumfetch',
					'description' => __('this is the number of items per page. (10 by default)', 'my_framework'),
				),
			),
			__('Display thumbnail title and Length of title', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogthumbtitleonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide thumbnail title.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bloglentitle',
					'description' => __('number of title character for per thumbnail.', 'my_framework'),
				),
			),
			__('Display thumbnail excerpt and Length of excerpt', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogthumbexcerptonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide thumbnail excerpt.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bloglenexcerpt',
					'description' => __('number of excerpt word for per thumbnail.', 'my_framework'),
				),
			),
			__('Complete content', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogcompletecontentonoff',
					'description' => __('when it is on. content is fully used.<br />use this option for show complete content or excerpt on blog page.', 'my_framework'),
				),
			),
			__('Display prettyphoto', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogprettyphotoonoff',
					'description' => __('use this option for enable/disable prettyphoto.', 'my_framework'),
				),
			),
			__('Display author', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'bloginfoauthoronoff',
					'default' => 'true',
					'description' => __('use this option for show or hide author in meta information.', 'my_framework'),
				),
			),
			__('Display tag', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'bloginfotagonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide tag in meta information.', 'my_framework'),
				),
			),
			__('Display comment', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'bloginfocommentonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide comment in meta information.', 'my_framework'),
				),
			),
			__('Display continue link', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogcontinuelinkonoff',
					'default' => 'true',
					'description' => __('when it is on. link is used.<br />use this option for show or hide continue reading link.', 'my_framework'),
				),
			),
			__('Display pagination', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogpaginationonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide pagination.', 'my_framework'),
				),
			),
			__('Enable ajax pagination', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'blogpaginationajax',
					'description' => __('use this option for ajax pagination.', 'my_framework'),
				),
			),
		),
		'portfoliopageoption' => array(
			__('Portfolio thumbnail size', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'portsize',
					'options' => array(
						'11' => '1/1',
						'12' => '1/2',
						'13' => '1/3',
						'14' => '1/4',
					),
					'description' => __('select size of portfolio thumbnail.', 'my_framework'),
				),
			),
			__('Category of portfolio', 'my_framework') => array(
				array(
					'type' => 'category',
					'name' => 'portcat',
					'posttype' => 'portfolio',
					'description' => __('select category to disply on page.', 'my_framework'),
				),
			),
			__('Display Filters', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portfilteronoff',
					'default' => 'true',
					'description' => __('use this option for show or hide filter buttons.', 'my_framework'),
				),
			),
			__('portfolio item per page', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'portnumfetch',
					'description' => __('this is the number of items per page. (10 by default)', 'my_framework'),
				),
			),
			__('Length of title', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'portlentitle',
					'description' => __('number of title character for per thumbnail.<br />(40 character by default)', 'my_framework'),
				),
			),
			__('Length of excerpt', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'portlenexcerpt',
					'description' => __('number of excerpt word for per thumbnail.', 'my_framework'),
				),
			),
			__('Portfolio text align', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'portalign',
					'options' => array(
						'' => 'default',
						'left' => 'left',
						'center' => 'center',
						'right' => 'right',
					),
					'description' => __('select portfolio text align.', 'my_framework'),
				),
			),
			__('Portfolio singlemode', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'portsinglemode',
					'options' => array(
						'' => 'normal',
						'lightbox' => 'lightbox',
						'inline' => 'inline',
						'outline' => 'outline',
					),
					'description' => __('select portfolio single mode.', 'my_framework'),
				),
			),
			__('Display portfolio category', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portthumbcategoryonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide portfolio category.', 'my_framework'),
				),
			),
			__('Display pagination', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portpaginationonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide pagination.', 'my_framework'),
				),
			),
		),
		'contactpageoption' => array(
			__('Email', 'my_framework') => array(
				array(
					'type' => 'longtext',
					'name' => 'contactemail',
					'description' => __('enter your <strong>"email"</strong> for contact form destination.', 'my_framework'),
				),
			),
			__('Successful message', 'my_framework') => array(
				array(
					'type' => 'textarea',
					'name' => 'contactmessage',
					'default' => '<strong>Thanks!</strong> Your email was successfully sent.',
					'description' => __('paste your <strong>"successful message"</strong> here.', 'my_framework'),
				),
			),
			__('Label/Placeholder and error message', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'contactlabel',
					'options' => array(
						'placeholder' => 'placeholder',
						'label' => 'label',
					),
					'description' => __('select between <strong>"label"</strong> and <strong>"placeholder"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactnamelabel',
					'default' => 'Your Name',
					'placeholder' => __('Name label/placeholder', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactnameerror',
					'default' => 'Please enter your name.',
					'placeholder' => __('Name error message', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactemaillabel',
					'default' => 'Your Email',
					'placeholder' => __('Email label/placeholde', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactemailerror',
					'default' => 'Please enter your email.',
					'placeholder' => __('Email error message', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactemailvalidateerror',
					'default' => 'Please enter a valid email.',
					'placeholder' => __('Email validate error message', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactphonelabel',
					'default' => 'Your Phone',
					'placeholder' => __('Phone label/placeholde', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactcommentlabel',
					'default' => 'Your Message',
					'placeholder' => __('Comment label/placeholde', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactcommenterror',
					'default' => 'Please enter your message.',
					'placeholder' => __('Comment error message', 'my_framework'),
				),
			),
			__('Recaptcha', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'recaptchaonoff',
					'description' => __('use this option for <strong>"recaptcha on/off"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'recaptchatheme',
					'options' => array(
						'white' => 'white',
						'red' => 'red',
						'blackglass' => 'blackglass',
						'clean' => 'clean',
						'custom' => 'custom',
					),
					'description' => __('select <strong>"recaptcha theme"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'recaptchalang',
					'options' => array(
						'en' => 'english',
						'nl' => 'dutch',
						'fr' => 'french',
						'de' => 'german',
						'pt' => 'portuguese',
						'ru' => 'russian',
						'es' => 'spanish',
						'tr' => 'turkish',
					),
					'description' => __('select <strong>"recaptcha language"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'textarea',
					'name' => 'recaptchaerror',
					'default' => 'The reCAPTCHA wasn`t entered correctly. Please try it again.',
					'description' => __('paste your <strong>"recaptcha error message"</strong> here.', 'my_framework'),
				),
			),
			__('Google map', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'contactmapfilteronoff',
					'description' => __('enable/disable <strong>"grayscale filter"</strong> for map.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'contactmapheight',
					'default' => '480',
					'description' => __('enter <strong>"height"</strong> for google map.<br />digits only, without any unit.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'contactmaplocation',
					'options' => array(
						'bottom' => 'on bottom',
						'top' => 'on top',
					),
					'description' => __('set <strong>"google map location"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'contactmap',
					'description' => __('paste your <strong>"google map source"</strong> here. must be like this:<br />http://maps.google.com/maps/ms?msa= ... output=embed', 'my_framework'),
				),
			),
		),
		'gallerypageoption' => array(
			__('Gallery type', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'gallerytype',
					'options' => array(
						'default' => 'default',
						'carousel' => 'carousel',
					),
					'description' => __('select "gallery type". carousel didnt accept sidebar', 'my_framework'),
				),
			),
			__('Category of gallery', 'my_framework') => array(
				array(
					'type' => 'category',
					'name' => 'gallerycat',
					'posttype' => 'gallery',
					'description' => __('select category to disply on page.', 'my_framework'),
				),
			),
			__('Gallery thumbnail size', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'gallerysize',
					'options' => array(
						'11' => '1/1',
						'12' => '1/2',
						'13' => '1/3',
						'14' => '1/4',
					),
					'description' => __('select size of gallery thumbnail (only for default type).', 'my_framework'),
				),
			),
			__('Gallery navigation', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'gallerynav',
					'options' => array(
						'direction' => 'direction',
						'pagination' => 'pagination',
					),
					'description' => __('select "gallery navigation" type.', 'my_framework'),
				),
			),
		),
	);

	// post option elements
	$option_element_post = array(
		'postoption' => array(
			__('Select Sidebar', 'my_framework') => array(
				array(
					'type' => 'radio',
					'name' => 'postsidebar',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
				array(
					'type' => 'selectsidebar',
					'name' => 'postsidebarright',
					'side' => 'right',
					'description' => __('select custom <strong>"right sidebar"</strong> for this post.', 'my_framework'),
				),
				array(
					'type' => 'selectsidebar',
					'name' => 'postsidebarleft',
					'side' => 'left',
					'description' => __('select custom <strong>"left sidebar"</strong> for this post.', 'my_framework'),
				),
			),
			__('Display author information', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'postauthoronoff',
					'description' => __('use this option for show or hide post author information.', 'my_framework'),
				),
			),
			__('Display social icon', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'postsocialonoff',
					'description' => __('use this option for show or hide post social icon.', 'my_framework'),
				),
			),
			__('Select title place', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'posttitleplace',
					'options' => array(
						'above' => 'above image',
						'below' => 'below image',
					),
					'description' => __('place title above or below thumbnail image.', 'my_framework'),
				),
			),
			__('Select paginate place', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'postpaginateplace',
					'options' => array(
						'bottom' => 'on bottom',
						'top' => 'on top',
						'disable' => 'disable',
					),
					'description' => __('place pagination on top or bottom of the post.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'postpaginatetitle',
					'options' => array(
						'next-prev' => 'next & previous',
						'post' => 'post name',
					),
					'description' => __('use "post name" or "next & previous".', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'postpaginatealign',
					'options' => array(
						'default' => 'right & left',
						'right' => 'both right',
						'left' => 'both left',
					),
					'description' => __('set align for pagination.', 'my_framework'),
				),
			),
			__('Display related posts', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'postrelatedonoff',
					'description' => __('use this option for show or hide related posts.', 'my_framework'),
				),
			),
			__('Select thumbnail type', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'postthumbtype',
					'options' => array(
						'image' => 'image',
						'video' => 'video',
						'slider' => 'slider',
					),
					'description' => __('select type of post thumbnail. is used in blog<br />when <strong>"image"</strong> is selected, featured image used as thumbnail.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'postthumbvideo',
					'description' => __('place your <strong>"youtube"</strong> or <strong>"vimeo"</strong> url here.', 'my_framework'),
				),
				array(
					'type' => 'setslider',
					'name' => 'postthumbslider',
				),
			),
			__('Select inside thumbnail type', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'postinthumbtype',
					'options' => array(
						'normal' => 'normal',
						'image' => 'image',
						'video' => 'video',
						'slider' => 'slider',
					),
					'description' => __('select type of inside post thumbnail. is used in single post<br />when <strong>"normal"</strong> is selected, thumbnail and inside thumbnail are the same.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'postinthumbimage',
					'description' => __('Choose and upload your image from here.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'postinthumbvideo',
					'description' => __('place your <strong>"youtube"</strong> or <strong>"vimeo"</strong> url here.', 'my_framework'),
				),
				array(
					'type' => 'setslider',
					'name' => 'postinthumbslider',
				),
			),
		),
	);

	// portfolio option elements
	$option_element_portfolio = array(
		'portfoliooption' => array(
			__('Select display style', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'portstyle',
					'options' => array(
						'full' => 'full style',
						'half' => 'half style',
					),
					'description' => __('use desired style.', 'my_framework'),
				),
			),
			__('Display portfolio details', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portdetailsonoff',
					'description' => __('use this option for show/hide details section.', 'my_framework'),
				),
			),
			__('More Info', 'my_framework') => array(
				array(
					'type' => 'textarea',
					'name' => 'portinfo',
					'description' => __('You can use text, html or shortcode here.<br />for same style use in this format:<br />&lt;span class="detail"&gt;&lt;strong&gt;title&lt;/strong&gt;content&lt;/span&gt;', 'my_framework'),
				),
			),
			__('Display date', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portdateonoff',
					'description' => __('use this option for show/hide date.', 'my_framework'),
				),
			),
			__('Display tags', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'porttagonoff',
					'description' => __('use this option for show/hide tags.', 'my_framework'),
				),
			),
			__('Display related portfolios', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'portrelatedonoff',
					'description' => __('use this option for show/hide related portfolios.', 'my_framework'),
				),
			),
			__('Select title place', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'porttitleplace',
					'options' => array(
						'above' => 'above image',
						'below' => 'below image',
					),
					'description' => __('place title above or below thumbnail image.', 'my_framework'),
				),
			),
			__('Select paginate place', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'portpaginateplace',
					'options' => array(
						'bottom' => 'on bottom',
						'top' => 'on top',
						'disable' => 'disable',
					),
					'description' => __('place pagination on top or bottom of the portfolio.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'portpaginatetitle',
					'options' => array(
						'post' => 'post name',
						'next-prev' => 'next & previous',
					),
					'description' => __('use "portfolio name" or "next & previous".', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'portpaginatealign',
					'options' => array(
						'default' => 'right & left',
						'right' => 'both right',
						'left' => 'both left',
					),
					'description' => __('set align for pagination.', 'my_framework'),
				),
			),
			__('Select thumbnail type', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'portthumbtype',
					'options' => array(
						'image' => 'image',
						'video' => 'video',
						'slider' => 'slider',
					),
					'description' => __('select type of portfolio thumbnail.<br />when <strong>"image"</strong> is selected, featured image used as thumbnail.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'portthumbimage',
					'options' => array(
						'post' => 'link to post',
						'url' => 'link to custom url',
						'full' => 'lightbox for full image',
						'picture' => 'lightbox for picture',
						'video' => 'lightbox for video',
					),
					'description' => __('select option for link.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'portthumbimageurl',
				),
				array(
					'type' => 'longtext',
					'name' => 'portthumbvideo',
					'description' => __('place your <strong>"youtube"</strong> or <strong>"vimeo"</strong> url here.', 'my_framework'),
				),
				array(
					'type' => 'setslider',
					'name' => 'portthumbslider',
				), 
			),
			__('Select inside thumbnail type', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'portinthumbtype',
					'options' => array(
						'normal' => 'normal',
						'image' => 'image',
						'video' => 'video',
						'slider' => 'slider',
					),
					'description' => __('select type of inside portfolio thumbnail. is used in single portfolio<br />when <strong>"normal"</strong> is selected, thumbnail and inside thumbnail are the same.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'portinthumbimage',
					'description' => __('Choose and upload your logo from here.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'portinthumbvideo',
					'description' => __('place your <strong>"youtube"</strong> or <strong>"vimeo"</strong> url here.', 'my_framework'),
				),
				array(
					'type' => 'setslider',
					'name' => 'portinthumbslider',
				),
			),
		),
	);

	// testimonial option elements
	$option_element_testimonial = array(
		'testimonialoption' => array(
			__('Author destails', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'testipost',
					'description' => __('type <strong>"post of author"</strong> here.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'testicompany',
					'description' => __('type <strong>"company name"</strong> here.', 'my_framework'),
				),
				array(
					'type' => 'longtext',
					'name' => 'testiurl',
					'description' => __('place <strong>"website url"</strong> here. <strong>without "http://"</strong>', 'my_framework'),
				),
			),
		),
	);

	// gallery option elements
	$option_element_gallery = array(
		'galleryoption' => array(
			__('Choose image', 'my_framework') => array(
				array(
					'type' => 'setslider',
					'name' => 'gallerythumbs',
				),
			),
		),
	);

	// slider option elements
	$option_element_slider = array(
		'slideroption' => array(
			__('Select link type', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'sliderlinktype',
					'options' => array(
						'no' => 'no link',
						'image' => 'ligtbox',
						'url' => 'link to url',
						'video' => 'link to video',
					),
					'description' => __('select type of <strong>"slider link"</strong>.<br />unsupported in tm slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sliderlinkurl',
					'description' => __('place your url here.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sliderlinkvideo',
					'description' => __('place your <strong>"video path"</strong> here.', 'my_framework'),
				),
			),
			__('Upload Your Image', 'my_framework') => array(
				array(
					'type' => 'uploadimage',
					'name' => 'slidersecondarypic',
					'description' => __('Choose and upload your <strong>"secondary image"</strong> from here.<br />Currently "Cycle Slider" only.', 'my_framework'),
				),
			),
		),
	);