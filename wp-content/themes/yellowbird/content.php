<?php

// set options
$pagelength = get_post_meta($id, 'pagelength', true);
$pagesidebar= get_post_meta($id, 'pagesidebar', true);
$pagesidebarright = get_post_meta($id, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($id, 'pagesidebarleft', true);
$pageicon = get_post_meta($id, 'pageicon', true);
$pagesubtitle = get_post_meta($id, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($id, 'pagetitleonoff', true);

if ($pagetitleonoff=='true') { ?>

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

<!-- Page content
================================================== -->
<div class="content pb0 <?php if ($pagelength=='normal') { 
	if ($pagesidebar=='right') echo 'container_8 floatleft';
	elseif ($pagesidebar=='left') echo 'container_8 floatright';
	elseif ($pagesidebar=='both') echo 'container_6 bothmiddle';
	} elseif (!$pagelength) echo ' grid_12'; ?>">
	
	<?php echo $content; ?>

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