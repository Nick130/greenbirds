<?php
$slider = main_slider();
$slidercat = $slider[1];
$slider = $slider[0];

if ($slider!='bgstretcher' && $slider!='false') {
?>

<!-- Slider
================================================== -->
<div id="slider-wrapper" <?php echo get_option('mytheme_sliderposition')!='above' ? 'class="mb0"' : ''; ?>>

<?php
if ($slider=='nivo') { 

/*-----------------------------------------------------------------------------------*/
/*	Nivo Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="nivoslider-wrapper">
	<div id="nivoslider" class="nivoSlider">
		<?php
		query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0;
		while ( have_posts() ) : the_post();
		$thumb_width = intval(get_option('mytheme_nivocontrolnavthumbswidth'));
		$thumb_height = intval(get_option('mytheme_nivocontrolnavthumbsheight'));
		if ((!$thumb_width) || $thumb_width == "") $thumb_width = 90;
		if ((!$thumb_height) || $thumb_height == "") $thumb_height = 50;
		$thumb_size = $thumb_width.'x'.$thumb_height;
		
		$linktype = get_post_meta($post->ID, 'sliderlinktype', true);
		if ($linktype == 'no') { $url = '#'; $rel = ''; }
		elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
		elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
		elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
		
		$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x380');
		$slider_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumb_size);
		$i++
		?>
		
		<?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
			<img src="<?php echo $slider_full[0]; ?>" title="<?php echo '#caption'.$i; ?>" data-thumb="<?php echo $slider_thumb[0]; ?>" alt="" />
		<?php if ($linktype != 'no') { ?></a><?php } ?>
		
		<?php endwhile; ?>
	</div>
</div>
<?php
query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0;
while ( have_posts() ) : the_post(); $i++; ?>
<div id="caption<?php echo $i; ?>" class="nivo-html-caption">
    <?php if (get_option('mytheme_nivocaptiononoff')=='true') echo '<h2 class="nivo-title">'.get_the_title().'</h2>'.get_the_content(); ?>
</div>
<?php endwhile; ?>
<?php wp_reset_query();?>

<?php } elseif ($slider=='kwicks') { 

/*-----------------------------------------------------------------------------------*/
/*	Kwicks Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="kwicks-wrapper">
	<ul class="kwicks">
		<?php
		query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=5&slider-category=".$slidercat); $i=0; 
		while ( have_posts() ) : the_post();
		
		$linktype = get_post_meta($post->ID, 'sliderlinktype', true);
		if ($linktype == 'no') { $url = '#'; $rel = ''; }
		elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
		elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
		elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
		
		$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x380');
		$slider_title = get_the_title();
		$slider_content = get_the_content();
		$i++
		?>
		<li id="kwick_<?php echo $i; ?>" style="background-image:url(<?php echo $slider_full[0]; ?>);" class="<?php if ($i==5) echo 'last'; ?>">
			<?php if (get_option('mytheme_kwickscaptiononoff')=='true') { ?>
			<div class="kwicks-caption <?php if (get_option('mytheme_kwickscaptionstepped')=='true') echo 'kwicks'.$i; ?> <?php if ($i==1)echo 'first'; elseif ($i==5)echo 'last'; ?>">
				<div class="inner">
					<h2 class="kwicks-title"><?php echo $slider_title; ?></h2>
					<a href="<?php echo $url; ?>"<?php echo $rel; ?> class="link">Read More &rarr;</a>
					<div class="kwicks-content"><?php echo $slider_content; ?></div>
				</div>
			</div>
			<?php } ?>
		</li>
		<?php endwhile; ?>
	</ul>
</div>
<?php wp_reset_query();?>

<?php } elseif ($slider=='showcase') { 

/*-----------------------------------------------------------------------------------*/
/*	ShowCase Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="showcase-holder">
	<div id="showcase" class="showcase">
		<?php
		query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0; 
		while ( have_posts() ) : the_post();
		
		$linktype = get_post_meta($post->ID, 'sliderlinktype', true);
		if ($linktype == 'no') { $url = '#'; $rel = ''; }
		elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
		elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
		elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
		
		if (get_option('mytheme_showcasethumbalign')=='vertical') {
			$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '800x380');
		} else {
			$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x290');
		}
		$slider_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), '110x56');
		$slider_title = get_the_title();
		$slider_content = get_the_content();
		$i++
		?>
		<div class="showcase-slide">
			<div class="showcase-content">
				<?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
					<img src="<?php echo $slider_full[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
				<?php if ($linktype != 'no') { ?></a><?php } ?>
			</div>
			<div class="showcase-thumbnail">
				<img src="<?php echo $slider_thumb[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
				<div class="showcase-thumbnail-caption"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
			<?php if (get_option('mytheme_showcasecaptiononoff')=='true') { ?>
			<div class="showcase-caption">
				<h2 class="showcase-title"><?php echo $slider_title; ?></h2><?php echo $slider_content; ?>
			</div>
			<?php } ?>
		</div>
		<?php endwhile; ?>
	</div>
</div>
<?php wp_reset_query();?>

<?php } elseif ($slider=='cycle') { 

/*-----------------------------------------------------------------------------------*/
/*	Cycle Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="cycle-wrap">
	<?php if (get_option('mytheme_cycledirectiononoff')=='true') { ?>
    <a id="cycle-next" href="#"></a>
    <a id="cycle-prev" href="#"></a>
    <?php } ?>
    <div class="cycle-wrapper">
        <div id="cycle" class="cycle">
            <?php
            query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0; 
            while ( have_posts() ) : the_post();
        
            $linktype = get_post_meta($post->ID, 'sliderlinktype', true);
            if ($linktype == 'no') { $url = '#'; $rel = ''; }
            elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
            elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
            elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
            
            $slidersecondarypic = get_post_meta($post->ID, 'slidersecondarypic', true);
            $slidersecondarypic = wp_get_attachment_image_src($slidersecondarypic, '940x420');
            $slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x420');
            
            $slider_title = get_the_title();
            $slider_content = get_the_content();
            $i++
            ?>
            <div class="cycle-slide">
                <div class="cycle-content">
                    <?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
                        <img src="<?php echo $slider_full[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
                    <?php if ($linktype != 'no') { ?></a><?php } ?>
                </div>
                <?php if ($slidersecondarypic[0]) { ?>
                <div class="cycle-secondary">
                    <?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
                    <img src="<?php echo $slidersecondarypic[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
                    <?php if ($linktype != 'no') { ?></a><?php } ?>
                </div>
                <?php } ?>
                <?php if (get_option('mytheme_cyclecaptiononoff')=='true') { ?>
                <div class="cycle-caption">
                    <h2 class="cycle-title"><?php echo $slider_title; ?></h2><?php echo $slider_content; ?>
                </div>
                <?php } ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php wp_reset_query();?>

<?php } elseif ($slider=='roundabout') { 

/*-----------------------------------------------------------------------------------*/
/*	Roundabout Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="roundaboutslider">
	<div id="roundabout-loader">
		<div id="roundabout-inner">
			<?php if (get_option('mytheme_roundaboutdirectiononoff')=='true') { ?>
			<a id="roundabout-next" href="#"></a>
			<a id="roundabout-prev" href="#"></a>
			<?php } ?>
			<ul id="roundabout-holder" class="roundabout-holder">
				<?php
				query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat);
				while ( have_posts() ) : the_post();

				$linktype = get_post_meta($post->ID, 'sliderlinktype', true);
				if ($linktype == 'no') { $url = '#'; $rel = ''; }
				elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
				elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
				elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
	
				$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '640x380');
				$slider_title = get_the_title();
				$slider_content = get_the_content();
				?>
				<li class="roundabout-moveable-item">
					<?php if (get_option('mytheme_roundaboutcaptiononoff')=='true') { ?>
					<div class="roundabout-caption">
						<h2 class="roundabout-title"><?php echo $slider_title; ?></h2><?php echo $slider_content; ?>
					</div>
					<?php } ?>
					<?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
						<img src="<?php echo $slider_full[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
					<?php if ($linktype != 'no') { ?></a><?php } ?>
				</li>			
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<?php wp_reset_query();?>

<?php } elseif ($slider=='liteaccordion') { 

/*-----------------------------------------------------------------------------------*/
/*	Liteaccordion Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="liteaccordion">
	<ol>
		<?php
		$the_query = new WP_Query("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0;
		$total = $the_query->found_posts;
		while ( $the_query->have_posts() ) : $the_query->the_post();

		$linktype = get_post_meta($post->ID, 'sliderlinktype', true);
		if ($linktype == 'no') { $url = '#'; $rel = ''; }
		elseif ($linktype == 'image') { $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize'); $url = $url[0]; $rel = ' rel="prettyPhoto[gallery]"'; }
		elseif ($linktype == 'url') { $url = get_post_meta($post->ID, 'sliderlinkurl', true); $rel = ''; }
		elseif ($linktype == 'video') { $url = get_post_meta($post->ID, 'sliderlinkvideo', true); $rel = ' rel="prettyPhoto[gallery]"'; }
				
		$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x380');
		$slider_title = get_the_title();
		$slider_content = get_the_content();
		$i++
		?>
		<li>
			<h2 class="<?php if ($i==1) echo 'first'; elseif ($i==$total) echo 'last'; ?>">
				<span class="slide_name">
					<?php echo $slider_title; ?>
				</span>
				<span class="slide_number">
					<?php if ($i<10) echo '0'.$i; else echo $i ?>
				</span>
			</h2>
			<div>
				<div>
					<?php if ($linktype != 'no') { ?><a href="<?php echo $url; ?>"<?php echo $rel; ?>><?php } ?>
						<img src="<?php echo $slider_full[0]; ?>" alt="<?php echo $slider_title; ?>" title="">
					<?php if ($linktype != 'no') { ?></a><?php } ?>
					<?php if (get_option('mytheme_liteaccordioncaptiononoff')=='true') { ?>
					<div class="liteaccordion-caption">
						<h2 class="liteaccordion-title"><?php echo $slider_title; ?></h2><?php echo $slider_content; ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</li>	
		<?php endwhile; ?>
	</ol>
</div>
<?php wp_reset_query(); ?>

<?php } elseif ($slider=='tm') { 

/*-----------------------------------------------------------------------------------*/
/*	Tm Slider
/*-----------------------------------------------------------------------------------*/

?>
<div id="tmslider-holder">
	<div id="tmslider-wrapper">
		<div class="tmslider <?php if (get_option('mytheme_tmcaptiononbottom')=='true') echo 'bottom'; ?>">
			<ul class="items">
				<?php
				query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat); $i=0; 
				while ( have_posts() ) : the_post();
				$tmwidth = intval (get_option('mytheme_tmwidth'));
				if (get_option('mytheme_tmwidth')) {
				$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), $tmwidth.'x402');
				} elseif (get_option('mytheme_themestyle')=='boxed') {
				$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '940x402');
				} else {
				$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), '1600x402');
				}
				$slider_title = get_the_title();
				$slider_content = get_the_content();
				$slider_caption = 
				'<h2 class=&quot;tm-title&quot;>'.$slider_title.'</h2>'.$slider_content;
				$i++
				?>
				
				<li>
					<img class="<?php echo $i; ?>" src="<?php echo $slider_full[0]; ?>" alt="<?php echo $slider_title; ?>" title="<?php echo $slider_caption; ?>">
				</li>
				
				<?php endwhile; ?>
			</ul>
		</div>
		<?php if (get_option('mytheme_tmdirectiononoff')=='true') { ?>
		<a href="#" class="prev"></a>
		<a href="#" class="next"></a>
		<?php } ?>
	</div>
</div>
<?php wp_reset_query(); ?>

<?php } elseif ($slider=='revolution') { 

/*-----------------------------------------------------------------------------------*/
/*	Revolution Slider
/*-----------------------------------------------------------------------------------*/

if (function_exists('putRevSlider'))
putRevSlider($slidercat);

} ?>

</div><!-- #slider-wrapper -->
<?php } ?>



<?php if ($slider=='bgstretcher') {

/*-----------------------------------------------------------------------------------*/
/*	Bgstretcher Slider
/*-----------------------------------------------------------------------------------*/

query_posts("post_type=slider&post_status=publish&order=ASC&posts_per_page=-1&slider-category=".$slidercat);
$bgstretcher_images = '';
$width = (get_option('mytheme_bgstretcherwidth')=='' ? 1600 : get_option('mytheme_bgstretcherwidth'));
$height = (get_option('mytheme_bgstretcherheight')=='' ? 900 : get_option('mytheme_bgstretcherheight'));

while ( have_posts() ) : the_post();
	$slider_full = wp_get_attachment_image_src(get_post_thumbnail_id(), $width.'x'.$height);
	$bgstretcher_images .= $slider_full[0].',';
endwhile;
wp_reset_query();

return substr($bgstretcher_images,0,-1);

} ?>