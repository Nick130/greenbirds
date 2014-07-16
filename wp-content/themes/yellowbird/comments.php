
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'my_framework' ); ?></p>
	</div>
	<?php
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
				printf( _n( 'One Comment', 'Comments (%1$s)', get_comments_number(), 'my_framework' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'theme_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="comment-nav">
			<h3><?php _e( 'Comment Navigation', 'my_framework' ); ?></h3>
			<div class="nav-prev"><?php previous_comments_link( __( '&larr; Older Comments', 'my_framework' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'my_framework' ) ); ?></div>
		</div>
		<?php endif; // check for comment navigation ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'my_framework' ); ?></p>
	<?php endif; ?>

	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$comments_args = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<label for="author">'. __('Name ', 'my_framework') . ($req ? '<span class="skin-color">*</span>' : '') .'</label>
						<div>
							<input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" size="30" tabindex="1" '. $aria_req .' />
						</div>',
			'email'  => '<label for="email">'. __('Mail (will not be published) ', 'my_framework') . ($req ? '<span class="skin-color">*</span>' : '') .'</label>
						<div>
							<input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="30" tabindex="2" '. $aria_req .' />
						</div>',
			'url'    => '<label for="url">'. __('Website ', 'my_framework') .'</label>
						<div>
							<input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" size="30" tabindex="3" />
						</div>' ) ),
		'comment_field' => '<label for="comment">' . __( 'Comment ', 'my_framework' ) . ($req ? '<span class="skin-color">*</span>' : '') . '</label>
							<div class="textarea">
								<textarea name="comment" id="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>
							</div>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_submit' => 'comment-submit',
		'label_submit' => __( 'SUBMIT', 'my_framework' ),
		'title_reply' => __( 'Leave a Comments', 'my_framework' )
	);
	comment_form($comments_args, $post->ID);
	?>
	
	</div>