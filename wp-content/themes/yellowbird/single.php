<?php 

get_header(); 
	
	// start loop
	if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more=0;

	// set options
	$sidebarsinglepost = get_option('mytheme_sidebarsinglepost');
	
	$portstyle = get_post_meta($post->ID, 'portstyle', true);
	$portinfo = get_post_meta($post->ID, 'portinfo', true);
	$portdetailsonoff = get_post_meta($post->ID, 'portdetailsonoff', true);
	$portdateonoff = get_post_meta($post->ID, 'portdateonoff', true);
	$porttagonoff = get_post_meta($post->ID, 'porttagonoff', true);
	$portrelatedonoff = get_post_meta($post->ID, 'portrelatedonoff', true);
	$porttitleplace = get_post_meta($post->ID, 'porttitleplace', true);
	$portpaginateplace = get_post_meta($post->ID, 'portpaginateplace', true);
	$portpaginatetitle = get_post_meta($post->ID, 'portpaginatetitle', true);
	$portpaginatealign = get_post_meta($post->ID, 'portpaginatealign', true);
	$portthumbtype = get_post_meta($post->ID, 'portthumbtype', true);
	$portthumbimage = get_post_meta($post->ID, 'portthumbimage', true);
	$portthumbimageurl = get_post_meta($post->ID, 'portthumbimageurl', true);
	$portthumbvideo = get_post_meta($post->ID, 'portthumbvideo', true);
	$portthumbslider = get_post_meta($post->ID, 'portthumbslider', true);
	$portinthumbtype = get_post_meta($post->ID, 'portinthumbtype', true);
	$portinthumbimage = get_post_meta($post->ID, 'portinthumbimage', true);
	$portinthumbvideo = get_post_meta($post->ID, 'portinthumbvideo', true);
	$portinthumbslider = get_post_meta($post->ID, 'portinthumbslider', true);
	
	$postsidebar = get_post_meta($post->ID, 'postsidebar', true);
	$postsidebarright = get_post_meta($post->ID, 'postsidebarright', true);
	$postsidebarleft = get_post_meta($post->ID, 'postsidebarleft', true);
	$postauthor = get_post_meta($post->ID, 'postauthoronoff', true);
	$postsocial = get_post_meta($post->ID, 'postsocialonoff', true);
	$postrelated = get_post_meta($post->ID, 'postrelatedonoff', true);
	$posttitleplace = get_post_meta($post->ID, 'posttitleplace', true);
	$postpaginateplace = get_post_meta($post->ID, 'postpaginateplace', true);
	$postpaginatetitle = get_post_meta($post->ID, 'postpaginatetitle', true);
	$postpaginatealign = get_post_meta($post->ID, 'postpaginatealign', true);
	$postthumbtype = get_post_meta($post->ID, 'postthumbtype', true);
	$postthumbvideo = get_post_meta($post->ID, 'postthumbvideo', true);
	$postthumbslider = get_post_meta($post->ID, 'postthumbslider', true);
	$postinthumbtype = get_post_meta($post->ID, 'postinthumbtype', true);
	$postinthumbimage = get_post_meta($post->ID, 'postinthumbimage', true);
	$postinthumbvideo = get_post_meta($post->ID, 'postinthumbvideo', true);
	$postinthumbslider = get_post_meta($post->ID, 'postinthumbslider', true);
	
	if ( $postinthumbtype == 'normal' ) {
		$postinthumbtype = $postthumbtype;
		$postinthumbimage = get_post_thumbnail_id();
		$postinthumbvideo = $postthumbvideo;
		$postinthumbslider = $postthumbslider;
	}
	
	if ( $portinthumbtype == 'normal' ) {
		$portinthumbtype = $portthumbtype;
		$portinthumbimage = get_post_thumbnail_id();
		$portinthumbvideo = $portthumbvideo;
		$portinthumbslider = $portthumbslider;
	}
	
	if ( get_post_type() == 'post' ) {
		if ( ! empty( $postsidebar ) ) {
			$pagesidebar = $postsidebar;
		} else {
			$pagesidebar = $sidebarsinglepost;
		}
		$pagesidebarleft = $postsidebarleft;
		$pagesidebarright = $postsidebarright;
		
		if ( $pagesidebar == 'right' || $pagesidebar == 'left' ) { 
			$width = 870;
			$height = 425;
			if ( $pagesidebar == 'right' ) {
				$class = 'grid_9';
			} else {
				$class = 'grid_9 floatright';
			}
			$relclass = 'col3';
			$relwidth = '187';
			$relheight = '100';
			$relnum = '3';
		} elseif ( $pagesidebar == 'both' ) {
			$width = 570;
			$height = 285;
			$class = 'grid_6 bothmiddle';
			$relclass = 'col2';
			$relwidth = '210';
			$relheight = '100';
			$relnum = '2';
		} else {
			$width = 1170;
			$height = 585;
			$class = 'grid_12';
			$relclass = '';
			$relwidth = '215';
			$relheight = '100';
			$relnum = '4'; 
		}
	}
	
	if ( get_post_type() == 'portfolio' ) {
		$relclass = '';
		$relwidth = '270';
		$relheight = '135';
		$relnum = '4';
		if ( $portstyle == 'full' ) {
			$width = '1170';
			$height = '585';
			$class = 'grid_12';
		} else {
			$width = '870';
			$height = '435';
			$class = 'grid_8';
		}
	}

