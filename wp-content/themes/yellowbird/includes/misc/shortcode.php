<?php

	// init process for button control
	function shortcode_addbuttons() {

		// Only add hooks when the current user has permissions and is in Rich Text editor mode
		if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) && get_user_option('rich_editing') ) {
			add_filter('mce_external_plugins', 'add_shortcode_tinymce_plugin');
			add_filter('mce_buttons_3', 'register_shortcode_button_3');
			add_filter('mce_buttons_4', 'register_shortcode_button_4');
		}
	}
	add_action('admin_head', 'shortcode_addbuttons');

	function register_shortcode_button_3($buttons) {

		array_push($buttons, 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'separator');
		array_push($buttons, 'row', 'column', 'percent_column', 'separator');
		array_push($buttons, 'accordion', 'toggle', 'tab', 'separator');
		array_push($buttons, 'divider', 'space', 'buttons', 'separator');
		array_push($buttons, 'list', 'faq', 'quote', 'dropcap', 'highlight', 'separator');

		return $buttons;
	}

	function register_shortcode_button_4($buttons) {

		array_push($buttons, 'step', 'counter', 'personnel', 'separator');
		array_push($buttons, 'social', 'progress_bar', 'price_table', 'contact_info', 'separator');
		array_push($buttons, 'testimonial', 'message_box', 'stunning', 'twitter', 'separator');
		array_push($buttons, 'youtube', 'vimeo', 'separator');
		array_push($buttons, 'frame', 'slider', 'separator');
		array_push($buttons, 'service1', 'service2', 'service3', 'separator');
		array_push($buttons, 'portfolio', 'post', 'separator');
		array_push($buttons, 'client', 'separator');

		return $buttons;
	}

	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_shortcode_tinymce_plugin($plugin_array) {

		if ( 'normal' == get_option( 'mytheme_editorstyle' ) ) {
			$plugin_array['allshortcodes'] = get_template_directory_uri() . '/includes/shortcode/shortcodes-normal.js';
		} else {
			$plugin_array['allshortcodes'] = get_template_directory_uri() . '/includes/shortcode/shortcodes.js';
		}

		return $plugin_array;
	}

	// Remove the auto-formatters for shortcode
	function all_run_shortcode($content) {
		global $shortcode_tags;
		$orig_shortcode_tags = $shortcode_tags;
		remove_all_shortcodes();
		add_shortcode('accordion', 'my_accordion');
		add_shortcode('ac-item', 'my_ac_item');
		add_shortcode('buttons', 'my_button');
		add_shortcode('client', 'my_client');
		add_shortcode('cl-item', 'my_client_item');
		add_shortcode('column', 'my_column');
		add_shortcode('percent-column', 'my_percolumn');
		add_shortcode('contact-info', 'my_contact_info');
		add_shortcode('counter', 'my_counter');
		add_shortcode('divider', 'my_divider');
		add_shortcode('dropcap', 'my_dropcap');
		add_shortcode('faq', 'my_faq');
		add_shortcode('fa-item', 'my_faq_item');
		add_shortcode('frame', 'my_frame');
		add_shortcode('h1', 'my_h1');
		add_shortcode('h2', 'my_h2');
		add_shortcode('h3', 'my_h3');
		add_shortcode('h4', 'my_h4');
		add_shortcode('h5', 'my_h5');
		add_shortcode('h6', 'my_h6');
		add_shortcode('highlight', 'my_highlight');
		add_shortcode('list', 'my_list');
		add_shortcode('li', 'my_list_item');
		add_shortcode('message-box', 'my_messagebox');
		add_shortcode('personnel', 'my_personnel');
		add_shortcode('portfolio', 'my_portwidget');
		add_shortcode('post', 'my_postwidget');
		add_shortcode('price-table', 'my_pricetable');
		add_shortcode('pr-item', 'my_pr_item');
		add_shortcode('pr-text', 'my_pr_item_text');
		add_shortcode('progress-bar', 'my_progress_bar');
		add_shortcode('quote', 'my_quote');
		add_shortcode('row', 'my_row');
		add_shortcode('service1', 'my_service1');
		add_shortcode('service2', 'my_service2');
		add_shortcode('service3', 'my_service3');
		add_shortcode('slider', 'my_slider');
		add_shortcode('social', 'my_social');
		add_shortcode('space', 'my_space');
		add_shortcode('step', 'my_step');
		add_shortcode('stunning', 'my_stunning');
		add_shortcode('tab', 'my_tab');
		add_shortcode('tab_item', 'my_tab_item');
		add_shortcode('testimonial', 'my_testimonial');
		add_shortcode('toggle', 'my_toggle');
		add_shortcode('to-item', 'my_to_item');
		add_shortcode('twitter', 'my_twitter');
		add_shortcode('vimeo', 'my_vimeo');
		add_shortcode('whiteframe', 'my_whiteframe');
		add_shortcode('youtube', 'my_youtube');
		$content = do_shortcode($content);
		$shortcode_tags = $orig_shortcode_tags;
		return $content;
	}
	add_filter('the_content', 'all_run_shortcode', 7);

	


/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/

	function my_accordion($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'titlecolor' => '',
	        'titlebackground' => '',
	        'signcolor' => '',
	        'signbackground' => '',
	        'contentcolor' => '',
	        'contentbackground' => ''
	    ), $atts));

		global $pa_accordion_array;
		$pa_accordion_array = array();

		do_shortcode($content);

		$my_accordion = 
		'<div>
			<ul class="pa-accordion">';

		for ( $i = 0; $i < sizeOf( $pa_accordion_array ); $i++ ) {
			$my_accordion .= 
			'<li class="sub-accordion '.$pa_accordion_array[$i]['active'].'">
				<div class="accordion-head" style="color:'.$titlecolor.'; background:'.$titlebackground.';">
					<div class="accordion-head-sign" style="color:'.$signcolor.'; background-color:'.$signbackground.';"></div>'
					.$pa_accordion_array[$i]['title'].
				'</div>
				<div class="accordion-content" style="color:'.$contentcolor.'; background-color:'.$contentbackground.';'.($contentbackground ? ' padding-top:20px;' : '').'">'
					.$pa_accordion_array[$i]['content'].
				'</div>
			</li>';
		}

		$my_accordion .= '</ul>
		</div>';
		return $my_accordion;
	}
	add_shortcode('accordion', 'my_accordion');

	// add shortcode for ac_item
	function my_ac_item($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'title' => '',
	        'active' => ''	// active
	    ), $atts));

		global $pa_accordion_array;

		$pa_accordion_array[] = array(
			'title' => $title,
	        'active' => $active,
			'content' => do_shortcode($content)
		);
	}
	add_shortcode('ac-item', 'my_ac_item');
	
	


/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/

	function my_button($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "text" => 'Read More',
	        "href" => '#',
			"size" => '',	// small, larg, xlarg
	        "class" => ''	// reverse
	    ), $atts));
		
		$my_button = '<a class="normal-button '.$size.' '.$class.'" href="'.$href.'" title="">'.$text.'</a>';
		return $my_button;
	}
	add_shortcode("buttons", "my_button");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Client
