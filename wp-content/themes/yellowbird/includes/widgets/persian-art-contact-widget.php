<?php
/* ----------------------------------------

	Plugin Name: PersianArt Contact Widget
	Description: Contact From Widget
	Version: 1.0
	Author: PersianArt 
	Author URL: http://www.PersiTheme.com/

---------------------------------------- */

// Register widget and add it
add_action( 'widgets_init', 'PersianArt_Contact_widget' );
function PersianArt_Contact_widget() {
	register_widget( 'PersianArt_Contact' );
}

class PersianArt_Contact extends WP_Widget {

	// Constructor
    function PersianArt_Contact() {
        parent::WP_Widget(false, 'PersianArt - Contact', array('description' => __('Contact form widget', 'my_framework')));
    }

	// Widget
    function widget( $args, $instance ) {		
        extract( $args );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Contact Me', 'my_framework') : $instance['title'] );
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $message = ! empty( $instance['message'] ) ? $instance['message'] : '';
        $label = ! empty( $instance['label'] ) ? $instance['label'] : '';
		$name_label = ! empty( $instance['name_label'] ) ? $instance['name_label'] : '';
		$name_error_message = ! empty( $instance['name_error_message'] ) ? $instance['name_error_message'] : '';
		$email_label = ! empty( $instance['email_label'] ) ? $instance['email_label'] : '';
		$email_error_message = ! empty( $instance['email_error_message'] ) ? $instance['email_error_message'] : '';
		$email_validate_error_message =  ! empty( $instance['email_validate_error_message'] ) ? $instance['email_validate_error_message'] : '';
		$comment_label = ! empty( $instance['comment_label'] ) ? $instance['comment_label'] : '';
		$comment_error_message = ! empty( $instance['comment_error_message'] ) ? $instance['comment_error_message'] : '';

		echo $before_widget; 

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		// If the form is submitted
		if ( isset( $_POST['widget-submitted'] ) ) {
		
			// Check to see if the honeypot captcha field was filled in
			if ( trim( $_POST['widget-checking'] ) !== '' ) {
				$captcha_error = true;
			} else {
			
				// Check to make sure that the name field is not empty
				if ( trim( $_POST['widget-name']) === '' ) {
					$name_error = true;
					$has_error = true;
				} else {
					$name = trim($_POST['widget-name']);
				}
				
				// Check to make sure that a valid email address is submitted
				if ( trim( $_POST['widget-email'] ) === '' )  {
					$email_error = true;
					$has_error = true;
				} elseif ( ! filter_var( trim( $_POST['widget-email'] ), FILTER_VALIDATE_EMAIL ) ) {
					$email_validate_error = true;
					$has_error = true;
				} else {
					$email = trim( $_POST['widget-email'] );
				}
					
				// Check to make sure comments were entered	
				if ( trim( $_POST['widget-comments'] ) === '' ) {
					$comment_error = true;
					$has_error = true;
				} else {
					if ( function_exists( 'stripslashes' ) ) {
						$comments = stripslashes( trim( $_POST['widget-comments'] ) );
					} else {
						$comments = trim( $_POST['widget-comments'] );
					}
				}
					
				// If there is no error, send the email
				if ( ! isset( $has_error ) ) {
		
					$emailTo = $instance['email'];
					$subject = __('Contact Form Submission from ', 'my_framework') . $name;
					$body = __('Name: ', 'my_framework') . $name . "\n\n" . __('Email: ', 'my_framework') . $email . "\n\n" . __('Comments: ', 'my_framework') . $comments;
					$headers = 'From: My Site <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
					
					mail( $emailTo, $subject, $body, $headers );
		
					$emailSent = true;
		
				}
			}
		}

		// Message for ajax ?>
		<p id="widgetcontact-success-message" class="message-box no-icon green <?php if ( ! isset( $emailSent ) ) echo 'display-none'; else echo ''; ?>"><?php echo $message; ?></p>
		
		<?php if ( ! isset( $emailSent ) ) { ?>
		
		<form action="<?php the_permalink(); ?>" id="widget-contact-form" method="post">

			<!-- Name
			================================================== -->
			<?php if ( $label == 'label' ) { ?><label for="widget-name"><?php echo $name_label; ?> <span class="skin-color">*</span></label><?php } ?>
			<div>
				<input type="text" name="widget-name" id="widget-name" size="1" value="<?php if ( isset( $_POST['widget-name'] ) ) echo $_POST['widget-name']; ?>" data-message="<?php echo $name_error_message; ?>" class="requiredfield" placeholder="<?php  if ( $label != 'label' ) echo $name_label; ?>" />
				<?php if ( isset( $name_error ) && $name_error == true ) { ?>
				<div class="error-message php-message"><?php echo $name_error_message; ?></div>
				<?php } ?>
			</div>

			<!-- Email
			================================================== -->
			<?php if ( $label == 'label' ) { ?><label for="widget-email"><?php echo $email_label; ?> <span class="skin-color">*</span></label><?php } ?>
			<div>
				<input type="text" name="widget-email" id="widget-email" size="1" value="<?php if ( isset( $_POST['widget-email'] ) )  echo $_POST['widget-email']; ?>" data-message="<?php echo $email_error_message; ?>" data-email="<?php echo $email_validate_error_message; ?>" class="requiredfield email" placeholder="<?php  if ( $label != 'label' ) echo $email_label; ?>" />
				<?php if ( isset( $email_error ) && $email_error  == true ) { ?>
				<div class="error-message php-message"><?php echo $email_error_message; ?></div>
				<?php } ?>
				<?php if ( isset( $email_validate_error ) && $email_validate_error  == true ) { ?>
				<div class="error-message php-message"><?php echo $email_validate_error_message; ?></div>
				<?php } ?>
			</div>

			<!-- Message
			================================================== -->
			<?php if ( $label == 'label' ) { ?><label for="widget-commentsText"><?php echo $comment_label; ?> <span class="skin-color">*</span></label><?php } ?>
			<div class="textarea">
				<textarea name="widget-comments" id="widget-commentsText" rows="1" cols="1" data-message="<?php echo $comment_error_message; ?>" class="requiredfield" placeholder="<?php  if ( $label != 'label' ) echo $comment_label; ?>" ><?php if ( isset( $_POST['widget-comments'] ) ) { if ( function_exists( 'stripslashes' ) ) echo stripslashes( $_POST['widget-comments'] ); else echo $_POST['widget-comments']; } ?></textarea>
				<?php if ( isset( $comment_error ) && $comment_error  == true ) { ?>
				<div class="error-message php-message"><?php echo $comment_error_message; ?></div>
				<?php } ?>
			</div>

			<div class="screenReader display-none">
				<label for="widget-checking" class="screenReader"><?php _e('If you want to submit this form, do not enter anything in this field', 'my_framework'); ?></label>
				<input type="text" name="widget-checking" id="widget-checking" size="1" class="screenReader" value="<?php if ( isset( $_POST['widget-checking'] ) ) echo $_POST['widget-checking'];?>" />
			</div>

			<!-- Submit
			================================================== -->
			<div class="buttons">
				<input type="hidden" name="widget-submitted" id="widget-submitted" value="true" />
				<input type="submit" id="widget-contact-submit" value="<?php _e('SUBMIT', 'my_framework'); ?>">
			</div>

		</form>

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
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$message = isset( $instance['message'] ) ? esc_attr( $instance['message'] ) : '<strong>Thanks!</strong> Your email was successfully sent.';
		$label = isset( $instance['label'] ) ? esc_attr( $instance['label'] ) : '';
		$name_label = isset( $instance['name_label'] ) ? esc_attr( $instance['name_label'] ) : 'Name';
		$name_error_message = isset( $instance['name_error_message'] ) ? esc_attr( $instance['name_error_message'] ) : 'Please enter your name.';
		$email_label = isset( $instance['email_label'] ) ? esc_attr( $instance['email_label'] ) : 'Email';
		$email_error_message = isset( $instance['email_error_message'] ) ? esc_attr( $instance['email_error_message'] ) : 'Please enter your email.';
		$email_validate_error_message = isset( $instance['email_validate_error_message'] ) ? esc_attr( $instance['email_validate_error_message'] ) : 'Please enter a valid email.';
		$comment_label = isset( $instance['comment_label'] ) ? esc_attr( $instance['comment_label'] ) : 'Message';
		$comment_error_message = isset( $instance['comment_error_message'] ) ? esc_attr( $instance['comment_error_message'] ) : 'Please enter your message.';
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Successful message:', 'my_framework'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo esc_textarea( $message ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('label'); ?>">
				<?php _e('Label or Placeholder:', 'my_framework'); ?>
				<select id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" class="widefat">
					<option value="placeholder" <?php echo ($label === 'placeholder' ? ' selected="selected"' : ''); ?>>Placeholder</option>
					<option value="label" <?php echo ($label === 'label' ? ' selected="selected"' : ''); ?> >Label</option>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('name_label'); ?>"><?php _e('Name label/placeholder:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('name_label'); ?>" name="<?php echo $this->get_field_name('name_label'); ?>" type="text" value="<?php echo esc_attr( $name_label ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('name_error_message'); ?>"><?php _e('Name error message:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('name_error_message'); ?>" name="<?php echo $this->get_field_name('name_error_message'); ?>" type="text" value="<?php echo esc_attr( $name_error_message ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email_label'); ?>"><?php _e('Email label/placeholder:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email_label'); ?>" name="<?php echo $this->get_field_name('email_label'); ?>" type="text" value="<?php echo esc_attr( $email_label ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email_error_message'); ?>"><?php _e('Email error message:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email_error_message'); ?>" name="<?php echo $this->get_field_name('email_error_message'); ?>" type="text" value="<?php echo esc_attr( $email_error_message ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email_validate_error_message'); ?>"><?php _e('Email validate error message:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email_validate_error_message'); ?>" name="<?php echo $this->get_field_name('email_validate_error_message'); ?>" type="text" value="<?php echo esc_attr( $email_validate_error_message ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('comment_label'); ?>"><?php _e('Message label/placeholder:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('comment_label'); ?>" name="<?php echo $this->get_field_name('comment_label'); ?>" type="text" value="<?php echo esc_attr( $comment_label ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('comment_error_message'); ?>"><?php _e('Comment error message:', 'my_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('comment_error_message'); ?>" name="<?php echo $this->get_field_name('comment_error_message'); ?>" type="text" value="<?php echo esc_attr( $comment_error_message ); ?>" />
		</p>
<?php 
	}
}