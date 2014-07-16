<?php
	

/*-----------------------------------------------------------------------------------*/
/*	General Functions
/*-----------------------------------------------------------------------------------*/


// the excerpt based on words
function string_limit_words($string, $word_limit) {
	
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words).'... ';
}


// create background for pages
function all_pages_bg() {
	
	global $post, $inline_css;
		
	if (is_page() || (class_exists('Woocommerce') && is_woocommerce())) {
		
		$pageimageonoff = get_post_meta($post->ID, 'pageimageonoff', true);
		$pageimage = get_post_meta($post->ID, 'pageimage', true);
		$pageimageleft = get_post_meta($post->ID, 'pageimageleft', true);
		$pageimagetop = get_post_meta($post->ID, 'pageimagetop', true);
		$pageimagerepeat = get_post_meta($post->ID, 'pageimagerepeat', true);
		$pageimagefix = get_post_meta($post->ID, 'pageimagefix', true);
		
		if (class_exists('Woocommerce') && is_woocommerce()) {
			$pageimageonoff = get_post_meta(woocommerce_get_page_id('shop'), 'pageimageonoff', true);
			$pageimage = get_post_meta(woocommerce_get_page_id('shop'), 'pageimage', true);
			$pageimageleft = get_post_meta(woocommerce_get_page_id('shop'), 'pageimageleft', true);
			$pageimagetop = get_post_meta(woocommerce_get_page_id('shop'), 'pageimagetop', true);
			$pageimagerepeat = get_post_meta(woocommerce_get_page_id('shop'), 'pageimagerepeat', true);
			$pageimagefix = get_post_meta(woocommerce_get_page_id('shop'), 'pageimagefix', true);
		}

		if (!empty($pageimage) && $pageimageonoff=='true') { 
			$pageimage = wp_get_attachment_image_src($pageimage,'full'); 
			$inline_css = '.body-background { background:url('.$pageimage[0].') '.$pageimageleft.' '.$pageimagetop.' '.$pageimagerepeat.' '.$pageimagefix.' !important; }' . "\n";
		}
	}

	// get all pages
	$args = array(
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'hierarchical' => 1,
		'exclude' => '',
		'child_of' => 0,
		'parent' => -1,
		'exclude_tree' => '',
		'number' => '',
		'offset' => 0,
		'post_type' => 'page',
		'post_status' => 'publish'
	);
	$pages = get_pages($args);
	
	//start loop
	foreach ($pages as $page_data) {
			
		$pageimageonoff = get_post_meta($page_data->ID, 'pageimageonoff', true);
		$pageimage = get_post_meta($page_data->ID, 'pageimage', true);
		$pageimageleft = get_post_meta($page_data->ID, 'pageimageleft', true);
		$pageimagetop = get_post_meta($page_data->ID, 'pageimagetop', true);
		$pageimagerepeat = get_post_meta($page_data->ID, 'pageimagerepeat', true);
		$pageimagefix = get_post_meta($page_data->ID, 'pageimagefix', true);
	
		if (!empty($pageimage) && $pageimageonoff=='true') {
			$pageimage = wp_get_attachment_image_src($pageimage,'full');
			$inline_css .= '#'.$page_data->post_name.' { background:url('.$pageimage[0].') '.$pageimageleft.' '.$pageimagetop.' '.$pageimagerepeat.' '.$pageimagefix.'; }' . "\n";
		}
	}
}
add_action('wp_enqueue_scripts', 'all_pages_bg');


// call google web font
function add_google_font() {
	
	$gfonts = array('fontbody','fonth','fontmainnav','fonthsidebar','fonthfooter','fontslogan','fontstunningtext');
	$protocol = is_ssl() ? 'https' : 'http';

	foreach ($gfonts as $gfont) {
		if (get_option('mytheme_'.$gfont)) {
			$gfont = explode('|', get_option('mytheme_'.$gfont)); 
			if ($gfont[1]=='googlefont') {
				$abr_name = strtolower(str_replace(' ', '' , $gfont[0]));
				$font_name = str_replace(' ', '+' , $gfont[0]);
			}
			if ($gfont[2]!='') $font_name = $font_name . ':'.$gfont[2];
			
			wp_enqueue_style( 'mytheme-'.$abr_name, "$protocol://fonts.googleapis.com/css?family=$font_name" );
		}
	}
	
}
add_action('wp_enqueue_scripts', 'add_google_font');


// call cufon font
function add_cufon_font(){

	$sections = array( 
		array( 'fontbody', 'bodytext', 'body' ),
		array( 'fonth', 'bodyh', 'h1, h2, h3, h4, h5, h6, .h-wrapper h1, .h-wrapper h2, .h-wrapper h3, .h-wrapper h4, .h-wrapper h5, .h-wrapper h6' ),
		array( 'fontmainnav', 'mainnavtext', '#main-nav a' ),
		array( 'fonthsidebar', 'sidebarh', '.sidebar .widget > h3, .sidebar .widget > .h-wrapper h3' ),
		array( 'fonthfooter', 'footerh', '#footer-wrapper .widget > h4' ),
		array( 'fontslogan', 'slogan', '#slogan' ),
		array( 'fontstunningtext', 'stunningtext', '.stunningtext-title' ),	
	);

	$replace = '';

	foreach( $sections as $section ) {

		$fontsection = explode('|', get_option( 'mytheme_' . $section[0] ) );
		$fontsectioncolor = get_option( 'mytheme_' . $section[1] . 'color' );
		if ( $fontsectioncolor != '' ) { $fontsectioncolor = ", color:'".$fontsectioncolor."'"; }
		$fontsectionshadow = get_option( 'mytheme_' . $section[1] . 'shadowcolor' );
		if ( $fontsectionshadow != '' ) { $fontsectionshadow = ", textShadow:'".$fontsectionshadow." 1px 1px 3px'"; }

		if ( isset( $fontsection[1] ) && $fontsection[1] == 'cufonfont' ) {
			echo '<script type="text/javascript" src="' . $fontsection[2] . '"></script>';
			$replace .= 'Cufon.replace("' . $section[2] . '", { hover:true, fontFamily:"' . $fontsection[0] . '" ' . $fontsectioncolor . $fontsectionshadow . ' });' . "\n";
		}
	}
	
	if ( $replace != '' ) {
		echo '<script type="text/javascript">' . $replace . '</script>'; 
	}
}
add_action('wp_footer', 'add_cufon_font', 22);