/*-----------------------------------------------------------------------------------*/

	function my_client($atts, $content = null) {
	    extract(shortcode_atts(array(
			"class" => '',	// dark
			"showcarousel" => 'off',	// off
			"navigation" => 'none',	// direction, pagination, none
			"visiblenumber" => '5',
			"showdivider" => 'off',	// off
			"background" => ''
	    ), $atts));
		
		$rand = rand();
		$my_client = '';
		
		if ($showcarousel!='off') $my_client .=
		'<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#clients-'.$rand.'").carouFredSel({
					items: {
						visible: '.$visiblenumber.',
						minimum: 1
					},
					pagination: "#client-pager-'.$rand.'",
					prev: {
						button: "#client-prev-'.$rand.'",
						key: "left"
					},
					next: {
						button: "#client-next-'.$rand.'",
						key: "right"
					},
					responsive: true,
					scroll: {
						items: 1,
						fx: "scroll",
						duration: 1000
					},
					auto: {
						timeoutDuration: 5000
					},
				});
			});
		</script>';
		
		$my_client .= 
		'<div class="clients-shortcode">
			<div class="clients-wrapper '.$class.'"'.($background!='' ? ' style="background-color:'.$background.';"' : '').'>
				<ul id="clients-'.$rand.'" class="clients'.($showdivider!='off' ? ' border' : '').'">'
						.do_shortcode($content).
				'</ul>
			</div>';
		if ($navigation=='direction') $my_client .= '<div class="client-direction"><a id="client-prev-'.$rand.'" class="prev" href="#"></a><a id="client-next-'.$rand.'" class="next" href="#"></a></div>';
		if ($navigation=='pagination') $my_client .= '<div id="client-pager-'.$rand.'" class="pager"></div>';
		$my_client .= '</div>';
		
		return $my_client;
	}
	add_shortcode("client", "my_client");
	
	// add shortcode for client item
	function my_client_item($atts, $content = null) {
	    extract(shortcode_atts(array(
			"href" => '#',
	        "image" => ''
	    ), $atts));
		
		$client_preview = wp_get_attachment_image_src($image,'full'); $client_preview = $client_preview[0];
		
		return '<li><a href="'.$href.'"> <img src="'.$client_preview.'" alt=""></a></li>';
	}
	add_shortcode("cl-item", "my_client_item");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Column
/*-----------------------------------------------------------------------------------*/

	function my_column($atts, $content = null) {
		extract( shortcode_atts(array(
			"size" => '1/1',
		), $atts) );

		switch($size){
			case '1/6':
				return '<div class="grid_2">'.do_shortcode($content).'</div>';
			case '1/4':
				return '<div class="grid_3">'.do_shortcode($content).'</div>';
			case '1/3':
				return '<div class="grid_4">'.do_shortcode($content).'</div>';
			case '5/12':
				return '<div class="grid_5">'.do_shortcode($content).'</div>';
			case '1/2':
				return '<div class="grid_6">'.do_shortcode($content).'</div>';
			case '7/12':
				return '<div class="grid_7">'.do_shortcode($content).'</div>';
			case '2/3':
				return '<div class="grid_8">'.do_shortcode($content).'</div>';
			case '3/4':
				return '<div class="grid_9">'.do_shortcode($content).'</div>';
			case '5/6':
				return '<div class="grid_10">'.do_shortcode($content).'</div>';
			default : 
			case '1/1':
				return '<div class="grid_12">'.do_shortcode($content).'</div>';
		}
	}
	add_shortcode("column", "my_column");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Column Percent Style
/*-----------------------------------------------------------------------------------*/

	function my_percolumn($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "width" => '',
	        "paddingright" => '',
	        "paddingleft" => ''
	    ), $atts));
		
		if ($paddingright=="") { $width=($width-2)."%"; $paddingright="2%"; }
		
		$my_percolumn = '<div class="percol" style="float:left; width:'.$width.'; padding-right:'.$paddingright.'; padding-left:'.$paddingleft.';">'.do_shortcode($content).'</div>';
		return $my_percolumn;
	}
	add_shortcode("percent-column", "my_percolumn");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Contact Info
/*-----------------------------------------------------------------------------------*/

	function my_contact_info($atts, $content = null) {
	    extract(shortcode_atts(array(
			'size' => '1/1',	// 1/1, 1/2, 1/3, 1/4
			'style' => '',	// color, default
			"address" => '',
			"phone" => '',
			"email" => '',
			"web" => ''
	    ), $atts));
		
		if ($size=='') $size = '1/1';
		if ($size=='1/1') $size = 'col1';
		if ($size=='1/2') $size = 'col2';
		if ($size=='1/3') $size = 'col3';
		if ($size=='1/4') $size = 'col4';
		
		$my_contact_info = '<ol class="contact-info '.$style.'">';
			if ($address!='') $my_contact_info .= '<li class="address '.$size.'"><div class="icon icon-building"></div>'.$address.'</li>';
			if ($phone!='') $my_contact_info .= '<li class="phone '.$size.'"><div class="icon icon-phone"></div>'.$phone.'</li>';
			if ($email!='') $my_contact_info .= '<li class="email '.$size.'"><div class="icon icon-envelope-alt"></div>'.$email.'</li>';
			if ($web!='') $my_contact_info .= '<li class="web '.$size.'"><div class="icon icon-globe2"></div>'.$web.'</li>';
		$my_contact_info .= '</ol>';
		
		return $my_contact_info;
	}
	add_shortcode("contact-info", "my_contact_info");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Counter
/*-----------------------------------------------------------------------------------*/

	function my_counter($atts, $content = null) {
	    extract(shortcode_atts(array(
			'size' => '1/4',	// 1/1, 1/2, 1/3, 1/4
			'start' => '1',
			'end' => '100',
			'color' => '',
			'speed' => '2000',
	    ), $atts));
		
		// set size
		if ($size == '1/1') { $size='grid_12'; }
		elseif ($size == '1/2') { $size='grid_6'; }
		elseif ($size == '1/3') { $size='grid_4'; }
		elseif ($size == '1/4') { $size='grid_3'; }
		
		$my_counter = '
		<div class="counter-item '.$size.'">
			<div class="counter-number once" data-from="'.$start.'" data-to="'.$end.'" data-speed="'.$speed.'" style="color:'.$color.';"></div>
			<div class="counter-text">'.$content.'</div></div>';
		
		return $my_counter;
	}
	add_shortcode("counter", "my_counter");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Divider
/*-----------------------------------------------------------------------------------*/

	function my_divider($atts) {
	    extract(shortcode_atts(array(
	        "width" => '',
	        "class" => '',	// left, right
	        "color" => '',
			"text" => '',
			"textalign" => '',	// left, right
			"textcolor" => '',
			"textsize" => ''
	    ), $atts));
		
		if ($textalign!='') $textalign='float'.$textalign;
		if ($class!='') $wrapclass='float'.$class; else $wrapclass='';
		
		$my_divider  = '<div class="divider-wrapper '.$wrapclass.'" '.($width!='' ? 'style="max-width:'.$width.';"' : '').'><div class="divider '.$class.'" style="background-color:'.$color.';"></div>';
		if ($text!='') $my_divider .= '<div class="divider-gotop '.$textalign.'" style="color:'.$textcolor.'; font-size:'.$textsize.';">'.$text.'</div>';
		$my_divider  .= '</div>';
		
		return $my_divider;
	}
	add_shortcode("divider", "my_divider");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Dropcap
/*-----------------------------------------------------------------------------------*/

	function my_dropcap($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "type" => '',	// circle
	        "color" => '',
			"background" => ''
	    ), $atts));
		
		$my_dropcap = '<span class="dropcaps '.$type.'" style="color:'.$color.'; background-color:'.$background.';">'.$content.'</span>';
		return $my_dropcap;
	}
	add_shortcode("dropcap", "my_dropcap");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Faq
/*-----------------------------------------------------------------------------------*/

	function my_faq($atts, $content = null) {
		
		$my_faq = 
		'<dl class="faq_list">'
			.do_shortcode($content).
		'</dl>';
		return $my_faq;
	}
	add_shortcode("faq", "my_faq");
	
	// add shortcode for faq item
	function my_faq_item($atts, $content = null) {
	    extract(shortcode_atts(array(
			"q" => '' //
	    ), $atts));
		
		$my_faq_item = 
		'<dt><span class="marker">Q?</span>'.$q.'</dt>
		<dd><span class="marker">A.</span><div>'.$content.'</div></dd>';
		return $my_faq_item;
	}
	add_shortcode("fa-item", "my_faq_item");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Frame
