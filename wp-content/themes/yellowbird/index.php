<?php

get_header();

// set options
$pagesidebar = 'no';	// left, right, both, no
$pagesidebarright = 'sidebar-right';
$pagesidebarleft = 'sidebar-left';
$pagesubtitle = '';	// text
$pagetitleonoff = 'true';	// false
$blogthumbtitleonoff = 'true';	// false
$bloglentitle = '';	// digit
$blogthumbexcerptonoff = 'true';	// false
$bloglenexcerpt = '';	// digit
$blogstyle = 'full';	// half
$blogcompletecontentonoff = 'false';	// true
$blogprettyphotoonoff = 'false';	// true
$bloginfoauthoronoff = 'true';	// false
$bloginfotagonoff = 'true';	// false
$bloginfocommentonoff = 'true';	// false
$blogcontinuelinkonoff = 'true';	// false

if (is_archive()) {
	if (is_author()) {
		$pagesidebar = get_option('mytheme_sidebarauthor');
	} elseif (is_category()) {
		$pagesidebar = get_option('mytheme_sidebarcategory');
	} elseif (is_tag()) {
		$pagesidebar = get_option('mytheme_sidebartag');
	} else {
		$pagesidebar = get_option('mytheme_sidebararchive');
	}
} elseif (is_search()) {
	$pagesidebar = get_option('mytheme_sidebarsearch');
} else {
	$pagesidebar = 'no';
}

if ($blogstyle=='half') {
	if ($pagesidebar=='right' || $pagesidebar=='left') {
		$width=300;
		$height=200;
		$bloglentitle=38;
		$bloglenexcerpt=34;
	} elseif ($pagesidebar=='both') {
		$width=200;
		$height=200;
		$bloglentitle=30;
		$bloglenexcerpt=27;
	} else {
		$width=450;
		$height=300;
		$bloglentitle=60;
		$bloglenexcerpt=100;
	}
} else {
	if ($pagesidebar=='right' || $pagesidebar=='left') {
		$width=870;
		$height=435;
		$bloglentitle=56;
		$bloglenexcerpt=41;
	} elseif ($pagesidebar=='both') {
		$width=570;
		$height=285;
		$bloglentitle=42;
		$bloglenexcerpt=30;
	} else {
		$width=1170;
		$height=585;
		$bloglentitle=88;
		$bloglenexcerpt=64;
	}
}

if ($blogprettyphotoonoff=='true') $postthumbimage = 'full'; else $postthumbimage = 'post';

// get current author
if(isset($_GET['author_name'])) {
	$curauth = get_userdatabylogin($author_name);
} else {
	$curauth = get_userdata(intval($author));
}

?>

<?php if ($pagetitleonoff=='true') { ?>

<!-- Page title
================================================== -->
<div class="h-wrapper">
	<span class="icon <?php /*echo $pageicon;*/ ?>"></span>
	<div class="container_12">
		<h1 class="grid_12 title">
		<?php
		if (is_archive()) {
			if (is_author()) {
				_e('Recent Posts by ', 'my_framework'); echo $curauth->display_name;
			} elseif (is_category()) {
				printf( __('Category Archives: %s', 'my_framework'), '<span>' . single_cat_title( '', false ) . '</span>' );
			} elseif (is_tag()) {
				printf( __('Tag Archives: %s', 'my_framework'), '<span>' . single_tag_title( '', false ) . '</span>' );
			} else {
				if ( is_day() ) {
				printf( __('Daily Archives: <span>%s</span>', 'my_framework'), get_the_date() );
				} elseif ( is_month() ) {
				printf( __('Monthly Archives: <span>%s</span>', 'my_framework'), get_the_date('F Y') );
				} elseif ( is_year() ) {
				printf( __('Yearly Archives: <span>%s</span>', 'my_framework'), get_the_date('Y') );
				} else {
				_e('Archives', 'my_framework');
				}
			}
		} elseif (is_search()) {
			_e('Search For: ', 'my_framework');  the_search_query();
		} else the_title();
		?>
		</h1>
		<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
	</div>
</div>
<?php } ?>

