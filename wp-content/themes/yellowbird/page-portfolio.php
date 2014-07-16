<?php
/**
 * Template Name: Portfolio
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
$portsize = get_post_meta($post->ID, 'portsize', true);
$portcat = get_post_meta($post->ID, 'portcat', true);
$portsinglemode = get_post_meta($post->ID, 'portsinglemode', true);
$portfilteronoff = get_post_meta($post->ID, 'portfilteronoff', true);
$portnumfetch = get_post_meta($post->ID, 'portnumfetch', true);
$portlentitle = get_post_meta($post->ID, 'portlentitle', true);
$portlenexcerpt = get_post_meta($post->ID, 'portlenexcerpt', true);
$portalign = get_post_meta($post->ID, 'portalign', true);
$portthumbcategoryonoff = get_post_meta($post->ID, 'portthumbcategoryonoff', true);
$portpaginationonoff = get_post_meta($post->ID, 'portpaginationonoff', true);

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
<div class="content portfolio-full<?php if ($pagesidebar == 'right') { echo ' portrightsidebar'; } elseif ($pagesidebar == 'left') { echo ' portleftsidebar'; } elseif ($pagesidebar == 'both') { echo ' portbothsidebar';} ?>">
	
	<?php $wp_query = new WP_Query('post_type=portfolio&portfolio-category='.$portcat.'&posts_per_page='.$portnumfetch.'&paged='.$paged );?>
	<div class="ports">
	
		<?php if ($portfilteronoff=='true') { ?>

		<!-- Portfolio category filter
		================================================== -->
		<div id="load-portfolio">
			<ul class="portfolio-filter" data-key="filter">
				<li><a href="#filter" data-value="*">all</a></li>
				<?php $categories = custom_type_category( 'portfolio-category', $category_val = null );
					if ( is_array( $categories ) ) {
						foreach( $categories as $category ) {
							$category_slug = str_replace( ' ', '_', $category );
							echo '<li><a href="#filter" data-value="' . $category_slug . '">' . $category . '</a></li>';
						}
					}
				?>
			</ul>
		</div>
		<?php } ?>
		
		<ul class="portfolio-item-wrapper">
			
			<?php // start loop
			if ( have_posts() ) while ( have_posts() ) : the_post();
			
			$portwebsite = get_post_meta($post->ID, 'portwebsite', true);
			$portthumbtype = get_post_meta($post->ID, 'portthumbtype', true);
			$portthumbimage = get_post_meta($post->ID, 'portthumbimage', true);
			$portthumbvideo = get_post_meta($post->ID, 'portthumbvideo', true);
			$portthumbslider = get_post_meta($post->ID, 'portthumbslider', true);
			$portthumbimageurl = get_post_meta($post->ID, 'portthumbimageurl', true);
			
			if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); }
			if ($portthumbimage == 'post') { $href=get_permalink(); $icon='none'; $rel=''; }
			if ($portthumbimage == 'url') { $href=$portthumbimageurl; $icon='link'; $rel=''; }
			if ($portthumbimage == 'full') { $href=$large_image_url[0]; $icon='magnify'; $rel='prettyPhoto'; }
			if ($portthumbimage == 'picture') { $href=$portthumbimageurl; $icon='picture'; $rel='prettyPhoto'; }
			if ($portthumbimage == 'video') { $href=$portthumbimageurl; $icon='video'; $rel='prettyPhoto'; }
			
			if ($pagesidebar && $pagesidebar!='no') {
				if ($pagesidebar == 'both') {
					if ($portsize != '12') {
						$width=570; $height=370;
						if ($portlentitle=='') $portlentitle=30;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_12 twosidebar'; }
					elseif ($portsize == '12') {
						$width=270; $height=175;
						if ($portlentitle=='') $portlentitle=30;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_6 twosidebar'; }
				}
				else {
					if ($portsize == '11') {
						$width=620; $height=414;
						if ($portlentitle=='') $portlentitle=30;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_12 onesidebar'; }
					elseif ($portsize == '12') {
						$width=300; $height=200;
						if ($portlentitle=='') $portlentitle=30;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_6 onesidebar'; }
					elseif ($portsize == '13') {
						$width=193; $height=128;
						if ($portlentitle=='') $portlentitle=24;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_4 onesidebar'; }
					elseif ($portsize == '14') {
						$width=140; $height=93;
						if ($portlentitle=='') $portlentitle=18;
						if ($portlenexcerpt=='') $portlenexcerpt=0;
						$liclass='grid_3 onesidebar'; }
					}
			} else {
				if ($portsize == '11') {
					$width=1170; $height=760;
					if ($portlentitle=='') $portlentitle=30;
					if ($portlenexcerpt=='') $portlenexcerpt=0;
					$liclass='grid_12'; }
				elseif ($portsize == '12') { 
					$width=570; $height=370;
					if ($portlentitle=='') $portlentitle=30; 
					if ($portlenexcerpt=='') $portlenexcerpt=0; 
					$liclass='grid_6'; }
				elseif ($portsize == '13') { 
					$width=370; $height=240;
					if ($portlentitle=='') $portlentitle=30; 
					if ($portlenexcerpt=='') $portlenexcerpt=0; 
					$liclass='grid_4'; }
				elseif ($portsize == '14') { 
					$width=270; $height=175;
					if ($portlentitle=='') $portlentitle=30; 
					if ($portlenexcerpt=='') $portlenexcerpt=0; 
					$liclass='grid_3'; 
				}
			}	
			?>
			
			<li data-id="id-<?php echo $post->ID; ?>" class="portfolio-item <?php echo $liclass; echo get_category_filter('portfolio-category'); ?>">
			
				<?php if (($portthumbtype == 'image' && has_post_thumbnail()) || ($portthumbtype == 'video' && $portthumbvideo) || ($portthumbtype == 'slider' && $portthumbslider)) { ?>
				
				<!-- Featured thumbnail
				================================================== -->
				<div class="featured-thumbnail-wrapper">
					<div class="featured-thumbnail <?php echo $portthumbtype; ?>">
						<?php if ($portthumbtype == 'image') echo create_image ($portthumbimage, $portthumbimageurl, $width, $height);
						if ($portthumbtype == 'video') echo create_video ($portthumbvideo, $width, $height);
						if ($portthumbtype == 'slider') echo create_slider ($portthumbslider, $width, $height); ?>
					</div>
				</div><!-- .featured-thumbnail-wrapper -->
				<?php } ?>
				
				<!-- Details
				================================================== -->
				<div class="portfolio-item-context <?php echo $portalign; ?>">
					
					<?php if ($portlentitle!=0) { ?>
					<h2 class="portfolio-item-title">
						<a href="<?php the_permalink(); ?>" <?php if ($portsinglemode=='lightbox') echo 'class="lightbox-port"'; elseif ($portsinglemode=='inline') echo 'class="inline-port"'; elseif ($portsinglemode=='outline') echo 'class="outline-port"'; echo 'data-id="'.get_the_ID().'"' ?> title="">
							<?php $title = get_the_title(); echo substr($title, 0, $portlentitle); ?>
						</a>
					</h2>
					<?php } ?>

					<div class="portfolio-item-icon-wrapper"><span class="icon"><span class="icon-picture <?php echo $icon; ?>"></span></span></div>
									
					<div class="portfolio-item-content-wrapper">
						<?php if ($portthumbcategoryonoff=='true') { ?>
						<div class="portfolio-item-category">
							<?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' ); ?>
						</div>
						<?php } ?>
						
						<?php if ($portlenexcerpt!=0) { ?>
						<div class="portfolio-item-content">
							<?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt, $portlenexcerpt);?>
						</div>
						<?php } ?>
					</div><!-- .portfolio-item-content-wrapper -->
					
				</div><!-- .portfolio-item-context -->
				
			</li>
			<?php endwhile; // end loop ?>
			
		</ul>
	</div><!-- #ports -->

	<div class="<?php echo $class; ?>">
	<?php // get pagination
	if (($wp_query->max_num_pages > 1) && ($portpaginationonoff=='true')) {
		if (function_exists('pagination')) pagination();
	} ?>
	</div>
	
</div><!-- .content -->

<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>