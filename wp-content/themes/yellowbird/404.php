<?php get_header(); ?>

<div class="container_12">
	<div class="content grid_12">
		<div id="error404">
			<h1><?php _e('Error 404 Not Found', 'my_framework'); ?></h1>
			<div>
				<?php _e('<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>', 'my_framework'); ?>
				<?php _e('<p>Please try using our search box below to look for information on the internet</p>', 'my_framework'); ?>
				<div class="searchform-wrapper">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div><!-- #error404 -->
	</div><!-- .content-->
</div>
	
<?php get_footer(); ?>