// get main slider and main slider category
function main_slider() {
	
	global $post;

	$slider = get_option('mytheme_slider');
	$slidercat = get_option('mytheme_slidercat');
	
	if (is_page() || (class_exists('Woocommerce') && is_woocommerce())) {
		$pageslider = get_post_meta($post->ID, 'pageslider', true);
		$pageslidercat = get_post_meta($post->ID, 'pageslidercat', true);
		if (class_exists('Woocommerce') && is_woocommerce()) {
			$pageslider = get_post_meta(woocommerce_get_page_id('shop'), 'pageslider', true);
			$pageslidercat = get_post_meta(woocommerce_get_page_id('shop'), 'pageslidercat', true);
		}
		if ($pageslider!='notset') { $slider=$pageslider; $slidercat=$pageslidercat; }
	}
	return array($slider,$slidercat);
}


function main_slider_options() {
	$slider = main_slider();
	$slider_options = null;
	if (!empty($slider[0])) {
		if ($slider[0]=='nivo') {
			
			$slider_options = array(
			'effect'=>get_option('mytheme_nivoeffect'),
			'slices'=>get_option('mytheme_nivoslices'),
			'boxcols'=>get_option('mytheme_nivoboxcols'),
			'boxrows'=>get_option('mytheme_nivoboxrows'),
			'animspeed'=>get_option('mytheme_nivoanimspeed'),
			'pausetime'=>get_option('mytheme_nivopausetime'),
			'directionnav'=>get_option('mytheme_nivodirectionnav'),
			'directionnavhide'=>get_option('mytheme_nivodirectionnavhide'),
			'controlnav'=>get_option('mytheme_nivocontrolnav'),
			'controlnavthumbs'=>get_option('mytheme_nivocontrolnavthumbs'),
			'pauseonhover'=>get_option('mytheme_nivopauseonhover'),
			'randomstart'=>get_option('mytheme_nivorandomstart'));
		
		} elseif ($slider[0]=='kwicks') {
			
			$slider_options = array(
			'easing'=>get_option('mytheme_kwicksease'),
			'isvertical'=>get_option('mytheme_kwicksvertical'),
			'sticky'=>get_option('mytheme_kwickssticky'),
			'defaultkwick'=>get_option('mytheme_kwicksdefault'),
			'event'=>get_option('mytheme_kwicksevent'),
			'duration'=>get_option('mytheme_kwicksduration'));
		
		} elseif ($slider[0]=='showcase') {
			
			$slider_options = array(
			'auto'=>get_option('mytheme_showcaseauto'),
			'interval'=>get_option('mytheme_showcaseinterval'),
			'keybordkeys'=>get_option('mytheme_showcasekeyboardnav'),
			'pauseonover'=>get_option('mytheme_showcasepauseonhover'),
			'transition'=>get_option('mytheme_showcaseeffect'),
			'transitiondelay'=>get_option('mytheme_showcasedelay'),
			'transitionspeed'=>get_option('mytheme_showcaseanimspeed'),
			'showcaption'=>get_option('mytheme_showcasecaption'),
			'thumbnails'=>get_option('mytheme_showcasethumb'),
			'thumbnailsposition'=>get_option('mytheme_showcasethumbpos'),
			'thumbnailsdirection'=>get_option('mytheme_showcasethumbalign'),
			'thumbnailsslidex'=>get_option('mytheme_showcasethumbsslidex'));
		
		} elseif ($slider[0]=='cycle') {
			
			$slider_options = array(
			'fx'=>get_option('mytheme_cycleeffect'),
			'pause'=>get_option('mytheme_cyclepauseonhover'),
			'easing'=>get_option('mytheme_cycleease'),
			'random'=>get_option('mytheme_cyclerandom'),
			'timeout'=>get_option('mytheme_cycletimeout'),
			'speed'=>get_option('mytheme_cycleanimspeed'),
			'sync'=>get_option('mytheme_cyclesync'),
			'animation'=>get_option('mytheme_cyclecaptionanimation'));
		
		} elseif ($slider[0]=='roundabout') {
			
			$slider_options = array(
			'minopacity'=>get_option('mytheme_roundaboutminopacity'),
			'minscale'=>get_option('mytheme_roundaboutminscale'),
			'maxscale'=>get_option('mytheme_roundaboutmaxscale'),
			'duration'=>get_option('mytheme_roundaboutduration'),
			'easing'=>get_option('mytheme_roundaboutease'),
			'autoplay'=>get_option('mytheme_roundaboutautoplay'),
			'autoplayduration'=>get_option('mytheme_roundaboutautoduration'),
			'autoplaypauseonhover'=>get_option('mytheme_roundaboutpauseonhover'),
			'reflect'=>get_option('mytheme_roundaboutreflect'),
			'shape'=>get_option('mytheme_roundaboutshape'));
		
		} elseif ($slider[0]=='liteaccordion') {
			
			$slider_options = array(
			'activateon'=>get_option('mytheme_liteaccordionactivateon'),
			'firstslide'=>get_option('mytheme_liteaccordionactiveslide'),
			'slidespeed'=>get_option('mytheme_liteaccordionslidespeed'),
			'autoplay'=>get_option('mytheme_liteaccordionautoplay'),
			'pauseonhover'=>get_option('mytheme_liteaccordionpauseonhover'),
			'cyclespeed'=>get_option('mytheme_liteaccordioncyclespeed'),
			'easing'=>get_option('mytheme_liteaccordionease'),
			'rounded'=>get_option('mytheme_liteaccordionrounded'));
		
		} elseif ($slider[0]=='tm') {
			
			$slider_options = array(
			'show'=>get_option('mytheme_tmshow'),
			'pauseonhover'=>get_option('mytheme_tmpauseonhover'),
			'duration'=>get_option('mytheme_tmduration'),
			'preset'=>get_option('mytheme_tmeffect'),
			'slideshow'=>get_option('mytheme_tmslideshow'));
		
		} elseif ($slider[0]=='bgstretcher') {
			
			$slider_options = array(
			'pagination'=>get_option('mytheme_bgstretcherpagination'),
			'images'=>include_once(TEMPLATEPATH . '/slider.php'),
			'imagewidth'=>get_option('mytheme_bgstretcherwidth'),
			'imageheight'=>get_option('mytheme_bgstretcherheight'),
			'maxwidth'=>get_option('mytheme_bgstretchermaxwidth'),
			'maxheight'=>get_option('mytheme_bgstretchermaxheight'),
			'nextslidedelay'=>get_option('mytheme_bgstretcherdelay'),
			'slideshowspeed'=>get_option('mytheme_bgstretcherspeed'),
			'transitioneffect'=>get_option('mytheme_bgstretchereffect'),
			'slidedirection'=>get_option('mytheme_bgstretcherslidedirection'),
			'sequencemode'=>get_option('mytheme_bgstretchermode'),
			'anchoring'=>get_option('mytheme_bgstretcheranchor'));
		
		}
	}
	return $slider_options;
}