/*-----------------------------------------------------------------------------------*/

	function my_frame($atts, $content = null) {
	    extract(shortcode_atts(array(
			"image" => '',
	        "width" => '210',
	        "height" => '120',
			"align" => 'left',	// left, center, right
			"showlightbox" => 'off',	// off
			"linktype" => '',	// link, picture, video
			"href" => '',
			"showborder" => 'off',	// off
			"background" => '',
			"title" => ''
	    ), $atts));
		
		$rel='';
		$frame_full = wp_get_attachment_image_src($image, 'full'); $frame_full = $frame_full[0];
		$frame_preview = wp_get_attachment_image_src($image, $width.'x'.$height); $frame_preview = $frame_preview[0];
		
		if ($showborder!='off') $showborder=' border'; else $showborder='';
		if ($showlightbox!='off') $rel='data-rel="prettyPhoto"';
		if ($showlightbox!='off' && $href=='') { $rel='data-rel="prettyPhoto"'; $href=$frame_full; $linktype='magnify'; }
		
		$my_frame ='<div class="featured-thumbnail image-frame '.$align.$showborder.'">';
		
		if ($href!="" || $showlightbox!="off") $my_frame .= '<a class="image-wrap"'.($background!='' ? ' style="background:'.$background.';"' : '').' href="'.$href.'" '.$rel.' title="'.$title.'">'; else $my_frame .= '<div class="image-wrap"'.($background!='' ? ' style="background:'.$background.';"' : '').'>';

		if(!empty($frame_preview)){
		$my_frame .= '<img src="'.$frame_preview.'" width="'.$width.'" height="'.$height.'" alt="" title="'.$title.'" />';
		}
		
		if ($href!="" || $showlightbox!='off') $my_frame .= '<span class="zoom-icon icon-post '.$linktype.'"></span></a>'; else $my_frame .= '</div>';
		
		$my_frame .= '</div>';
		
		return $my_frame;
	}
	add_shortcode("frame", "my_frame");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Headings
/*-----------------------------------------------------------------------------------*/

	// add shortcode for h1
	function my_h1($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h1>'.$content.'</h1>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h1", "my_h1");
	
	// add shortcode for h2
	function my_h2($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h2>'.$content.'</h2>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h2", "my_h2");
	
	// add shortcode for h3
	function my_h3($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h3>'.$content.'</h3>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h3", "my_h3");
	
	// add shortcode for h4
	function my_h4($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h4>'.$content.'</h4>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h4", "my_h4");
	
	// add shortcode for h5
	function my_h5($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h5>'.$content.'</h5>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h5", "my_h5");
	
	// add shortcode for h6
	function my_h6($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "icon" => '',
	        "subtitle" => '',
	    ), $atts));
		
		$my_heading = '<div class="h-wrapper"><span class="icon '.$icon.'"></span><div><h6>'.$content.'</h6>';
		if ( $subtitle != '' ) $my_heading .= '<div class="sub-title">'.$subtitle.'</div>';
		$my_heading .= '</div></div>';
		
		return $my_heading;
	}
	add_shortcode("h6", "my_h6");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Highlight
/*-----------------------------------------------------------------------------------*/

	function my_highlight($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "color" => '',
	        "background" => ''
	    ), $atts));
		
		$my_highlight = 
		'<span class="highlight" style="color:'.$color.'; background:'.$background.';">'
			.$content.
		'</span>';
		return $my_highlight;
	}
	add_shortcode("highlight", "my_highlight");
	
	


/*-----------------------------------------------------------------------------------*/
/*	List
/*-----------------------------------------------------------------------------------*/

	function my_list($atts, $content = null) {
	    extract(shortcode_atts(array(
			"icon" => 'icon-checkmark2',
			"color" => '',
			"background" => '',
	    ), $atts));
		
		if ($color != '' || $background != '') $background = ' style="color:'.$color.'; background-color:'.$background.';"';

		global $list_array;
		$list_array = array();
		
		do_shortcode($content);
		
		$num = sizeOf($list_array);
		$my_list = '<div class="list"><ul>';

		for($i=0; $i<$num; $i++){

		$my_list .= '<li '.$background.'><span class="'.$icon.'"></span>' . $list_array[$i]["content"] . '</li>';
		}
		
		$my_list .= '</ul></div>';

		return $my_list;
	}
	add_shortcode("list", "my_list");
	
	// add shortcode for list item
	function my_list_item($atts, $content = null) {
		
		global $list_array;

		$list_array[] = array(
		"content" => do_shortcode($content));
	}
	add_shortcode("li", "my_list_item");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Message Box
/*-----------------------------------------------------------------------------------*/

	function my_messagebox($atts, $content = null) {
	    extract(shortcode_atts(array(
			"type" => 'red',	// red, yellow, blue, green
			"class" => ''	// small-icon, no-icon
	    ), $atts));
		
		$my_messagebox = 
		'<div class="message-box '.$class.' '.$type.'">'
			.do_shortcode($content).
		'</div>';
		return $my_messagebox;
	}
	add_shortcode("message-box", "my_messagebox");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Personnel
/*-----------------------------------------------------------------------------------*/

	function my_personnel($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "name" => '',
	        "post" => '',
	        "image" => '',
			"size" => '1/3',	// 1/2, 1/3, 1/4, 1/6
			"class" => '',	// dark
	        "background" => ''
	    ), $atts));
		
		if ($size=='') $size='1/3';
		if ($size=='1/2') $grid='grid_6';
		if ($size=='1/3') $grid='grid_4';
		if ($size=='1/4') $grid='grid_3';
		if ($size=='1/6') $grid='grid_2';
		
		$my_personnel = '<div class="personnel-shortcode '.$grid.' '.$class.'">';
		$my_personnel .= '<div class="personnel-image" style="background-color:'.$background.'">';
		
		if (!empty($image)) {
			$personnel_preview = wp_get_attachment_image_src($image, '570x570');
			$personnel_preview = $personnel_preview[0];
		}
				
		$my_personnel .= '<img src="'.$personnel_preview.'" alt="" />';
				
		$my_personnel .= '
			</div>
			<div class="personnel-content">
			<div class="personnel-name">'.$name.'</div>
			<div class="personnel-post">'.$post.'</div>
			<div class="personnel-details">'.$content.'</div></div></div>';
		return $my_personnel;
	}
	add_shortcode("personnel", "my_personnel");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Portfolio
