<?php

// set options
$pagesidebar = get_post_meta($id, 'pagesidebar', true);
$pagesidebarright = get_post_meta($id, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($id, 'pagesidebarleft', true);
$pageicon = get_post_meta($id, 'pageicon', true);
$pagesubtitle = get_post_meta($id, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($id, 'pagetitleonoff', true);
$pagesubsectiononoff = get_post_meta($id, 'pagesubsectiononoff', true);
$pagesubsectioncontent = get_post_meta($id, 'pagesubsectioncontent', true);
$contactemail = get_post_meta($id, 'contactemail', true);
$contactmessage = get_post_meta($id, 'contactmessage', true);
$contactlabel = get_post_meta($id, 'contactlabel', true);
$contactnamelabel = get_post_meta($id, 'contactnamelabel', true);
$contactnameerror = get_post_meta($id, 'contactnameerror', true);
$contactemaillabel = get_post_meta($id, 'contactemaillabel', true);
$contactemailerror = get_post_meta($id, 'contactemailerror', true);
$contactemailvalidateerror =  get_post_meta($id, 'contactemailvalidateerror', true);
$contactphonelabel = get_post_meta($id, 'contactphonelabel', true);
$contactcommentlabel = get_post_meta($id, 'contactcommentlabel', true);
$contactcommenterror = get_post_meta($id, 'contactcommenterror', true);
$recaptchaonoff = get_post_meta($id, 'recaptchaonoff', true);
$recaptchatheme = get_post_meta($id, 'recaptchatheme', true);
$recaptchalang = get_post_meta($id, 'recaptchalang', true);
$recaptchaerror = get_post_meta($id, 'recaptchaerror', true);
$contactmap = get_post_meta($id, 'contactmap', true);
$contactmapfilteronoff = get_post_meta($id, 'contactmapfilteronoff', true);
$contactmapheight = get_post_meta($id, 'contactmapheight', true);
$contactmaplocation = get_post_meta($id, 'contactmaplocation', true);

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
		<h2 class="title"><?php echo $title; ?></h2>
		<div class="sub-title grid_12"><?php echo $pagesubtitle; ?></div>
	</div>
</div>
<?php } ?>

<div class="container_12">

	<!-- Page content
	================================================== -->
	<div class="content <?php if ($pagesidebar == 'right') { echo 'grid_9'; } elseif ($pagesidebar == 'left') { echo 'grid_9 fright'; } elseif ($pagesidebar == 'both') { echo 'grid_6 bothmiddle';} elseif ($pagesidebar == 'no') { /*echo 'grid_12';*/ } ?>">
		
		<div class="grid_6">
		<?php require_once('contactform.php'); ?>
		</div>
		<div class="grid_6">
		<?php echo $content; ?>
		</div>
		
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