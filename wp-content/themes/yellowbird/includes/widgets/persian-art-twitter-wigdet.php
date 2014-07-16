<?php
/* ----------------------------------------

	Plugin Name: PersianArt Twitter Widget
	Description: Show twitter messages
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// Register widget and add it
add_action( 'widgets_init', 'PersianArt_Twitter_widget' );
function PersianArt_Twitter_widget() {
	register_widget( 'PersianArt_Twitter' );
}

class PersianArt_Twitter extends WP_Widget {

	// Constructor
    function PersianArt_Twitter() {
        parent::WP_Widget(false, 'PersianArt - Twitter', array('description' => __('a simple twitter widget', 'my_framework')));
    }

	// Widget
    function widget( $args, $instance ) {
 		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Twitter Feed', 'my_framework') : $instance['title'] );
		$consumerkey = ! empty( $instance['consumerkey'] ) ? $instance['consumerkey'] : '';
		$consumersecret = ! empty( $instance['consumersecret']) ? $instance['consumersecret'] : '';
		$accesstoken = ! empty( $instance['accesstoken']) ? $instance['accesstoken'] : '';
		$accesstokensecret = ! empty( $instance['accesstokensecret']) ? $instance['accesstokensecret'] : '';
		$username = ! empty( $instance['username']) ? $instance['username'] : '';
		$count = ! empty( $instance['count']) ? $instance['count'] : '';

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		// Check settings and die if not set
		if ( empty( $instance['consumerkey'] ) || empty( $instance['consumersecret'] ) || empty( $instance['accesstoken'] ) || empty( $instance['accesstokensecret'] ) || empty( $instance['username'] ) ) {
			echo '<strong>Please fill all widget settings!</strong>' . $after_widget;
			return;
		}	  
										  
		$connection = getConnectionWithAccessToken( $instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret'] );
		$tweets = $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $instance['username'] . "&count=".$count ) or die( 'Couldn\'t retrieve tweets! Wrong username?' );
		
		// Check error						
		if ( ! empty( $tweets->errors ) ) {
			if ( $tweets->errors[0]->message == 'Invalid or expired token' ) {
				echo '<strong>' . $tweets->errors[0]->message . '!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
			} else {
				echo '<strong>' . $tweets->errors[0]->message . '</strong>' . $after_widget;
			}
			return;
		}
	
		for ( $i = 0; $i <= count( $tweets ); $i++ ) {
			if ( ! empty( $tweets[ $i ] ) ) {
				$tweets_array[ $i ]['created_at'] = $tweets[ $i ]->created_at;
				$tweets_array[ $i ]['text'] = $tweets[ $i ]->text;			
				$tweets_array[ $i ]['status_id'] = $tweets[ $i ]->id_str;			
			}	
		}
		
		// Output
		$pa_twitter_widget_tweets = maybe_unserialize( serialize( $tweets_array ) );
		if ( ! empty( $pa_twitter_widget_tweets ) ) {
			print '
			<div id="twitter-div">
				<ul id="twitter_update_list">';
				foreach( $pa_twitter_widget_tweets as $tweet ) {								
					print '<li><span>'.convert_links( $tweet['text'] ) . '</span><a class="twitter_time" target="_blank" href="http://twitter.com/' . $instance['username'] . '/statuses/' . $tweet['status_id'].'">' . relative_time( $tweet['created_at'] ) . '</a></li>';
				}
	
			print '
				</ul>
			</div>';
		}

		echo $after_widget;
	}

	// Update
    function update( $new_instance, $old_instance ) {
        return $new_instance;
	}

	// Form
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$consumerkey = isset( $instance['consumerkey'] ) ? esc_attr( $instance['consumerkey'] ) : '';
		$consumersecret = isset( $instance['consumersecret'] ) ? esc_attr( $instance['consumersecret'] ) : '';
		$accesstoken = isset( $instance['accesstoken'] ) ? esc_attr( $instance['accesstoken'] ) : '';
		$accesstokensecret = isset( $instance['accesstokensecret'] ) ? esc_attr( $instance['accesstokensecret'] ) : '';
		$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
		$count = isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : '';
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('consumerkey'); ?>"><?php _e('Consumer key:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('consumerkey'); ?>" name="<?php echo $this->get_field_name('consumerkey'); ?>" type="text" value="<?php echo esc_attr( $consumerkey ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('consumersecret'); ?>"><?php _e('Consumer secret:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('consumersecret'); ?>" name="<?php echo $this->get_field_name('consumersecret'); ?>" type="text" value="<?php echo esc_attr( $consumersecret ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('accesstoken'); ?>"><?php _e('Access token:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('accesstoken'); ?>" name="<?php echo $this->get_field_name('accesstoken'); ?>" type="text" value="<?php echo esc_attr( $accesstoken ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('accesstokensecret'); ?>"><?php _e('Access token secret:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('accesstokensecret'); ?>" name="<?php echo $this->get_field_name('accesstokensecret'); ?>" type="text" value="<?php echo esc_attr( $accesstokensecret ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter username:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of tweet:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
<?php
	}
}