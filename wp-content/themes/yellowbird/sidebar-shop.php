<?php // get sidebars to use on the shop page
if (get_option('mytheme_sidebardivideronoff')=='true') $sidebarborder=' border'; else $sidebarborder='';
$pagesidebar = get_post_meta(woocommerce_get_page_id('shop'), 'pagesidebar', true);
$pagesidebarright = get_post_meta(woocommerce_get_page_id('shop'), 'pagesidebarright', true);
$pagesidebarleft = get_post_meta(woocommerce_get_page_id('shop'), 'pagesidebarleft', true);
?>

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