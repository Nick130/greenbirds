<?php // get sidebar to use on the right side
if (get_option('mytheme_sidebardivideronoff')=='true') $sidebarborder=' border'; else $sidebarborder='';
global $pagesidebar, $pagesidebarright;

if (($pagesidebar == "right") || ($pagesidebar == "both")) { ?>
	
<aside class="sidebar sidebarright grid_3 <?php echo $sidebarborder; if ($pagesidebar == "both") { echo 'bothright'; } ?>">

	<?php dynamic_sidebar( $pagesidebarright ); ?>

</aside><!-- .sidebarright -->

<?php } ?>