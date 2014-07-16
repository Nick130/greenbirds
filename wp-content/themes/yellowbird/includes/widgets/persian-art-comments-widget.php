<?php
/* ----------------------------------------

	Plugin Name: PersianArt Recent Comments Widget
	Description: Show latest comments
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// register widget and add it
add_action( 'widgets_init', 'PersianArt_RecentComments_widget' );
function PersianArt_RecentComments_widget() {
	register_widget( 'PersianArt_RecentComments' );
}

class PersianArt_RecentComments extends WP_Widget_Recent_Comments {

	// constructor
    function PersianArt_RecentComments() {
        parent::WP_Widget(false, 'PersianArt - Recent Comments', array('description' => __('Show latest comments', 'my_framework')));	
    }

	// widget
	function widget( $args, $instance ) {
		global $wpdb, $comments, $comment;

		extract( $args, EXTR_SKIP );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Recent Comments','my_framework') : $instance['title'] );
		if ( ! $number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$comment_len = 100;

		if ( ! $comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
			$comments = $wpdb->get_results( "SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT 15" );
			wp_cache_add( 'recent_comments', $comments, 'widget' );
		}

		$comments = array_slice( (array) $comments, 0, $number );

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;
?>
		<ol class="widget-recent-comments-wrpper">
			<?php if ( $comments ) : foreach ( (array) $comments as $comment) :?>
			<li class="widget-recent-comments">
				<div class="author"><?php echo sprintf(_x('%1$s on', 'widgets', 'my_framework'), get_comment_author_link()); ?></div>
				<div class="tilte">
					<h5><?php echo sprintf(_x('%1$s', 'widgets', 'my_framework'), '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'); ?></h5>
				</div>
			</li>
			<?php endforeach; endif; ?>
		</ol>
		<?php echo $after_widget; ?>
<?php
	}
}