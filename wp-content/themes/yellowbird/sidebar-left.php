<?php // get sidebar to use on the left side
if (get_option('mytheme_sidebardivideronoff')=='true') $sidebarborder=' border'; else $sidebarborder='';
global $pagesidebar, $pagesidebarleft;

if (($pagesidebar == "left") || ($pagesidebar == "both")) { ?>

<aside class="sidebar sidebarleft grid_3 <?php echo $sidebarborder; if ($pagesidebar == "both") { echo 'bothleft'; } ?>">

	<?php dynamic_sidebar( $pagesidebarleft ); ?>

</aside><!-- .sidebarleft -->

<?php } ?>