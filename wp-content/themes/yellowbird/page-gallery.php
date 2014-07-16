<?php
/*
 * Template Name: Gallery
 */

get_header();

// set options
$pagesidebar= get_post_meta($post->ID, 'pagesidebar', true);
$pagesidebarright = get_post_meta($post->ID, 'pagesidebarright', true);
$pagesidebarleft = get_post_meta($post->ID, 'pagesidebarleft', true);
$pageicon = get_post_meta($id, 'pageicon', true);
$pagesubtitle = get_post_meta($post->ID, 'pagesubtitle', true);
$pagetitleonoff = get_post_meta($post->ID, 'pagetitleonoff', true);
$pagesubsectiononoff = get_post_meta($post->ID, 'pagesubsectiononoff', true);
$pagesubsectioncontent = get_post_meta($post->ID, 'pagesubsectioncontent', true);
$gallerytype = get_post_meta($post->ID, 'gallerytype', true);
$gallerycat = get_post_meta($post->ID, 'gallerycat', true);
$gallerysize = get_post_meta($post->ID, 'gallerysize', true);
$gallerynav = get_post_meta($post->ID, 'gallerynav', true);

if ($pagesidebar=='right' || $pagesidebar=='left') $class='grid_8'; elseif ($pagesidebar=='both') $class='grid_6'; else $class='grid_12';

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
<div class="content <?php if ($gallerytype=='default') { if ($pagesidebar == 'right') { echo ' gallrightsidebar'; } elseif ($pagesidebar == 'left') { echo ' gallleftsidebar'; } elseif ($pagesidebar == 'both') { echo ' gallbothsidebar';} } ?>">

	<?php  // content
	if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more=0;
		the_content();
	endwhile;
	?>
	
	<?php // gallery type is carousel
	if ($gallerytype=='carousel') {
		
		// start loop
		$wp_query = new WP_Query('post_type=gallery&gallery-category='.$gallerycat.'&paged=-1');
		if ( have_posts() ) while ( have_posts() ) : the_post();
		$gallerythumbs = get_post_meta($post->ID, 'gallerythumbs', true);
		$rand = rand(); ?>
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#gallery-<?php echo $rand; ?>").carouFredSel({
					items: {
						visible: 4,
						minimum: 4
					},
					pagination: "#gallery-pager-<?php echo $rand; ?>",
					prev: {
						button: "#gallery-prev-<?php echo $rand; ?>",
						key: "left"
					},
					next: {
						button: "#gallery-next-<?php echo $rand; ?>",
						key: "right"
					},
					responsive: true,
					scroll: {
						items: 4,
						fx: "scroll",
						duration: 1000
					},
					auto: {
						play: false,
						timeoutDuration: 5000
					},
				});
			});
		</script>
		<div class="gallery-container grid_12 <?php echo $gallerytype; ?>">
			<div class="h-wrapper grid_12">
				<h2><span class="line left"></span><?php the_title(); ?><span class="line right"></span></h2>
			</div>
			<div class="gallery-wrapper">
				<div class="gallery">
					<ul id="gallery-<?php echo $rand; ?>">
						<?php if ($gallerythumbs) {
						$gallerythumbs = explode(',', substr($gallerythumbs, 0, -1));
						foreach ($gallerythumbs as $gallerythumb) {
						$image_full = wp_get_attachment_image_src($gallerythumb, 'full');
						$image_src = wp_get_attachment_image_src($gallerythumb, '220x130'); ?>
						<li class="featured-thumbnail grid_3">
							<a class="image-wrapper" href="<?php echo $image_full[0]; ?>" data-rel="prettyPhoto" title="">
							<img src="<?php echo $image_src[0]; ?>" alt="" /><span class="zoom-icon magnify"></span>
							</a>
						</li>
						<?php } } ?>
					</ul>
				</div>
				<?php if ($gallerynav!='pagination') { ?>
				<div class="gallery-direction">
					<a id="gallery-prev-<?php echo $rand; ?>" class="prev" href="#"></a>
					<a id="gallery-next-<?php echo $rand; ?>" class="next" href="#"></a>
				</div>
				<?php } else { ?>
				<div id="gallery-pager-<?php echo $rand; ?>" class="pager"></div>
				<?php } ?>
			</div>
		</div><!-- .gallery-container -->
		<?php endwhile; // end loop ?>
		
	<?php } ?>
	
	<?php // gallery type is default
	if ($gallerytype=='default') { ?>
		
		<div class="gallery-container">
			<div class="gallery-wrapper">
				<div id="gallery-default" class="gallery">
					<ul>
						
						<?php // start loop
						$wp_query = new WP_Query('post_type=gallery&gallery-category='.$gallerycat.'&paged=-1');
						if ( have_posts() ) while ( have_posts() ) : the_post();
						$gallerythumbs = get_post_meta($post->ID, 'gallerythumbs', true);
						
						// set thumbnail size
						if ($pagesidebar && $pagesidebar!='no') {
							if ($pagesidebar == 'both') {
								if ($gallerysize != '12') {
									$width=460; $height=270;
									$liclass='grid_12 twosidebar'; }
								elseif ($gallerysize == '12') {
									$width=220; $height=130;
									$liclass='grid_6 twosidebar'; }
							}
							else {
								if ($gallerysize == '11') {
									$width=620; $height=360;
									$liclass='grid_12 onesidebar'; }
								elseif ($gallerysize == '12') {
									$width=300; $height=180;
									$liclass='grid_6 onesidebar'; }
								elseif ($gallerysize == '13') {
									$width=193; $height=115;
									$liclass='grid_4 onesidebar'; }
								elseif ($gallerysize == '14') {
									$width=140; $height=80;
									$liclass='grid_3 onesidebar'; }
								}
						} else {
							if ($gallerysize == '11') {
								$width=940; $height=450;
								$liclass='grid_12'; }
							elseif ($gallerysize == '12') { 
								$width=460; $height=270;
								$liclass='grid_6'; }
							elseif ($gallerysize == '13') { 
								$width=300; $height=170;
								$liclass='grid_4'; }
							elseif ($gallerysize == '14') { 
								$width=220; $height=140;
								$liclass='grid_3'; 
							}
						}
						
						if ($gallerythumbs) {
						$gallerythumbs = explode(',', substr($gallerythumbs, 0, -1));
						foreach ($gallerythumbs as $gallerythumb) {
							$image_full = wp_get_attachment_image_src($gallerythumb, 'full');
							$image_src = wp_get_attachment_image_src($gallerythumb, $width.'x'.$height);
						?>
						<li class="featured-thumbnail <?php echo $liclass; ?>">
							<a class="image-wrapper" href="<?php echo $image_full[0]; ?>" data-rel="prettyPhoto" title="">
							<img src="<?php echo $image_src[0]; ?>" alt="" /><span class="zoom-icon magnify"></span>
							</a>
						</li>
						<?php } } ?>
						<?php endwhile; // end loop ?>
						
					</ul>
				</div>
			</div>
		</div><!-- .gallery-container -->
	
	<?php } ?>
	
</div><!-- .content -->

<?php if ($gallerytype=='default') {
get_sidebar('left');
get_sidebar('right');
} ?>
<?php get_footer(); ?>