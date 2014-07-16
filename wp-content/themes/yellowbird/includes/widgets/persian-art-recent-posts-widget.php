<?php
/* ----------------------------------------

	Plugin Name: PersianArt Recent Posts Widget
	Description: Show latest posts
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// Register widget and add it
add_action( 'widgets_init', 'PersianArt_RecentPosts_widget' );
function PersianArt_RecentPosts_widget() {
	register_widget( 'PersianArt_RecentPosts' );
}

class PersianArt_RecentPosts extends WP_Widget {

	// Constructor
    function PersianArt_RecentPosts() {
        parent::WP_Widget(false, 'PersianArt - Recent Posts', array('description' => __('Show latest posts', 'my_framework')));	
    }

	// Widget
    function widget( $args, $instance ) {		
        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'my_framework') : $instance['title']);
        $limit = ! empty( $instance['limit']) ? $instance['limit'] : 9;
		$category = ! empty( $instance['category']) ? $instance['category'] : '';
		$numpost = ! empty( $instance['numpost']) ? $instance['numpost'] : 3;
		$linktext = ! empty( $instance['linktext']) ? $instance['linktext'] : '';
		$linkurl = ! empty( $instance['linkurl']) ? $instance['linkurl'] : '';

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		query_posts( 'showposts=' . $numpost . '&post_type=post&category_name=' . $category );
		if ( have_posts() ) :
?>
		<ol class="widget-recent-post">
			<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<span class="date">
					<?php the_time('F j, Y') ?>
				</span>
				<div class="details-wrap">
					<h5>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h5>
					<div class="excerpt">
					<?php $excerpt = get_the_excerpt(); echo string_limit_words( $excerpt, $limit ); ?>
					</div>
				</div>
				<a class="morelink" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read more', 'my_framework');?></a>
			</li>
			<?php endwhile; ?>
		</ol>
		<?php endif; ?>
		<?php if ( $linkurl != '' ) { /* Print a link to this category */?>
		<span class="text-styled">
			<a href="<?php echo $linkurl; ?>">
				<?php echo $linktext; ?>
			</a>
		</span>
		<?php }
		wp_reset_query();

		echo $after_widget;
	}

	// Update
    function update( $new_instance, $old_instance ) {				
        return $new_instance;
    }

	// Form
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$limit = isset( $instance['limit'] ) ? esc_attr( $instance['limit'] ) : 9;
		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$numpost = isset( $instance['numpost'] ) ? esc_attr( $instance['numpost'] ) : 3;
		$linktext = isset( $instance['linktext'] ) ? esc_attr( $instance['linktext'] ) : '';
		$linkurl = isset( $instance['linkurl'] ) ? esc_attr( $instance['linkurl'] ) : '';
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit text:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select category:', 'my_framework'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:226px;">
				<option value="" <?php selected( $category, '' ); ?> >all</option>
				<?php
				$category_ids = get_all_category_ids();
				foreach( $category_ids as $cat_id ) {
					$cat_name = get_cat_name( $cat_id ); ?>
				<option value="<?php echo $cat_name; ?>" <?php selected( $category, $cat_name ); ?>><?php echo $cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numpost'); ?>"><?php _e('Number of posts to show:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('numpost'); ?>" name="<?php echo $this->get_field_name('numpost'); ?>" type="text" value="<?php echo esc_attr( $numpost ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo esc_attr( $linktext ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkurl'); ?>"><?php _e('Link url:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkurl'); ?>" name="<?php echo $this->get_field_name('linkurl'); ?>" type="text" value="<?php echo esc_attr( $linkurl ); ?>" />
		</p>
<?php 
    }
}