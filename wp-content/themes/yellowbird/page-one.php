<?php
/*
 * Template Name: OnePage
 */

get_header();

// get all pages
$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'hierarchical' => 1,
	'exclude' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
);
$pages = get_pages($args);

//start loop
foreach ($pages as $page_data) {
	$content = apply_filters('the_content', $page_data->post_content);
	$template = $page_data->page_template;
	$title = $page_data->post_title;
	$slug = $page_data->post_name;
	$id = $page_data->ID;
	$onhomeonoff = get_post_meta($id, 'onhomeonoff', true);
	$pageimageparallax = get_post_meta($id, 'pageimageparallax', true);
	if ( $pageimageparallax == 'true' ) { $parallax = 'parallax'; } else { $parallax = ''; } 
	
	// check which page set to appear in the singlepage
	if ($onhomeonoff=='true') {
		
		// when template is default
		if ($template=='default') { ?>
		
		<section class="row <?php echo $parallax; ?>" id="<?php echo $slug; ?>">
			<article>
				<?php include(TEMPLATEPATH . '/content.php'); ?>
			</article>
		</section>
		
		<?php // when template is blog
		} if ($template=='page-blog.php') { ?>
		
		<section class="row <?php echo $parallax; ?>" id="<?php echo $slug; ?>">
			<article>
				<?php include_once(TEMPLATEPATH . '/blog.php'); ?>
			</article>
		</section>
		
		<?php // when template is contact
		} if ($template=='page-contact.php') { ?>
		
		<section class="row <?php echo $parallax; ?>" id="<?php echo $slug; ?>">
			<article>
				<?php include_once(TEMPLATEPATH . '/contact.php'); ?>
			</article>
		</section>
		
	<?php }
	}
}
		
get_footer(); ?>