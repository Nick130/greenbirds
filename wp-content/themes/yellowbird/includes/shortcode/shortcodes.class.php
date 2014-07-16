<?php

//Setup location of WordPress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

// Access WordPress
require_once( $path_to_wp . '/wp-load.php' );

class pa_shortcodes
{
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var	$tag_close;
	
	var	$cparams;
	var	$cshortcode;
	var	$popup_title;
	var	$has_child;
	
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup ) {
		
		if ( file_exists( dirname(__FILE__) . '/config.php' ) ) {
			
			$this->conf = dirname(__FILE__) . '/config.php';
			$this->popup = $popup;
			
			$this->get_shortcode_form();
		}
		else {
			$this->errors . "\n" . 'Config file does not exist';
		}
	}
	
	// --------------------------------------------------------------------------
	
	function get_shortcode_form()
	{
		// get config file
		require_once( $this->conf );
		
		if ( isset( $pa_shortcodes[$this->popup]['child_shortcode'] ) ) {
			$this->has_child = true;
		}
		
		if ( isset( $pa_shortcodes ) && is_array( $pa_shortcodes ) ) {
			
			// get shortcode config stuff
			$this->params = $pa_shortcodes[$this->popup]['params'];
			$this->shortcode = $pa_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $pa_shortcodes[$this->popup]['popup_title'];
			$this->tag_close = $pa_shortcodes[$this->popup]['tag_close'];
			
			// adds stuff for js use
			$this->append_output( "\n" . '<div id="pa_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="pa_popup" class="hidden">' . $this->popup . '</div>' );
			$this->append_output( "\n" . '<div id="pa_close" class="hidden">' . $this->tag_close . '</div>' );
			$this->append_output( "\n" . '<table id="shortcode-table" class="form-table">' );
			
			// filters and excutes params
			foreach( $this->params as $pkey => $param ) {
				
				// popup form row start
				$row_start  = '<tr>' . "\n";
				$row_start .= '<th>' . $param['label'] . '</th>' . "\n";
				$row_start .= '<td>' . "\n";
				
				// popup form row end
				$row_end	= '';
				if ( isset( $param['desc'] ) && $param['desc'] != '' )
				$row_end   .= '<span class="param-desc">' . $param['desc'] . '</span>' . "\n";
				$row_end   .= '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";
				
				switch( $param['type'] )
				{
					case 'text' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['def'] . '" data-rel="' . $param['def'] . '" class="short-input" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'image' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['def'] . '" data-rel="' . $param['def'] . '" class="short-input upload-text" /><input type="button" class="upload-button image button-primary" data-title="' . __('Select image', 'my_framework') . '" data-button="' . __('Insert image', 'my_framework') . '" value="Upload" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;

						
					case 'gallery' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['def'] . '" data-rel="' . $param['def'] . '" class="short-input upload-text" /><input type="button" class="upload-button gallery button-primary" data-title="' . __('Select gallery', 'my_framework') . '" data-button="' . __('Insert gallery', 'my_framework') . '" value="Upload" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'color' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['def'] . '" data-rel="' . $param['def'] . '" class="short-input coloring" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'textarea' :
						
						// prepare
						$output  = $row_start;
						$output .= '<textarea rows="5" cols="30" name="' . $pkey . '" id="' . $pkey . '" data-rel="' . $param['def'] . '" class="short-input" >' . $param['def'] . '</textarea>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'select' :
						
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" data-rel="' . $param['def'] . '" class="short-input" >' . "\n";
						
						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '" '. ($value == $param['def'] ? 'selected="selected"' : '' ) .'>' . $option . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'icon' :
						
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" data-rel="' . $param['def'] . '" class="short-input select-font-icon" >' . "\n";
						$output .= '<option value="">' . __('Select Icon', 'my_framework') . '</option>' . "\n";
						$output .= '</select>' . "\n";
						$output .= '<div class="font-icon">' . "\n";
						require_once( 'icon.php' );
						foreach( $icon_array as $icon )
						{
							$output .= '<span class="'.$icon.'"></span>';
						}
						$output .= '</div>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'portcat' :
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" data-rel="' . $param['def'] . '" class="short-input" >' . "\n";
						
						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '" '. ($value == $param['def'] ? 'selected="selected"' : '' ) .'>' . $option . '</option>' . "\n";
						}
						
						$categories = custom_type_category('portfolio-category', null);
						if (is_array($categories)) {
							foreach($categories as $category)
								$output .= '<option value="'. $category . '">'. $category . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'postcat' :
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" data-rel="' . $param['def'] . '" class="short-input" >' . "\n";
						
						foreach( $param['options'] as $value => $option )
						{
							$output .= '<option value="' . $value . '" '. ($value == $param['def'] ? 'selected="selected"' : '' ) .'>' . $option . '</option>' . "\n";
						}
						
						$categories = get_all_category_ids();
						if (is_array($categories)) {
							foreach($categories as $category_id) {
								$category = get_cat_name($category_id);
								$output .= '<option value="'. $category . '">'. $category . '</option>' . "\n";
							}
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
				}
			}
			
			$this->append_output( "\n" . '</table>' );
			
			// checks if has a child shortcode
			if ( isset( $pa_shortcodes[$this->popup]['child_shortcode'] ) ) {
				
				// set child shortcode
				$this->cparams = $pa_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $pa_shortcodes[$this->popup]['child_shortcode']['shortcode'];
			
				// popup parent form row start
				$this->append_output( "\n" . '<div id="pa_cshortcode" class="hidden">' . $this->cshortcode . '</div>' );
				$prow_start  = '<p class="submit">';
				$prow_start .= '<input type="button" id="shortcode-clone" class="button-primary" value="Add ' . $this->popup_title .'" name="submit" />';
				$prow_start .= '</p>';
				$prow_start .= '<table id="sample-clone" class="form-table table-clone display-none">';
				
				// add $prow_start to output
				$this->append_output( $prow_start );
				
				foreach( $this->cparams as $cpkey => $cparam ) {
						
					// popup form row start
					$crow_start  = '<tr>' . "\n";
					$crow_start .= '<th>' . $cparam['label'] . '</th>' . "\n";
					$crow_start .= '<td>' . "\n";
					
					// popup form row end
					$crow_end	= '';
					if (isset($cparam['desc']) && $cparam['desc']!='')
					$crow_end   .= '<span class="param-desc">' . $cparam['desc'] . '</span>' . "\n";
					$crow_end   .= '</td>' . "\n";
					$crow_end   .= '</tr>' . "\n";
					
					switch( $cparam['type'] )
					{
						case 'text' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['def'] . '" data-rel="' . $cparam['def'] . '" class="short-input" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
						
						case 'image' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['def'] . '" data-rel="' . $cparam['def'] . '" class="short-input upload-text" /><input type="button" class="upload-button image button-primary" data-title="' . __('Select image', 'my_framework') . '" data-button="' . __('Insert image', 'my_framework') . '" value="Upload" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;						
							
						case 'color' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['def'] . '" data-rel="' . $cparam['def'] . '" class="short-input coloring" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'textarea' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="5" cols="30" name="' . $cpkey . '" id="' . $cpkey . '" data-rel="' . $cparam['def'] . '" class="short-input" >' . $cparam['def'] . '</textarea>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'select' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<select name="' . $cpkey . '" id="' . $cpkey . '" data-rel="' . $cparam['def'] . '" class="short-input" >' . "\n";
							
							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . $value . '" '. ($value == $cparam['def'] ? 'selected="selected"' : '' ) .'>' . $option . '</option>' . "\n";
							}
							
							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
					}
				}
				
				// popup parent form row end
				$prow_end  = '<tr>';
				$prow_end .= '<th><a href="#" class="remove-clone">Remove Item</a></th><td></td>';
				$prow_end .= '</tr>';
				$prow_end .= '</table>';
				$prow_end .= '<div id="wrapper-clone"></div>';
				
				// add $prow_end to output
				$this->append_output( $prow_end );
			}
			
			$this->append_output( "\n" . '<p class="submit">' );
			$this->append_output( "\n" . '<input type="button" id="shortcode-submit" class="button-primary" value="Insert ' . $this->popup_title . '" name="submit" />' );
			$this->append_output( "\n" . '</p>' );			
		}
	}
	
	// --------------------------------------------------------------------------
	
	function append_output( $output ) {
		$this->output = $this->output . "\n" . $output;		
	}
}