/*-----------------------------------------------------------------------------------*/

	function my_portwidget($atts, $content = null) {
	    extract(shortcode_atts(array(
			"number" => '3',
	        "size" => '1/3',	// 1/2, 1/3, 1/4
	        "column" => '3',	// 1, 2, 3, 4
			"category" => '',
			"showcategory" => '',	//	off
			"showfilter" => '',	//	off
			"titlelength" => '30',
			"excerptlength" => '0',
			"textalign" => '',	//	left, right, center
			"showloadmore" => '',	//	off
			"singlemode" => 'outline',	//	lightbox, inline, outline, normal
			"counter" => '1'
	    ), $atts));
		
		$offset = 0;
		
		// set column
		if ($size == "1/1") { $col=''; }
		if ($size == "1/2") { if ($column=='1') $col='container_6'; else $col=''; }
		if ($size == "1/3") { if ($column=='1') $col='container_4'; elseif ($column=='2') $col='container_8'; else $col=''; }
		if ($size == "1/4") { if ($column=='1') $col='container_3'; elseif ($column=='2') $col='container_6'; elseif ($column=='3') $col='container_9'; else $col=''; }
		
		// set width, height
		if ($size == "1/1") { $width=1170; $height=760; $liclass="grid_12"; }
		elseif ($size == "1/2") { $width=570; $height=570; $liclass="grid_6"; }
		elseif ($size == "1/3") { $width=370; $height=370; $liclass="grid_4"; }
		elseif ($size == "1/4") { $width=270; $height=270; $liclass="grid_3"; }
		
		$wp_query = new WP_Query('post_type=portfolio&portfolio-category='.$category.'&posts_per_page='.$number.'&paged=1' );
			
		$my_portwidget = '<div class="ports shortcode '.$col.'"><div class="portfolio-shortcode-wrapper"><input id="port-info" type="hidden" data-count="'.$wp_query->found_posts.'" data-offset="'.($offset+$number).'" data-counter="'.$counter.'" data-singlemode="'.$singlemode.'" data-size="'.$size.'" data-column="'.$column.'" data-category="'.$category.'" data-showcategory="'.$showcategory.'" data-titlelength="'.$titlelength.'" data-excerptlength="'.$excerptlength.'" data-textalign="'.$textalign.'" value="" />';
		
		if ($showfilter!='off') {
		$my_portwidget .= '<div id="load-portfolio">
				<ul class="portfolio-filter" data-key="filter">
					<li><a href="#filter" data-value="*">All</a></li>';
						$filtercategories = custom_type_category('portfolio-category', $category_val=null );
						foreach($filtercategories as $filtercategory){
							$category_slug = str_replace(' ', '_', $filtercategory);
							$my_portwidget .= '<li><a href="#filter" data-value="' . $category_slug . '">' . $filtercategory . '</a></li>';
						}
					
		$my_portwidget .= '</ul>
			</div>';
		}
		
		$my_portwidget .= '
			<div id="outlineinfo"></div>
			<ul class="portfolio-item-wrapper">';
			if ( $wp_query->have_posts() ) while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$portwebsite = get_post_meta(get_the_ID(), 'portwebsite', true);
			$portthumbtype = get_post_meta(get_the_ID(), 'portthumbtype', true);
			$portthumbimage = get_post_meta(get_the_ID(), 'portthumbimage', true);
			$portthumbvideo = get_post_meta(get_the_ID(), 'portthumbvideo', true);
			$portthumbslider = get_post_meta(get_the_ID(), 'portthumbslider', true);
			$portthumbimageurl = get_post_meta(get_the_ID(), 'portthumbimageurl', true);
			
			if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); }

			if ($portthumbimage == 'post') { $href=get_permalink(); $icon='none'; $rel=''; }
			if ($portthumbimage == 'url') { $href=$portthumbimageurl; $icon='link'; $rel=''; }
			if ($portthumbimage == 'full') { $href=$large_image_url[0]; $icon='magnify'; $rel='prettyPhoto'; }
			if ($portthumbimage == 'picture') { $href=$portthumbimageurl; $icon='picture'; $rel='prettyPhoto'; }
			if ($portthumbimage == 'video') { $href=$portthumbimageurl; $icon='video'; $rel='prettyPhoto'; }
			
				$my_portwidget .= '<li data-id="id-'.get_the_ID().'" class="portfolio-item '.$liclass.' '.get_category_filter("portfolio-category").'">';
					
					if (($portthumbtype == "image" && has_post_thumbnail()) || ($portthumbtype == "video" && $portthumbvideo) || ($portthumbtype == "slider" && $portthumbslider)) { 
					$my_portwidget.='<div class="featured-thumbnail-wrapper">
										<div class="featured-thumbnail '.$portthumbtype.'">';
								if ($portthumbtype == "image") $my_portwidget .= create_port_image ($portthumbimage, $portthumbimageurl, $width, $height);
								if ($portthumbtype == "video") $my_portwidget .= create_video ($portthumbvideo, $width, $height);
								if ($portthumbtype == "slider") $my_portwidget .= create_slider ($portthumbslider, $width, $height);
					$my_portwidget .= '</div></div>';
					}
					
					/*$my_portwidget .= '<div class="portfolio-item-context '.$textalign.'">';
						
					if ($titlelength!=0) { 
					$my_portwidget .= '<h2 class="portfolio-item-title">';
					if ($singlemode=='lightbox') $my_portwidget .= '<a href="'.get_permalink().'" class="lightbox-port" data-id="'.get_the_ID().'" title="">';
					elseif ($singlemode=='inline') $my_portwidget .= '<a href="'.get_permalink().'" class="inline-port" data-id="'.get_the_ID().'" title="">';
					elseif ($singlemode=='outline') $my_portwidget .= '<a href="'.get_permalink().'" class="outline-port" data-id="'.get_the_ID().'" title="">';
					else $my_portwidget .= '<a href="'.get_permalink().'" title="">';
						$title = get_the_title(); $my_portwidget .= ($titlelength!='' ? substr($title, 0, $titlelength) : $title); 
					$my_portwidget .= '</a></h2>';
					}

					$my_portwidget .= '<div class="portfolio-item-icon-wrapper"><span class="icon"><span class="icon-post '.$icon.'"></span></span></div>';
	
					$my_portwidget .= '<div class="portfolio-item-content-wrapper">';
					if ($showcategory!='off') {
					$my_portwidget .= '<div class="portfolio-item-category">'.get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ', '' ).'</div>';
					}
		
					if ($excerptlength!=0) { 
					$my_portwidget .= '<div class="portfolio-item-content">'.wp_trim_words(get_the_content(), $excerptlength, '').'</div>';
					}

					$my_portwidget .= '</div></div>';*/
					
				$my_portwidget .= '</li>';
				
				endwhile;
				
			$my_portwidget .= '</ul>';
		
		if ($showloadmore!='off') {
		$my_portwidget .= '<div class="loadmore-wrapper textcenter"><span id="loadmore-portfolio" class="normal-button">LOAD<span class="spinner icon-spinner6"></span>MORE</span></div>';
		}
		
		$my_portwidget .= '</div></div>';
			
			wp_reset_query();
			
		return $my_portwidget;
	}
	add_shortcode("portfolio", "my_portwidget");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Post/Blog