// create static css
function generate_options_css(/*$newdata*/) {
	
	// check for create ststic or not
	global $cssstatic;
	if ($cssstatic!='true') return false;
 
	/** Define some vars **/
	/*$data = $newdata;*/ 
	$uploads = wp_upload_dir();
	$css_dir = get_template_directory(); // Shorten code, save 1 call
	
	/** Capture CSS output **/
	ob_start();
	require($css_dir.'/includes/misc/options.php');
	$css = ob_get_clean();
	
	/** Write to options.css file **/
	WP_Filesystem();
	global $wp_filesystem;
	if (!$wp_filesystem->put_contents($css_dir.'/css/options.css', $css, 0644)) {
		return true;
	}	
}
	

// return the category for custom type
function custom_type_category( $category_name, $parent=null ) {
	
	if( $parent=='' || $parent==null ){ 
		$categories = get_categories( array( 'taxonomy' => $category_name ));
		foreach( $categories as $category ){
			$category_list[] = $category->cat_name;
		}
		return $category_list;
	} else {
		$parent_id = get_term_by('name', $parent, $category_name);
		$categories = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id ));
		$category_list = array( '0' => $parent );
		
		foreach( $categories as $category ){
			$category_list[] = $category->cat_name;
		}
		return $category_list;
	}
}


// get the category for filter
function get_category_filter($custom_type) {
	
	$item_categories = get_the_terms( get_the_ID(), $custom_type );
	$item_category_slug = " ";
	if( !empty($item_categories) ){
		foreach( $item_categories as $item_category ){
			$item_category_slug .= str_replace(' ', '_', $item_category->name) . ' ';
		}
	}
	return $item_category_slug;
}


// get id from iamge source
function get_attachment_id_from_src($image_src) {
	
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='".trim($image_src)."'";
	$id = $wpdb->get_var($query);
	return $id;
}


// create image inside thumbnail
function create_image_inside($image, $width, $height, $lightbox=true) {
	
	$image_full = ''; $image_preview = '';
	if (!empty($image)) { 
		$image_full = wp_get_attachment_image_src( $image, 'full' );
		$image_full = (empty($image_full)) ? '' : $image_full[0];
		$image_preview = wp_get_attachment_image_src( $image, $width.'x'.$height);
		$image_preview = (empty($image_preview)) ? '' : $image_preview[0];
	}
	
	$a = ''; 
	if ($lightbox == 'true') $a .= '<a class="image-wrapper" href="'.$image_full.'" data-rel="prettyPhoto" title="">';
	$a .= '<img src="'.$image_preview.'" alt="'.get_the_title().'" />';
	if ($lightbox == 'true') $a .= '<span class="zoom-icon icon-post magnify"></span></a>';
	return $a;
}


// create image thumbnail
function create_image($image, $imageurl, $width, $height, $lightbox=true) {
	
	if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); }
	$href=get_permalink(); $icon='none'; $rel='';
	
	if ($image == 'post') { $href=get_permalink(); $icon='none'; $rel=''; }
	if ($image == 'url') { $href=$imageurl; $icon='link'; $rel=''; }
	if ($image == 'full') { $href=$large_image_url[0]; $icon='magnify'; $rel='prettyPhoto'; } 
	if ($image == 'picture') { $href=$imageurl; $icon='picture'; $rel='prettyPhoto'; } 
	if ($image == 'video') { $href=$imageurl; $icon='video'; $rel='prettyPhoto'; }

	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $width.'x'.$height);
	$image_src = (empty($image_src)) ? '' : $image_src[0];
	
	$a = ''; 
	if ($lightbox == 'true') $a .= '<a class="image-wrapper" href="'.$href.'" data-rel="'.$rel.'" title="">';
	$a .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';
	if ($lightbox == 'true') $a .= '<span class="zoom-icon icon-post '.$icon.'"></span></a>';
	return $a;
}