if ( get_post_type() == 'portfolio' ) {
		
/*-----------------------------------------------------------------------------------*/
/*	Portfolio Single Page
/*-----------------------------------------------------------------------------------*/

?>

	<?php // display title above thumbnail image
	if ($porttitleplace=='above') { ?>
		
	<!-- Title
	================================================== -->
	<div class="h-wrapper">
		<span class="icon <?php /*echo $pageicon;*/ ?>"></span>
		<div class="container_12">
			<h1 class="grid_12 title"><?php the_title(); ?></h1>
			<div class="sub-title grid_12">
				<div class="date-wrapper">
					<div class="date-wrap">
						<?php the_time('j F, Y / '); comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="container_12">
		<div class="content">
			<div class="ports single<?php if ($porttitleplace!='above') echo ' titlebottom'; ?>">
			
				<?php // display paginate above thumbnail image
				if ( $portpaginateplace == 'top' ) { ?>
					
				<!-- Pagination
				================================================== -->
				<div class="older-newer grid_12 <?php if ($porttitleplace!='above') echo 'above'; ?>">
					<?php if ($portpaginatealign!='right') { ?><div class="older"><?php if ($portpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
					<div class="newer <?php if ($portpaginatealign!='left') echo 'floatright'; ?>"><?php if ($portpaginatetitle=='next-prev') next_post_link('%link', __('Next', 'my_framework')); else next_post_link('%link', '%title'); ?></div>
					<?php if ($portpaginatealign=='right') { ?><div class="older floatright"><?php if ($portpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
				</div><!-- .older-newer -->
				<?php } ?>
				
				<?php if (($portinthumbtype == 'image' && $portinthumbimage) || ($portinthumbtype == 'video' && $portinthumbvideo) || ($portinthumbtype == 'slider' && $portinthumbslider)) { ?>
					
				<!-- Featured thumbnail
				================================================== -->
				<div class="featured-thumbnail-wrapper <?php if ($portstyle=='half') echo 'grid_9'; else echo 'grid_12'; ?>">
					<div class="featured-thumbnail <?php echo $portinthumbtype; ?>">
						<?php if ($portinthumbtype == 'image') echo create_image_inside ($portinthumbimage, $width, $height); ?>
						<?php if ($portinthumbtype == 'video') echo create_video ($portinthumbvideo, $width, $height); ?>
						<?php if ($portinthumbtype == 'slider') echo create_slider ($portinthumbslider, $width, $height); ?>
					</div>
				</div><!-- .featured-thumbnail-wrapper -->
				
				<?php if ($portstyle=='half' && $portdetailsonoff!='false') { ?>
					
				<!-- Details
				================================================== -->
				<div id="port-details-wrapper" class="grid_3">
					<div id="port-details">
						<?php if ($portdateonoff!='false') { ?><span class="detail"><strong><?php _e('Date:', 'my_framework'); ?></strong> <?php the_time('j M, Y'); ?></span><?php } ?>
						<?php if ($porttagonoff!='false') { ?><span class="detail"><strong><?php _e('Tags:', 'my_framework'); ?></strong> <?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ' , '' ); ?></span><?php } ?>
						<?php echo do_shortcode($portinfo); ?>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
			
				<?php // display title below thumbnail image
				if ($porttitleplace!='above') { ?>
					
				<!-- Title
				================================================== -->
				<div class="container_12">
					<div class="grid_12 h-wrapper">
						<span class="<?php /*echo $pageicon;*/ ?>"></span>
						<h1 class="title"><?php the_title(); ?></h1>
						<div class="sub-title grid_12">
							<div class="date-wrapper">
								<div class="date-wrap">
									<?php the_time('j F, Y / '); comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
						
				<div id="port-content-wrapper" <?php if ($porttitleplace=='above') echo 'class="above"'; ?>>
					<?php if ($portstyle=='full' && $portdetailsonoff!='false') { ?>
					<div id="port-details-wrapper" class="grid_3">
						<div id="port-details">
							<?php if ($portdateonoff!='false') { ?><span class="detail"><strong><?php _e('Date:', 'my_framework'); ?></strong> <?php the_time('j M, Y'); ?></span><?php } ?>
							<?php if ($porttagonoff!='false') { ?><span class="detail"><strong><?php _e('Tags:', 'my_framework'); ?></strong> <?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ' , '' ); ?></span><?php } ?>
							<?php echo do_shortcode($portinfo); ?>
						</div>
					</div>
					<?php } ?>
					<div class="content-portstyle <?php if ($portstyle=='full' && $portdetailsonoff!='false') echo 'grid_9'; else echo 'grid_12'; ?>">
						<div class="post-content port-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			
				<?php // display paginate below content
				if ($portpaginateplace!='top' && $portpaginateplace!='disable') { ?>
					
				<!-- Pagination
				================================================== -->
				<div class="older-newer grid_12">
					<?php if ($portpaginatealign!='right') { ?><div class="older"><?php if ($portpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
					<div class="newer <?php if ($portpaginatealign!='left') echo 'floatright'; ?>"><?php if ($portpaginatetitle=='next-prev') next_post_link('%link', __('Next', 'my_framework')); else next_post_link('%link', '%title'); ?></div>
					<?php if ($portpaginatealign=='right') { ?><div class="older floatright"><?php if ($portpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
				</div><!-- .older-newer -->
				<?php } ?>
				
				
				<?php // display related portfolio
				if ($portrelatedonoff!='false') { ?>
					
				<!-- Related Portfolio
				================================================== -->
				<div class="related">
					<div class="related-title grid_12">
						<h3><?php _e('Related Portfolio', 'my_framework'); ?></h3>
					</div>
					<div class="related-content">
						<ul>
						
						<?php
						$my_query = new wp_query(array('portfolio-category' => get_the_term_list( $post->ID, 'portfolio-category', '', ', ' , '' ),'post__not_in' => array($post->ID), 'showposts' => -1));
						if ( $my_query->have_posts() && get_the_term_list( $post->ID, 'portfolio-category', '', ', ' , '' ) != '' ) {
							while ($my_query->have_posts()) { $my_query->the_post();
						
							$relportcount = $my_query->post_count;
					
							$portwebsite = get_post_meta($post->ID, 'portwebsite', true);
							$portthumbtype = get_post_meta($post->ID, 'portthumbtype', true);
							$portthumbimage = get_post_meta($post->ID, 'portthumbimage', true);
							$portthumbvideo = get_post_meta($post->ID, 'portthumbvideo', true);
							$portthumbslider = get_post_meta($post->ID, 'portthumbslider', true);
							$portthumbimageurl = get_post_meta($post->ID, 'portthumbimageurl', true);
						?>
									
							<li class="grid_3">
								<div class="featured-thumbnail <?php echo $portthumbtype; ?>">
									<?php if ($portthumbtype == 'image') echo create_image ($portthumbimage, $portthumbimageurl, $relwidth, $relheight, false); ?>
									<?php if ($portthumbtype == 'video') echo create_video ($portthumbvideo, $relwidth, $relheight); ?>
									<?php if ($portthumbtype == 'slider') echo create_slider ($portthumbslider, $relwidth, $relheight); ?>
									<a href="<?php the_permalink() ?>" class="zoom-icon icon-post <?php if ($portthumbtype=='slider') echo 'slider'; elseif ($portthumbtype=='video') echo 'video'; else echo 'none' ?>"></a>
								</div><!-- .featured-thumbnail -->
								<div class="related-context">
									<h3 class="related-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
									<div class="related-category">
										<span class="related-date"><?php the_time('j M Y'); ?></span>
										<span class="related-tag"><?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' ); ?></span>
									</div>
								</div><!-- .related-context -->
							</li>		
							
						<?php
							}
						}
						wp_reset_query();
						?>
						
						</ul>
					</div>
				</div><!-- .related port -->
				<?php } ?>
				
			</div><!-- .ports -->
		</div><!-- .content -->
	</div>
	
<?php } elseif ( get_post_type() == 'post' ) {
		
/*-----------------------------------------------------------------------------------*/
/*	Post Single Page
/*-----------------------------------------------------------------------------------*/

?>
	
	
	<!-- Page title
	================================================== -->
	<div class="h-wrapper">
	<span class="icon <?php /*echo $pageicon;*/ ?>"></span>
		<div class="container_12">
			<h1 class="grid_12 title"><?php the_title(); ?></h1>
			<div class="sub-title grid_12">
				<div class="date-wrapper">
					<div class="date-wrap">
						<?php the_time('j F, Y / '); comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
			
	<div class="container_12">

		<?php // display paginate above content
		if ($postpaginateplace=='above') { ?>

		<!-- Pagination, Date
		================================================== -->
		<div class="grid_12">
			<div class="older-newer">
				<?php if ($postpaginatealign!='right') { ?><div class="older"><?php if ($postpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
				<div class="newer <?php if ($postpaginatealign!='left') echo 'floatright'; ?>"><?php if ($postpaginatetitle=='next-prev') next_post_link('%link', __('Next', 'my_framework')); else next_post_link('%link', '%title'); ?></div>
				<?php if ($postpaginatealign=='right') { ?><div class="older floatright"><?php if ($postpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
			</div><!-- .older-newer -->
		</div>
			<?php } ?>
			
		<!-- Page content
		================================================== -->
		<div class="content <?php echo $class; ?>">
			<div class="posts single<?php if ($posttitleplace!='above') echo ' titlebottom'; ?>">
				
				<?php if (($postinthumbtype == 'image' && $postinthumbimage) || ($postinthumbtype == 'video' && $postinthumbvideo) || ($postinthumbtype == 'slider' && $postinthumbslider)) { ?>
				
				<!-- Featured thumbnail
				================================================== -->
				<div class="featured-thumbnail-wrapper">
					<div class="featured-thumbnail <?php echo $postinthumbtype; ?>">
						<?php if ($postinthumbtype == 'image') echo create_image_inside ($postinthumbimage, $width, $height); ?>
						<?php if ($postinthumbtype == 'video') echo create_video ($postinthumbvideo, $width, $height); ?>
						<?php if ($postinthumbtype == 'slider') echo create_slider ($postinthumbslider, $width, $height); ?>
					</div>
				</div><!-- .featured-thumbnail-wrapper -->
				<?php } ?>
				
				<!-- Content
				================================================== -->
				<div class="post-content">
					<?php the_content('Continue Reading'); ?>
					<?php wp_link_pages('before=<p class="pagelink">Pages:', 'after=</p>'); ?>
				</div><!-- .post-content -->
				
				<?php if ($postsocial!='false') { ?>
				
				<!-- Social icons
				================================================== -->
				<div id="social-share">
					<?php include_once(TEMPLATEPATH . '/social-share.php'); ?>
				</div>
				<?php } ?>
				
				<?php // display paginate below content
				if ($postpaginateplace!='above' && $postpaginateplace!='disable') { ?>
				
				<!-- Pagination
				================================================== -->
				<div class="older-newer">
					<?php if ($postpaginatealign!='right') { ?><div class="older"><?php if ($postpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
					<div class="newer <?php if ($postpaginatealign!='left') echo 'floatright'; ?>"><?php if ($postpaginatetitle=='next-prev') next_post_link('%link', __('Next', 'my_framework')); else next_post_link('%link', '%title'); ?></div>
					<?php if ($postpaginatealign=='right') { ?><div class="older floatright"><?php if ($postpaginatetitle=='next-prev') previous_post_link('%link', __('Previous', 'my_framework')); else previous_post_link('%link', '%title'); ?></div><?php } ?>
				</div><!-- .older-newer -->
				<?php } ?>
				
				<?php if ($postauthor!='false') { ?>
				
				<!-- Author Information
				================================================== -->
				<div class="author-info">
					<div class="authorDescription">
						<?php // Displays the Gravatar based on the author's email address
						if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('ID'), $size='78'); } ?>
						
						<h3><?php _e('About the Author', 'my_framework'); ?></h3>
						<?php the_author_meta('description') ?>
					</div>
				</div><!-- .author-info -->
				<?php } ?>
				
				<?php // display related post
				if ($postrelated=='true') { ?>
				
				<!-- Related post
				================================================== -->
				<div class="related">
					<div class="related-title">
					<h3><?php _e('Related Post', 'my_framework'); ?><span class="line"></span></h3>
					</div>
					<div class="related-content">
						<ul>
						
						<?php
						$categories = get_the_category($post->ID);
						if ($categories) {
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
						}
						$my_query = new wp_query(array('category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts' => -1));
						if ( $my_query->have_posts() ) {
							while ($my_query->have_posts()) { $my_query->the_post();
						?>		
							<li>
								<a href="<?php the_permalink() ?>" class="zoom-icon related-post"><?php the_title(); ?></a><span class="related-date">(<?php the_time('l, j F Y'); ?>)</span>
							</li>
						<?php
							}
						}
						wp_reset_query();
						?>
						
						</ul>
					</div>
				</div><!-- .related post -->
				<?php } ?>
			
			</div><!-- .posts -->
			
			<?php comments_template( '', true ); ?>
		
		</div><!-- .content -->
		
		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>


<?php } elseif ( get_post_type() == 'attachment' ) {
		
/*-----------------------------------------------------------------------------------*/
/*	Attachment Single Page
/*-----------------------------------------------------------------------------------*/

?>
		
	<!-- Page title
	================================================== -->
	<div class="h-wrapper">
	<span class="icon <?php /*echo $pageicon;*/ ?>"></span>
	<span class="line"></span>
		<div class="container_12">
			<h1 class="grid_12 title"><?php the_title(); ?></h1>
			<div class="sub-title grid_12"></div>
		</div>
	</div>
		
	<!-- Page content
	================================================== -->
	<div class="content single-post grid_12">
		<div id="customsinglepage" class="posts">

			<div class="entry-attachment">
				<div class="attachment">
				
					<?php
					/**
					* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
					* or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
					*/
					$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
					foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
					break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( count( $attachments ) > 1 ) {
					if ( isset( $attachments[ $k ] ) )
					// get the URL of the next image attachment
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
					else
					// or get the URL of the first image attachment
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					} else {
					// or, if there's only 1 image, get the URL of the image
					$next_attachment_url = wp_get_attachment_url();
					}
					?>
					
					<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, '940x600' ); ?>
					</a>

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div>
					<?php endif; ?>
					
				</div><!-- .attachment -->
			</div><!-- .entry-attachment -->
							
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
			
		</div><!-- #customsinglepost -->
		
		<!-- Pagination
		================================================== -->
		<div class="older-newer mb40">
			<div class="older"><?php previous_image_link( false, __('previous', 'my_framework')) ?></div>
			<div class="newer floatright"><?php next_image_link( false, __('Next', 'my_framework')) ?></div>
		</div><!-- .older-newer-->
		
		<?php comments_template( '', true ); ?>
		
	</div><!-- .content -->


<?php } else {
		
/*-----------------------------------------------------------------------------------*/
/*	Other Post Type
/*-----------------------------------------------------------------------------------*/

?>
		
	<!-- Page title
	================================================== -->
	<div class="h-wrapper">
	<span class="icon <?php /*echo $pageicon;*/ ?>"></span>
	<span class="line"></span>
		<div class="container_12">
			<h1 class="grid_12 title"><?php the_title(); ?></h1>
			<div class="sub-title grid_12"></div>
		</div>
	</div>
	
	<!-- Page content
	================================================== -->
	<div class="content single-post grid_12">
		<div id="customsinglepage" class="posts">
		
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
		
		</div><!-- #customsinglepost -->
		
		<!-- Pagination
		================================================== -->
		<div class="older-newer mb40">
			<div class="older"><?php previous_post_link('%link', '%title') ?></div>
			<div class="newer floatright"><?php next_post_link('%link', '%title') ?></div>
		</div><!-- .older-newer-->
		
		<?php paginate_links(); ?>
		
		<?php comments_template( '', true ); ?>
	
	</div><!-- .content -->
	
	<?php } endwhile; // end loop ?>

<?php get_footer(); ?>