/*-----------------------------------------------------------------------------------*/

	function my_postwidget($atts, $content = null) {
	    extract(shortcode_atts(array(
			"number" => '3',
			"size" => '1/3',	// 1/2, 1/3, 1/4
			"column" => '3',	// 1, 2, 3, 4
			"category" => '',
			"titlelength" => '',
			"excerptlength" => '23',
			"showimage" => '',	// off
			"showdate" => '',	// off
			"showbutton" => '',	// off
			"showloadmore" => '',	// off
			"counter" => '1'
		), $atts));
		
		$offset = 0;
		
		// set column
		if ($size == "1/1") { $col=''; }
		if ($size == "1/2") { if ($column=='1') $col='container_6'; else $col=''; }
		if ($size == "1/3") { if ($column=='1') $col='container_4'; elseif ($column=='2') $col='container_8'; else $col=''; }
		if ($size == "1/4") { if ($column=='1') $col='container_3'; elseif ($column=='2') $col='container_6'; elseif ($column=='3') $col='container_9'; else $col=''; }
		
		// set width, height
		if ($size == "1/1") { $width=1170; $height=760; $liclass="grid_12"; }
		elseif ($size == "1/2") { $width=570; $height=370; $liclass="grid_6"; }
		elseif ($size == "1/3") { $width=370; $height=240; $liclass="grid_4"; }
		elseif ($size == "1/4") { $width=270; $height=175; $liclass="grid_3"; }
									
		$wp_query = new WP_Query('post_type=post&post_status=publish&category_name='.$category.'&posts_per_page='.$number.'&paged=1');
		
		$my_postwidget = '<div class="posts-shortcode-wrapper '.$col.'">
								<div class="posts-shortcode">
								<input id="post-info" type="hidden" data-category="'.$category.'" data-titlelength="'.$titlelength.'" data-excerptlength="'.$excerptlength.'" data-count="'.$wp_query->found_posts.'" data-offset="'.($offset+$number).'" data-showimage="'.$showimage.'" data-showdate="'.$showdate.'" data-counter="'.$counter.'" value="" /><ul>';
									
		if ( $wp_query->have_posts() ) while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
		$postwebsite = get_post_meta(get_the_ID(), 'postwebsite', true);
		$postthumbtype = get_post_meta(get_the_ID(), 'postthumbtype', true);
		$postthumbimage = get_post_meta(get_the_ID(), 'postthumbimage', true);
		$postthumbvideo = get_post_meta(get_the_ID(), 'postthumbvideo', true);
		$postthumbslider = get_post_meta(get_the_ID(), 'postthumbslider', true);
		
		$my_postwidget .= '<li class="post-shortcode-item '.$liclass.'"><div class="details-wrap">';
		
		if ($showimage!='off') {
		$my_postwidget .= '<div class="featured-thumbnail">';
					if ($postthumbtype == "image") $my_postwidget .= create_image ($postthumbimage, '', $width, $height, false);
					if ($postthumbtype == "video") $my_postwidget .= create_video ($postthumbvideo, $width, $height);
					if ($postthumbtype == "slider") $my_postwidget .= create_slider ($postthumbslider, $width, $height);
		$my_postwidget .= '</div>';
		}
		
		$my_postwidget .= '<div class="post-avatar">'.get_avatar( get_the_author_meta('ID'), $size='70' ).'</div>';
		
		$my_postwidget .= '<div class="post-title"><h3><a href="'.get_permalink().'">';
			$title = get_the_title(); $my_postwidget .= (intval($titlelength)!='' ? substr($title, 0, $titlelength) : $title);
		$my_postwidget .= '</a></h3></div>';
		
		if ($showdate!='off') {
		$my_postwidget .= '<div class="post-time">'.get_the_time('F j, Y').'</div>';
		}
		
		$my_postwidget .= '<div class="post-context">';
		
		if ($excerptlength!=0) {
		 $my_postwidget .= '<div class="post-excerpt">'.wp_trim_words(get_the_content(), $excerptlength, '').'</div>';	
		}
		
		if ($showbutton!='off') {
		$my_postwidget .= '<div class="textcenter"><a href="'.get_permalink().'" class="normal-button">Read More</a></div>';
		}
				
		$my_postwidget .= '</div></div>';
		$my_postwidget .= '</li>';
		
		endwhile; wp_reset_query();
		
		$my_postwidget .= '</ul></div>';
		
		if ($showloadmore!='off') {
		$my_postwidget .= '<div class="loadmore-wrapper textcenter"><span id="loadmore-post" class="normal-button">LOAD<span class="spinner icon-spinner6"></span>MORE</span></div>';
		}
		
		$my_postwidget .= '</div>';
			
		return $my_postwidget;
	}
	add_shortcode("post", "my_postwidget");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Price Table
/*-----------------------------------------------------------------------------------*/

	function my_pricetable($atts, $content = null) {
		
		$my_pricetable = 
		'<div class="pa-price-table">
			<div class="price-item-wrapper">'
			.do_shortcode($content).
			'</div>
		</div>';
		return $my_pricetable;
	}
	add_shortcode("price-table", "my_pricetable");
	
	// add shortcode for price table item
	function my_pr_item($atts, $content = null) {
	    extract(shortcode_atts(array(
			"size" => '1/5',	// 1/3, 1/4, 1/5, 1/6
			"width" => '',
	        "title" => '',
	        "price" => '',
			"pricetext" => '',
	        "buttontext" => 'SUBMIT',
	        "href" => '',
	        "active" => ''	// active
	    ), $atts));
		
		if ($size=='') $size = '1/5';
		if ($size=='1/3') $size = 'col3';
		if ($size=='1/4') $size = 'col4';
		if ($size=='1/5') $size = 'col5';
		if ($size=='1/6') $size = 'col6';
		
		$my_pr_item = 
		'<div class="price-item '.$size.' '.$active.'" '.($width!='' ? 'style="width:'.intval($width).'px;"' : '').'>
			<div class="top">
				<div class="price-title">'.$title.'</div>
				<div class="price-price">'.$price.'</div>
				<div class="price-pricetext">'.$pricetext.'</div></div>
			<div class="price-content-wrapper">'
				.do_shortcode($content).
			'</div>
			<div class="bottom">
				<div class="price-button">
					<a class="normal-button" href="'.$href.'">'.$buttontext.'</a></div></div>
		</div>';
		return $my_pr_item;
	}
	add_shortcode("pr-item", "my_pr_item");
	
	// add shortcode for price text
	function my_pr_item_text($atts, $content = null) {
		
		$my_pr_item_text = 
		'<div class="price-content">'
			.$content.
		'</div>';
		return $my_pr_item_text;
	}
	add_shortcode("pr-text", "my_pr_item_text");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/

	function my_progress_bar($atts, $content = null) {
	    extract(shortcode_atts(array(
			"title" => '',
			"titlecolor" => '',
			"showtitleinside" => '',	// off
			"value" => '',
			"showvalue" => '',	// off
			"barcolor" => '',
			"background" => '',
			"showradius" => ''	// off
	    ), $atts));
		
		if ($titlecolor!='') $titlecolor='style="color:'.$titlecolor.';"';
		if ($showtitleinside=='off') $inside=''; else $inside = 'inside';
		if ($showradius=='off') $radius=''; else $radius = 'radius';
		if ($showvalue=='off') $showvalue='display-none'; else $showvalue = '';
		
		$my_progress_bar = '
		<div class="progress-bar-wrapper once '.$inside.'" '.$titlecolor.'>';
		if ($showtitleinside=='off') $my_progress_bar .= '<span class="progress-bar-title">'.$title.'</span>';
			$my_progress_bar .= '<div class="progress-bar '.$inside.' '.$radius.'" style="background-color:'.$background.';">
				<div class="progress-bar-meter" style="width:'.intval($value).'%; background-color:'.$barcolor.';"><span class="icon icon-checkmark2"><span class="value '.$showvalue.'">'.$value.'</span></span>';
			if ($showtitleinside!='off') $my_progress_bar .= '<span class="progress-bar-title inside">'.$title.'</span><span class="value '.$showvalue.'">'.$value.'</span>';
			$my_progress_bar .= '</div></div>
		</div>';
		return $my_progress_bar;
	}
	add_shortcode("progress-bar", "my_progress_bar");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Quote
/*-----------------------------------------------------------------------------------*/

	function my_quote($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "type" => '',	// quote1, quote2, quote3, quote4
	        "color" => '',
			"background" => '',
	        "width" => '',
	        "align" => '',	// right, left
			"textshadow" => ''
	    ), $atts));
		
		$my_quote = 
		'<div class="blockquote '.$align.' '.$type.'" style="color:'.$color.'; background-color:'.$background.'; width:'.$width.'; text-shadow:'.$textshadow.';">';
		/*if ($type=='1') $my_quote .= '<div class="sign-wrapper"><span class="sign icon-quote-left"></span></div>';*/
		$my_quote .= '<div class="sign-wrapper '.$type.'">';
		if ( $type == '' ) $my_quote .= '<span class="icon-left icon-quote-left"></span>';
		$my_quote .= do_shortcode($content);
		if ( $type == '' ) $my_quote .= '<span class="icon-right icon-quote-right"></span>';
		$my_quote .= '</div></div>';
		return $my_quote;
	}
	add_shortcode("quote", "my_quote");
	
	