// create image thumbnail
function create_port_image($image, $imageurl, $width, $height, $lightbox=true) {
	
	if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); }
	$href=get_permalink(); $icon='none'; $rel='';
	
	if ($image == 'post') { $href=get_permalink(); $icon='none'; $rel=''; }
	if ($image == 'url') { $href=$imageurl; $icon='link'; $rel=''; }
	if ($image == 'full') { $href=$large_image_url[0]; $icon='magnify'; $rel='prettyPhoto'; } 
	if ($image == 'picture') { $href=$imageurl; $icon='picture'; $rel='prettyPhoto'; } 
	if ($image == 'video') { $href=$imageurl; $icon='video'; $rel='prettyPhoto'; }

	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $width.'x'.$height);
	$image_src = (empty($image_src)) ? '' : $image_src[0];
	
	$a  = '<a class="image-wrapper" href="'.$href.'" data-rel="'.$rel.'" title="">';
	$a .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';
	$a .= '<span class="zoom-icon"><h2>'.get_the_title().'</h2>';
	/*$a .= '<div class="portfolio-item-category">'.get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ', '' ).'</div>';*/
	$a .= '</span></a>';
	return $a;
}


// create video thumbnail
function create_video($video, $width, $height) {
								
	preg_match('@^(?:http://)?([^/]+)@i', $video, $matches);
						
	if ($matches[1] == "www.youtube.com" || $matches[1] == "youtube.com") {
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $id);
		$a = '<iframe src="http://www.youtube.com/embed/'.$id[1].'?wmode=transparent" width="'.$width.'" height="'.$height.'" title="">youtube</iframe>';
		}
	 
	elseif ($matches[1] == "www.vimeo.com" || $matches[1] == "vimeo.com") {
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $video, $id);
		$a = '<iframe src="http://player.vimeo.com/video/'.$id[1].'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" title="">vimeo</iframe>';
		}
	return $a;
}


// create slider thumbnail
function create_slider($slider, $width, $height) {

	$a = '<div class="nivoSlider">';
	
	$sliderimageids = explode(",", substr($slider,0,-1));
	if ($sliderimageids) {
		foreach ($sliderimageids as $sliderimageid) {
		$image_src = wp_get_attachment_image_src($sliderimageid, $width.'x'.$height);
		$a .= '<img src="'.$image_src[0].'" alt="" />';
		}
	}
	
	$a .= '</div>';
	return $a;
}


// create TwitterOAuth class  (twitter widget & shortcode)
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}


// convert links to clickable format (twitter widget & shortcode)
function convert_links($status,$targetBlank=true,$linkMaxLen=250){
	// the target
		$target=$targetBlank ? " target=\"_blank\" " : "";
	// convert link to url
		$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
	// convert @ to follow
		$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
	// convert # to search
		$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
	// return the status
		return $status;
}


// convert dates to readable format (twitter widget & shortcode)
function relative_time($a) {
	//get current timestampt
	$b = strtotime("now"); 
	//get timestamp when tweet created
	$c = strtotime($a);

	//get difference
	$d = $b - $c;
	//calculate different time values
	$minute = 60;
	$hour = $minute * 60;
	$day = $hour * 24;
	$week = $day * 7;
		
	if(is_numeric($d) && $d > 0) {
		//if less then 3 seconds
		if($d < 3) return "right now";
		//if less then minute
		if($d < $minute) return floor($d) . " seconds ago";
		//if less then 2 minutes
		if($d < $minute * 2) return "about 1 minute ago";
		//if less then hour
		if($d < $hour) return floor($d / $minute) . " minutes ago";
		//if less then 2 hours
		if($d < $hour * 2) return "about 1 hour ago";
		//if less then day
		if($d < $day) return floor($d / $hour) . " hours ago";
		//if more then day, but less then 2 days
		if($d > $day && $d < $day * 2) return "yesterday";
		//if less then year
		if($d < $day * 365) return floor($d / $day) . " days ago";
		//else return more than a year
		return "over a year ago";
	}
}


// create array of all revolution sliders
function all_rev_sliders_in_array(){
	if (class_exists('RevSlider')) {
		$theslider     = new RevSlider();
		$arrSliders = $theslider->getArrSliders();
		$arrA     = array();
		$arrT     = array();
		foreach($arrSliders as $slider){
			$arrA[]     = $slider->getAlias();
			$arrT[]     = $slider->getTitle();
		}
		if($arrA && $arrT){
			$result = array_combine($arrA, $arrT);
		}
		else
		{
			$result = false;
		}
		return $result;
	}
}


