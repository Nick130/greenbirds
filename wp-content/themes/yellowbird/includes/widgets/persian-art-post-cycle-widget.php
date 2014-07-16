<?php
/* ----------------------------------------

	Plugin Name: PersianArt Latest Posts Widget
	Description: Show latest posts and portfolios
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// Register widget and add it
add_action( 'widgets_init', 'PersianArt_CyclePosts_widget' );
function PersianArt_CyclePosts_widget() {
	register_widget( 'PersianArt_CyclePosts' );
}

class PersianArt_CyclePosts extends WP_Widget {

	// Constructor
    function PersianArt_CyclePosts() {
        parent::WP_Widget(false, 'PersianArt - Cycle Posts', array('description' => __('Show latest posts and portfolios', 'my_framework')));
    }

	// Widget
    function widget( $args, $instance ) {		
        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'my_framework') : $instance['title']);
		$limittext = ! empty( $instance['limittext'] ) ? $instance['limittext'] : '';
		$posttype = ! empty( $instance['posttype'] ) ? $instance['posttype'] : '';
		$numpost = ! empty( $instance['numpost'] ) ? $instance['numpost'] : 3;

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;
		
		if ( $posttype == 'portfolio' ) {
?>
		<ol class="portfolio-cycle-widget">
			<?php
			query_posts( 'posts_per_page=' . $numpost . '&post_type=' . $posttype );
			while ( have_posts() ) : the_post();
			
			$portthumbtype = get_post_meta(get_the_ID(), 'portthumbtype', true);
			$portthumbimage = get_post_meta(get_the_ID(), 'portthumbimage', true);
			$portthumbvideo = get_post_meta(get_the_ID(), 'portthumbvideo', true);
			$portthumbslider = get_post_meta(get_the_ID(), 'portthumbslider', true);
			$portthumbimageurl = get_post_meta(get_the_ID(), 'portthumbimageurl', true);
			
			$width=96; $height=60; ?>

			<li class="widget-recent-portfolio-wrapper">
				<div class="widget-recent-portfolio">
					<div class="details-wrap">
						<div class="shadow">
							<?php if ( ( $portthumbtype == 'image' && has_post_thumbnail() ) || ( $portthumbtype == 'video' && $portthumbvideo ) || ( $portthumbtype == 'slider' && $portthumbslider) ) { ?>
							<div class="featured-thumbnail">
								<div class="image-wrap">
									<?php if ( $portthumbtype == 'image' ) echo create_image ($portthumbimage, '', $width, $height, false); ?>
									<?php if ( $portthumbtype == 'video' ) echo create_video ($portthumbvideo, $width, $height); ?>
									<?php if ( $portthumbtype == 'slider' ) echo create_slider ($portthumbslider, $width, $height); ?>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="tilte">
							<h5> <a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h5>
							<div class="date">
								<span><?php the_time('M'); ?></span>
								<span><?php the_time('j'); ?></span>
								<span><?php the_time('Y'); ?></span>
							</div>
						</div>
					</div>
					<?php if ( $limittext != 0 ) { ?>
					<div class="excerpt">
						<?php $excerpt = get_the_excerpt(); echo string_limit_words( $excerpt, $limittext ); ?>
					</div>
					<?php } ?>
				</div>
			</li>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</ol>
		
		<?php } else { ?>

		<ol class="post-cycle-widget">
			<?php
			query_posts( 'posts_per_page=' . $numpost . '&post_type=' . $posttype );
			while ( have_posts() ) : the_post();
			
			// Get variables
			$postthumbtype = get_post_meta(get_the_ID(), 'postthumbtype', true);
			$postthumbimage = get_post_meta(get_the_ID(), 'postthumbimage', true);
			$postthumbvideo = get_post_meta(get_the_ID(), 'postthumbvideo', true);
			$postthumbslider = get_post_meta(get_the_ID(), 'postthumbslider', true);
			
			$width=96; $height=60; ?>

			<li class="post-widget-item">
				<div class="details-wrap">
					<?php if ( ( $postthumbtype == 'image' && has_post_thumbnail()) || ( $postthumbtype == 'video' && $postthumbvideo ) || ( $postthumbtype == 'slider' && $postthumbslider ) ) { ?>
					<div class="featured-thumbnail">
						<div class="image-wrap">
							<?php if ($postthumbtype == 'image') echo create_image ($postthumbimage, '', $width, $height, false); ?>
							<?php if ($postthumbtype == 'video') echo create_video ($postthumbvideo, $width, $height); ?>
							<?php if ($postthumbtype == 'slider') echo create_slider ($postthumbslider, $width, $height); ?>
						</div>
					</div>
					<?php } ?>
					<div class="tilte">
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<div class="date">
							<?php the_time('F j, Y') ?>
						</div>
					</div>
				</div>
				<?php if ( $limittext != 0 ) { ?>
				<div class="excerpt">
					<?php $excerpt = get_the_excerpt(); echo string_limit_words( $excerpt, $limittext ); ?>
				</div>
				<?php } ?>
			</li>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</ol>

		<?php }

		echo $after_widget;
    }

	// Update
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

	// Form
    function form( $instance ) {				
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$limittext = isset( $instance['limittext'] ) ? esc_attr( $instance['limittext'] ) : '';
		$posttype = isset( $instance['posttype'] ) ? esc_attr( $instance['posttype'] ) : '';
		$numpost = isset( $instance['numpost'] ) ? esc_attr( $instance['numpost'] ) : 3;
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
			<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Post type:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>" style="width:226px;" >
				<option value="post" <?php selected( $posttype, 'post' ); ?>>blog</option>
				<option value="portfolio" <?php selected( $posttype, 'portfolio' ); ?> >portfolio</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numpost'); ?>"><?php _e('Number of posts to show:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('numpost'); ?>" name="<?php echo $this->get_field_name('numpost'); ?>" type="text" value="<?php echo esc_attr( $numpost ); ?>" />
		</p>
<?php 
    }
}