/*-----------------------------------------------------------------------------------*/
/*	row
/*-----------------------------------------------------------------------------------*/

	function my_row($atts, $content = null) {
	    extract(shortcode_atts(array(
			"textalign" => '',	// left, center, right
	        "color" => '',
	        "background" => '',
	        "image" => '',
	        "padding" => '0 0 0 0',
	        "margin" => '0 0 0 0',
	        "showparallax" => 'off',	// off
	    ), $atts));
		
		$image = wp_get_attachment_image_src($image,'full'); $image = 'url('.$image[0].')';

		$my_row = '<div class="row'.($showparallax!='off' ? ' parallax' : '').'" style="text-align:'.$textalign.'; color:'.$color.'; background-color:'.$background.'; background-image:'.$image.'; padding:'.$padding.'; margin:'.$margin.';"><div class="container_12">'.do_shortcode($content).'</div></div>';
		return $my_row;
	}
	add_shortcode("row", "my_row");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Service 1
/*-----------------------------------------------------------------------------------*/

	function my_service1($atts, $content = null) {
	    extract(shortcode_atts(array(
			"size" => '1/3',	// 1/2, 1/3, 1/4
	        "type" => '',	// reverse
	        "title" => '',
			"icon" => '',
			"href" => '#'
	    ), $atts));
		
		if ($size=='') $size='1/4';
		if ($size=='1/1') $grid='grid_12';
		if ($size=='1/2') $grid='grid_6';
		if ($size=='1/3') $grid='grid_4';
		if ($size=='1/4') $grid='grid_3';
		if ($size=='1/6') $grid='grid_2';
		
		$my_service1 = 
		'<div class="service-1 '.$type.' '.$grid.'">
			<div class="tilte"><h2>'.$title.'</h2></div>
			<div class="icon-wrapper"><span class="'.$icon.'"></span></div>
			<div class="text">'.$content.'</div>
		</div>';
		return $my_service1;
	}
	add_shortcode("service1", "my_service1");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Service 2
/*-----------------------------------------------------------------------------------*/

	function my_service2($atts, $content = null) {
	    extract(shortcode_atts(array(
			"size" => '1/3',	// 1/1, 1/2, 1/3, 1/4, 1/6
	        "title" => '',
	        "type" => '',	// type2, type3, type4
			"icon" => '',
			"href" => '#'
	    ), $atts));
		
		if ($size=='') $size='1/3';
		if ($size=='1/1') { $grid='grid_12'; $width='1170'; $height='585'; }
		if ($size=='1/2') { $grid='grid_6'; $width='570'; $height='285'; }
		if ($size=='1/3') { $grid='grid_4'; $width='370'; $height='185'; }
		if ($size=='1/4') { $grid='grid_3'; $width='270'; $height='135'; }
		if ($size=='1/6') { $grid='grid_2'; $width='120'; $height='60'; }
		
		$my_service2 =
		'<div class="service-2 '.$type.' '.$grid.'">';

		$my_service2 .= '<div class="icon"><span class="'.$icon.'"></span></div>';
		
		$my_service2 .= '<div class="text">';
		
		if ($href!='') $my_service2 .= '<h3><a href="'.$href.'" title="">'.$title.'</a></h3>';
		else $my_service2 .= '<h3>'.$title.'</h3>';
		
		$my_service2 .= '<div>'.$content.'</div></div></div>';
		return $my_service2;
	}
	add_shortcode("service2", "my_service2");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Service 3
/*-----------------------------------------------------------------------------------*/

	function my_service3($atts, $content = null) {
	    extract(shortcode_atts(array(
			"size" => '1/4',	// 1/2, 1/3, 1/4
	        "type" => '',	// color
	        "title" => '',
			"icon" => '',
			"href" => '#',
			"buttontext" => 'Read More',
	    ), $atts));
		
		if ($size=='') $size='1/4';
		if ($size=='1/1') $grid='grid_12';
		if ($size=='1/2') $grid='grid_6';
		if ($size=='1/3') $grid='grid_4';
		if ($size=='1/4') $grid='grid_3';
		if ($size=='1/6') $grid='grid_2';
		
		$my_service3 = 
		'<div class="'.$grid.'"><div class="service-3 '.$type.'">
			<div class="icon"><span class="'.$icon.'"></span></div>
			<h3>'.$title.'</h3>
			<div class="text">'
				.$content.
			'</div><div class="button-wrapper"><a href="'.$href.'" class="normal-button" title="">'.$buttontext.'</a></div></div></div>';
		return $my_service3;
	}
	add_shortcode("service3", "my_service3");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/

	function my_slider($atts, $content = null) {
	    extract(shortcode_atts(array(
			"images" => '',
			"width" => '210',
			"height" => '120',
			"align" => 'left',	// right, left, center
			"effect" => 'fade',
			"showcaption" => 'off',	// off
			"showborder" => 'off',	// off
			"showdirection" => 'off',	// off
			"showcontrol" => ''	// off
	    ), $atts));
		
		$rand = rand();
		$my_slider = '<script type="text/javascript">
				jQuery(window).load(function() {
					// shortcodeslider init
					jQuery("#shortcodeslider-'.$rand.'").nivoSlider({
						effect:"'.$effect.'",
						directionNav:'.($showdirection=='off' ? 'false' : 'true').',
						directionNavHide:true,
						controlNav:'.($showcontrol=='off' ? 'false' : 'true').',
						pauseOnHover:true
					});
				});
		</script>';
		
		if ($align=='center') $my_slider .= '<div class="shortcodeslider-wrapper">';
		
		$my_slider .= '<div class="shortcodeslider featured-thumbnail '.$align.($showborder!='off' ? ' border' : '').'">
							<div id="shortcodeslider-'.$rand.'" class="nivoSlider">';
		
		$slider_ids = explode(",",$images);
		if ($slider_ids) {
				
			foreach ($slider_ids as $slider_id) {
			
				if(!empty($slider_id)) {
					$slider_preview = wp_get_attachment_image_src($slider_id, $width.'x'.$height);
					$attachment = get_post($slider_id);
				
					$my_slider .= '<img src="'.$slider_preview[0].'" alt="" title="'.($showcaption!='off' ? $attachment->post_excerpt : '').'" />';
				}
			}
		}
		
		$my_slider .= '</div></div>';
		
		if ($align=='center') $my_slider .= '</div>';
		return $my_slider;
	}
	add_shortcode("slider", "my_slider");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Social
/*-----------------------------------------------------------------------------------*/

	function my_social($atts, $content = null) {
	    extract(shortcode_atts(array(
			"type" => '',
			"text" => '',
			"style" => '',	// opened
			"class" => 'light'	// light, dark
	    ), $atts));
		
		$my_social = '<div class="social-icon '.$type.'">
							<a class="icon-social '.$class.' '.$style.'" href="'.$content.'"';
							if ( $style != 'opened' ) $my_social .= ' title="'.$type.'" data-rel="tipsy"';
							$my_social  .= '>';
							if ( $style == 'opened' ) $my_social .= '<span class="title">'.strtoupper($type).'</span><span class="text">'.$text.'</span>';
							$my_social .= '</a>
						</div>';
						
		return $my_social;
	}
	add_shortcode("social", "my_social");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Space