<div class="container_12">

	<!-- Page content
	================================================== -->
	<div class="content <?php if ($pagesidebar == 'right') { echo 'grid_9'; } elseif ($pagesidebar == 'left') { echo 'grid_9 floatright'; } elseif ($pagesidebar == 'both') { echo 'grid_6 bothmiddle';} else { echo 'grid_12'; } ?>">
		
		<?php if (is_author()) { ?>
		
		<!-- Author info
		================================================== -->
		<div class="author-info">
			<div class="authorDescription">
				<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('ID'), $size='75'); } /* Displays the Gravatar based on the author's email address. */ ?>
				<!-- end of .avatar -->
				<h3><?php _e('About: ', 'my_framework'); echo $curauth->display_name; ?></h3>
				<?php if($curauth->description !='') /* Displays the author's description from their Wordpress profile */
				 echo $curauth->description;
				?>
			</div>
		</div><!-- .author-info -->
		<?php } ?>
	
		<ul class="post-item-wrapper">
		
			<?php // set paged
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }
			
			// start loop
			if (have_posts()) : while (have_posts()) : the_post();
			
			// get variables
			/*if ( get_post_type() == 'portfolio' ) {
				$postthumbtype = get_post_meta($post->ID, 'portthumbtype', true);
				$postthumbimage = get_post_meta($post->ID, 'portthumbimage', true);
				$postthumbvideo = get_post_meta($post->ID, 'portthumbvideo', true);
				$postthumbslider = get_post_meta($post->ID, 'portthumbslider', true);
			} else {
				$postthumbtype = get_post_meta($post->ID, 'postthumbtype', true);
				$postthumbimage = get_post_meta($post->ID, 'postthumbimage', true);
				$postthumbvideo = get_post_meta($post->ID, 'postthumbvideo', true);
				$postthumbslider = get_post_meta($post->ID, 'postthumbslider', true);
			}*/
			
			// get variables
			$postthumbtype = get_post_meta($post->ID, 'postthumbtype', true);
			$postthumbvideo = get_post_meta($post->ID, 'postthumbvideo', true);
			$postthumbslider = get_post_meta($post->ID, 'postthumbslider', true);
			?>
			
			<li id="post-<?php the_ID(); ?>" <?php post_class('posts '.($blogstyle=='half' ? 'halfstyle' : 'fullstyle')) ?>>
				
				<?php if (($postthumbtype == 'image' && has_post_thumbnail()) || ($postthumbtype == 'video' && $postthumbvideo) || ($postthumbtype == 'slider' && $postthumbslider)) { ?>
				
				<!-- Featured thumbnail
				================================================== -->
				<div class="featured-thumbnail-wrapper">
					<div class="featured-thumbnail <?php echo $postthumbtype; ?>">
						<?php if ($postthumbtype == 'image') echo create_image ($postthumbimage, '', $width, $height); ?>
						<?php if ($postthumbtype == 'video') echo create_video ($postthumbvideo, $width, $height); ?>
						<?php if ($postthumbtype == 'slider') echo create_slider ($postthumbslider, $width, $height); ?>
					</div>
				</div><!-- .featured-thumbnail-wrapper -->
				<?php } ?>
				
				<?php if ($blogthumbtitleonoff!='false') { ?>
				
				<!-- Title
				================================================== -->
				<h2><a href="<?php the_permalink(); ?>"><?php $title = the_title('','',false); echo substr($title, 0, $bloglentitle); ?></a></h2>
				<?php } ?>
				
				<!-- Date
				================================================== -->
				<div class="date-wrap">
					<span><?php the_time('l j, F, Y'); ?></span>
				</div>
				
				<?php if ($blogthumbexcerptonoff!='false') { ?>
				
				<!-- Excerpt
				================================================== -->
				<div class="excerpt">
					<?php if ($blogcompletecontentonoff!='true') { ?>
					<?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,$bloglenexcerpt);?>
					<?php } else the_content('Continue Reading'); ?>
					<?php wp_link_pages('before=<p class="pagelink">Pages:', 'after=</p>'); ?>
				</div>
				<?php } ?>
				
				<!-- Post info
				================================================== -->
				<div class="post-info-wrapper">
					<div class="post-info">
					
						<?php if ($bloginfoauthoronoff!='false') { ?>
						
						<!-- Author
						================================================== -->
						<span class="post-author">
							<span aria-hidden="true" class="icon-users"></span>
							<?php the_author_posts_link() ?>
						</span>
						<?php } ?>
						
						<?php if ($bloginfotagonoff!='false') { ?>
						
						<!-- Tags
						================================================== -->
						<?php the_tags( '<span class="post-tags"><span aria-hidden="true" class="icon-tags"></span>', ', ', '</span>' ); ?>
						<?php } ?>
						
						<?php if ($bloginfocommentonoff!='false') { ?>
						
						<!-- Comment
						================================================== -->
						<span class="post-comment">
							<span aria-hidden="true" class="icon-bubbles2"></span>
							<?php comments_number(__('No Comments', 'my_framework'), __('1 Comments', 'my_framework'), __('% Comments', 'my_framework')); ?>
						</span>
						<?php } ?>
						
						<?php if ($blogcontinuelinkonoff!='false') { ?>
		
						<!-- Readmore link
						================================================== -->
						<div class="posts-link"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'my_framework'); ?></a></div>
						<?php } ?>
						
					</div>
				</div><!-- .post-info-wrapper -->
				
			</li>
			<?php endwhile; ?>
			
			<?php else: // if no result ?>

			<?php if (is_search()) { ?>
			<div class="no-results">
				<h2><?php _e('No Results', 'my_framework'); ?></h2>
				<p><?php _e('Please feel free try again!', 'my_framework'); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .no-results -->
			<?php }?>

			<?php endif; // end loop ?>
		
		</ul>
		
		<?php // get pagination
		if ($wp_query->max_num_pages > 1) {
			if (function_exists('pagination')) pagination();
		} ?>
		
	</div><!-- .content -->

	<?php get_sidebar('left'); ?>
	<?php get_sidebar('right'); ?>

</div>
<?php get_footer(); ?>