<?php
/*
 * Template Name: Contact
 */

get_header(); 

// set options
$pagesidebar = get_post_meta($post->ID, 'pagesidebar', true);
$pagesidebarright = get_post_meta($post->ID, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($post->ID, 'pagesidebarleft', true);
/*$pageicon = get_post_meta($post->ID, 'pageicon', true);*/
$pagesubtitle = get_post_meta($post->ID, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($post->ID, 'pagetitleonoff', true);
$pagesubsectiononoff = get_post_meta($post->ID, 'pagesubsectiononoff', true);
$pagesubsectioncontent = get_post_meta($post->ID, 'pagesubsectioncontent', true);
$contactemail = get_post_meta($post->ID, 'contactemail', true);
$contactmessage = get_post_meta($post->ID, 'contactmessage', true);
$contactlabel = get_post_meta($post->ID, 'contactlabel', true);
$contactnamelabel = get_post_meta($post->ID, 'contactnamelabel', true);
$contactnameerror = get_post_meta($post->ID, 'contactnameerror', true);
$contactemaillabel = get_post_meta($post->ID, 'contactemaillabel', true);
$contactemailerror = get_post_meta($post->ID, 'contactemailerror', true);
$contactemailvalidateerror =  get_post_meta($post->ID, 'contactemailvalidateerror', true);
$contactphonelabel = get_post_meta($post->ID, 'contactphonelabel', true);
$contactcommentlabel = get_post_meta($post->ID, 'contactcommentlabel', true);
$contactcommenterror = get_post_meta($post->ID, 'contactcommenterror', true);
$recaptchaonoff = get_post_meta($post->ID, 'recaptchaonoff', true);
$recaptchatheme = get_post_meta($post->ID, 'recaptchatheme', true);
$recaptchalang = get_post_meta($post->ID, 'recaptchalang', true);
$recaptchaerror = get_post_meta($post->ID, 'recaptchaerror', true);
$contactmap = get_post_meta($post->ID, 'contactmap', true);
$contactmapfilteronoff = get_post_meta($post->ID, 'contactmapfilteronoff', true);
$contactmapheight = get_post_meta($post->ID, 'contactmapheight', true);
$contactmaplocation = get_post_meta($post->ID, 'contactmaplocation', true);

?>

<?php // get googlemap when it is on top
if ($contactmap && $contactmaplocation=='top') { ?>

<!-- Googlemap
================================================== -->
<div class="google-map close top<?php if ($contactmapfilteronoff=='true') echo ' grayfilter'; ?>">
	<div class="sign-wrapper"><span class="sign icon-location2"></span></div>
	<div class="map-wrapper">
	<iframe height="<?php echo $contactmapheight; ?>" title="" src="<?php echo $contactmap; ?>"><?php _e('google map', 'my_framework'); ?></iframe>
	</div>
</div>
<?php } ?>
			
<?php if ($pagetitleonoff=='true') { ?>

<!-- Page title
================================================== -->
<div class="h-wrapper">
	<span class="icon <?php echo $pageicon; ?>"></span>
	<div class="container_12">
		<h1 class="grid_12 title"><?php the_title(); ?></h1>
		<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
	</div>
</div>
<?php } ?>

<div class="container_12">

	<!-- Page content
	================================================== -->
	<div class="content <?php if ($pagesidebar == 'right') { echo 'grid_8'; } elseif ($pagesidebar == 'left') { echo 'grid_8 floatright'; } elseif ($pagesidebar == 'both') { echo 'grid_6 bothmiddle';} elseif ($pagesidebar == 'no') { echo '';} ?>">
		
		<div class="grid_6">
		<?php require_once('contactform.php'); ?>
		</div>
		<div class="grid_6">
		<?php // content
		if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more=0;
			the_content();
		endwhile;
		?>
		</div>
		
	</div><!-- .content -->
	
	<?php get_sidebar('left'); ?>
	<?php get_sidebar('right'); ?>

</div>

<?php // get googlemap when it is on top
if ($contactmap && $contactmaplocation!='top') { ?>

<!-- Googlemap
================================================== -->
<div class="google-map close<?php if ($contactmapfilteronoff=='true') echo ' grayfilter'; ?>">
	<div class="sign-wrapper"><span class="sign icon-location2"></span></div>
	<div class="map-wrapper">
	<iframe height="<?php echo $contactmapheight; ?>" title="" src="<?php echo $contactmap; ?>"><?php _e('google map', 'my_framework'); ?></iframe>
	</div>
</div>
<?php } ?>

<?php get_footer(); ?>