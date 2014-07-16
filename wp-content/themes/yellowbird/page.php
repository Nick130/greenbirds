<?php
 
get_header();

// set options
$pagecommentonoff = (get_option('mytheme_pagecommentonoff'));
$pagelength = get_post_meta($post->ID, 'pagelength', true);
$pagesidebar= get_post_meta($post->ID, 'pagesidebar', true);
$pagesidebarright = get_post_meta($post->ID, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($post->ID, 'pagesidebarleft', true);
$pageicon = get_post_meta($post->ID, 'pageicon', true);
$pagesubtitle = get_post_meta($post->ID, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($post->ID, 'pagetitleonoff', true);

?>
			
	<?php if ($pagetitleonoff=='true') { ?>
	<?php if ($pagelength=='fullsize') echo ''; ?>

	<!-- Page title
	================================================== -->
	<div class="h-wrapper">
		<span class="icon <?php echo $pageicon; ?>"></span>
		<div class="container_12">
			<h1 class="grid_12 title"><?php the_title(); ?></h1>
			<?php if ( $pagesubtitle != '' ) { ?>
			<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
			<?php } ?>
		</div>
	</div>
	<?php if ($pagelength=='fullsize') echo '</div>'; ?>
	<?php } ?>
	
	<?php if ($pagesidebar!='no') { ?>
	<div class="container_12">
	<?php } ?>
	
		<!-- Page content
		================================================== -->
		<div class="content<?php if ($pagelength=='normal') { 
			if ($pagesidebar=='right') echo ' container_9 floatleft';
			elseif ($pagesidebar=='left') echo ' container_9 floatright';
			elseif ($pagesidebar=='both') echo ' container_6 bothmiddle';
			} elseif (!$pagelength) echo ' grid_12'; ?>">
			
			<?php // content
			if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more=0;
				the_content('Continue Reading');
			endwhile;
			?>
			
		</div><!-- .content -->
		
		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	
	<?php if ($pagesidebar!='no') { ?>
	</div>
	<?php } ?>
		
	<?php if ($pagecommentonoff!='false') { ?>

	<!-- Page comment
	================================================== -->
	<div class="container_12">
		<div class="grid_12 page-comment">
			<?php comments_template( '', true ); ?>
		</div>
	</div>
	<?php } ?>

<?php get_footer(); ?>