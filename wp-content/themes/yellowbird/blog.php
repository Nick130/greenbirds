<?php

// get options
$pagesidebar = get_post_meta($id, 'pagesidebar', true);
$pagesidebarright = get_post_meta($id, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($id, 'pagesidebarleft', true);
$pageicon = get_post_meta($id, 'pageicon', true);
$pagesubtitle = get_post_meta($id, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($id, 'pagetitleonoff', true);
$blogcat = get_post_meta($id, 'blogcat', true);
$blognumfetch = get_post_meta($id, 'blognumfetch', true);
$blogthumbtitleonoff = get_post_meta($id, 'blogthumbtitleonoff', true);
$bloglentitle = get_post_meta($id, 'bloglentitle', true);
$blogthumbexcerptonoff = get_post_meta($id, 'blogthumbexcerptonoff', true);
$bloglenexcerpt = get_post_meta($id, 'bloglenexcerpt', true);
$blogstyle = get_post_meta($id, 'blogstyle', true);
$blogcompletecontentonoff = get_post_meta($id, 'blogcompletecontentonoff', true);
$blogprettyphotoonoff = get_post_meta($id, 'blogprettyphotoonoff', true);
$bloginfoauthoronoff = get_post_meta($id, 'bloginfoauthoronoff', true);
$bloginfotagonoff = get_post_meta($id, 'bloginfotagonoff', true);
$bloginfocommentonoff = get_post_meta($id, 'bloginfocommentonoff', true);
$blogcontinuelinkonoff = get_post_meta($id, 'blogcontinuelinkonoff', true);
$blogpaginationonoff = get_post_meta($id, 'blogpaginationonoff', true);
$blogpaginationajax = get_post_meta($id, 'blogpaginationajax', true);

if ($blogstyle=='half') {
	if ($pagesidebar=='right' || $pagesidebar=='left') { $width=300; $height=200; if ($bloglentitle=='') $bloglentitle=38; if ($bloglenexcerpt=='') $bloglenexcerpt=34; }
	elseif ($pagesidebar=='both') { $width=200; $height=200; if ($bloglentitle=='') $bloglentitle=30; if ($bloglenexcerpt=='') $bloglenexcerpt=27; }
	else { $width=450; $height=300; if ($bloglentitle=='') $bloglentitle=60; if ($bloglenexcerpt=='') $bloglenexcerpt=100; }
} else {
	if ($pagesidebar=='right' || $pagesidebar=='left') { $width=620; $height=310; if ($bloglentitle=='') $bloglentitle=56; if ($bloglenexcerpt=='') $bloglenexcerpt=41; }
	elseif ($pagesidebar=='both') { $width=460; $height=230; if ($bloglentitle=='') $bloglentitle=42; if ($bloglenexcerpt=='') $bloglenexcerpt=30; }
	else { $width=940; $height=470; if ($bloglentitle=='') $bloglentitle=88; if ($bloglenexcerpt=='') $bloglenexcerpt=64; }
}

if ($blogprettyphotoonoff=='true') $postthumbimage = 'full'; else $postthumbimage = 'post';

?>
	
<?php if ($pagetitleonoff=='true') { ?>

<!-- Page title
================================================== -->
<div class="h-wrapper">
	<span class="icon <?php echo $pageicon; ?>"></span>
	<span class="line"></span>
	<div class="container_12">
		<h2 class="grid_12 title"><?php echo $title; ?></h2>
		<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
	</div>
</div>
<?php } ?>

<div class="container_12">

	<!-- Page content
	================================================== -->
	<div class="content pb0 <?php if ($pagesidebar == 'right') { echo 'grid_9'; } elseif ($pagesidebar == 'left') { echo 'grid_9 floatright'; } elseif ($pagesidebar == 'both') { echo 'grid_6 bothmiddle';} else { echo 'grid_12'; } ?>">
		
		<input id="blog-info" type="hidden" data-pagesidebar="<?php echo $pagesidebar; ?>" data-blogcat="<?php echo $blogcat; ?>" data-blognumfetch="<?php echo $blognumfetch; ?>" data-blogthumbtitleonoff="<?php echo $blogthumbtitleonoff; ?>" data-bloglentitle="<?php echo $bloglentitle; ?>" data-blogthumbexcerptonoff="<?php echo $blogthumbexcerptonoff; ?>" data-bloglenexcerpt="<?php echo $bloglenexcerpt; ?>" data-blogstyle="<?php echo $blogstyle; ?>" data-blogcompletecontentonoff="<?php echo $blogcompletecontentonoff; ?>" data-blogprettyphotoonoff="<?php echo $blogprettyphotoonoff; ?>" data-bloginfoauthoronoff="<?php echo $bloginfoauthoronoff; ?>" data-bloginfotagonoff="<?php echo $bloginfotagonoff; ?>" data-bloginfocommentonoff="<?php echo $bloginfocommentonoff; ?>" data-blogcontinuelinkonoff="<?php echo $blogcontinuelinkonoff; ?>" value="" />
		<div id="ajax-blog-wrapper">
			<ul class="post-item-wrapper">
				
				<?php // set paged
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }
				
				// start loop
				$wp_query = new WP_Query('post_type=post&category_name='.$blogcat.'&posts_per_page='.$blognumfetch.'&paged='.$paged );
				while ($wp_query->have_posts()) :$wp_query->the_post();
				
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
				<?php endwhile; // end loop ?>
			
			</ul>
			
			<?php // get pagination
			if (($wp_query->max_num_pages > 1) && ($blogpaginationonoff!='false')) {
				if ($blogpaginationajax!='true') {
					if (function_exists('pagination')) pagination();
				} else {
					if (function_exists('pagination_ajax')) pagination_ajax();
				}
			} ?>
		
		</div><!-- #ajax-blog -->
	</div><!-- .content -->

	<?php // get sidebars
	if (get_option('mytheme_sidebardivideronoff')=='true') $sidebarborder=' border'; else $sidebarborder=''; ?>
	
	<?php if (($pagesidebar == "left") || ($pagesidebar == "both")) { ?>
	<aside class="sidebar sidebarleft grid_3 <?php echo $sidebarborder; if ($pagesidebar == "both") { echo 'bothleft'; } ?>">
	
		<?php dynamic_sidebar( $pagesidebarleft ); ?>
	
	</aside><!-- .sidebarleft -->
	<?php } ?>
	
	<?php if (($pagesidebar == "right") || ($pagesidebar == "both")) { ?>	
	<aside class="sidebar sidebarright grid_3 <?php echo $sidebarborder; if ($pagesidebar == "both") { echo 'bothright'; } ?>">
	
		<?php dynamic_sidebar( $pagesidebarright ); ?>
	
	</aside><!-- .sidebarright -->
	<?php } ?>

</div>