// create array of all revolution sliders
function global_tags($cat_base){
	global $post; 
	//Make $the_tags exist
	$the_tags =''; 
	//Check to make sure there are tags
	if(get_the_tags($post->ID)){ 
		//Get the tags for this page's id and iterate through them
		foreach(get_the_tags($post->ID) as $tag) {
			//Get the tag name
			$tag_name = $tag->name; 
			//Get the tag url
			$tag_url = $tag->slug;
			//get the URL of my blog with category base specified
			$the_url = home_url('/').$cat_base;
			//Start adding all the linked tags into a single string for the next step 
			$the_tags = $the_tags.'<a href="'.$the_url.'/tag/'.$tag_url.'/">'.$tag_name.'</a>, ';
		}
		//Replace the comma which is -2 spaces from the right of the string with nothing (nothing is the 2nd parameter)
		echo substr_replace($the_tags ,"",-2);
	}
}

	
// get image from media library for image chooser
add_action('wp_ajax_get_media_image','get_media_image');
function get_media_image(){
	
	$paged = (isset($_POST['page'])) ? $_POST['page'] : 1; 	
	if ($paged == '') $paged = 1;
	
	$statement = array('post_type' => 'attachment',
		'post_mime_type' =>'image',
		'post_status' => 'inherit', 
		'posts_per_page' => 10,
		'paged' => $paged);
	$media_query = new WP_Query($statement);

	?>
	
	<div class="media-gallery-nav" id="media-gallery-nav">
        <ul>
            <li class="nav-first" data-page="1">First</li>
            
            <?php
            for ($i=1 ; $i<=$media_query->max_num_pages; $i++) {
                if ($i == $paged){
                    echo '<li data-page="'.$i.'" class="current">'.$i.'</li>';
                } else if(($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0) {
                    echo '<li data-page="'.$i.'">'.$i.'</li>';
                }
            }
            ?>
            
            <li class="nav-last" data-page="<?php echo $media_query->max_num_pages ?>">Last</li>
        </ul>
	</div>
	<ul>
	
		<?php
		foreach( $media_query->posts as $image ) {
			$full_src = wp_get_attachment_image_src( $image->ID, 'full');
			$thumb_src = wp_get_attachment_image_src( $image->ID, '150x150');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, '160x110');
			echo '<li><img src="' . $thumb_src[0] .'" data-id="' . $image->ID . '" data-src="' . $thumb_src_preview[0] . '"/></li>';
		}
		?>

	</ul>

	<?php if (isset($_POST['page'])) { die(''); }
}


// create image chooser
function image_chooser($slider){
?>
<div class="image-picker-wrapper">
	<div class="meta-input-slider">
		<div class="image-picker">
			<input type="hidden" class="slider-num" name="slider-num" value=<?php echo empty($slider) ? 0 : sizeof(explode(',', substr($slider, 0, -1))); ?> />
			<div class="selected-image" data-title="<?php _e( 'Delete Confirmation', 'my_framework' ); ?>" data-message="<?php _e( 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?', 'my_framework' ); ?>">
				<ul>
					<li class="slider-image-init default">
						<div class="selected-image-wrapper">
							<img src="#" alt="" />
							<div class="selected-image-element">
								<div class="unpick-image"></div>
							</div>
						</div>
					</li>
			
					<?php 
					$selectedimageids = explode(',', substr($slider, 0, -1));
					if ($slider) {
						foreach ( $selectedimageids as $selectedimageid ) {
							$thumbnail = wp_get_attachment_image_src($selectedimageid, '160x110');
					?>
					
					<li class="slider-image-init">
						<div class="selected-image-wrapper">
							<img src="<?php echo $thumbnail[0]; ?>" data-id="<?php echo $selectedimageid; ?>" alt="" />
							<div class="selected-image-element">
								<div class="unpick-image"></div>
							</div>
						</div>
					</li>

					<?php
						}
					}
					?>	
					
				</ul>
			</div>
			<div class="media-image-gallery-wrapper">
				<div class="show-media"></div>
				<div class="media-image-gallery">
					<?php get_media_image(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}


// create comment list
function theme_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>
			<?php _e( 'Pingback:', 'my_framework' ); ?> 
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'my_framework' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	<?php
		break;
	default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					<?php

						if ( '0' != $comment->comment_parent )
						$avatar_size = 40;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'my_framework' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a class="time" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s - %2$s', 'my_framework' ), get_comment_date(), /*get_comment_time()*/'' )
							)
						);
					?>

					<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'my_framework' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				</div>

			<div class="comment-content"><?php comment_text(); ?></div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'my_framework' ); ?></em>
					<br />
				<?php endif; ?>

			</div>

				<?php /*edit_comment_link( __( 'Edit', 'my_framework' ), '<span class="edit-link">', '</span>' );*/ ?>
				
		</div>

	<?php
			break;
	endswitch;
}


