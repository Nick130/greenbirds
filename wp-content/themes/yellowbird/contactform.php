<p id="contact-success-message" class="message-box no-icon green mt30 display-none"><?php echo $contactmessage; ?></p>

<!-- Contact form
================================================== -->
<div id="contact-form-wrapper">

	<?php // recaptcha options
	if ( $recaptchaonoff == 'true' ) { ?>
	<script type="text/javascript">
		var RecaptchaOptions = {
			theme : '<?php echo $recaptchatheme; ?>',
			lang : '<?php echo $recaptchalang; ?>'
		};
	</script>
	<?php } ?>

	<form action="" id="contact-form" method="post">

	<?php
	// If the form is submitted
	if ( isset( $_POST['submitted'] ) ) {

		// Check to see if the honeypot captcha field was filled in
		if ( trim( $_POST['checking'] ) !== '' ) {
			$captcha_error = true;
		} else {

			// Check to make sure that the name field is not empty
			if ( trim( $_POST['contactName'] ) === '' ) {
				$name_error = true;
				$has_error = true;
			} else {
				$name = trim( $_POST['contactName'] );
			}

			// Check to make sure that a valid email address is submitted
			if ( trim( $_POST['email'] ) === '' )  {
				$email_error = true;
				$has_error = true;
			} else if ( ! eregi( '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$', trim( $_POST['email'] ) ) ) {
				$email_error = true;
				$has_error = true;
			} else {
				$email = trim( $_POST['email'] );
			}

			// No need Check to make sure that the phone field is not empty
				$phone = trim( $_POST['phone'] );

			// Check to make sure comments were entered	
			if ( trim( $_POST['comments'] ) === '' ) {
				$comment_error = true;
				$has_error = true;
			} else {
				if ( function_exists('stripslashes') ) {
					$comments = stripslashes( trim( $_POST['comments'] ) );
				} else {
					$comments = trim( $_POST['comments'] );
				}
			}

			// If there is no error, send the email
			if ( ! isset( $has_error ) ) {

				$emailto = $contactemail;
					/*if (!isset($emailto) || ($emailto == '') ){
						$emailto = get_option('admin_email');
					}*/
				$subject = __('Contact Form Submission from ', 'my_framework') . $name;
				$body = __('Name: ', 'my_framework') . $name . "\n\n" . __('Email: ', 'my_framework') . $email . "\n\n" . __('Phone: ', 'my_framework') . $phone . "\n\n" . __('Comments: ', 'my_framework') . $comments;
				$headers = __('From: My Site ', 'my_framework') . '<' . $emailto . '>' . "\r\n" . __('Reply-To: ', 'my_framework') . $email;
				
				mail( $emailto, $subject, $body, $headers );
	
				$emailSent = true;
			}
		}
	}

	?>

	<?php if ( isset( $emailSent ) ) { ?>

		<p class="message-box no-icon green mt30"><?php echo $contactmessage; ?></p>

	<?php } else { ?>

		<!-- Name
		================================================== -->
		<?php if ( $contactlabel == 'label' ) { ?><label for="contactName"><?php echo $contactnamelabel; ?> <span class="skin-color">*</span></label><?php } ?>
		<div>
			<input type="text" name="contactName" id="contactName" value="<?php if ( isset( $_POST['contactName'] ) ) echo $_POST['contactName']; ?>" data-message="<?php echo $contactnameerror; ?>" class="requiredfield" placeholder="<?php if ( $contactlabel != 'label' ) echo $contactnamelabel; ?>" />
			<?php if ( isset( $name_error ) && $name_error != '' ) { ?>
			<div class="error-message php-message"><?php echo $name_error; ?></div>
			<?php } ?>
		</div>

		<!-- Email
		================================================== -->
		<?php if ( $contactlabel == 'label' ) { ?><label for="email"><?php echo $contactemaillabel; ?> <span class="skin-color">*</span></label><?php } ?>
		<div>
			<input type="text" name="email" id="email" value="<?php if ( isset( $_POST['email'] ) )  echo $_POST['email']; ?>" data-message="<?php echo $contactemailerror; ?>" data-email="<?php echo $contactemailvalidateerror; ?>" class="requiredfield email" placeholder="<?php if ( $contactlabel != 'label' ) echo $contactemaillabel; ?>" />
			<?php if ( isset( $email_error ) && $email_error != '' ) { ?>
			<div class="error-message php-message"><?php echo $email_error; ?></div>
			<?php } ?>
		</div>

		<!-- Phone
		================================================== -->
		<?php if ( $contactlabel == 'label' ) { ?><label for="phone"><?php echo $contactphonelabel; ?></label><?php } ?>
		<div>
			<input type="text" name="phone" id="phone" value="<?php if ( isset( $_POST['phone'] ) ) echo $_POST['phone']; ?>" placeholder="<?php if ( $contactlabel != 'label' ) echo $contactphonelabel; ?>" />
		</div>

		<!-- Message
		================================================== -->
		<?php if ( $contactlabel == 'label' ) { ?><label for="comments"><?php echo $contactcommentlabel; ?> <span class="skin-color">*</span></label><?php } ?>
		<div>
			<textarea name="comments" id="comments" rows="1" cols="1" data-message="<?php echo $contactcommenterror; ?>" class="requiredfield" placeholder="<?php if ( $contactlabel != 'label' ) echo $contactcommentlabel; ?>" ><?php if ( isset( $_POST['comments'] ) ) { if ( function_exists('stripslashes') ) echo stripslashes( $_POST['comments'] ); else echo $_POST['comments']; } ?></textarea>
			<?php if ( isset( $comment_error ) && $comment_error != '' ) { ?>
			<div class="error-message php-message"><?php echo $comment_error; ?></div>
			<?php } ?>
		</div>

		<!-- Recaptcha
		================================================== -->
		<div id="contact-recaptcha" class="recaptcha <?php if ( $recaptchaonoff == 'true' ) echo 'true'; ?>">
			<P class="recaptcha-error display-none"><?php echo $recaptchaerror; ?></p>
			<?php if ( $recaptchaonoff == 'true' ) echo recaptcha_get_html( get_option('mytheme_recaptchapublickey') ); ?>
		</div>

		<div class="screenReader display-none">
			<label for="checking" class="screenReader"><?php _e('If you want to submit this form, do not enter anything in this field', 'my_framework'); ?></label>
			<input type="text" name="checking" id="checking" class="screenReader" value="<?php if ( isset( $_POST['checking'] ) ) echo $_POST['checking'];?>" />
		</div>

		<!-- Submit
		================================================== -->
		<div class="buttons">
			<input type="hidden" name="submitted" id="submitted" value="true" />
			<input type="submit" class="normal-button reverse" id="contact-submit" value="<?php _e('Submit', 'my_framework'); ?>">
		</div>

	<?php } ?>

	</form>

</div>