/*-----------------------------------------------------------------------------------*/

	function my_space($atts) {
	    extract(shortcode_atts(array(
	        "height" => '40px'
	    ), $atts));
		
		$my_space  = '<div class="clear'.((intval($height)<=100 && intval($height)%5==0) ? ' space'.intval($height).'"' : '" style="height:'.intval($height).'px;"').'></div>';
		return $my_space;
	}
	add_shortcode("space", "my_space");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Step
/*-----------------------------------------------------------------------------------*/

	function my_step($atts, $content = null) {
	    extract(shortcode_atts(array(
			'size' => '1/4',	// 1/3, 1/4
			'class' => 'topleft',	// topleft, topright, bottomright, bottomleft
			'number' => '1',
			'title' => 'your title',
			'icon' => '',
	    ), $atts));
		
		// set size
		if ($size == '1/1') { $size='grid_12'; }
		elseif ($size == '1/2') { $size='grid_6'; }
		elseif ($size == '1/3') { $size='grid_4'; }
		elseif ($size == '1/4') { $size='grid_3'; }
		
		$my_step  = '
		<div class="step-item '.$size.'">
			<div class="step-number">'.$number.'</div>
			<h3 class="step-title">'.$title.'</h3>
			<div class="step-text">'.$content.'</div></div>';
		return $my_step;
	}
	add_shortcode("step", "my_step");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Stunning
/*-----------------------------------------------------------------------------------*/

	function my_stunning($atts, $content = null) {
	    extract(shortcode_atts(array(
			"class" => '',	// dark
			"color" => '',
			"background" => '',
			"bordercolor" => '',
	    ), $atts));
		
		$my_stunning = '
		<div class="stunningtext '.$class.'" '.(($color || $background || $bordercolor) ? 'style="color:'.$color.'; background:'.$background.'; border-color:'.$bordercolor.';"' : '').'>'.$content.'</div>';
		return $my_stunning;
	}
	add_shortcode("stunning", "my_stunning");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Tab
/*-----------------------------------------------------------------------------------*/

	function my_tab($atts, $content = null) {
		extract( shortcode_atts(array(
			'type' => '',	// vertical 
			'titlecolor' => '',
			'titlebackground' => '',
			'titlebordercolor' => '',
			'contentcolor' => '',
			'contentbackground' => '',
			'contentbordercolor' => ''
		), $atts) );

		global $pa_tab_array;
		$pa_tab_array = array();

		do_shortcode($content);

		$tab = '<div class="tab-wrapper"><ul class="pa-tabs '.$type.'" style="border-color:'.$contentbordercolor.';">';

		for ( $i = 0; $i < sizeOf( $pa_tab_array ); $i++ ) {
			$active = ( $i == 0 ) ? 'active' : '';
			$tab_id = str_replace( ' ', '-', $pa_tab_array[$i]['title'] );
			$tab .= '<li><a href="#'.$tab_id.'" class="'.$active.'" style="color:'.$titlecolor.'; background:'.$titlebackground.'; border-color:'.$titlebordercolor.';">'.$pa_tab_array[$i]['title'];
			if ( $type == '' ) { $tab .= '<span class="icon-arrow-down"></span>'; 
			} else { $tab .= '<span class="icon-arrow-right"></span>'; }
			$tab .= '</a></li>';
		}				

		$tab .= '</ul>';
		$tab .= '<ul class="pa-tabs-content '.$type.'" style="color:'.$contentcolor.'; background-color:'.$contentbackground.';">';

		for ( $i = 0; $i < sizeOf( $pa_tab_array ); $i++ ) {
			$active = ( $i == 0 ) ? 'active' : '';
			$tab_id = str_replace( ' ', '-', $pa_tab_array[$i]['title'] );
			$tab .= '<li id="'.$tab_id.'" class="'.$active.'">'.$pa_tab_array[$i]['content'].'</li>';
		}

		$tab .= '</ul></div>';

		return $tab;
	}
	add_shortcode('tab', 'my_tab');

	// add shortcode for tab_item
	function my_tab_item( $atts, $content = null ){
		extract( shortcode_atts(array(
			'title' => '',
		), $atts) );

		global $pa_tab_array;

		$pa_tab_array[] = array(
			'title' => $title,
			'content' => do_shortcode($content)
		);
	}
	add_shortcode('tab_item', 'my_tab_item');
	
	


/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/

	function my_testimonial($atts) {
	    extract(shortcode_atts(array(
	        "class" => '',	// dark
			"showcarousel" => '',	// off
			"effect" => 'scroll',	// scroll, directscroll, fade, crossfade, cover, cover-fade, uncover, uncover-fade, none
			"navigation" => 'none',	// direction, pagination, none
	        "showimage" => '',	// off
	        "number" => '-1',
	        "contentlength" => '',
	        "color" => '',
	        "background" => '',
			"infocolor" => ''
	    ), $atts));
			
		$rand = rand();
		$my_testimonial = '';
		
		if ($showcarousel!='off')
		$my_testimonial .= '
		<div><script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#testimonial-'.$rand.'").carouFredSel({
					items: 1,
					pagination: "#testimonial-pager-'.$rand.'",
					prev: {
						button: "#testimonial-prev-'.$rand.'",
						key: "left"
					},
					next: {
						button: "#testimonial-next-'.$rand.'",
						key: "right"
					},
					responsive: true,
					scroll: {
						items: 1,
						fx: "'.$effect.'",
						duration: 1000
					},
					auto: {
						timeoutDuration: 5000
					},
				});
			});
		</script></div>';
		
		$my_testimonial .= '<div class="testimonial-wrapper '.$class.($showimage=='off' ? ' noimage' : '').($showcarousel=='off' ? ' nocar' : '').'"><ol id="testimonial-'.$rand.'">';
		
		query_posts("post_type=testimonial&post_status=publish&posts_per_page=".$number);
		while ( have_posts() ) : the_post();
		$post = get_post_meta(get_the_ID(), 'testipost', true);
		$company = get_post_meta(get_the_ID(), 'testicompany', true);
		$testilink = get_post_meta(get_the_ID(), 'testiurl', true);
		$thumb = get_the_post_thumbnail(get_the_ID(), '60x60');
		$content = get_the_content();
		if ( $contentlength != '' ) {
			$content = string_limit_words($content, $contentlength);
		}
		$name = get_the_title();
		$permalink = get_permalink();
		
		$my_testimonial .= '<li><div class="testimonial" style="color:'.$color.'; background-color:'.$background.';"></span>';
		
		if ($showimage!='off') $my_testimonial .= '<div class="testi-pic" style="border-color:'.$background.';">'.$thumb.'<span class="testi-name" style="color:'.$infocolor.';"><span class="testi-user">'.$name.' </span><a href="http://'.$testilink.'">'.$company.'</a></span></div>';
		
		$my_testimonial .= $content.'</div></li>';
		
		endwhile; wp_reset_query();
		
		$my_testimonial .= '</ol>';
		
		if ($navigation=='direction') $my_testimonial .= '<div class="testimonial-direction"><a id="testimonial-prev-'.$rand.'" class="prev" href="#"></a><a id="testimonial-next-'.$rand.'" class="next" href="#"></a></div>';
		if ($navigation=='pagination') $my_testimonial .= '<div id="testimonial-pager-'.$rand.'" class="pager"></div>';
		
		$my_testimonial .= '</div>';
		
		return $my_testimonial;
	}
	add_shortcode("testimonial", "my_testimonial");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/

	function my_toggle($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'titlecolor' => '',
	        'titlebackground' => '',
	        'signcolor' => '',
	        'signbackground' => '',
	        'contentcolor' => '',
	        'contentbackground' => ''
	    ), $atts));

		global $pa_toggle_array;
		$pa_toggle_array = array();

		do_shortcode($content);

		$my_toggle = 
		'<div>
			<ul class="pa-toggle">';

		for ( $i = 0; $i < sizeOf( $pa_toggle_array ); $i++ ) {
		$my_toggle .= '<li class="sub-toggle">
				<div class="toggle-head" style="color:'.$titlecolor.'; background:'.$titlebackground.';">
					<div class="toggle-head-sign" style="color:'.$signcolor.'; background:'.$signbackground.';"></div>'
					.$pa_toggle_array[$i]['title'].
				'</div>
				<div class="toggle-content '.$pa_toggle_array[$i]['active'].'" style="color:'.$contentcolor.'; background-color:'.$contentbackground.';'.($contentbackground ? ' padding-top:20px;' : '').'">'
				.$pa_toggle_array[$i]['content'].
				'</div>
			</li>';
		}

		$my_toggle .= '</ul>
		</div>';
		return $my_toggle;
	}
	add_shortcode('toggle', 'my_toggle');

	// add shortcode for toggle_item
	function my_to_item($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'title' => '',
	        'active' => '',	// active
	    ), $atts));

		global $pa_toggle_array;

		$pa_toggle_array[] = array(
			'title' => $title,
	        'active' => $active,
			'content' => do_shortcode($content)
		);
	}
	add_shortcode('to-item', 'my_to_item');
	
	


