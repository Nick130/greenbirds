<?php
/*
 * Template Name: Site map
 */

get_header();

// set options
$pageicon = get_post_meta($id, 'pageicon', true);
$pagesubtitle = get_post_meta($post->ID, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($post->ID, 'pagetitleonoff', true);
$pagesubsectiononoff = get_post_meta($post->ID, 'pagesubsectiononoff', true);
$pagesubsectioncontent = get_post_meta($post->ID, 'pagesubsectioncontent', true);

?>
			
<?php if ($pagetitleonoff=='true') { ?>

<!-- Page title
================================================== -->
<div class="h-wrapper">
	<span class="icon <?php echo $pageicon; ?>"></span>
	<span class="line"></span>
	<div class="container_12">
		<h1 class="grid_12 title"><?php the_title(); ?></h1>
		<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
	</div>
</div>
<?php } ?>

<!-- Page content
================================================== -->
<div class="sidebar">
	
	<?php the_content(); ?>
	       
	<div class="grid_4">
		<?php dynamic_sidebar('sitemap-1'); ?>
	</div>
	<div class="grid_4">
		<?php dynamic_sidebar('sitemap-2'); ?>
	</div>
	<div class="grid_4">
		<?php dynamic_sidebar('sitemap-3'); ?>
	</div>
	
</div><!-- .sidebar -->
		
<?php get_footer(); ?>