// create ajax blog
add_action('wp_ajax_get_blog','get_blog');
add_action('wp_ajax_nopriv_get_blog','get_blog');
function get_blog(){
	
	$paged = (isset($_POST['page'])) ? $_POST['page'] : 1;
	
	$pagesidebar = (isset($_POST['pagesidebar'])) ? $_POST['pagesidebar'] : '';
	$blogcat = (isset($_POST['blogcat'])) ? $_POST['blogcat'] : '';
	$blognumfetch = (isset($_POST['blognumfetch'])) ? $_POST['blognumfetch'] : 1;
	$blogthumbtitleonoff = (isset($_POST['blogthumbtitleonoff'])) ? $_POST['blogthumbtitleonoff'] : 'true';
	$bloglentitle = (isset($_POST['bloglentitle'])) ? $_POST['bloglentitle'] : 1;
	$blogthumbexcerptonoff = (isset($_POST['blogthumbexcerptonoff'])) ? $_POST['blogthumbexcerptonoff'] : 'true';
	$bloglenexcerpt = (isset($_POST['bloglenexcerpt'])) ? $_POST['bloglenexcerpt'] : 1;
	$blogstyle = (isset($_POST['blogstyle'])) ? $_POST['blogstyle'] : 'full';
	$blogcompletecontentonoff = (isset($_POST['blogcompletecontentonoff'])) ? $_POST['blogcompletecontentonoff'] : 'false';
	$blogprettyphotoonoff = (isset($_POST['blogprettyphotoonoff'])) ? $_POST['blogprettyphotoonoff'] : 'false';
	$bloginfoauthoronoff = (isset($_POST['bloginfoauthoronoff'])) ? $_POST['bloginfoauthoronoff'] : 'true';
	$bloginfotagonoff = (isset($_POST['bloginfotagonoff'])) ? $_POST['bloginfotagonoff'] : 'true';
	$bloginfocommentonoff = (isset($_POST['bloginfocommentonoff'])) ? $_POST['bloginfocommentonoff'] : 'true';
	$blogcontinuelinkonoff = (isset($_POST['blogcontinuelinkonoff'])) ? $_POST['blogcontinuelinkonoff'] : 'true';

	if ($blogstyle=='half') {
		if ($pagesidebar=='right' || $pagesidebar=='left') { $width=300; $height=200; if ($bloglentitle=='') $bloglentitle=38; if ($bloglenexcerpt=='') $bloglenexcerpt=34; }
		elseif ($pagesidebar=='both') { $width=200; $height=200; if ($bloglentitle=='') $bloglentitle=30; if ($bloglenexcerpt=='') $bloglenexcerpt=27; }
		else { $width=450; $height=300; if ($bloglentitle=='') $bloglentitle=60; if ($bloglenexcerpt=='') $bloglenexcerpt=100; }
	} else {
		if ($pagesidebar=='right' || $pagesidebar=='left') { $width=620; $height=310; if ($bloglentitle=='') $bloglentitle=56; if ($bloglenexcerpt=='') $bloglenexcerpt=41; }
		elseif ($pagesidebar=='both') { $width=460; $height=230; if ($bloglentitle=='') $bloglentitle=42; if ($bloglenexcerpt=='') $bloglenexcerpt=30; }
		else { $width=940; $height=470; if ($bloglentitle=='') $bloglentitle=88; if ($bloglenexcerpt=='') $bloglenexcerpt=64; }
	}
	if ($blogprettyphotoonoff=='true') $postthumbimage = 'full'; else $postthumbimage = 'post';
	
	?>
	
	<ul class="post-item-wrapper">
	
		<?php $wp_query = new WP_Query('post_type=post&category_name='.$blogcat.'&posts_per_page='.$blognumfetch.'&paged='.$paged );
		while ($wp_query->have_posts()) :$wp_query->the_post(); 
		
		// get variables
		$postthumbtype = get_post_meta(get_the_ID(), 'postthumbtype', true);
		$postthumbvideo = get_post_meta(get_the_ID(), 'postthumbvideo', true);
		$postthumbslider = get_post_meta(get_the_ID(), 'postthumbslider', true);
		?>
		
		<li id="post-<?php the_ID(); ?>" <?php post_class('posts '.($blogstyle=='half' ? 'halfstyle' : 'fullstyle')) ?>>
			
			<?php if (($postthumbtype == 'image' && has_post_thumbnail()) || ($postthumbtype == 'video' && $postthumbvideo) || ($postthumbtype == 'slider' && $postthumbslider)) { ?>
			<div class="featured-thumbnail-wrapper">
				<div class="featured-thumbnail <?php echo $postthumbtype; ?>">
						<?php if ($postthumbtype == 'image') echo create_image ($postthumbimage, '', $width, $height); ?>
						<?php if ($postthumbtype == 'video') echo create_video ($postthumbvideo, $width, $height); ?>
						<?php if ($postthumbtype == 'slider') echo create_slider ($postthumbslider, $width, $height); ?>
				</div>
			</div>
			<!-- end of .featured-thumbnail-wrapper -->
			<?php } ?>
			
			<?php if ($blogthumbtitleonoff!='false') { ?>
			<h2><a href="<?php the_permalink(); ?>"><?php $title = the_title('','',false); echo substr($title, 0, $bloglentitle); ?></a></h2>
			<?php } ?>
	
			<div class="date-wrap">
				<span><?php the_time('l j, F, Y'); ?></span>
			</div>
			
			<?php if ($blogthumbexcerptonoff!='false') { ?>
			<div class="excerpt">
				<?php if ($blogcompletecontentonoff!='true') { ?>
				<?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,$bloglenexcerpt);?>
				<?php } else the_content('Continue Reading'); ?>
				<?php wp_link_pages('before=<p class="pagelink">Pages:', 'after=</p>'); ?>
			</div>
			<?php } ?>
			
			<div class="post-info-wrapper">
				<div class="post-info">
					<?php if ($bloginfoauthoronoff!='false') { ?>
					<span class="post-author">
						<span aria-hidden="true" class="icon-users"></span>
						<?php the_author_posts_link() ?>
					</span>
					<?php } ?>
					
					<?php if ($bloginfotagonoff!='false') { ?>
					<?php the_tags( '<span class="post-tags"><span aria-hidden="true" class="icon-tags"></span>', ', ', '</span>' ); ?>
					<?php } ?>
					
					<?php if ($bloginfocommentonoff!='false') { ?>
					<span class="post-comment">
						<span aria-hidden="true" class="icon-bubbles2"></span>
						<?php comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')); ?>
					</span>
					<?php } ?>
					
					<?php if ($blogcontinuelinkonoff!='false') { ?>
					<div class="posts-link"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'my_framework'); ?></a></div>
					<?php } ?>
				</div>
			</div>
			<!-- end of .post-info-wrapper -->
			
		</li>
		<?php endwhile; ?>
		
	</ul>
	
	<?php 
	// create pagination  
	if (function_exists('pagination_ajax')) pagination_ajax($paged,$wp_query->max_num_pages);
	
	if (isset($_POST['page'])) { die(''); }
}

	
// create load more for post
add_action('wp_ajax_loadmore_post','loadmore_post');
add_action('wp_ajax_nopriv_loadmore_post','loadmore_post');
function loadmore_post(){
	
	$size = '1/3';
	$column =  (isset($_POST['column'])) ? $_POST['column'] : '3';
	$category = (isset($_POST['category'])) ? $_POST['category'] : '';
	$titlelength = (isset($_POST['titlelength'])) ? $_POST['titlelength'] : '';
	$excerptlength = (isset($_POST['excerptlength'])) ? $_POST['excerptlength'] : 40;
	$showimage = (isset($_POST['showimage'])) ? $_POST['showimage'] : 40;
	$showdate = (isset($_POST['showdate'])) ? $_POST['showdate'] : 40;
	$showbutton = (isset($_POST['showbutton'])) ? $_POST['showbutton'] : 'true';
	$counter = (isset($_POST['counter'])) ? $_POST['counter'] : 1;
	$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
		
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
	
	$my_postwidget = '';
							
	query_posts('post_type=post&post_status=publish&category_name='.$category.'&offset='.$offset.'&posts_per_page='.$counter.'&paged=1');
	if ( have_posts() ) while ( have_posts() ) : the_post();
	
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
		
		$my_postwidget .= '<div class="post-avatar">'.get_avatar( get_the_author_meta('ID'), $size='75' ).'</div>';
		
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
			
	echo $my_postwidget;
	
	if (isset($_POST['offset'])) { die(''); }
}

	
// create load more for portfolio
add_action('wp_ajax_loadmore_portfolio','loadmore_portfolio');
add_action('wp_ajax_nopriv_loadmore_portfolio','loadmore_portfolio');
function loadmore_portfolio(){
	
	$counter = (isset($_POST['counter'])) ? $_POST['counter'] : 1;
	$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
	$singlemode = (isset($_POST['singlemode'])) ? $_POST['singlemode'] : '';
	
	$size = (isset($_POST['size'])) ? $_POST['size'] : '1/3';
	$column = (isset($_POST['column'])) ? $_POST['column'] : '3';
	$category = (isset($_POST['category'])) ? $_POST['category'] : '';
	$showcategory = (isset($_POST['showcategory'])) ? $_POST['showcategory'] : '';
	$titlelength = (isset($_POST['titlelength'])) ? $_POST['titlelength'] : '30';
	$excerptlength = (isset($_POST['excerptlength'])) ? $_POST['excerptlength'] : 0;
	$textalign = (isset($_POST['textalign'])) ? $_POST['textalign'] : '';

	$my_portwidget = '';
	
	// set column
	if ($size == "1/1") { $column='container_12'; }
	if ($size == "1/2") { if ($column=='1') $column='container_6'; else $column='container_12'; }
	if ($size == "1/3") { if ($column=='1') $column='container_4'; elseif ($column=='2') $column='container_8'; else $column='container_12'; }
	if ($size == "1/4") { if ($column=='1') $column='container_3'; elseif ($column=='2') $column='container_6'; elseif ($column=='3') $column='container_9'; else $column='container_12'; }
	if ($size == "1/6") { if ($column=='1') $column='container_2'; elseif ($column=='2') $column='container_4'; elseif ($column=='3') $column='container_6'; elseif ($column=='4') $column='container_8'; else $column='container_12'; }
	
	// set width, height
	if ($size == "1/1") { $width=1170; $height=760; $liclass="grid_12"; }
	elseif ($size == "1/2") { $width=570; $height=570; $liclass="grid_6"; }
	elseif ($size == "1/3") { $width=370; $height=370; $liclass="grid_4"; }
	elseif ($size == "1/4") { $width=270; $height=270; $liclass="grid_3"; }
	/*elseif ($size == "1/6") { $width=140; $height=100; $liclass="grid_2"; }*/
		
	query_posts('post_type=portfolio&portfolio-category='.$category.'&offset='.$offset.'&posts_per_page='.$counter.'&paged=1' );
	if ( have_posts() ) while ( have_posts() ) : the_post();
	
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
					$title = get_the_title(); $my_portwidget .= substr($title, 0, $titlelength);
		$my_portwidget .= '</a></h2>';
		}

		$my_portwidget .= '<div class="portfolio-item-icon-wrapper"><span class="icon"><span class="icon-post '.$icon.'"></span></span></div>';

		$my_portwidget .= '<div class="portfolio-item-content-wrapper">
								<div class="portfolio-item-category '.($showcategory=='off' ? 'off' : '').'">';
		if ($showcategory!='off') {
		$my_portwidget .= get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ', '' ); 
		}
		$my_portwidget .= '</div>';
				
		if ($excerptlength!=0) { 
		$my_portwidget .= '<div class="portfolio-item-content">'.wp_trim_words(get_the_content(), $excerptlength, '').'</div>';
		}
		
		$my_portwidget .= '</div></div>';*/
		
	$my_portwidget .= '</li>';
	
	endwhile;
	
	wp_reset_query();
		
	echo $my_portwidget;
	
	if (isset($_POST['offset'])) { die(''); }
}

	
// create outline box for portfolio
add_action('wp_ajax_outline_portfolio','outline_portfolio');
add_action('wp_ajax_nopriv_outline_portfolio','outline_portfolio');
function outline_portfolio(){
	
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	
	$my_outline = '';
		
	query_posts('post_type=portfolio&p='.$id );
	if ( have_posts() ) while ( have_posts() ) : the_post();
	
	$portstyle = get_post_meta(get_the_ID(), 'portstyle', true);
	$portinfo = get_post_meta(get_the_ID(), 'portinfo', true);
	$portdetailsonoff = get_post_meta(get_the_ID(), 'portdetailsonoff', true);
	$portdateonoff = get_post_meta(get_the_ID(), 'portdateonoff', true);
	$porttagonoff = get_post_meta(get_the_ID(), 'porttagonoff', true);
	$portrelatedonoff = get_post_meta(get_the_ID(), 'portrelatedonoff', true);
	$porttitleplace = get_post_meta(get_the_ID(), 'porttitleplace', true);
	$portpaginateplace = get_post_meta(get_the_ID(), 'portpaginateplace', true);
	$portpaginatetitle = get_post_meta(get_the_ID(), 'portpaginatetitle', true);
	$portpaginatealign = get_post_meta(get_the_ID(), 'portpaginatealign', true);
	$portthumbtype = get_post_meta(get_the_ID(), 'portthumbtype', true);
	$portthumbimage = get_post_meta(get_the_ID(), 'portthumbimage', true);
	$portthumbimageurl = get_post_meta(get_the_ID(), 'portthumbimageurl', true);
	$portthumbvideo = get_post_meta(get_the_ID(), 'portthumbvideo', true);
	$portthumbslider = get_post_meta(get_the_ID(), 'portthumbslider', true);
	$portinthumbtype = get_post_meta(get_the_ID(), 'portinthumbtype', true);
	$portinthumbimage = get_post_meta(get_the_ID(), 'portinthumbimage', true);
	$portinthumbvideo = get_post_meta(get_the_ID(), 'portinthumbvideo', true);
	$portinthumbslider = get_post_meta(get_the_ID(), 'portinthumbslider', true);
	
	if ($portstyle=='full') { $width='1170'; $height='585'; $class='grid_12'; }
	if ($portstyle=='half') { $width='870'; $height='435'; $class='grid_9'; }
	
	if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); }
	if ($portinthumbtype == 'normal') {
		$portinthumbtype = $portthumbtype;
		$portinthumbimage = get_post_thumbnail_id();
		$portinthumbvideo = $portthumbvideo;
		$portinthumbslider = $portthumbslider;
	}
	
	$my_outline .= '<div class="close"></div><div class="ports single">';
		
	if ($porttitleplace=='above')
	$my_outline .= '
	<div class="h-wrapper">
		<span class=""></span>
		<div class="container_12">
			<h1 class="grid_12 title">'. get_the_title() .'</h1>
			<div class="sub-title grid_12">
				<div class="date-wrapper">
					<div class="date-wrap">'
						. get_the_time('j F, Y / ') . get_comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')) .
					'</div>
				</div>
			</div>
		</div>
	</div>';
	
	$my_outline .= '<div class="container_12">';
	if (($portinthumbtype == 'image' && $portinthumbimage) || ($portinthumbtype == 'video' && $portinthumbvideo) || ($portinthumbtype == 'slider' && $portinthumbslider))
	$my_outline .= '<div class="featured-thumbnail-wrapper '. $portinthumbtype; 
		if ($portstyle=='half') $my_outline .= ' grid_9'; 
		if ($portstyle!='half') $my_outline .= ' grid_12';
	$my_outline .= '">
				<div class="featured-thumbnail '.$portinthumbtype.'">';
						if ($portinthumbtype == 'image') $my_outline .= create_image_inside ($portinthumbimage, $width, $height);
						if ($portinthumbtype == 'video') $my_outline .= create_video ($portinthumbvideo, $width, $height);
						if ($portinthumbtype == 'slider')$my_outline .= create_slider ($portinthumbslider, $width, $height);
	$my_outline .= '</div></div>';
			
	if ($portstyle=='half' && $portdetailsonoff!='false') {
	$my_outline .= '<div id="port-details-wrapper" class="grid_3">
						<div id="port-details">';
						if ($portdateonoff!='false') $my_outline .= '<span class="detail"><strong>'. __('Date:', 'my_framework') .'</strong> '. get_the_time('j M, Y') .'</span>';
						if ($porttagonoff!='false') $my_outline .= '<span class="detail"><strong>'. __('Tags:', 'my_framework') .'</strong> '. get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ' , '' ) .'</span>';
	$my_outline .= do_shortcode($portinfo);
	$my_outline .= '</div>
				</div>';
	}
		
	if ($porttitleplace!='above')
	$my_outline .= '<div class="h-wrapper grid_12">
				<h1><span class="line left"></span>'. get_the_title() .'<span class="line right"></span></h1>
			</div>';
					
	$my_outline .= '<div id="port-content-wrapper"'; if ($porttitleplace=='above') $my_outline .= 'class="above"'; $my_outline .= '>';
	
	if ($portstyle=='full' && $portdetailsonoff!='false') {
	$my_outline .= '<div id="port-details-wrapper" class="grid_3">
						<div id="port-details">';
						if ($portdateonoff!='false') $my_outline .= '<span class="detail"><strong>'. __('Date:', 'my_framework') .'</strong> '. get_the_time('j M, Y') .'</span>';
						if ($porttagonoff!='false') $my_outline .= '<span class="detail"><strong>'. __('Tags:', 'my_framework') .'</strong> '. get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ' , '' ) .'</span>';
	$my_outline .= do_shortcode($portinfo);
	$my_outline .= '</div>
				</div>';
	}
	
	$my_outline .= '<div class="content-portstyle';
		if ($portstyle=='full' && $portdetailsonoff!='false') $my_outline .= ' grid_9';
		else $my_outline .= ' grid_12';
	$my_outline .= '">';
					
	$my_outline .= '<div class="post-content port-content">';
	
		$content = apply_filters('the_content', get_the_content());
	$my_outline .= $content;
	/*$my_outline .= str_replace(']]>', ']]&gt;', $content);*/
	
	$my_outline .= '</div>
				</div>
			</div>';
			
	$my_outline .= '</div></div>';
	
	endwhile;
	
	wp_reset_query();
		
	echo $my_outline;
	
}

	
// create ajax recaptcha validate
add_action('wp_ajax_get_recaptcha','get_recaptcha');
add_action('wp_ajax_nopriv_get_recaptcha','get_recaptcha');
function get_recaptcha(){
	
	$resp = recaptcha_check_answer (
		get_option('mytheme_recaptchaprivatekey'),
		$_SERVER['REMOTE_ADDR'],
		$_POST['recaptcha_challenge_field'],
		$_POST['recaptcha_response_field']);
		
	if (!$resp->is_valid) { echo 'false'; } else { echo 'true'; }
	
	die();
}


?>