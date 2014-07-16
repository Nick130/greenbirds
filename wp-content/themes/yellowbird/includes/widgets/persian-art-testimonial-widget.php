<?php
/* ----------------------------------------

	Plugin Name: PersianArt Latest Posts Widget
	Description: Show latest posts, portfolios and testimonials
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// Register widget and add it
add_action( 'widgets_init', 'PersianArt_Testimonial_widget' );
function PersianArt_Testimonial_widget() {
	register_widget( 'PersianArt_Testimonial' );
}

class PersianArt_Testimonial extends WP_Widget {

	// Constructor
    function PersianArt_Testimonial() {
        parent::WP_Widget(false, 'PersianArt - Testimonial', array('description' => __('Show testimonials', 'my_framework')));
    }

	// Widget
    function widget( $args, $instance ) {		
        extract( $args );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Testimonials', 'my_framework') : $instance['title'] );
		$limittext = ! empty( $instance['limittext'] ) ? $instance['limittext'] : 40;
		$numpost = ! empty( $instance['numpost'] ) ? $instance['numpost'] : 3;
		$class = ! empty( $instance['class'] ) ? $instance['class'] : '';
		$showimage = ! empty( $instance['showimage'] ) ? $instance['showimage'] : '';
		$showcarousel = ! empty( $instance['showcarousel'] ) ? $instance['showcarousel'] : '';
		$effect = ! empty( $instance['effect'] ) ? $instance['effect'] : 'scroll';
		$navigation = ! empty( $instance['navigation'] ) ? $instance['navigation'] : '';

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		$rand = rand();
		if ( $showcarousel != 'off' ) {
?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#testimonial-<?php echo $rand; ?>").carouFredSel({
					items: 1,
					pagination: "#testimonial-pager-<?php echo $rand; ?>",
					prev: {
						button: "#testimonial-prev-<?php echo $rand; ?>",
						key: "left"
					},
					next: {
						button: "#testimonial-next-<?php echo $rand; ?>",
						key: "right"
					},
					responsive: true,
					scroll: {
						items: 1,
						fx: "<?php echo $effect; ?>",
						duration: 1000
					},
					auto: {
						timeoutDuration: 5000
					},
				});
			});
		</script>
		<?php } ?>
			
		<div class="testimonial-wrapper <?php echo $class . ( $showimage == 'off' ? ' noimage' : '' ) . ( $showcarousel == 'off' ? ' nocar' : '' ); ?>">
			<ol id="testimonial-<?php echo $rand; ?>">
				<?php
				query_posts( "post_type=testimonial&post_status=publish&posts_per_page=" . $numpost );
				while ( have_posts() ) : the_post();
				$post = get_post_meta(get_the_ID(), 'testipost', true);
				$company = get_post_meta(get_the_ID(), 'testicompany', true);
				$testilink = get_post_meta(get_the_ID(), 'testiurl', true);
				$thumb = get_the_post_thumbnail(get_the_ID(), '118x118');
				$content = get_the_content();
				$content = string_limit_words( $content, $limittext );
				$name = get_the_title();
				$permalink = get_permalink();
				?>	
				<li>
					<div class="testimonial">
						<span class="angle"></span>	
						<?php if ($showimage!='off') { ?>
						<div class="testi-pic"><?php echo $thumb; ?></div>
						<?php } ?>
						<?php echo $content; ?>
					</div>
					<span class="testi-name"><span class="testi-user"><?php echo $name.' / '.$company; ?></span><br/><a href="http://<?php echo $testilink; ?>"><?php echo $testilink; ?></a></span>
				</li>
				<?php endwhile; wp_reset_query(); ?>
			</ol>
				
			<?php if ($showcarousel!='off' && $navigation=='direction') { ?>
			<div class="testimonial-direction">
				<a id="testimonial-prev-<?php echo $rand; ?>" class="prev" href="#"></a>
				<a id="testimonial-next-<?php echo $rand; ?>" class="next" href="#"></a>
			</div>
			<?php } ?>
			<?php if ($showcarousel!='off' && $navigation=='pagination') { ?>
			<div id="testimonial-pager-<?php echo $rand; ?>" class="pager"></div>
			<?php } ?>
			
		</div>
<?php
		echo $after_widget;
	}

	// Update
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

	// Form
    function form( $instance ) {				
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$limittext = isset( $instance['limittext'] ) ? absint( $instance['limittext'] ) : 40;
		$numpost = isset( $instance['numpost'] ) ? absint( $instance['numpost'] ) : 3;
		$class = isset( $instance['class'] ) ? esc_attr( $instance['class'] ) : '';
		$showimage = isset( $instance['showimage'] ) ? esc_attr( $instance['showimage'] ) : '';
		$showcarousel = isset( $instance['showcarousel'] ) ? esc_attr( $instance['showcarousel'] ) : '';
		$effect = isset( $instance['effect'] ) ? esc_attr( $instance['effect'] ) : '';
		$navigation = isset( $instance['navigation'] ) ? esc_attr( $instance['navigation'] ) : '';
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limittext'); ?>"><?php _e('Limit text:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limittext'); ?>" name="<?php echo $this->get_field_name('limittext'); ?>" type="text" value="<?php echo esc_attr( $limittext ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numpost'); ?>"><?php _e('Number of posts to show:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('numpost'); ?>" name="<?php echo $this->get_field_name('numpost'); ?>" type="text" value="<?php echo esc_attr( $numpost ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Class:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" style="width:226px;" >
				<option value="" <?php selected( $class, '' ); ?>><?php _e('default', 'my_framework'); ?></option>
				<option value="dark" <?php selected( $class, 'dark' ); ?>><?php _e('dark', 'my_framework'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('showimage'); ?>"><?php _e('Display image:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>" style="width:226px;" >
				<option value="" <?php selected( $showimage, '' ); ?>><?php _e('enable', 'my_framework'); ?></option>
				<option value="off" <?php selected( $showimage, 'off' ); ?>><?php _e('disable', 'my_framework'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('showcarousel'); ?>"><?php _e('Carousel status:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('showcarousel'); ?>" name="<?php echo $this->get_field_name('showcarousel'); ?>" style="width:226px;" >
				<option value="" <?php selected( $showcarousel, '' ); ?>><?php _e('enable', 'my_framework'); ?></option>
				<option value="off" <?php selected( $showcarousel, 'off' ); ?>><?php _e('disable', 'my_framework'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Effect:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" style="width:226px;" >
				<option value="scroll" <?php selected( $effect, 'scroll' ); ?>><?php _e('scroll', 'my_framework'); ?></option>
				<option value="directscroll" <?php selected( $effect, 'directscroll' ); ?>><?php _e('direct scroll', 'my_framework'); ?></option>
				<option value="fade" <?php selected( $effect, 'fade' ); ?>><?php _e('fade', 'my_framework'); ?></option>
				<option value="crossfade" <?php selected( $effect, 'crossfade' ); ?>><?php _e('cross fade', 'my_framework'); ?></option>
				<option value="cover" <?php selected( $effect, 'cover' ); ?>><?php _e('cover', 'my_framework'); ?></option>
				<option value="cover-fade" <?php selected( $effect, 'cover-fade' ); ?>><?php _e('cover fade', 'my_framework'); ?></option>
				<option value="uncover" <?php selected( $effect, 'uncover' ); ?>><?php _e('uncover', 'my_framework'); ?></option>
				<option value="uncover-fade" <?php selected( $effect, 'uncover-fade' ); ?>><?php _e('uncover fade', 'my_framework'); ?></option>
				<option value="none" <?php selected( $effect, 'none' ); ?>><?php _e('none', 'my_framework'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('navigation'); ?>"><?php _e('Navigation:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('navigation'); ?>" name="<?php echo $this->get_field_name('navigation'); ?>" style="width:226px;" >
				<option value="" <?php selected( $navigation, '' ); ?>><?php _e('none', 'my_framework'); ?></option>
				<option value="direction" <?php selected( $navigation, 'direction' ); ?>><?php _e('direction', 'my_framework'); ?></option>
				<option value="pagination" <?php selected( $navigation, 'pagination' ); ?>><?php _e('pagination', 'my_framework'); ?></option>
			</select>
		</p>
<?php 
    }
}