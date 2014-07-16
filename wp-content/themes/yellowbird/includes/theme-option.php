<?php

	// Create new top-level menu
	function pa_create_menu() {

		add_menu_page('PersianArt Panel', 'PersianArt', 'administrator', 'theme-option', 'pa_general_settings', get_template_directory_uri().'/includes/images/icon.png', '2.1');
	}
	add_action('admin_menu', 'pa_create_menu');

	// Generate panel option
	function pa_general_settings() {

		global $panel_menu;
		global $panel_element; ?>

		<div id="themeoption">
			<form name="pa-panel-option" id="pa-panel-option">
			<input type="hidden" name="action" value="themeoptions_update">
			<input type="hidden" name="security" value="<?php echo wp_create_nonce(__FILE__); ?>">
			<div class="panelheader">
				<div class="panelupdate">
					<span><?php _e('When you apply the desired changes, press this button', 'my_framework'); ?></span>
					<input type="submit" value="" class="updatebutton" />
				</div>
			</div>

			<div class="panelbody">

				<?php create_pa_menu( $panel_menu ); ?>

				<div class="custom-form">
					<div id="welcome-section">
						<h2><?php _e('Welcome', 'my_framework'); ?></h2>
							<div id="welcome">
							<?php _e('<p>Welcome To Setting Section</p>', 'my_framework'); ?>
							<?php _e('<strong>Yellow Bird</strong>', 'my_framework'); ?>
							<?php _e('<p><span>You can apply your desired settings</span><span>for different sections</span>', 'my_framework'); ?></p>
						</div>
					</div><!-- #welcom-section -->

					<?php create_pa_elements( $panel_element ); ?>

				</div><!-- .custom-form -->
			</div><!-- .panelbody -->
			<div class="panelupdate">
				<span><?php _e('When you apply the desired changes, press this button', 'my_framework'); ?></span>
				<input type="submit" value="" class="updatebutton" />
			</div>
			</form>
		</div><!-- #themeoption -->

		<div class="paneloverlay">
			<div class="loadingbox">
				<h2><?php _e('Please Waiting', 'my_framework'); ?></h2>
				<p class="loading" data-success="<?php _e('Save Options Completed', 'my_framework'); ?>" data-fail="<?php _e('Save Options Failed', 'my_framework'); ?>"></p>
			</div>
		</div><!-- .paneloverlay -->

	<?php }

	// Save panel options
	add_action('wp_ajax_themeoptions_update','themeoptions_update');
	function themeoptions_update( $panel_element ) {

		check_ajax_referer( __FILE__, 'security' );

		global $panel_element;

		foreach( $panel_element as $elements ) {

			foreach( $elements as $element ) {

				foreach( $element as $key => $values ) {

					update_option('mytheme_'.$values['name'], $_POST[ $values['name'] ]);
				}
			}
		}

		// Generate static css file
		generate_options_css(/*$newdata*/);

		die('true');
	}





	// Panel navigation
	$panel_menu = array(			
		'general' => array(
			__('Page Style', 'my_framework') => 'pagestyle',
			__('Logo', 'my_framework') => 'logo',
			__('Favicon', 'my_framework') => 'favicon',
			__('Body Background', 'my_framework') => 'background',
			__('Sidebar', 'my_framework') => 'sidebar',
			__('Tracking Code & CSS', 'my_framework') => 'trackingcode',
			__('Recaptcha', 'my_framework') => 'recaptcha',
		),
		'font' => array(
			__('Font Size', 'my_framework') => 'fontsize',
			__('Font Family', 'my_framework') => 'fontfamily',
			__('Font Upload', 'my_framework') => 'fontupload',
		),
		'sliders' => array(
			__('Slider Status', 'my_framework') => 'slider',
			__('Nivo Slider', 'my_framework') => 'nivoslider',
			__('Bgstretcher Slider', 'my_framework') => 'bgstretcherslider',
		),
		'coloring' => array(
			__('Body / General', 'my_framework') => 'bodycolor',
			__('Top Bar', 'my_framework') => 'topbarcolor',
			__('Main Navigation', 'my_framework') => 'mainnavcolor',
			__('Top Search', 'my_framework') => 'topsearchcolor',
			__('Slogan', 'my_framework') => 'slogancolor',
			__('Breadcrumb', 'my_framework') => 'breadcrumbcolor',
			__('Sidebar', 'my_framework') => 'sidebarcolor',
			__('Footer', 'my_framework') => 'footercolor',
			__('Copyright', 'my_framework') => 'copyrightcolor',
			__('Post / Portfolio', 'my_framework') => 'postportcolor',
			__('Pagination', 'my_framework') => 'paginationcolor',
			__('ContactForm / Comment', 'my_framework') => 'concomcolor',
			__('404 Page', 'my_framework') => 'page404color',
			__('Back to Top', 'my_framework') => 'backtotopcolor',
		),
		'elements' => array(
			__('All Backgrounds', 'my_framework') => 'allbackground',
			__('Top Bar', 'my_framework') => 'topbar',
			__('Main Navigation', 'my_framework') => 'mainnavigation',
			__('Slogan', 'my_framework') => 'slogan',
			__('Breadcrumb', 'my_framework') => 'breadcrumb',
			__('Back To Top', 'my_framework') => 'backtotop',
			__('Social Sharing', 'my_framework') => 'socialshare',
			__('Footer Status', 'my_framework') => 'footeronoff',
			__('Footer Widget', 'my_framework') => 'footerstyle',
			__('Copyright Setting', 'my_framework') => 'copyright',
		),
	);

	// Panel elements
	$panel_element = array(
		'pagestyle' => array(
			__('Theme style', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'themestyle',
					'options' => array(
						'wide' => 'wide',
						'boxed' => 'boxed',
					),
					'description' => __('select theme style.', 'my_framework'),
				),
			),
			__('Editor style', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'editorstyle',
					'options' => array(
						'visual' => 'visual',
						'normal' => 'normal',
					),
					'description' => __('select text editor style.', 'my_framework'),
				),
			),
			__('Responsive', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'responsiveonoff',
					'default' => 'true',
					'description' => __('you can enable/disable responsive from here.', 'my_framework'),
				),
			),
			__('Page comment', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'pagecommentonoff',
					'default' => 'true',
					'description' => __('you can enable/disable page comment from here.', 'my_framework'),
				),
			),
			__('Custom style', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'allstyleonoff',
					'default' => 'true',
					'description' => __('when it is on, your custom style will be used.<br />include your desired options in coloring section.', 'my_framework'),
				),
			),
			__('Content wrapper properties', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'maintopmargin',
					'description' => __('set <strong>"top margin"</strong> for content wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainbottommargin',
					'description' => __('set <strong>"bottom margin"</strong> for content wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'maintoppadding',
					'description' => __('set <strong>"top padding"</strong> for content wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainbottompadding',
					'description' => __('set <strong>"bottom padding"</strong> for content wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
			),
			__('Body wrapper properties <small>(usefull for boxed layout)</small>', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'bodywrapshadowonoff',
					'default' => 'true',
					'description' => __('disable/enable <strong>"shadow"</strong> for body wrapper.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bodywraptopmargin',
					'description' => __('set <strong>"top margin"</strong> for body wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bodywrapbottommargin',
					'description' => __('set <strong>"bottom margin"</strong> for body wrapper.<br />leave it blank for original size.<br />with "px" for ex. 200px', 'my_framework'),
				),
			),
		),
		'logo' => array(
			__('Display logo', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'logoimageonoff',
					'description' => __('show or hide your logo.', 'my_framework'),
				),
			),
			__('Upload Your Logo', 'my_framework') => array( 
				array(
					'type' => 'uploadimage',
					'name' => 'logoimage',
					'description' => __('Choose and upload your logo from here.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'logowidth',
					'description' => __('set <strong>"width"</strong> for logo.<br />leave it blank for original size.<br />without unit for ex. 200', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'logoheight',
					'description' => __('set <strong>"height"</strong> for logo.<br />leave it blank for original size.<br />without unit for ex. 200', 'my_framework'),
				),
			),
			__('Logo margin size', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'logomarginleft',
					'description' => __('set <strong>"left margin"</strong> for logo.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'logomarginright',
					'description' => __('set <strong>"right margin"</strong> for logo.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'logomargintop',
					'description' => __('set <strong>"top margin"</strong> for logo.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'logomarginbottom',
					'description' => __('set <strong>"bottom margin"</strong> for logo.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
		),
		'favicon' => array(
			__('Display favicon', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'faviconimageonoff',
					'description' => __('show or hide your favicon.', 'my_framework'),
				),
			),
			__('Upload Your Favicon', 'my_framework') => array( 
				array(
					'type' => 'uploadimage',
					'name' => 'faviconimage',
					'description' => __('Choose and upload your favicon.<br />Best siz is 16x16 px.', 'my_framework'),
				),
			),
		),
		'background' => array(
			__('Display background image', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'bodyimageonoff',
					'description' => __('show or hide your body background image.<br />this is only for background image no pattern`s', 'my_framework'),
				),
			),
			__('Upload Your body background', 'my_framework') => array( 
				array(
					'type' => 'uploadimage',
					'name' => 'bodyimage',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bodyimageleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'bodyimagetop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'bodyimagerepeat',
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
					'name' => 'bodyimagefix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Body pattern', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'bodypattern',
					'options' => array(
						'pattern1', 'pattern2', 'pattern3', 'pattern4', 'pattern5', 'pattern6', 'pattern7', 'pattern8', 'pattern9', 'pattern10', 'pattern11', 'pattern12', 'pattern13', 'pattern14', 'pattern15', 'pattern16', 'pattern17', 'pattern18', 'pattern19', 'pattern20', 'pattern21', 'pattern22', 'pattern23', 'pattern24', 'pattern25', 'pattern26', 'pattern27', 'nopattern',
					),
					'default' => 'nopattern',
					'class' => 'body',
				),
				array(
					'type' => 'combobox',
					'name' => 'bodypatternfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'description' => __('pattern attachment fix.', 'my_framework'),
				),
			),
		),
		'sidebar' => array(
			__('Add sidebar', 'my_framework') => array( 
				array(
					'type' => 'addsidebar',
					'name' => 'sidebaraddvalues',
					'description' => __('create additional sidebar.<br /> for delete items, click on "x" button.', 'my_framework'),
				),
			),
			__('Set right sidebar radius', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'sidebarrightborderradius',
					'description' => __('set radius for <strong>"right sidebar"</strong>.<br />It is used when you set the background color.<br />use "px" or "%" etc. for ex. 20px', 'my_framework'),
				),
			),
			__('Set left sidebar radius', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'sidebarleftborderradius',
					'description' => __('set radius for <strong>"left sidebar"</strong>.<br />It is used when you set the background color.<br />use "px" or "%" etc. for ex. 20px', 'my_framework'),
				),
			),
			__('Display sidebar divider', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'sidebardivideronoff',
					'description' => __('show or hide divider between sidebar and content.<br />for set divider color go to coloring.', 'my_framework'),
				),
			),
			__('Select sidebar for <strong>"Singlepost Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebarsinglepost',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
			__('Select sidebar for <strong>"Category Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebarcategory',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
			__('Select sidebar for <strong>"Archive Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebararchive',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
			__('Select sidebar for <strong>"Author Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebarauthor',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
			__('Select sidebar for <strong>"Tag Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebartag',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
			__('Select sidebar for <strong>"Search Page"</strong>', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'sidebarsearch',
					'options' => array(
						'left',
						'right',
						'both',
						'no',
					),
					'default' => 'right',
					'class' => 'setsidebar sidebar',
				),
			),
		),
		'trackingcode' => array(
			__('Enable tracking code', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'trackingcodeonoff',
					'description' => __('from here you can disable or enable tracking code.', 'my_framework'),
				),
			),
			__('Past tracking code', 'my_framework') => array( 
				array(
					'type' => 'textarea',
					'name' => 'trackingcode',
					'description' => __('You can past your tracking code here to appear in your pages.<br />This is a JavaScript code that is something like this:<br /><code>&lt;script type="text/javascript"&gt; ... &lt;/script&gt;</code>', 'my_framework'),
				),
			),
			__('Enable custom css', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'customcssonoff',
					'description' => __('from here you can disable or enable custom css.', 'my_framework'),
				),
			),
			__('Type custom css', 'my_framework') => array( 
				array(
					'type' => 'textarea',
					'name' => 'customcss',
					'description' => __('You can type custom css here.', 'my_framework'),
				),
			),
		),
		'recaptcha' => array(
			__('Recaptcha public key', 'my_framework') => array( 
				array(
					'type' => 'longtext',
					'name' => 'recaptchapublickey',
					'description' => __('place <strong>"recaptcha public key"</strong> here.', 'my_framework'),
				),
			),
			__('Recaptcha private key', 'my_framework') => array( 
				array(
					'type' => 'longtext',
					'name' => 'recaptchaprivatekey',
					'description' => __('place <strong>"recaptcha private key"</strong> here.', 'my_framework'),
				),
			),
		),
		'fontsize' => array(
			__('Set body font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'bodyfontsize',
					'description' => __('set font size for <strong>"body"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set main navigation font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'navfontsize',
					'description' => __('set font size for <strong>"main navigation"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set sidebar heading font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'sidebarhfontsize',
					'description' => __('set font size for <strong>"sidebar heading"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set footer heading font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'footerhfontsize',
					'description' => __('set font size for <strong>"footer heading"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set widget title font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'widgethfontsize',
					'description' => __('set font size for <strong>"widgets title"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set slogan font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'sloganfontsize',
					'description' => __('set font size for <strong>"slogan"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set stunning text font size', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'stunningtextfontsize',
					'description' => __('set font size for <strong>"stunning text"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
			__('Set font size for headings', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh1',
					'description' => __('set font-size for <strong>"h1"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh2',
					'description' => __('set font-size for <strong>"h2"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh3',
					'description' => __('set font-size for <strong>"h3"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh4',
					'description' => __('set font-size for <strong>"h4"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh5',
					'description' => __('set font-size for <strong>"h5"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'fontsizeh6',
					'description' => __('set font-size for <strong>"h6"</strong>.<br />use "px" or "em" or other unit. for ex. 36px or 2em', 'my_framework'),
				),
			),
		),
		'fontfamily' => array(
			__('Body font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fontbody',
					'description' => __('replace desired font for body.<br />recommended don`t use cufon as body font.', 'my_framework'),
				),
			),
			__('Headings font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fonth',
					'description' => __('replace desired font for all headings.', 'my_framework'),
				),
			),
			__('Main navigation font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fontmainnav',
					'description' => __('replace desired font for main navigation.', 'my_framework'),
				),
			),
			__('Sidebar widgets title font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fonthsidebar',
					'description' => __('replace desired font for sidebar widget title.', 'my_framework'),
				),
			),
			__('Footer widgets title font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fonthfooter',
					'description' => __('replace desired font for footer widget title.', 'my_framework'),
				),
			),
			__('Slogan font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fontslogan',
					'description' => __('replace desired font for slogan text.', 'my_framework'),
				),
			),
			__('Stunning text font', 'my_framework') => array( 
				array(
					'type' => 'setfont',
					'name' => 'fontstunningtext',
					'description' => __('replace desired font for stunning text.', 'my_framework'),
				),
			),
		),
		'fontupload' => array(
			__('Add cufon font', 'my_framework') => array( 
				array(
					'type' => 'addfont',
					'name' => 'fontaddvalues',
					'description' => __('create additional cufon font.<br /> for delete items, click on "x" button.', 'my_framework'),
				),
			),
		),
		'slider' => array(
			__('Slider selection', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'slider',
					'options' => array(
						'false' => 'no slider',
						'revolution' => 'revolution',
						'nivo' => 'nivo',
						'bgstretcher' => 'bgstretcher',
					),
					'description' => __('select <strong>"slider"</strong> you want to use.', 'my_framework'),
				),
				array(
					'type' => 'category',
					'name' => 'slidercat',
					'posttype' => 'slider',
					'description' => __('select <strong>"category"</strong> to disply on slider.', 'my_framework'),
				),
			),
			__('Slider position', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'sliderposition',
					'options' => array(
						'under' => 'under menu',
						'above' => 'above menu',
					),
					'description' => __('select menu position.', 'my_framework'),
				),
			),
			__('SliderWrapper paddings', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'slidertoppadding',
					'default' => '0',
					'description' => __('set <strong>"top padding"</strong> for slider wrapper.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sliderbottompadding',
					'default' => '0',
					'description' => __('set <strong>"bottom padding"</strong> for slider wrapper.', 'my_framework'),
				),
			),
			__('SliderWrapper background color', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sliderbgcolor',
					'description' => 'background color',
				),
			),
		),
		'nivoslider' => array(
			__('Slider effects', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'nivoeffect',
					'options' => array(
						'random' => 'random',
						'fold' => 'fold',
						'fade' => 'fade',
						'sliceDown' => 'sliceDown',
						'sliceDownLeft' => 'sliceDownLeft',
						'sliceUp' => 'sliceUp',
						'sliceUpLeft' => 'sliceUpLeft',
						'sliceUpDown' => 'sliceUpDown',
						'sliceUpDownLeft' => 'sliceUpDownLeft',
						'slideInRight' => 'slideInRight',
						'slideInLeft' => 'slideInLeft',
						'boxRandom' => 'boxRandom',
						'boxRain' => 'boxRain',
						'boxRainReverse' => 'boxRainReverse',
						'boxRainGrow' => 'boxRainGrow',
						'boxRainGrowReverse' => 'boxRainGrowReverse',
					),
					'description' => __('specify <strong>"effect"</strong> parameter.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivoslices',
					'default' => '15',
					'description' => __('number of <strong>"slices"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivoboxcols',
					'default' => '8',
					'description' => __('number of <strong>"boxCols"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivoboxrows',
					'default' => '4',
					'description' => __('number of <strong>"boxRows"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivoanimspeed',
					'default' => '500',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivopausetime',
					'default' => '5000',
					'description' => __('set <strong>"timeout"</strong> for animation (ms).', 'my_framework'),
				),
			),
			__('Slider navigation', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'nivodirectionnav',
					'description' => __('show <strong>"direction"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'nivodirectionnavhide',
					'options' => array(
						'false' => 'always visible',
						'true' => 'only on hover',
					),
					'description' => __('how show <strong>"direction"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'nivocontrolnav',
					'description' => __('show <strong>"pagination"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'nivocontrolnavthumbs',
					'options' => array(
						'false' => 'buttons',
						'true' => 'thumbnails',
					),
					'description' => __('set <strong>"type of pagination"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'nivocontrolnavthumbsv',
					'options' => array(
						'false' => 'horizontally',
						'true' => 'vertically',
					),
					'description' => __('set <strong>"position"</strong> for thumbnails.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbswidth',
					'default' => '90px',
					'description' => __('set <strong>"width"</strong> for thumbnails.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbsheight',
					'default' => '50px',
					'description' => __('set <strong>"height"</strong> for thumbnails.<br />with "px" for ex. 200px', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbstop',
					'default' => '6px',
					'description' => __('set <strong>"top"</strong> for thumbnails location.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbsleft',
					'default' => '6px',
					'description' => __('set <strong>"left"</strong> for thumbnails location.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbsmarginr',
					'default' => '6px',
					'description' => __('set <strong>"margin right"</strong> for thumbnails.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocontrolnavthumbsmarginb',
					'default' => '6px',
					'description' => __('set <strong>"margin bottom"</strong> for thumbnails.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'nivocaptiononoff',
					'default' => 'true',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivocaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'nivopauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'nivorandomstart',
					'description' => __('set <strong>"Random selection"</strong> of the first image slider.', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'nivobgcolor',
					'description' => 'slider background',
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivotopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'nivobottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				),
			),
		),
		'kwicksslider' => array(
			__('Slider effects', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'kwicksease',
					'options' => array(
						'easeInQuad' => 'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad' => 'easeInOutQuad',
						'easeInCubic' => 'easeInCubic',
						'easeOutCubic' => 'easeOutCubic',
						'easeInOutCubic' => 'easeInOutCubic',
						'easeInQuart' => 'easeInQuart',
						'easeOutQuart' => 'easeOutQuart',
						'easeInOutQuart' => 'easeInOutQuart',
						'easeInQuint' => 'easeInQuint',
						'easeOutQuint' => 'easeOutQuint',
						'easeInOutQuint' => 'easeInOutQuint',
						'easeInSine' => 'easeInSine',
						'easeOutSine' => 'easeOutSine',
						'easeInOutSine' => 'easeInOutSine',
						'easeInExpo' => 'easeInExpo',
						'easeOutExpo' => 'easeOutExpo',
						'easeInOutExpo' => 'easeInOutExpo',
						'easeInCirc' => 'easeInCirc',
						'easeOutCirc' => 'easeOutCirc',
						'easeInOutCirc' => 'easeInOutCirc',
						'easeInElastic' => 'easeInElastic',
						'easeOutElastic' => 'easeOutElastic',
						'easeInOutElastic' => 'easeInOutElastic',
						'easeInBack' => 'easeInBack',
						'easeOutBack' => 'easeOutBack',
						'easeInOutBack' => 'easeInOutBack',
						'easeInBounce' => 'easeInBounce',
						'easeOutBounce' => 'easeOutBounce',
						'easeInOutBounce' => 'easeInOutBounce',
					),
					'description' => __('a custom <strong>"easing"</strong> function for the animation.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwicksduration',
					'default' => '500',
					'description' => __('set <strong>"duration"</strong> for animation (ms).', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'kwicksevent',
					'options' => array(
						'mouseover' => 'mouse over',
						'click' => 'click',
						'dblclick' => 'double click',
					),
					'description' => __('set <strong>"event"</strong> that triggers the expand effect.', 'my_framework'),
				),
			),
			__('Slider alignment', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'kwicksvertical',
					'options' => array(
						'false' => 'horizontally',
						'true' => 'vertically',
					),
					'description' => __('set <strong>"aligment"</strong> for slider.', 'my_framework'),
				),
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'kwickscaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwickscaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwickscaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwickscaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwickscaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'kwickssticky',
					'description' => __('sticky for kwick slides<br />one kwick will <strong>"always be expanded"</strong> if true.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwicksdefault',
					'description' => __('the <strong>"initially expanded kwick"</strong> (if and only if sticky is true).<br />default is 0 (index of slide).', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwickstopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'kwicksbottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				),
			),
		),
		'showcaseslider' => array(
			__('Slider effects', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'showcaseeffect',
					'options' => array(
						'hslide' => 'hslide',
						'vslide' => 'vslide',
						'fade' => 'fade',
					),
					'description' => __('specify <strong>"effect"</strong> parameter.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasedelay',
					'default' => '300',
					'description' => __('set <strong>"delay"</strong> time.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcaseanimspeed',
					'default' => '500',
					'description' => __('slide <strong>"transition speed</strong> (ms).', 'my_framework'),
				),
			),
			__('Slider thumbnails', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'showcasethumb',
					'description' => __('show <strong>"thumbnails"</strong> preview"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'showcasethumbalign',
					'options' => array(
						'horizontal' => 'horizontally',
						'vertical' => 'vertically',
					),
					'description' => __('set <strong>"aligment"</strong> for thumbnails.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'showcasethumbpos',
					'options' => array(
						'outside-last' => 'outside-last',
						'outside-first' => 'outside-first',
					),
					'description' => __('set <strong>"thumbnails position"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasethumbsslidex',
					'default' => '0',
					'description' => __('set <strong>"number of thumbnails"</strong> for slide.', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'showcasethumbbordercolor',
					'description' => 'thumbnails border color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'showcasethumbactivebordercolor',
					'description' => 'thumbnails active border color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'showcasethumbbgcolor',
					'description' => 'thumbnails background color',
				),
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'showcasecaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasecaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasecaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasecaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasecaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'showcasecaption',
					'options' => array(
						'onload' => 'onload',
						'onhover' => 'onhover',
						'show' => 'show',
					),
					'description' => __('specify <strong>"how show caption"</strong>.', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'showcaseauto',
					'description' => __('disable/enable <strong>"auto slider"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcaseinterval',
					'default' => '500',
					'description' => __('set <strong>"interval"</strong> for next slider (ms).', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'showcasepauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'showcasekeyboardnav',
					'description' => __('use <strong>"keyboard"</strong> navigation.', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'showcasebgcolor',
					'description' => 'background color',
				),
				array(
					'type' => 'inputtext',
					'name' => 'showcasetopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'showcasebottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				), 
			),
		),
		'cycleslider' => array(
			__('Slider effects', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'cycleeffect',
					'options' => array(
						'scrollLeft' => 'scrollLeft',
						'scrollRight' => 'scrollRight',
						'scrollUp' => 'scrollUp',
						'scrollDown' => 'scrollDown',
						'scrollHorz' => 'scrollHorz',
						'scrollVert' => 'scrollVert',
						'blindX' => 'blindX',
						'blindY' => 'blindY',
						'blindZ' => 'blindZ',
						'curtainX' => 'curtainX',
						'curtainY' => 'curtainY',
						'fade' => 'fade',
						'fadeZoom' => 'fadeZoom',
						'zoom' => 'zoom',
						'growX' => 'growX',
						'growY' => 'growY',
						'slideX' => 'slideX',
						'slideY' => 'slideY',
						'toss' => 'toss',
						'turnLeft' => 'turnLeft',
						'turnRight' => 'turnRight',
						'turnUp' => 'turnUp',
						'turnDown' => 'turnDown',
						'cover' => 'cover',
						'uncover' => 'uncover',
						'wipe' => 'wipe',
						'shuffle' => 'shuffle',
						'none' => 'none',
					),
					'description' => __('specify <strong>"effect"</strong> parameter.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'cyclesync',
					'description' => __('controls whether the <strong>"slide transitions occur simultaneously"</strong>.<br /> some effects behave differently.<br />(such as blind, curtain, and zoom)', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'cycleanimspeed',
					'default' => '1000',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'cycletimeout',
					'default' => '5000',
					'description' => __('set <strong>"timeout"</strong> between slide animation (ms).', 'my_framework'),
				), 
				array(
					'type' => 'combobox',
					'name' => 'cycleease',
					'options' => array(
						'' => 'no easing',
						'easeInQuad' => 'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad' => 'easeInOutQuad',
						'easeInCubic' => 'easeInCubic',
						'easeOutCubic' => 'easeOutCubic',
						'easeInOutCubic' => 'easeInOutCubic',
						'easeInQuart' => 'easeInQuart',
						'easeOutQuart' => 'easeOutQuart',
						'easeInOutQuart' => 'easeInOutQuart',
						'easeInQuint' => 'easeInQuint',
						'easeOutQuint' => 'easeOutQuint',
						'easeInOutQuint' => 'easeInOutQuint',
						'easeInSine' => 'easeInSine',
						'easeOutSine' => 'easeOutSine',
						'easeInOutSine' => 'easeInOutSine',
						'easeInExpo' => 'easeInExpo',
						'easeOutExpo' => 'easeOutExpo',
						'easeInOutExpo' => 'easeInOutExpo',
						'easeInCirc' => 'easeInCirc',
						'easeOutCirc' => 'easeOutCirc',
						'easeInOutCirc' => 'easeInOutCirc',
						'easeInElastic' => 'easeInElastic',
						'easeOutElastic' => 'easeOutElastic',
						'easeInOutElastic' => 'easeInOutElastic',
						'easeInBack' => 'easeInBack',
						'easeOutBack' => 'easeOutBack',
						'easeInOutBack' => 'easeInOutBack',
						'easeInBounce' => 'easeInBounce',
						'easeOutBounce' => 'easeOutBounce',
						'easeInOutBounce' => 'easeInOutBounce',
					),
					'description' => __('a custom <strong>"easing"</strong> function during the animation.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'cyclecaptionanimation',
					'description' => __('disable/enable <strong>"second image & caption animation"</strong>.', 'my_framework'),
				),
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'cyclecaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'cyclecaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'cyclecaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'cyclecaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'cyclecaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'cycledirectiononoff',
					'description' => __('enable/disable <strong>direction"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'cyclerandom',
					'description' => __('this causes the slides to be shown in <strong>"random order"</strong>, rather than sequential.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'cyclepauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'cyclebgcolor',
					'description' => 'background color',
				),
				array(
					'type' => 'inputtext',
					'name' => 'cycletopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'cyclebottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				), 
			),
		),
		'roundaboutslider' => array(
			__('Slider effects', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'roundaboutshape',
					'options' => array(
						'lazySusan' => 'lazySusan',
						'waterWheel' => 'waterWheel',
						'figure8' => 'figure8',
						'square' => 'square',
						'conveyorBeltLeft' => 'conveyorBeltLeft',
						'conveyorBeltRight' => 'conveyorBeltRight',
						'diagonalRingLeft' => 'diagonalRingLeft',
						'diagonalRingRight' => 'diagonalRingRight',
						'rollerCoaster' => 'rollerCoaster',
						'tearDrop' => 'tearDrop',
						'theJuggler' => 'theJuggler',
						'goodbyeCruelWorld' => 'goodbyeCruelWorld',
					),
					'description' => __('select <strong>"shape"</strong> for animation.<br />some of them are not suitable for this theme, It`s your choice.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'roundaboutease',
					'options' => array(
						'' => 'no easing',
						'easeInQuad' => 'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad' => 'easeInOutQuad',
						'easeInCubic' => 'easeInCubic',
						'easeOutCubic' => 'easeOutCubic',
						'easeInOutCubic' => 'easeInOutCubic',
						'easeInQuart' => 'easeInQuart',
						'easeOutQuart' => 'easeOutQuart',
						'easeInOutQuart' => 'easeInOutQuart',
						'easeInQuint' => 'easeInQuint',
						'easeOutQuint' => 'easeOutQuint',
						'easeInOutQuint' => 'easeInOutQuint',
						'easeInSine' => 'easeInSine',
						'easeOutSine' => 'easeOutSine',
						'easeInOutSine' => 'easeInOutSine',
						'easeInExpo' => 'easeInExpo',
						'easeOutExpo' => 'easeOutExpo',
						'easeInOutExpo' => 'easeInOutExpo',
						'easeInCirc' => 'easeInCirc',
						'easeOutCirc' => 'easeOutCirc',
						'easeInOutCirc' => 'easeInOutCirc',
						'easeInElastic' => 'easeInElastic',
						'easeOutElastic' => 'easeOutElastic',
						'easeInOutElastic' => 'easeInOutElastic',
						'easeInBack' => 'easeInBack',
						'easeOutBack' => 'easeOutBack',
						'easeInOutBack' => 'easeInOutBack',
						'easeInBounce' => 'easeInBounce',
						'easeOutBounce' => 'easeOutBounce',
						'easeInOutBounce' => 'easeInOutBounce',
					),
					'description' => __('a custom <strong>"easing"</strong> function during the animation.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutduration',
					'default' => '600',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutautoduration',
					'default' => '3000',
					'description' => __('<strong>"timeout"</strong> between slide animation (ms).', 'my_framework'),
				), 
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutcaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutcaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutcaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutcaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutcaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutcaptionontop',
					'description' => __('put <strong>"title on top"</strong> of the slider elements.<br />when it is on, caption text is hidden', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutdirectiononoff',
					'description' => __('enable/disable <strong>direction"</strong>.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutautoplay',
					'description' => __('enable/disable <strong>"autoplay"</strong> animation.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutreflect',
					'description' => __('enable/disable <strong>"reverses"</strong> the direction in which Roundabout will operate.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'roundaboutpauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutminopacity',
					'default' => '1',
					'description' => __('set <strong>"lowest opacity"</strong> that will be assigned to a moving element.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutminscale',
					'default' => '0.4',
					'description' => __('set <strong>"lowest size"</strong> (relative to its starting size) that will be assigned to a moving element.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutmaxscale',
					'default' => '1',
					'description' => __('set <strong>"greatest size"</strong> (relative to its starting size) that will be assigned to a moving element.', 'my_framework'),
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'roundaboutbordercolor',
					'description' => 'elements bottom border color',
				),
				array(
					'type' => 'inputtext',
					'name' => 'roundabouttopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'roundaboutbottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				), 
			),
		),
		'liteaccordionslider' => array(
			__('Slider effects', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'liteaccordionease',
					'options' => array(
						'' => 'no easing',
						'easeInQuad' => 'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad' => 'easeInOutQuad',
						'easeInCubic' => 'easeInCubic',
						'easeOutCubic' => 'easeOutCubic',
						'easeInOutCubic' => 'easeInOutCubic',
						'easeInQuart' => 'easeInQuart',
						'easeOutQuart' => 'easeOutQuart',
						'easeInOutQuart' => 'easeInOutQuart',
						'easeInQuint' => 'easeInQuint',
						'easeOutQuint' => 'easeOutQuint',
						'easeInOutQuint' => 'easeInOutQuint',
						'easeInSine' => 'easeInSine',
						'easeOutSine' => 'easeOutSine',
						'easeInOutSine' => 'easeInOutSine',
						'easeInExpo' => 'easeInExpo',
						'easeOutExpo' => 'easeOutExpo',
						'easeInOutExpo' => 'easeInOutExpo',
						'easeInCirc' => 'easeInCirc',
						'easeOutCirc' => 'easeOutCirc',
						'easeInOutCirc' => 'easeInOutCirc',
						'easeInElastic' => 'easeInElastic',
						'easeOutElastic' => 'easeOutElastic',
						'easeInOutElastic' => 'easeInOutElastic',
						'easeInBack' => 'easeInBack',
						'easeOutBack' => 'easeOutBack',
						'easeInOutBack' => 'easeInOutBack',
						'easeInBounce' => 'easeInBounce',
						'easeOutBounce' => 'easeOutBounce',
						'easeInOutBounce' => 'easeInOutBounce',
					),
					'description' => __('a custom <strong>"easing"</strong> function during the animation.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordionslidespeed',
					'default' => '800',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordioncyclespeed',
					'default' => '6000',
					'description' => __('<strong>"timeout"</strong> between slide animation (ms).', 'my_framework'),
				), 
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'liteaccordioncaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordioncaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordioncaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordioncaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordioncaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
			__('Items color', 'my_framework') => array(
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionbgcolor',
					'description' => 'item background color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionnamecolor',
					'description' => 'item name color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionactivenamecolor',
					'description' => 'item active name color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionnumbercolor',
					'description' => 'item number color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionactivenumbercolor',
					'description' => 'item active number color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionbordercolor',
					'description' => 'item border color',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'liteaccordionactivebordercolor',
					'description' => 'item active border color',
				),
			),
			__('Miscellaneous', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'liteaccordionactivateon',
					'options' => array(
						'click' => 'click',
						'mouseover' => 'mouseover',
					),
					'description' => __('set <strong>"event"</strong> that triggers the expand effect.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'liteaccordionautoplay',
					'description' => __('enable/disablee <strong>"autoplay"</strong> animation.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'liteaccordionpauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordionactiveslide',
					'default' => '1',
					'description' => __('displays <strong>"which slide on"</strong> page load.', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'liteaccordionrounded',
					'description' => __('enable/disable <strong>"rounded corner"</strong> for slider wrapper.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordiontopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'liteaccordionbottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				),
			),
		),
		'tmslider' => array(
			__('Slider effects', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'tmeffect',
					'options' => array(
						'zoomer' => 'zoomer',
						'centralExpand' => 'centralExpand',
						'fadeThree' => 'fadeThree',
						'simpleFade' => 'simpleFade',
						'gSlider' => 'gSlider',
						'vSlider' => 'vSlider',
						'slideFromLeft' => 'slideFromLeft',
						'slideFromTop' => 'slideFromTop',
						'diagonalFade' => 'diagonalFade',
						'diagonalExpand' => 'diagonalExpand',
						'fadeFromCenter' => 'fadeFromCenter',
						'zabor' => 'zabor',
						'vertivalLines' => 'vertivalLines',
						'gorizontalLines' => 'gorizontalLines',
						'random' => 'random',
					),
					'description' => __('specify <strong>"effect"</strong> parameter.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmduration',
					'default' => '10000',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'tmslideshow',
					'default' => '7000',
					'description' => __('<strong>"timeout"</strong> between slide animation (ms).', 'my_framework'),
				), 
			),
			__('Slider caption', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'tmcaptiononoff',
					'description' => __('enable/disable <strong>"caption"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmcaptiontop',
					'default' => '0',
					'description' => __('set <strong>"top"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmcaptionbottom',
					'default' => '0',
					'description' => __('set <strong>"bottom"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmcaptionleft',
					'default' => '0',
					'description' => __('set <strong>"left"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmcaptionright',
					'default' => '0',
					'description' => __('set <strong>"right"</strong> for caption.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
				array(
					'type' => 'checkbox',
					'name' => 'tmcaptiononbottom',
					'description' => __('put <strong>"title on bottom"</strong> of the slider wrapper.<br />when it is on, caption text is hidden', 'my_framework'),
				),
			),
			__('Miscellaneous', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'tmdirectiononoff',
					'description' => __('enable/disable <strong>direction"</strong>.', 'my_framework'),
				), 
				array(
					'type' => 'checkbox',
					'name' => 'tmpauseonhover',
					'description' => __('<strong>"pause animation"</strong> while hovering.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'tmwidth',
					'default' => '1600',
					'description' => __('set <strong>"width"</strong> for slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmshow',
					'default' => '0',
					'description' => __('displays <strong>"which slide"</strong> on page load (index of slide).', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'tmbgcolor',
					'description' => 'background color',
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmtopmargin',
					'default' => '0',
					'description' => __('set <strong>"top margin"</strong> for slider.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tmbottommargin',
					'default' => '0',
					'description' => __('set <strong>"bottom margin"</strong> for slider.', 'my_framework'),
				),
			),
		),
		'bgstretcherslider' => array(
			__('Slider effects', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'bgstretchereffect',
					'options' => array(
						'fade' => 'fade',
						'simpleSlide' => 'simpleSlide',
						'superSlide' => 'superSlide',
						'none' => 'none',
					),
					'description' => __('specify <strong>"effect"</strong> parameter.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'bgstretcherslidedirection',
					'options' => array(
						'W' => 'from left',
						'E' => 'from right',
						'N' => 'from top',
						'S' => 'from bottom',
						'NW' => 'from top left',
						'NE' => 'from top right',
						'SW' => 'from bottom left',
						'SE' => 'from bottom right',
					),
					'description' => __('specify <strong>"Slide Direction"</strong> parameter.<br />choose top right, top left, bottom right, bottom left when "superSlide" is selected for effect.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherspeed',
					'default' => '1000',
					'description' => __('slide <strong>"transition speed"</strong> (ms).', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherdelay',
					'default' => '6000',
					'description' => __('set <strong>"delay"</strong> between slide animation (ms).', 'my_framework'),
				), 
			),
			__('Image Setting', 'my_framework') => array(
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherwidth',
					'default' => '1600',
					'description' => __('set <strong>"width"</strong> for images.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherheight',
					'default' => '900',
					'description' => __('set <strong>"height"</strong> for images.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'bgstretchermaxwidth',
					'default' => 'auto',
					'description' => __('set <strong>"maximum width"</strong> for images.', 'my_framework'),
				), 
				array(
					'type' => 'inputtext',
					'name' => 'bgstretchermaxheight',
					'default' => 'auto',
					'description' => __('set <strong>"maximum height"</strong> for images.', 'my_framework'),
				), 
			),
			__('Pagination', 'my_framework') => array(
				array(
					'type' => 'checkbox',
					'name' => 'bgstretcherpagination',
					'description' => __('disable/enable <strong>"pagination"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherpaginationtop',
					'description' => __('set <strong>"top"</strong> for pagination.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherpaginationleft',
					'description' => __('set <strong>"left"</strong> for pagination.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'bgstretcherpaginationmargin',
					'description' => __('set <strong>"margin"</strong> for pagination.', 'my_framework'),
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bgstretcherpaginationcolor',
					'description' => 'pagination',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bgstretcherpaginationactivecolor',
					'description' => 'active pagination',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bgstretcherpaginationshadowcolor',
					'description' => 'pagination shadow',
				),
			),
			__('Miscellaneous', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'bgstretcherposition',
					'options' => array(
						'false' => 'fixed',
						'true' => 'absolute',
					),
					'description' => __('set <strong>"slider position"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'bgstretchermode',
					'options' => array(
						'normal' => 'normal',
						'back' => 'back',
						'random' => 'random',
					),
					'description' => __('displays <strong>"how slides play"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'combobox',
					'name' => 'bgstretcheranchor',
					'options' => array(
						'left top' => 'left top',
						'left center' => 'left center',
						'left bottom' => 'left bottom',
						'center top' => 'center top',
						'center center' => 'center center',
						'center bottom' => 'center bottom',
						'right top' => 'right top',
						'right center' => 'right center',
						'right bottom' => 'left center',
					),
					'description' => __('set <strong>"position"</strong> for slider.', 'my_framework'),
				),
			),
		),
		'bodycolor' => array(
			__('Set color for body elements', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'bodybgcolor',
					'description' => 'background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'bodytextcolor',
					'description' => 'text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bodytextshadowcolor',
					'description' => 'text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bodylinkcolor',
					'description' => 'link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'bodylinkhovercolor',
					'description' => 'link hovered',
				),
			),
			__('Set color for all headings', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'bodyhcolor',
					'description' => 'heading',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'bodyhshadowcolor',
					'description' => 'heading shadow',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'bodyhhovercolor',
					'description' => 'heading hovered',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'bodyhlinecolor',
					'description' => 'heading colored line',
				),
			),
			__('Set color for main sections', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'headerwrappercolor',
					'description' => 'header wrapper background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'contentwrappercolor',
					'description' => 'content wrapper background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footerwrappercolor',
					'description' => 'footer wrapper background',
				),
			),
			__('Set color for theme button', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'themebuttontextcolor',
					'description' => 'theme button text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'themebuttonbgcolor',
					'description' => 'theme button background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'themebuttontexthovercolor',
					'description' => 'theme button hover text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'themebuttonbghovercolor',
					'description' => 'theme button hover background',
				),
			),
			__('Set color for highlight', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'highlightcolor',
					'description' => 'highlight',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'highlightbgcolor',
					'description' => 'highlight background',
				),
			),
		),
		'topbarcolor' => array(
			__('Set color for top bar text', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'topbarbgcolor',
					'description' => 'top bar background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'topbarcolor',
					'description' => 'top bar text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'topbarshadowcolor',
					'description' => 'top bar text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'topbarlinkcolor',
					'description' => 'top bar link and hover',
				),
			),
		),
		'topinfocolor' => array(
			__('Set color for social network background', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'socialiconcolor',
					'description' => 'social icon background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'socialiconhovercolor',
					'description' => 'social icon hover background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'socialnetworkbgcolor',
					'description' => 'social network background',
				),
			),
		),
		'mainnavcolor' => array(
			__('Set color for main menu', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavbgcolor',
					'description' => 'menu background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavwrapbgcolor',
					'description' => 'menu wrapper background',
				),
			),
			__('Set color for main menu items', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavtextcolor',
					'description' => 'menu item text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavtexthovercolor',
					'description' => 'menu item text hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavtextcurrentcolor',
					'description' => 'menu item text current',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavtextshadowcolor',
					'description' => 'menu item text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavmenucolor',
					'description' => 'menu item background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavmenuhovercolor',
					'description' => 'menu item hover background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavmenucurrentcolor',
					'description' => 'menu item current background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavmenubordercolor',
					'description' => 'menu item top-border',
				),
			),
			__('Set color for main sub menus', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavsubmenucolor',
					'description' => 'sub-menu background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavsubmenushadowcolor',
					'description' => 'sub-menu bottom border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavsubmenutextcolor',
					'description' => 'sub-menu item text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavsubmenutexthovercolor',
					'description' => 'sub-menu item text hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'mainnavsubmenuitemcolor',
					'description' => 'sub-menu item background',
				),
			),
		),
		'topsearchcolor' => array(
			__('Set color for top/404 search', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'topsearchcolor',
					'description' => 'top search text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'topsearchbgcolor',
					'description' => 'top search background',
				),
			),
			__('Set color for top search wrapper', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'topsearchwrapperbgcolor',
					'description' => 'top search wrapper background',
				),
			),
		),
		'slogancolor' => array(
			__('Set color for slogan text', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'slogancolor',
					'description' => 'slogan',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sloganshadowcolor',
					'description' => 'slogan shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sloganbgcolor',
					'description' => 'slogan background',
				),
			),
		),
		'breadcrumbcolor' => array(
			__('Set color for breadcrumb text', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'breadcrumbcolor',
					'description' => 'breadcrumb',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'breadcrumbshadowcolor',
					'description' => 'breadcrumb shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'breadcrumblinkcolor',
					'description' => 'breadcrumb link and hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'breadcrumbbgcolor',
					'description' => 'breadcrumb background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'breadcrumbbordercolor',
					'description' => 'breadcrumb border',
				),
			),
		),
		'sidebarcolor' => array(
			__('Set general color', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarbgcolor',
					'description' => 'background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartextcolor',
					'description' => 'text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartextshadowcolor',
					'description' => 'text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarlinkcolor',
					'description' => 'link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarlinkhovercolor',
					'description' => 'link hovered',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarbordercolor',
					'description' => 'horizontal borders',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebardividercolor',
					'description' => 'sidebar divider',
				),
			),
			__('Set color for titles', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarhcolor',
					'description' => 'title',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarhshadowcolor',
					'description' => 'title shadow',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarhbgcolor',
					'description' => 'title background color',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarhtopbordercolor',
					'description' => 'title top border color',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarhbottombordercolor',
					'description' => 'title bottom border color',
				),
			),
			__('Set color for post/portfolio/comment widgets', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarheadingcolor',
					'description' => 'custom widgets title',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarheadinghovercolor',
					'description' => 'custom widgets title hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarrecentpostdatecolor',
					'description' => 'recent post date',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarrecentportdatecolor',
					'description' => 'recent portfolio date',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarrecentcommentcolor',
					'description' => 'recent comment author',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebardateauthorbgcolor',
					'description' => 'custom widgets date & author background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarframebgcolor',
					'description' => 'frame background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarframeshadowcolor',
					'description' => 'frame shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarrecentpostcolor',
					'description' => 'recent post text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarrecentpostbgcolor',
					'description' => 'recent post background',
				),
			),
			__('Set color for testimonial widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartestimonialtextcolor',
					'description' => 'testimonial text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartestimonialbgcolor',
					'description' => 'testimonial background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartestimonialnavcolor',
					'description' => 'testimonial navigation background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartestimonialimagebgcolor',
					'description' => 'testimonial image background',
				),
			),
			__('Set color for twitter widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartwittertextcolor',
					'description' => 'twitter text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartwitterbgcolor',
					'description' => 'twitter background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartwitterlinkcolor',
					'description' => 'twitter link',
				),
			),
			__('Set color for flickr widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarflickrbgcolor',
					'description' => 'flickr image background',
				),
			),
			__('Set color for contact form widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformtextcolor',
					'description' => 'contact form text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformbgcolor',
					'description' => 'contact form background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformbordercolor',
					'description' => 'contact form border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformshadowcolor',
					'description' => 'contact form shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformbuttontextcolor',
					'description' => 'contact form button text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarwidgetformbuttonbgcolor',
					'description' => 'contact form button background',
				),
			),
			__('Set color for tag/search/calendar widgets', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartagcolor',
					'description' => 'tag',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartagbgcolor',
					'description' => 'tag background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebartagbordercolor',
					'description' => 'tag border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarsearchtextcolor',
					'description' => 'search text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarsearchbgcolor',
					'description' => 'search background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarsearchiconbgcolor',
					'description' => 'search icon background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarsearchbordercolor',
					'description' => 'search border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'sidebarcalendarcolor',
					'description' => 'calendar active days background',
				),
			),
		),
		'footercolor' => array(
			__('Set general color', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footerbgcolor',
					'description' => 'background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footertextcolor',
					'description' => 'text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footertextshadowcolor',
					'description' => 'text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerlinkcolor',
					'description' => 'link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerlinkhovercolor',
					'description' => 'link hovered',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerbordercolor',
					'description' => 'bottom borders',
				),
			),
			__('Set color for titles', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footerhcolor',
					'description' => 'title',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footerhshadowcolor',
					'description' => 'title shadow',
				),
			),
			__('Set color for post/portfolio/comment widgets', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footerheadingcolor',
					'description' => 'custom widgets title',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerheadinghovercolor',
					'description' => 'custom widgets title hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerrecentpostdatecolor',
					'description' => 'recent post date',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerrecentportdatecolor',
					'description' => 'recent portfolio date',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerrecentcommentcolor',
					'description' => 'recent comment author',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerdateauthorbgcolor',
					'description' => 'custom widgets date & author background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerframebgcolor',
					'description' => 'frame background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerframeshadowcolor',
					'description' => 'frame shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerrecentpostcolor',
					'description' => 'recent post text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerrecentpostbgcolor',
					'description' => 'recent post background',
				),
			),
			__('Set color for testimonial widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footertestimonialtextcolor',
					'description' => 'testimonial text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footertestimonialbgcolor',
					'description' => 'testimonial background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footertestimonialnavcolor',
					'description' => 'testimonial navigation background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footertestimonialimagebgcolor',
					'description' => 'testimonial image background',
				),
			),
			__('Set color for twitter widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footertwittertextcolor',
					'description' => 'twitter text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footertwitterbgcolor',
					'description' => 'twitter background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footertwitterlinkcolor',
					'description' => 'twitter link',
				),
			),
			__('Set color for flickr widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footerflickrbgcolor',
					'description' => 'flickr image background',
				),
			),
			__('Set color for contact form widget', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformtextcolor',
					'description' => 'contact form text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformbgcolor',
					'description' => 'contact form background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformbordercolor',
					'description' => 'contact form border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformshadowcolor',
					'description' => 'contact form shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformbuttontextcolor',
					'description' => 'contact form button text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footerwidgetformbuttonbgcolor',
					'description' => 'contact form button background',
				),
			),
			__('Set color for tag/search/calendar widgets', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footertagcolor',
					'description' => 'tag',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footertagbgcolor',
					'description' => 'tag background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footertagbordercolor',
					'description' => 'tag border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footersearchtextcolor',
					'description' => 'search text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footersearchbgcolor',
					'description' => 'search background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footersearchiconbgcolor',
					'description' => 'search icon background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footersearchbordercolor',
					'description' => 'search border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footercalendarcolor',
					'description' => 'calendar active days background',
				),
			),
		),
		'copyrightcolor' => array(
			__('Set color for copyright section', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'footercopybgcolor',
					'description' => 'background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'footercopytextcolor',
					'description' => 'text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footercopytextshadowcolor',
					'description' => 'text shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footercopylinkcolor',
					'description' => 'link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'footercopylinkhovercolor',
					'description' => 'link hovered',
				),
			),
		),
		'postportcolor' => array(
			__('Set color for blog elements', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'postframebgcolor',
					'description' => 'frame background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'postinfotextcolor',
					'description' => 'info text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'postinfolinkcolor',
					'description' => 'info link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'postinfobgcolor',
					'description' => 'info background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'postinfoiconcolor',
					'description' => 'info icon background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'postdatecolor',
					'description' => 'date text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'postdatebgcolor',
					'description' => 'date background',
				),
			),
			__('Set color for portfolio elements', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'portframebgcolor',
					'description' => 'frame background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'portdetailstitlecolor',
					'description' => 'details titles',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdetailsdatecolor',
					'description' => 'details date text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdetailsdatebgcolor',
					'description' => 'details date background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdetailsiconcolor',
					'description' => 'details icon background',
				),
			),
			__('Set color for portfolio styles', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaulthcolor',
					'description' => 'default heading',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaultcatcolor',
					'description' => 'default category',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaulttextcolor',
					'description' => 'default text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaultbuttontextcolor',
					'description' => 'default button text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaultbuttonbgcolor',
					'description' => 'default button background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaultbgcolor',
					'description' => 'default background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'portdefaultbordercolor',
					'description' => 'default border',
				),
			),
			__('Set color for portfolio filter', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'portfiltertextcolor',
					'description' => 'filter text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'portfilteractivetextcolor',
					'description' => 'filter active text',
				),
			),
			__('Set color for author section', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'authortextcolor',
					'description' => 'author text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'authorhcolor',
					'description' => 'author heading',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'authorlinkcolor',
					'description' => 'author link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'authorbgcolor',
					'description' => 'author background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'authorbordercolor',
					'description' => 'author border',
				),
			),
			__('Set color for pagination section', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'oldernewertextcolor',
					'description' => 'pagination text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'oldernewertexthovercolor',
					'description' => 'pagination text hover',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'oldernewerbgcolor',
					'description' => 'pagination background',
				),
			),
			__('Set color for related post section', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'relatedpostcolor',
					'description' => 'related post thumbnail text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'relatedpostbgcolor',
					'description' => 'related post thumbnail background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'relatedposticoncolor',
					'description' => 'related post thumbnail icon background',
				),
			),
		),
		'paginationcolor' => array(
			__('Set color for pagination', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'paginationtextcolor',
					'description' => 'text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'paginationbgcolor',
					'description' => 'background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'paginationactivetextcolor',
					'description' => 'current-item text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'paginationactivebgcolor',
					'description' => 'current-item background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'paginationhovertextcolor',
					'description' => 'hovered-item text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'paginationhoverbgcolor',
					'description' => 'hovered-item background',
				),
			),
		),
		'concomcolor' => array(
			__('Set color for contact / reply forms', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'contacttextcolor',
					'description' => 'contact/reply form text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'contactbgcolor',
					'description' => 'contact/reply form background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'contactbordercolor',
					'description' => 'contact/reply form border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'contactshadowcolor',
					'description' => 'contact/reply form shadow',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'contactbuttontextcolor',
					'description' => 'contact/reply form button text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'contactbuttonbgcolor',
					'description' => 'contact/reply form button background',
				),
			),
			__('Set color for comment elements', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'commenttextcolor',
					'description' => 'comments text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'commentlinkcolor',
					'description' => 'comments link',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'commentbgcolor',
					'description' => 'comments background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'commentbordercolor',
					'description' => 'comments border',
				),
			),
		),
		'page404color' => array(
			__('Set color for 404 page heading & text', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'heading404color',
					'description' => '404 page heading',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'text404color',
					'description' => '404 page text',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'text404shadowcolor',
					'description' => '404 page text shadow',
				),
			),
			__('Set color for 404 search', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'search404textcolor',
					'description' => '404 page search text',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'search404bgcolor',
					'description' => '404 page search background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'search404iconbgcolor',
					'description' => '404 page search icon background',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'search404bordercolor',
					'description' => '404 page search border',
				),
			),
		),
		'backtotopcolor' => array(
			__('Set color for Back to Top', 'my_framework') => array( 
				array(
					'type' => 'colorpicker',
					'name' => 'backtotopbgcolor',
					'description' => 'back to top background',
				), 
				array(
					'type' => 'colorpicker',
					'name' => 'backtotopbordercolor',
					'description' => 'back to top border',
				),
				array(
					'type' => 'colorpicker',
					'name' => 'backtotoparrowcolor',
					'description' => 'back to top arrow',
				),
			),
		),
		'allbackground' => array(
			__('Top bar wrapper', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'topnavwrapperbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'topnavwrapperbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'topnavwrapperbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'topnavwrapperbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'topnavwrapperbgrepeat',
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
					'name' => 'topnavwrapperbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Header', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'headerbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'headerbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'headerbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'headerbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'headerbgrepeat',
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
					'name' => 'headerbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Main navigation wrapper', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'mainnavwrapperbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'mainnavwrapperbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainnavwrapperbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainnavwrapperbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'mainnavwrapperbgrepeat',
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
					'name' => 'mainnavwrapperbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Slider wrapper', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'sliderwrapperbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'sliderwrapperbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sliderwrapperbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'sliderwrapperbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'sliderwrapperbgrepeat',
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
					'name' => 'sliderwrapperbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Slogan wrapper', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'sloganwrapperbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'sloganwrapperbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sloganwrapperbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'sloganwrapperbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'sloganwrapperbgrepeat',
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
					'name' => 'sloganwrapperbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Sidebar', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'sidebarbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'sidebarbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'sidebarbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'sidebarbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'sidebarbgrepeat',
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
					'name' => 'sidebarbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Content', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'contentbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'contentbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'contentbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'contentbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'contentbgrepeat',
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
					'name' => 'contentbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Main (content & sidebar wrapper)', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'mainbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'mainbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'mainbgrepeat',
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
					'name' => 'mainbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Footer', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'footerwrapperbgonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'footerwrapperbg',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'footerwrapperbgleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'footerwrapperbgtop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'footerwrapperbgrepeat',
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
					'name' => 'footerwrapperbgfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Widget section', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'footerwidgetwrapperonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'footerwidgetwrapper',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'footerwidgetwrapperleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'footerwidgetwrappertop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'footerwidgetwrapperrepeat',
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
					'name' => 'footerwidgetwrapperfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
			__('Copyright', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'footercopyrightwrapperonoff',
					'description' => __('show or hide your desired background.', 'my_framework'),
				),
				array(
					'type' => 'uploadimage',
					'name' => 'footercopyrightwrapper',
					'description' => __('Choose and upload your image from here.<br />use the following fields respectively for set parameter:<br /><strong>"left"</strong> <strong>"top"</strong> <strong>"repeat"</strong> &amp;<strong>"fix"</strong>.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'footercopyrightwrapperleft',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'inputtext',
					'name' => 'footercopyrightwrappertop',
					'rowclass' => 'w130',
				),
				array(
					'type' => 'combobox',
					'name' => 'footercopyrightwrapperrepeat',
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
					'name' => 'footercopyrightwrapperfix',
					'options' => array(
						'' => 'scroll',
						'fixed' => 'fixed',
					),
					'rowclass' => 'w130',
				),
			),
		),
		'topbar' => array(
			__('Display top bar', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'topbaronoff',
					'description' => __('from here you can show or hide top bar.', 'my_framework'),
				),
			),
			__('Display top navigation', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'topbarnavonoff',
					'description' => __('from here you can show or hide top navigation.', 'my_framework'),
				),
			),
			__('Bar information', 'my_framework') => array( 
				array(
					'type' => 'textarea',
					'name' => 'topbartext',
					'description' => __('You can write your text to appear in top bar.', 'my_framework'),
				),
			),
		),
		'topinfo' => array(
			__('Display top information', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'topinfoonoff',
					'description' => __('from here you can show or hide top information section.', 'my_framework'),
				),
			),
			__('Top information align', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'topinfoalign',
					'options' => array(
						'textcenter' => 'center',
						'textleft' => 'left',
						'textright' => 'right',
					),
					'description' => __('set top information position.', 'my_framework'),
				),
			),
			__('Top information', 'my_framework') => array( 
				array(
					'type' => 'textarea',
					'name' => 'topinfo',
					'description' => __('You can write your information to appear in top i.e.<br />&lt;span class="email"&gt;support@company.com&lt;/span&gt;<br />&lt;span class="phone"&gt;(897) 222 8765&lt;/span&gt;', 'my_framework'),
				),
			),
		),
		'topsearch' => array(
			__('Display top search', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'topsearchonoff',
					'description' => __('from here you can show or hide top search.', 'my_framework'),
				),
			),
		),
		'mainnavigation' => array(
			__('Sticky menu', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'mainnavstickyonoff',
					'description' => __('you can enable/disable sticky menu from here.', 'my_framework'),
				),
			),
			__('Navigation arrow', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'mainnavarrowonoff',
					'description' => __('show or hide main navigation arrow.', 'my_framework'),
				),
			),
			__('Menu divider', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'mainnavmenudivideronoff',
					'description' => __('show or hide menu item divider.', 'my_framework'),
				),
			),
			__('Class', 'my_framework') => array(
				array(
					'type' => 'combobox',
					'name' => 'mainnavclass',
					'options' => array(
						'' => 'white',
						'color' => 'color',
					),
					'description' => __('select <strong>"class"</strong> for navigation.', 'my_framework'),
				),
			),
			__('Supersubs max width', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'mainnavsupersubsmaxwidth',
					'default' => '27',
					'description' => __('set <strong>"max width"</strong> for supersubs plugin.<br /><b><i>note: supersubs active when you set color for submenu and submenuitems</i></b>.', 'my_framework'),
				),
			),
			__('Effect properties', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'mainnavdelay',
					'default' => '200',
					'description' => __('set <strong>"delay"</strong> in milliseconds that the mouse can remain outside a submenu without it closing.', 'my_framework'),
				), 
				array(
					'type' => 'combobox',
					'name' => 'mainnavspeed',
					'options' => array(
						'normal' => 'normal',
						'fast' => 'fast',
						'slow' => 'slow',
					),
					'description' => __('select <strong>"speed"</strong> of the animation.', 'my_framework'),
				),
			),
			__('Main menu properties', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'mainnavborderradius',
					'description' => __('set <strong>"border radius"</strong>.<br />leave it blank for use default.', 'my_framework'),
				),
			),
			__('Main sub menu properties', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'mainnavsubmenuradius',
					'description' => __('set <strong>"sub-menu border radius"</strong>.<br />leave it blank for use default.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'mainnavsubmenuitemradius',
					'description' => __('set <strong>"sub-menu item border radius"</strong>.<br />leave it blank for use default.', 'my_framework'),
				),
			),
		),
		'slogan' => array(
			__('Display slogan', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'sloganonoff',
					'description' => __('enable/disable "slogan".', 'my_framework'),
				),
			),
			__('Display slogan controls', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'slogancontrolonoff',
					'description' => __('enable/disable "slogan controls".', 'my_framework'),
				),
			),
			__('Slogan speed', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'sloganspeed',
					'default' => '8000',
					'description' => __('set "animation speed" (ms).', 'my_framework'),
				),
			),
			__('Slogans', 'my_framework') => array( 
				array(
					'type' => 'textarea',
					'name' => 'slogan',
					'description' => __('You can write your slogan to appear.<br />slogans must be "|" separated like this:<br />slogan 1 | slogan 2 | etc ...', 'my_framework'),
				),
			),
		),
		'breadcrumb' => array(
			__('Display breadcrumb', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'breadcrumbonoff',
					'description' => __('from here you can show or hide breadcrumb.', 'my_framework'),
				),
			),
			__('Breadcrumb on home', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'breadcrumbhome',
					'description' => __('enable/disable breadcrumb on homepage.', 'my_framework'),
				),
			),
			__('Breadcrumb align', 'my_framework') => array(  
				array(
					'type' => 'combobox',
					'name' => 'breadcrumbalign',
					'options' => array(
						'textcenter' => 'center',
						'textleft' => 'left',
						'textright' => 'right',
					),
					'description' => __('set breadcrumb position.', 'my_framework'),
				),
			),
		),
		'backtotop' => array(
			__('Display "back to top"', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'backtotoponoff',
					'default' => 'true',
					'description' => __('from here you can show or hide backtotop.', 'my_framework'),
				),
			),
			__('Side of "back to top"', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'backtotopside',
					'options' => array(
						'right' => 'right',
						'left' => 'left',
					),
					'description' => __('select the side of "back to top" must be appear.', 'my_framework'),
				),
			),
			__('Margin from edge', 'my_framework') => array(  
				array(
					'type' => 'inputtext',
					'name' => 'backtotopmargin',
					'default' => '50px',
					'description' => __('margin from left or right edge of body.<br />with "px" for ex. 200px', 'my_framework'),
				),
			),
			__('Margin from bottom', 'my_framework') => array( 
				array(
					'type' => 'inputtext',
					'name' => 'backtotopbottom',
					'default' => '50px',
					'description' => __('margin from bottom of window.<br />with "px" or in percent for ex. 200px or 50%', 'my_framework'),
				),
			),
		),
		'socialnetwork' => array(
			__('Display Socials', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'socialonoff',
					'description' => __('enable/disable social icons.', 'my_framework'),
				),
			),
			__('Social Class', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'socialclass',
					'options' => array(
						'light' => 'light',
						'dark' => 'dark',
					),
					'description' => __('select <strong>"class"</strong> for dark or light icons.', 'my_framework'),
				),
			),
			__('Social Algin', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'socialalign',
					'options' => array(
						'center' => 'center',
						'left' => 'left',
						'right' => 'right',
					),
					'description' => __('select <strong>"align"</strong> social icons.', 'my_framework'),
				),
			),
			__('Social Icons (drag and sort items)', 'my_framework') => array( 
				array(
					'type' => 'hidden',
					'name' => 'socialnetworksort',
					'default' => 'delicious,deviantart,digg,facebook,flickr,google,lastfm,linkedin,picasa,rss,stumbleupon,tumblr,twitter,vimeo,youtube',
				),
				array(
					'type' => 'inputtext',
					'name' => 'deliciousnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Delicious"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'deviantartnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Deviant Art"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'diggnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Digg"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'facebooknetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Face Book"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'flickrnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Flickr"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'googlenetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Google"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'lastfmnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Lastfm"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'linkedinnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Linkedin"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'picasanetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Picasa"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'rssnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"RSS"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'stumbleuponnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Stumble Upon"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'tumblrnetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Tumblr"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'twitternetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Twitter"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'vimeonetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"Vimeo"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
				array(
					'type' => 'inputtext',
					'name' => 'youtubenetwork',
					'rowclass' => 'pa-option',
					'description' => __('set url for<strong>"You Tube"</strong>.<br />leave it blank if you want remove it.', 'my_framework'),
				),
			),
		),
		'socialshare' => array(
			__('Face Book', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'facebookshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Face Book"</strong>.', 'my_framework'),
				),
			),
			__('Twitter', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'twittershare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Twitter"</strong>.', 'my_framework'),
				),
			),
			__('Google', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'googleshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Google"</strong>.', 'my_framework'),
				),
			),
			__('Stumble Upon', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'stumbleuponshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Stumble Upon"</strong>.', 'my_framework'),
				),
			),
			__('My Space', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'myspaceshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"My Space"</strong>.', 'my_framework'),
				),
			),
			__('Delicious', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'deliciousshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Delicious"</strong>.', 'my_framework'),
				),
			),
			__('Digg', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'diggshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Digg"</strong>.', 'my_framework'),
				),
			),
			__('Reddit', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'redditshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Reddit"</strong>.', 'my_framework'),
				),
			),
			__('Linkedin', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'linkedinshare',
					'default' => 'true',
					'description' => __('set social share for<strong>"Linkedin"</strong>.', 'my_framework'),
				),
			),
		),
		'footeronoff' => array(
			__('Footer status', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'footeronoff',
					'default' => 'true',
					'description' => __('show or hide footer completely.<br />this section includes <strong>"widget section"</strong> and <strong>"copyright section"</strong>', 'my_framework'),
				),
			),
		),
		'footerstyle' => array(
			__('Footer widgets status', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'footerstyleonoff',
					'default' => 'true',
					'description' => __('show or hide footer widget section.', 'my_framework'),
				),
			),
			__('Select desired footer style', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'footerstyle',
					'options' => array(
						'style1',
						'style2',
						'style3',
						'style4',
						'style5',
						'style6',
						'style7',
						'style8',
					),
					'default' => 'style1',
					'class' => 'footer',
					'description' => __('show or hide footer widget section.', 'my_framework'),
				),
			),
		),
		'copyright' => array(
			__('Display copyright', 'my_framework') => array( 
				array(
					'type' => 'checkbox',
					'name' => 'copyrightonoff',
					'default' => 'true',
					'description' => __('use this option for show or hide copyright.', 'my_framework'),
				),
			),
			__('Display footer navigation', 'my_framework') => array( 
				array(
					'type' => 'combobox',
					'name' => 'copyrightnav',
					'options' => array(
						'no' => 'no navigation',
						'left' => 'left',
						'middle' => 'middle',
						'right' => 'right',
					),
					'description' => __('use this option for show or hide footer navigation.<br />Do not add any text when using navigation in desired section.', 'my_framework'),
				),
			),
			__('Choose and write copyright', 'my_framework') => array( 
				array(
					'type' => 'radio',
					'name' => 'copyright',
					'options' => array(
						'left-right',
						'middle',
					),
					'default' => 'left-right',
					'class' => 'copyright-',
					'description' => __('You can choose between the <strong>"left &amp; right"</strong> style or <strong>"middle"</strong> style.<br />click on button, text input will appear.', 'my_framework'),
				),
				array(
					'type' => 'textarea',
					'name' => 'copyrightleft',
					'rowclass' => 'copybox2',
					'placeholder' => __('Left text', 'my_framework'),
				),
				array(
					'type' => 'textarea',
					'name' => 'copyrightright',
					'rowclass' => 'copybox2',
					'placeholder' => __('Right text', 'my_framework'),
				),
				array(
					'type' => 'textarea',
					'name' => 'copyrightmiddle',
					'rowclass' => 'copybox1',
					'placeholder' => __('Middle text', 'my_framework'),
				),
			),
		),
	);





	// Create menu
	function create_pa_menu( $menu ) {

		echo '<div class="panelsidebar"><ul class="pa-accordion">';

		foreach ( $menu as $title => $sub_menu ) { 

			echo '<li class="sub-accordion">
					<div id="' . $title . '" class="accordion-head"></div>
					<div class="accordion-content">
						<ul class="tabs">';

			foreach ( $sub_menu as $sub_title => $name ) {

				echo '<li><a href="#' . $name . '-section">' . $sub_title . '</a></li>';
			}

			echo '</ul></div></li>';
		}

		echo '</ul></div>';
	}

	// Create elements
	function create_pa_elements($sections) {

		foreach($sections as $section => $elements) {

			echo '<div id="' . $section . '-section">
					<h2></h2>';

			foreach($elements as $title => $element) {

				echo '<div class="pa-option">
						<h4>' . $title . '</h4>';

						foreach( $element as $key => $values ) {

							if( ! empty( $values['name'] ) ) {
								$values['value'] = get_option( 'mytheme_'.$values['name'] );
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

			echo '</div><!-- #' . $section . '-section -->';
		}
	}





	// Create input text
	function pa_panel_inputtext( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" size="1" placeholder="<?php if ( isset( $placeholder ) ) echo $placeholder; ?>" value="<?php if ( $value == '' && isset( $default ) ) echo $default; else echo esc_attr( $value ); ?>"/>

			<?php if ( isset( $description ) ) { ?>
			<div class="description"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create long text
	function pa_panel_longtext( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="w500" size="1" placeholder="<?php if ( isset( $placeholder ) ) echo $placeholder; ?>" value="<?php if ( $value == '' && isset( $default ) ) echo $default; else echo esc_attr( $value ); ?>"/>

			<?php if ( isset( $description ) ) { ?>
			<div class="description full"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create textarea
	function pa_panel_textarea( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="1" rows="1" placeholder="<?php if ( isset( $placeholder ) ) echo $placeholder; ?>"><?php if ( $value == '' && isset( $default ) ) echo $default; else echo stripcslashes( esc_textarea( $value ) ); ?></textarea>

			<?php if ( isset( $description ) ) { ?>
			<div class="description full"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create combobox
	function pa_panel_combobox( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">

				<?php foreach ( $options as $key => $option ) { ?>

				<option value="<?php echo $key; ?>" <?php if ( $value == $key ) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>

				<?php } ?>

			</select>

			<?php if ( isset( $description ) ) { ?>
			<div class="description"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create checkbox
	function pa_panel_checkbox( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<label for="<?php echo $name; ?>"></label>
			<input type="hidden" name="<?php echo $name; ?>" value="false" />
			<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="true" <?php if ( $value == 'true' || ( $value == '' && $default == 'true' ) ) { echo 'checked="checked"'; } ?> />

			<?php if ( isset( $description ) ) { ?>
			<div class="description"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create radio
	function pa_panel_radio( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<?php foreach ($options as $key => $val ) { ?>

				<label for="<?php echo $name.$key; ?>" class="<?php echo $class.$val; ?>"><?php if ( $name == 'bodypattern' ) { echo '<img src="' . get_template_directory_uri() . '/includes/images/bodypattern.png" alt="" />'; } ?></label>
				<input type="radio" name="<?php echo $name; ?>" id="<?php echo $name.$key; ?>" value="<?php echo $val; ?>" <?php if ( $value == $val || ( $value == '' && $default == $val ) ) { echo 'checked="checked"'; } ?> />

			<?php } ?>

			<?php if ( isset( $description ) ) { ?>
			<div class="description full"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create add sidebar
	function pa_panel_addsidebar( $values ) {

		extract( $values ); ?>

		<div class="row">

			<label for="sidebaradd" class="wrapper-label">
			<input type="text" name="sidebaradd" id="sidebaradd" class="upload-text" size="1" value=""/>
			<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr($value); ?>"/>
			<input type="button" class="add-sidebar" value=""/>
			</label>

			<div id="added-sidebar-wrapper" data-title="<?php _e( 'Delete Confirmation', 'my_framework' ); ?>" data-message="<?php _e( 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?', 'my_framework' ); ?>">

				<div id="sidebar-item" class="sample-sidebar-item">
					<div class="added-sidebar-item-del"></div>
					<div class="added-sidebar-item-title"></div>
					<input type="hidden" id="created-sidebar">
				</div>

				<?php 
				$sidebaradd = explode('|', $value);
				for ($i=0; $i<sizeof($sidebaradd)-1 ;$i++) {
				?>

				<div id="sidebar-item" class="added-sidebar-item">
					<div class="added-sidebar-item-del"></div>
					<div class="added-sidebar-item-title"><?php echo $sidebaradd[$i]; ?></div>
					<input type="hidden" name="created-sidebar-<?php echo $i; ?>" id="created-sidebar-<?php echo $i; ?>" value="<?php echo $sidebaradd[$i]; ?>">
				</div>

				<?php } ?>

			</div>

		</div>

		<?php if ( isset( $description ) ) { ?>
		<div class="description full"><?php echo $description; ?></div>
		<?php } ?>

	<?php }

	// Create select sidebar
	function pa_panel_selectsidebar( $values ) {

		extract( $values ); ?>

		<div class="row <?php if ( $side == 'right' ) { echo 'sidebar-selection-right'; } else { echo 'sidebar-selection-left'; } ?>">

			<select name="<?php echo $name; ?>">
				<?php if ( $side == 'right' ) { ?>
				<option value="sidebar-right" <?php if ( $value == 'sidebar-right' ) { echo 'selected="selected"'; } ?> ><?php _e('main right', 'my_framework'); ?></option>
				<?php } if ( $side == 'left' ) {  ?>
				<option value="sidebar-left" <?php if ( $value == 'sidebar-left') { echo 'selected="selected"'; } ?> ><?php _e('main left', 'my_framework'); ?></option>
				<?php } ?>
				<?php $sidebaradds = get_option('mytheme_sidebaraddvalues'); $sidebaradd = explode('|', $sidebaradds); for ( $i=0; $i<sizeof($sidebaradd)-1; $i++ ) { ?>
				<option value="<?php echo $sidebaradd[$i]; ?>" <?php if ( $value == $sidebaradd[$i] ) { echo 'selected="selected"'; } ?>><?php echo $sidebaradd[$i]; ?></option>
				<?php } ?>
			</select>

			<?php if ( isset( $description ) ) { ?>
			<div class="description"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create add font
	function pa_panel_addfont( $values ) {

		extract( $values ); ?>

		<div class="row">

			<label for="fontaddpath" class="wrapper-label">
			<input type="text" name="fontaddpath" id="fontaddpath" class="upload-text" size="1" value=""/>
			<input type="button" class="upload-button font" data-title="<?php _e('Select cufon font', 'my_framework'); ?>" data-button="<?php _e('Insert font', 'my_framework'); ?>" value=""/>
			</label>
			<input type="hidden" name="fontadd" id="fontadd" value=""/>
			<input type="hidden" name="fontaddvalues" id="fontaddvalues" value="<?php echo esc_attr( $value ); ?>"/>
			<input type="button" class="add-font" value="" />

			<div id="added-font-wrapper" data-title="<?php _e( 'Delete Confirmation', 'my_framework' ); ?>" data-message="<?php _e( 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?', 'my_framework' ); ?>">

				<div id="font-item" class="sample-font-item">
					<div class="added-font-item-del"></div>
					<div class="added-font-item-title"></div>
					<input type="hidden" id="created-font">
				</div>

				<?php 
				$fontadd = explode('|', $value);
				for ($i=0; $i<sizeof($fontadd)-1; $i++) {
					$font = explode('~', $fontadd[$i]);
				?>

				<div id="font-item" class="added-font-item">
					<div class="added-font-item-del"></div>
					<div class="added-font-item-title"><?php echo $font[0]; ?></div>
					<input type="hidden" name="created-font-<?php echo $i; ?>" id="created-font-<?php echo $i; ?>" value="<?php echo $fontadd[$i].'|'; ?>">
				</div>

				<?php } ?>

			</div>

		</div>

		<?php if ( isset( $description ) ) { ?>
		<div class="description full"><?php echo $description; ?></div>
		<?php } ?>

	<?php }

	// Create set font
	function pa_panel_setfont( $values ) {

		extract( $values ); ?>

		<div class="row">

			<?php include(TEMPLATEPATH . '/includes/misc/all-font.php'); ?>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
				<option value="" <?php if ($value=='') { echo 'selected="selected"'; } ?>><?php _e('Default', 'my_framework'); ?></option>

				<optgroup label="Upload Font">
				<?php sort($upload_font_array);
				foreach ($upload_font_array as $fontvalue) {
					$font_type = $fontvalue['name'].'|'.$fontvalue['type'].'|'.$fontvalue['path'] ?>
					<option value="<?php echo $font_type; ?>" <?php if ( $value == $font_type ) { echo 'selected="selected"'; } ?>><?php echo $fontvalue['name']; ?></option>
				<?php } ?>
				</optgroup>

				<optgroup label="Cufon Font">
				<?php sort($cufon_font_array);
				foreach ($cufon_font_array as $fontvalue) {
					$font_type = $fontvalue['name'].'|'.$fontvalue['type'].'|'.$fontvalue['path'] ?>
					<option value="<?php echo $font_type; ?>" <?php if ( $value == $font_type ) { echo 'selected="selected"'; } ?>><?php echo $fontvalue['name']; ?></option>
				<?php } ?>
				</optgroup>

				<optgroup label="Google Font">
				<?php sort($google_font_array);
				foreach ($google_font_array as $fontvalue) {
					$font_type = $fontvalue['name'].'|'.$fontvalue['type'].'|'.$fontvalue['weight'] ?>
					<option value="<?php echo $font_type; ?>" <?php if ( $value == $font_type ) { echo 'selected="selected"'; } ?>><?php echo $fontvalue['name']; ?></option>
				<?php } ?>
				</optgroup>

			</select>
			<div id="<?php echo $name; ?>-example" class="font-example"><?php _e('The Sample Text', 'my_framework'); ?></div>

		<?php if ( isset( $description ) ) { ?>
		<div class="description full"><?php echo $description; ?></div>
		<?php } ?>

		</div>

	<?php }

	// Create color picker
	function pa_panel_colorpicker( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="coloring" size="1" value="<?php echo esc_attr( $value ); ?>"/>
			<div class="description"><?php _e('set color for ', 'my_framework'); echo '<strong>"' . ( isset( $description ) ? $description : '' ) . '"</strong>.<br />'; _e('use name or hex etc....', 'my_framework'); ?></div>

		</div>

	<?php }

	// Create slider image chooser
	function pa_panel_setslider( $values ) {

		extract( $values ); ?>

		<div class="row<?php if ( isset( $rowclass ) ) echo ' ' . $rowclass; ?>">

			<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>"/>
			<?php image_chooser( $value ); ?>

		</div>

	<?php }

	// Create category
	function pa_panel_category( $values ) {

		extract( $values ); ?>

		<div class="row">

			<select name="<?php echo $name; ?>">
				<option value="" <?php if ( $value == '' ) { echo 'selected="selected"'; } ?> ><?php _e('all', 'my_framework'); ?></option>

				<?php
				if ( $posttype == 'blog' ) {
					$categories = get_all_category_ids();
					if ( is_array( $categories ) ) {
						foreach( $categories as $category ) {
							$category = get_cat_name( $category ); ?>
							<option value="<?php echo $category; ?>" <?php if ( $value == $category ) { echo 'selected="selected"'; } ?>><?php echo $category; ?></option>
						<?php } 
					}

				} else {
					$categories = custom_type_category( $posttype . '-category', null );
					if ( is_array( $categories ) ) {
						foreach( $categories as $category ) { ?>
							<option value="<?php echo $category; ?>" <?php if ( $value == $category ) { echo 'selected="selected"'; } ?>><?php echo $category; ?></option>
						<?php } 
					}
				}

				if ( $posttype == 'slider' ) {
					// add rev sliders list
					$result = all_rev_sliders_in_array();
					if ( is_array( $result ) ) {
						foreach( $result as $alias => $Title ) { ?>
							<option value="<?php echo $alias; ?>" <?php if ( $value == $alias ) { echo 'selected="selected"'; } ?>><?php echo $alias.' ( revolution only )'; ?></option>
					<?php }
					}
				}
				?>

			</select>

			<?php if ( isset( $description ) ) { ?>
			<div class="description"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create upload image
	function pa_panel_uploadimage( $values ) {

		extract( $values ); ?>

		<div class="row">

			<div class="example-image">
			<?php echo wp_get_attachment_image($value, '200x200'); ?>		
			</div>

			<label for="<?php echo $name; ?>" class="wrapper-label">
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="upload-text" size="1" value="<?php echo esc_attr($value); ?>"/>
			<input class="upload-button image" type="button" data-title="<?php _e('Select image', 'my_framework'); ?>" data-button="<?php _e('Insert image', 'my_framework'); ?>" value="" /></label>

			<?php if ( isset( $description ) ) { ?>
			<div class="description full"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create select icon
	function pa_panel_icon( $values ) {

		extract( $values ); ?>

		<div class="row">

			<div id="example-icon"></div>

			<label for="<?php echo $name; ?>" class="wrapper-label">
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="select-font-icon" >
				<option  value="<?php echo esc_attr($value); ?>"><?php _e('Select Icon', 'my_framework'); ?></option>
			</select>
			<div class="font-icon">
				<?php require_once( 'shortcode/icon.php' );
				foreach( $icon_array as $icon ) { ?>
					<span class="<?php echo $icon; ?>"></span>
				<?php } ?>
			</div>
			</label>

			<?php if ( isset( $description ) ) { ?>
			<div class="description full"><?php echo $description; ?></div>
			<?php } ?>

		</div>

	<?php }

	// Create hidden input
	function pa_panel_hidden( $values ) {

		extract( $values ); ?>

			<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if ( $value == '' && isset( $default ) ) echo $default; else echo esc_attr( $value ); ?>"/>

	<?php }