/*-----------------------------------------------------------------------------------*/
/*	Twitter
/*-----------------------------------------------------------------------------------*/

	function my_twitter($atts, $content = null) {
	    extract(shortcode_atts(array(
	        "id" => '',
			"consumerkey" => '',
			"consumersecret" => '',
			"accesstoken" => '',
			"accesstokensecret" => '',
			"showcarousel" => '',	// off
			"effect" => 'fade',	// scroll, directscroll, fade, crossfade, cover, cover-fade, uncover, uncover-fade, none
	        "number" => '3',
			"navigation" => 'none',	// direction, pagination, none
	        "showbutton" => 'off',	// off
	        "buttontext" => 'Follow Us',
	        "color" => '',
	    ), $atts));
			
		$rand = rand();
		$my_twitter = '';
		
		if ($showcarousel!='off')
		$my_twitter .= '
		<div><script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#twitter-shortcode-'.$rand.'").carouFredSel({
					items: 1,
					pagination: "#twitter-pager-'.$rand.'",
					prev: {
						button: "#twitter-prev-'.$rand.'",
						key: "left"
					},
					next: {
						button: "#twitter-next-'.$rand.'",
						key: "right"
					},
					responsive: true,
					scroll: {
						items: 1,
						fx: "'.$effect.'",
						duration: 1000
					},
					auto: {
						timeoutDuration: 5000
					},
				});
			});
		</script></div>';
		
		if (!empty($consumerkey) && !empty($consumersecret) && !empty($accesstoken) && !empty($accesstokensecret) && !empty($id)) {
				
			$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$id."&count=".$number) or die('Couldn\'t retrieve tweets! Wrong username?');
									
			if(!empty($tweets->errors)){
				if($tweets->errors[0]->message == 'Invalid or expired token'){
					echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
				}else{
					echo '<strong>'.$tweets->errors[0]->message.'</strong>';
				}
				return;
			}
			
			for($i = 0;$i <= count($tweets); $i++){
				if(!empty($tweets[$i])){
					$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
					$tweets_array[$i]['text'] = $tweets[$i]->text;			
					$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
				}	
			}
		
			$pa_twitter_shortcode_tweets = maybe_unserialize(serialize($tweets_array));
			if ( ! empty( $pa_twitter_shortcode_tweets ) ) {
			$my_twitter .= '
				<div class="twitter-shortcode-wrapper"'.($color!='' ? ' style="color:'.$color.';"' : '').'>
					<div class="twitter-shortcode">
						<div class="sign-wrapper"><span class="sign icon-twitter2"></span></div>
						<ul id="twitter-shortcode-'.$rand.'">';
						foreach($pa_twitter_shortcode_tweets as $tweet){								
							$my_twitter .= '<li><div>'.convert_links($tweet['text']).'</div><a class="twitter_time" target="_blank" href="http://twitter.com/'.$id.'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></li>';
						}
				
			$my_twitter .= '</ul>';
			
			if ( $showbutton != 'off' ) {
			$my_twitter .= '<div><a class="normal-button" href="http://twitter.com/'.$id.'">'.$buttontext.'</a></div>';
			}
			
			if ($navigation=='direction') $my_twitter .= '<div class="twitter-direction"><a id="twitter-prev-'.$rand.'" class="prev" href="#"><span class="icon-arrow-left11"></span></a><a id="twitter-next-'.$rand.'" class="next" href="#"><span class="icon-uniEA83"></span></a></div>';
			if ($navigation=='pagination') $my_twitter .= '<div id="twitter-pager-'.$rand.'" class="pager"></div>';
			
			$my_twitter .= '</div>';
			
			$my_twitter .= '</div>';
			
			}
			
			return $my_twitter;
		
		}
	}
	add_shortcode("twitter", "my_twitter");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Vimeo
/*-----------------------------------------------------------------------------------*/

	function my_vimeo($atts, $content = null) {
	    extract(shortcode_atts(array(
			"video" => '',
			"width" => '210',
			"height" => '120',
			"align" => 'left',	// right, left, center
			"showborder" => 'off',	// off
			"autoplay" => 'off',	// off
			"portrait" => 'off',	// off
			"title" => 'off',	// off
			"byline" => 'off',	// off
			"color" => ''
	    ), $atts));
		
		if ($showborder!='off') $showborder=' border'; else $showborder='';
		if ($autoplay!='off') $autoplay='autoplay=1&amp;'; else $autoplay='autoplay=0&amp;';
		if ($portrait!='off') $portrait='portrait=1&amp;'; else $portrait='portrait=0&amp;';
		if ($title!='off') $title='title=1&amp;'; else $title='title=0&amp;';
		if ($byline!='off') $byline='byline=1&amp;'; else $byline='byline=0&amp;';
		if ($color!='') $color='color='.substr($color, 1, 6).'&amp;'; else $color='';
		
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $video, $id);
		
		if(!empty($id[1])) {
		$my_vimeo = '<div class="shortcodevideo-wrapper '.$align.'">
					<div class="shortcodevideo'.$showborder.'">
						<iframe src="http://player.vimeo.com/video/'.$id[1].'?'.$autoplay.$portrait.$title.$byline.$color.'" width="'.$width.'" height="'.$height.'" title="">vimeo</iframe>
					</div></div>';
		return $my_vimeo;
		}
	}
	add_shortcode("vimeo", "my_vimeo");
	
	


/*-----------------------------------------------------------------------------------*/
/*	Youtube
/*-----------------------------------------------------------------------------------*/

	function my_youtube($atts, $content = null) {
	    extract(shortcode_atts(array(
			"video" => '',
			"width" => '210',
			"height" => '120',
			"align" => 'left',	// right, left, center
			"showborder" => 'off',	// off
			"autoplay" => 'off'	// off
	    ), $atts));
		
		if ($showborder!='off') $showborder=' border'; else $showborder='';
		if ($autoplay!='off') $autoplay='&amp;autoplay=1'; else $autoplay='';
		
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $id);
		
		if(!empty($id[1])) {
		$my_youtube = '<div class="shortcodevideo-wrapper '.$align.'">
						<div class="shortcodevideo'.$showborder.'">
							<iframe src="http://www.youtube.com/embed/'.$id[1].'?wmode=transparent'.$autoplay.'" width="'.$width.'" height="'.$height.'" title="">youtube</iframe>
						</div></div>';
		return $my_youtube;
		}
	}
	add_shortcode("youtube", "my_youtube");

?>