<?php
		
$currenturl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if (!empty($_SERVER['HTTPS'])){
	$currenturl = "https://" . $currenturl;
}else{
	$currenturl = "http://" . $currenturl;
}

?>

<?php if (get_option('mytheme_facebookshare')!='false') { ?>
	<div class="social-share facebook">
		<a class="icon-social" href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank" title="facebook" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_twittershare')!='false') { ?>
	<div class="social-share twitter">
		<a class="icon-social" href="http://twitter.com/home?status=<?php echo str_replace(' ','%20',get_the_title()); ?>%20-%20<?php echo $currenturl; ?>" target="_blank" title="twitter" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_googleshare')!='false') { ?>
	<div class="social-share google">
		<a class="icon-social" href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="google" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_stumbleuponshare')!='false') { ?>
	<div class="social-share stumbleupon">
		<a class="icon-social" href="http://www.stumbleupon.com/submit?url=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="stumble" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_myspaceshare')!='false') { ?>
	<div class="social-share myspace">
		<a class="icon-social" href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $currenturl; ?>" target="_blank" title="my space" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_deliciousshare')!='false') { ?>
	<div class="social-share delicious">
		<a class="icon-social" href="http://delicious.com/post?url=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="delicious" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_diggshare')!='false') { ?>
	<div class="social-share digg">
		<a class="icon-social" href="http://digg.com/submit?url=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="digg" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_redditshare')!='false') { ?>
	<div class="social-share reddit">
		<a class="icon-social" href="http://reddit.com/submit?url=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="reddit" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>
<?php if (get_option('mytheme_linkedinshare')!='false') { ?>
	<div class="social-share linkedin">
		<a class="icon-social" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $currenturl; ?>&amp;title=<?php echo str_replace(' ','%20',get_the_title()); ?>" target="_blank" title="linkedin" data-rel="tipsy">
			<span></span>
		</a>
	</div>
<?php } ?>