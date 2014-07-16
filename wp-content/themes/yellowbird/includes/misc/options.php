<?php 
// create dynamically css if server did not allow to create static css page
global $cssstatic;
if ($cssstatic!='true') {
	header("Content-type: text/css; charset: UTF-8");
	
	$current_url = dirname(__FILE__);
	$wp_content_pos = strpos($current_url, 'wp-content');
	$wp_content = substr($current_url, 0, $wp_content_pos);
	
	require_once($wp_content . 'wp-load.php');
}

// start custom style
if (get_option('mytheme_allstyleonoff')=='true') { /* styling on/off */ ?>
@charset "utf-8";

::selection {
	color:<?php echo get_option('mytheme_highlightcolor') ?>;
	background-color:<?php echo get_option('mytheme_highlightbgcolor') ?>;
}
::-moz-selection {
	color:<?php echo get_option('mytheme_highlightcolor') ?>;
	background-color:<?php echo get_option('mytheme_highlightbgcolor') ?>;
}
a {
	color:<?php echo get_option('mytheme_bodylinkcolor') ?>;
}
a:hover {
	color:<?php echo get_option('mytheme_bodylinkhovercolor') ?>;
}

h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	font-family:<?php $fonth = explode('|', get_option('mytheme_fonth')); if (isset($fonth[1]) && $fonth[1] == 'googlefont') echo $fonth[0]; ?>;
	color:<?php echo get_option('mytheme_bodyhcolor') ?>;
<?php if (get_option('mytheme_bodyhshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_bodyhshadowcolor'); ?>;
<?php } ?>
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
	color:<?php echo get_option('mytheme_bodyhhovercolor') ?>;
<?php if (!get_option('mytheme_bodyhhovercolor')) { ?>
	color:<?php echo get_option('mytheme_bodylinkhovercolor') ?>;
<?php } ?>
}
h1 {
	font-size:<?php echo get_option('mytheme_fontsizeh1'); ?>;
}
h2 {
	font-size:<?php echo get_option('mytheme_fontsizeh2'); ?>;
}
h3 {
	font-size:<?php echo get_option('mytheme_fontsizeh3'); ?>;
}
h4 {
	font-size:<?php echo get_option('mytheme_fontsizeh4'); ?>;
}
h5 {
	font-size:<?php echo get_option('mytheme_fontsizeh5'); ?>;
}
h6 {
	font-size:<?php echo get_option('mytheme_fontsizeh6'); ?>;
}

.h-wrapper h1,
.h-wrapper h2,
.h-wrapper h3,
.h-wrapper h4,
.h-wrapper h5,
.h-wrapper h6 {
	background-color:<?php echo get_option('mytheme_contentwrappercolor'); ?>;
}
.h-wrapper .line {
	background-color:<?php echo get_option('mytheme_bodyhlinecolor'); ?>;
}

.normal-button,
.normal-button.small,
.normal-button.larg,
.normal-button.xlarg,
input[type='submit'] {
	color:<?php echo get_option('mytheme_themebuttontextcolor') ?>;
	background-color:<?php echo get_option('mytheme_themebuttonbgcolor') ?>;
}
.normal-button:hover,
.normal-button.small:hover,
.normal-button.larg:hover,
.normal-button.xlarg:hover,
input[type='submit']:hover {
	color:<?php echo get_option('mytheme_themebuttontexthovercolor') ?>;
	background-color:<?php echo get_option('mytheme_themebuttonbghovercolor') ?>;
}


body {
<?php if (get_option('mytheme_bodypattern')!='' && get_option('mytheme_bodypattern')!='nopattern') { ?>
	background-image:url(<?php echo get_template_directory_uri(); ?>/images/pattern/<?php echo get_option('mytheme_bodypattern') ?>.png);
<?php } ?>
	background-attachment:<?php echo get_option('mytheme_bodypatternfix'); ?>;
<?php if (get_option('mytheme_fontbody')) { ?>
	font-family:<?php $fontbody = explode('|', get_option('mytheme_fontbody')); if (isset($fontbody[1]) && $fontbody[1] == 'googlefont') echo $fontbody[0]; ?>;
<?php } ?>
	color:<?php echo get_option('mytheme_bodytextcolor') ?>;
<?php if (get_option('mytheme_bodytextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_bodytextshadowcolor') ?>;
<?php } ?>
	background-color:<?php echo get_option('mytheme_bodybgcolor') ?>;
	font-size:<?php echo get_option('mytheme_bodyfontsize') ?>;
}
.body-background {
<?php if (get_option('mytheme_bodyimageonoff')=='true') { ?>
	background-image:url(<?php $bodybg = wp_get_attachment_image_src(get_option('mytheme_bodyimage'), 'full'); echo $bodybg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_bodyimagerepeat'); ?>;
	background-position:<?php echo get_option('mytheme_bodyimageleft'); ?> <?php echo get_option('mytheme_bodyimagetop'); ?>;
	background-attachment:<?php echo get_option('mytheme_bodyimagefix'); ?>;
<?php } ?>
}
.body-wrapper {
	margin-top:<?php echo get_option('mytheme_bodywraptopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_bodywrapbottommargin'); ?>;
<?php if (get_option('mytheme_bodywrapshadowonoff')=='false') { ?>
	box-shadow:none;
	-moz-box-shadow:none;
	-webkit-box-shadow:none;
<?php } ?>
}
#header {
	background-color:<?php echo get_option('mytheme_headerwrappercolor'); ?>;
}
#header-up {
	height:<?php echo get_option('mytheme_topheaderheight'); ?>;
}
#main {
	background-color:<?php echo get_option('mytheme_contentwrappercolor'); ?>;
}
#footer-wrapper {
	background-color:<?php echo get_option('mytheme_footerwrappercolor'); ?>;
}
#sub-main {
	margin-top:<?php echo get_option('mytheme_maintopmargin'); ?> !important;
	margin-bottom:<?php echo get_option('mytheme_mainbottommargin'); ?> !important;
	padding-top:<?php echo get_option('mytheme_maintoppadding'); ?> !important;
	padding-bottom:<?php echo get_option('mytheme_mainbottompadding'); ?> !important;
}


#topbar-wrapper {
<?php if (get_option('mytheme_topnavwrapperbgonoff')=='true') { ?>
	background-image:url(<?php $topnavwrapperbg = wp_get_attachment_image_src(get_option('mytheme_topnavwrapperbg'), 'full'); echo $topnavwrapperbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_topnavwrapperbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_topnavwrapperbgleft'); ?> <?php echo get_option('mytheme_topnavwrapperbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_topnavwrapperbgfix'); ?>;
<?php } ?>
}
#header {
<?php if (get_option('mytheme_headerbgonoff')=='true') { ?>
	background-image:url(<?php $headerbg = wp_get_attachment_image_src(get_option('mytheme_headerbg'), 'full'); echo $headerbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_headerbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_headerbgleft'); ?> <?php echo get_option('mytheme_headerbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_headerbgfix'); ?>;
<?php } ?>
}
#menu-wrap {
<?php if (get_option('mytheme_mainnavwrapperbgonoff')=='true') { ?>
	background-image:url(<?php $mainnavwrapperbg = wp_get_attachment_image_src(get_option('mytheme_mainnavwrapperbg'), 'full'); echo $mainnavwrapperbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_mainnavwrapperbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_mainnavwrapperbgleft'); ?> <?php echo get_option('mytheme_mainnavwrapperbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_mainnavwrapperbgfix'); ?>;
<?php } ?>
	background-color:<?php echo get_option('mytheme_mainnavwrapbgcolor'); ?>;
}
#slider-wrapper {
<?php if (get_option('mytheme_sliderwrapperbgonoff')=='true') { ?>
	background-image:url(<?php $sliderwrapperbg = wp_get_attachment_image_src(get_option('mytheme_sliderwrapperbg'), 'full'); echo $sliderwrapperbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_sliderwrapperbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_sliderwrapperbgleft'); ?> <?php echo get_option('mytheme_sliderwrapperbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_sliderwrapperbgfix'); ?>;
<?php } ?>
	padding-top:<?php echo get_option('mytheme_slidertoppadding'); ?>;
	padding-bottom:<?php echo get_option('mytheme_sliderbottompadding'); ?>;
	background-color:<?php echo get_option('mytheme_sliderbgcolor'); ?>;
}
#slogan-wrapper {
<?php if (get_option('mytheme_sloganwrapperbgonoff')=='true') { ?>
	background-image:url(<?php $sloganwrapperbg = wp_get_attachment_image_src(get_option('mytheme_sloganwrapperbg'), 'full'); echo $sloganwrapperbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_sloganwrapperbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_sloganwrapperbgleft'); ?> <?php echo get_option('mytheme_sloganwrapperbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_sloganwrapperbgfix'); ?>;
<?php } ?>
}
#main {
<?php if (get_option('mytheme_mainbgonoff')=='true') { ?>
	background-image:url(<?php $mainbg = wp_get_attachment_image_src(get_option('mytheme_mainbg'), 'full'); echo $mainbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_mainbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_mainbgleft'); ?> <?php echo get_option('mytheme_mainbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_mainbgfix'); ?>;
<?php } ?>
}
.content {
<?php if (get_option('mytheme_contentbgonoff')=='true') { ?>
	background-image:url(<?php $contentbg = wp_get_attachment_image_src(get_option('mytheme_contentbg'), 'full'); echo $contentbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_contentbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_contentbgleft'); ?> <?php echo get_option('mytheme_contentbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_contentbgfix'); ?>;
<?php } ?>
}
.sidebar {
<?php if (get_option('mytheme_sidebarbgonoff')=='true') { ?>
	background-image:url(<?php $sidebarbg = wp_get_attachment_image_src(get_option('mytheme_sidebarbg'), 'full'); echo $sidebarbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_sidebarbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_sidebarbgleft'); ?> <?php echo get_option('mytheme_sidebarbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_sidebarbgfix'); ?>;
<?php } ?>
}
#footer-wrapper {
<?php if (get_option('mytheme_footerwrapperbgonoff')=='true') { ?>
	background-image:url(<?php $footerwrapperbg = wp_get_attachment_image_src(get_option('mytheme_footerwrapperbg'), 'full'); echo $footerwrapperbg[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_footerwrapperbgrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_footerwrapperbgleft'); ?> <?php echo get_option('mytheme_footerwrapperbgtop'); ?>;
	background-attachment:<?php echo get_option('mytheme_footerwrapperbgfix'); ?>;
<?php } ?>
}
#footer-wrapper .footer-top-wrapper {
<?php if (get_option('mytheme_footerwidgetwrapperonoff')=='true') { ?>
	background-image:url(<?php $footerwidgetwrapper = wp_get_attachment_image_src(get_option('mytheme_footerwidgetwrapper'), 'full'); echo $footerwidgetwrapper[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_footerwidgetwrapperrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_footerwidgetwrapperleft'); ?> <?php echo get_option('mytheme_footerwidgetwrappertop'); ?>;
	background-attachment:<?php echo get_option('mytheme_footerwidgetwrapperfix'); ?>;
<?php } ?>
}
#footer-wrapper .footer-bot-wrapper {
<?php if (get_option('mytheme_footercopyrightwrapperonoff')=='true') { ?>
	background-image:url(<?php $footercopyrightwrapper = wp_get_attachment_image_src(get_option('mytheme_footercopyrightwrapper'), 'full'); echo $footercopyrightwrapper[0]; ?>);
	background-repeat:<?php echo get_option('mytheme_footercopyrightwrapperrepeat'); ?>;
	background-position:<?php echo get_option('mytheme_footercopyrightwrapperleft'); ?> <?php echo get_option('mytheme_footercopyrightwrappertop'); ?>;
	background-attachment:<?php echo get_option('mytheme_footercopyrightwrapperfix'); ?>;
<?php } ?>
}


<?php if (get_option('mytheme_socialnetworkbgcolor')) { ?>
.social-wrapper {
	background-color:<?php echo get_option('mytheme_socialnetworkbgcolor'); ?>;
}
.social-wrapper .triangle {
	border-color:transparent <?php echo get_option('mytheme_socialnetworkbgcolor'); ?> <?php echo get_option('mytheme_socialnetworkbgcolor'); ?> transparent;
}
<?php }?>
.social-wrapper .social-icon a {
	background-color:<?php echo get_option('mytheme_socialiconcolor'); ?>;
}
.social-wrapper .social-icon a:hover {
	background-color:<?php echo get_option('mytheme_socialiconhovercolor'); ?>;
}


.sf-menu a {
<?php if (get_option('mytheme_fontmainnav')) { ?>
	font-family:<?php $fontmainnav = explode('|', get_option('mytheme_fontmainnav')); if (isset($fontmainnav[1]) && $fontmainnav[1] == 'googlefont') echo $fontmainnav[0]; ?>;
<?php } ?>
	font-size:<?php echo get_option('mytheme_navfontsize'); ?>;
}


#topbar-wrapper {
	background-color:<?php echo get_option('mytheme_topbarbgcolor'); ?>;
}
#topbar,
#topbar a {
	color:<?php echo get_option('mytheme_topbarcolor'); ?>;
<?php if (get_option('mytheme_topbarshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_topbarshadowcolor'); ?>;
<?php } ?>
}
#topbar a:hover {
	color:<?php echo get_option('mytheme_topbarlinkcolor'); ?>;
}


.top-information {
	color:<?php echo get_option('mytheme_topinfocolor'); ?>;
	background-color:<?php echo get_option('mytheme_topinfobgcolor'); ?>;
<?php if (get_option('mytheme_topinfoshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_topinfoshadowcolor'); ?>;
<?php } ?>
}
<?php if (get_option('mytheme_topinfobgcolor')) { ?>
.top-information .triangle {
	border-color:<?php echo get_option('mytheme_topinfobgcolor'); ?> <?php echo get_option('mytheme_topinfobgcolor'); ?> transparent transparent;
}
<?php } ?>
.top-information a,
.top-information a:hover {
	color:<?php echo get_option('mytheme_topinfolinkcolor'); ?>;
}


#slogan {
	font-family:<?php $fontslogan = explode('|', get_option('mytheme_fontslogan')); if (isset($fontslogan[1]) && $fontslogan[1] == 'googlefont') echo $fontslogan[0]; ?>;
	color:<?php echo get_option('mytheme_slogancolor'); ?>;
<?php if (get_option('mytheme_sloganshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_sloganshadowcolor'); ?>;
<?php } ?>
	font-size:<?php echo get_option('mytheme_sloganfontsize'); ?>;
}
#slogan-wrapper {
	background-color:<?php echo get_option('mytheme_sloganbgcolor'); ?>;
}


#breadcrumb {
	color:<?php echo get_option('mytheme_breadcrumbcolor'); ?>;
<?php if (get_option('mytheme_breadcrumbshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_breadcrumbshadowcolor'); ?>;
<?php } ?>
}
#breadcrumb a,
#breadcrumb a:hover {
	color:<?php echo get_option('mytheme_breadcrumblinkcolor'); ?>;
}
#breadcrumb-wrapper {
	background-color:<?php echo get_option('mytheme_breadcrumbbgcolor'); ?>;
	border-color:<?php echo get_option('mytheme_breadcrumbbordercolor'); ?>;
}


.sidebar .widget > h3,
.sidebar .widget > .h-wrapper h3 {
	font-family:<?php $fonthsidebar = explode('|', get_option('mytheme_fonthsidebar')); if (isset($fonthsidebar[1]) && $fonthsidebar[1] == 'googlefont') echo $fonthsidebar[0]; ?>;
	font-size:<?php echo get_option('mytheme_sidebarhfontsize') ?>;
<?php if (get_option('mytheme_sidebarhtopbordercolor')) { ?>
	border-top:1px solid <?php echo get_option('mytheme_sidebarhtopbordercolor') ?>;
<?php } ?>
<?php if (get_option('mytheme_sidebarhbottombordercolor')) { ?>
	border-bottom:1px solid <?php echo get_option('mytheme_sidebarhbottombordercolor') ?>;
<?php } ?>
	color:<?php echo get_option('mytheme_sidebarhcolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebarhbgcolor') ?>;
<?php if (get_option('mytheme_sidebarhbgcolor')=='transparent') { ?>
	padding-left:0;
<?php } ?>
<?php if (get_option('mytheme_sidebarhshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_sidebarhshadowcolor'); ?>;
<?php } ?>
}


.sidebar .grid_3, .sidebar .grid_4 {
	color:<?php echo get_option('mytheme_sidebartextcolor') ?>;
<?php if (get_option('mytheme_sidebartextshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_sidebartextshadowcolor') ?>;
<?php } ?>
<?php if (get_option('mytheme_sidebarbgcolor')) { ?>
	background-color:<?php echo get_option('mytheme_sidebarbgcolor') ?>;
<?php } ?>
}


.sidebar.sidebarright .grid_3, .sidebar.sidebarright .grid_4 {
<?php if (get_option('mytheme_sidebarrightborderradius')) { ?>
	border-radius:<?php echo get_option('mytheme_sidebarrightborderradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_sidebarrightborderradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_sidebarrightborderradius'); ?>;
<?php } ?>
}
.sidebar.sidebarleft .grid_3, .sidebar.sidebarleft .grid_4 {
<?php if (get_option('mytheme_sidebarleftborderradius')) { ?>
	border-radius:<?php echo get_option('mytheme_sidebarleftborderradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_sidebarleftborderradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_sidebarleftborderradius'); ?>;
<?php } ?>
}


<?php if (get_option('mytheme_sidebarbgcolor')) { ?>
.sidebar .h-wrapper h3 {
	background-color:<?php echo get_option('mytheme_sidebarbgcolor'); ?>
}
.sidebar .grid_4.pleft {
	width:260px;
	<?php if (get_option('mytheme_sidebardivideronoff')=='false') { ?>
	padding:20px;
	<?php } else { ?>
	padding:20px 20px 20px 19px;
	<?php } ?>
}
.sidebar .grid_4.pright {
	width:260px;
	<?php if (get_option('mytheme_sidebardivideronoff')=='false') { ?>
	padding:20px;
	<?php } else { ?>
	padding:20px 19px 20px 20px;
	<?php } ?>
}
#main .grid_3.bothleft {
	width:180px;
	<?php if (get_option('mytheme_sidebardivideronoff')=='false') { ?>
	padding:20px;
	<?php } else { ?>
	padding:20px 20px 20px 19px;
	<?php } ?>
}
#main .grid_3.bothright {
	width:180px;
	<?php if (get_option('mytheme_sidebardivideronoff')=='false') { ?>
	padding:20px;
	<?php } else { ?>
	padding:20px 19px 20px 20px;
	<?php } ?>
}
<?php } ?>


<?php if (get_option('mytheme_sidebardivideronoff')=='true') { ?>
.bothleft.border,
.bothright.border,
.pleft.border,
.pright.border {
	border-color:<?php echo get_option('mytheme_sidebardividercolor'); ?>;
}
<?php } ?>


.sidebar a {
	color:<?php echo get_option('mytheme_sidebarlinkcolor') ?>;
}
.sidebar a:hover {
	color:<?php echo get_option('mytheme_sidebarlinkhovercolor') ?>;
}


.sidebar h5 a {
	color:<?php echo get_option('mytheme_sidebarheadingcolor') ?>;
}
.sidebar h5 a:hover {
	color:<?php echo get_option('mytheme_sidebarheadinghovercolor') ?>;
}


.sidebar .widget_calendar caption {
	color:<?php echo get_option('mytheme_sidebarlinkcolor') ?>;
}
.sidebar .widget_calendar tbody td a {
	background:<?php echo get_option('mytheme_sidebarcalendarcolor') ?>;
}


.sidebar .tagcloud a {
	color:<?php echo get_option('mytheme_sidebartagcolor') ?>;
	background:<?php echo get_option('mytheme_sidebartagbgcolor') ?>;
	border-color:<?php echo get_option('mytheme_sidebartagbordercolor') ?>;
}


.sidebar .search-wrapper {
	background-color:<?php echo get_option('mytheme_sidebarsearchbgcolor') ?>;
	border-color:<?php echo get_option('mytheme_sidebarsearchbordercolor') ?>;
}
.sidebar .search-wrapper input.submit {
	background-color:<?php echo get_option('mytheme_sidebarsearchiconbgcolor') ?>;
}
.sidebar .searchform input.text {
	color:<?php echo get_option('mytheme_sidebarsearchtextcolor') ?>;
}


.sidebar .widget-recent-portfolio .date {
	color:<?php echo get_option('mytheme_sidebarrecentportdatecolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebardateauthorbgcolor') ?>;
}
.sidebar .widget-recent-post .date{
	color:<?php echo get_option('mytheme_sidebarrecentpostdatecolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebardateauthorbgcolor') ?>;
}
.sidebar .widget-recent-comments .author {
	color:<?php echo get_option('mytheme_sidebarrecentcommentcolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebardateauthorbgcolor') ?>;
}
.sidebar .post-widget-item h5 {
    border-color:<?php echo get_option('mytheme_sidebardateauthorbgcolor') ?>;
}


.sidebar .widget-recent-post .details-wrap {
	color:<?php echo get_option('mytheme_sidebarrecentpostcolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebarrecentpostbgcolor') ?>;
}


<?php if (get_option('mytheme_sidebarbordercolor')) { ?>
.sidebar .widget ul li {
	border-bottom-color:<?php echo get_option('mytheme_sidebarbordercolor') ?>;
}
<?php } ?>


.sidebar .widget-recent-post .details-wrap {
	background-color:<?php echo get_option('mytheme_sidebarrecentpostbgcolor') ?>;
}


.sidebar .portfolio_cycle_widget .featured-thumbnail,
.sidebar .post_cycle_widget .featured-thumbnail {
<?php if (get_option('mytheme_sidebarframebordercolor')) { ?>
	border:1px solid <?php echo get_option('mytheme_sidebarframebordercolor') ?>;
<?php } ?>
	background:<?php echo get_option('mytheme_sidebarframebgcolor') ?>;
<?php if (get_option('mytheme_sidebarframeshadowcolor')) { ?>
	-moz-box-shadow: 0px 0px 5px <?php echo get_option('mytheme_sidebarframeshadowcolor') ?>;
	-webkit-box-shadow: 0px 0px 5px <?php echo get_option('mytheme_sidebarframeshadowcolor') ?>;
	box-shadow: 0px 0px 5px <?php echo get_option('mytheme_sidebarframeshadowcolor') ?>;
<?php } ?>
}


.sidebar .testimonial {
	color:<?php echo get_option('mytheme_sidebartestimonialtextcolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebartestimonialbgcolor') ?>;
}
.sidebar .testimonial .testi-name,
.sidebar .testimonial .testi-name a {
	color:<?php echo get_option('mytheme_sidebartestimonialtextcolor') ?>;
}
.sidebar .testimonial .testi-pic a {
	background:<?php echo get_option('mytheme_sidebartestimonialimagebgcolor') ?>;
}
.sidebar .testimonial-widget-nav .next,
.sidebar .testimonial-widget-nav .prev {
	background-color:<?php echo get_option('mytheme_sidebartestimonialnavcolor') ?>;
}


.sidebar #twitter_update_list li {
	color:<?php echo get_option('mytheme_sidebartwittertextcolor') ?>;
	background-color:<?php echo get_option('mytheme_sidebartwitterbgcolor') ?>;
<?php if (get_option('mytheme_sidebartwitterbgcolor')) { ?>
	background-image:url(<?php echo get_template_directory_uri(); ?>/images/tweet-tranparent.png);
<?php } ?>
}
.sidebar #twitter_update_list span {
    border-color:<?php echo get_option('mytheme_sidebartwittertextcolor') ?>;
}
.sidebar #twitter_update_list li a,
.sidebar #twitter_update_list li a:hover {
	color:<?php echo get_option('mytheme_sidebartwitterlinkcolor') ?>;
}


.sidebar .flickr-widget a img {
    background-color:<?php echo get_option('mytheme_sidebarflickrbgcolor') ?>;
}


.sidebar #widget-contactForm input[type='text'],
.sidebar #widget-contactForm textarea {
	color:<?php echo get_option('mytheme_sidebarwidgetformtextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_sidebarwidgetformbgcolor'); ?>;
    border-color:<?php echo get_option('mytheme_sidebarwidgetformbordercolor'); ?>;
<?php if (get_option('mytheme_sidebarwidgetformshadowcolor')) { ?>
	box-shadow:0px 0px 5px <?php echo get_option('mytheme_sidebarwidgetformshadowcolor'); ?>;
	-moz-box-shadow:0px 0px 5px <?php echo get_option('mytheme_sidebarwidgetformshadowcolor'); ?>;
	-webkit-box-shadow:0px 0px 5px <?php echo get_option('mytheme_sidebarwidgetformshadowcolor'); ?>;
<?php } ?>
}


.sidebar #widget-contactForm input[type='submit'] {
	color:<?php echo get_option('mytheme_sidebarwidgetformbuttontextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_sidebarwidgetformbuttonbgcolor'); ?>;
}


.sidebar h5,
#footer-wrapper h5 {
	font-size:<?php echo get_option('mytheme_widgethfontsize'); ?>;
}


#footer-wrapper .widget > h3 {
	font-family:<?php $fonthfooter = explode('|', get_option('mytheme_fonthfooter')); if (isset($fonthfooter[1]) && $fonthfooter[1] == 'googlefont') echo $fonthfooter[0]; ?>;
	font-size:<?php echo get_option('mytheme_footerhfontsize') ?>;
	color:<?php echo get_option('mytheme_footerhcolor'); ?>;
<?php if (get_option('mytheme_footerhshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_footerhshadowcolor'); ?>;
<?php } ?>
}


#footer-wrapper .footer-top-wrapper {
	background-color:<?php echo get_option('mytheme_footerbgcolor'); ?>;
	color:<?php echo get_option('mytheme_footertextcolor'); ?>;
<?php if (get_option('mytheme_footertextshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_footertextshadowcolor'); ?>;
<?php } ?>
}


#footer-wrapper  a {
	color:<?php echo get_option('mytheme_footerlinkcolor'); ?>;
}
#footer-wrapper a:hover {
	color:<?php echo get_option('mytheme_footerlinkhovercolor'); ?>;
}


#footer-wrapper div[id|="calendar"] tbody td a {
	background:<?php echo get_option('mytheme_footercalendarcolor') ?>;
}


#footer-wrapper a[class^="tag-link"] {
	background:<?php echo get_option('mytheme_footertagbgcolor') ?>;
	border-color:<?php echo get_option('mytheme_footertagbordercolor') ?>;
}


#footer-wrapper .tagcloud a {
	color:<?php echo get_option('mytheme_footertagcolor') ?>;
	background:<?php echo get_option('mytheme_footertagbgcolor') ?>;
	border-color:<?php echo get_option('mytheme_footertagbordercolor') ?>;
}


#footer-wrapper .search-wrapper {
	background-color:<?php echo get_option('mytheme_footersearchbgcolor') ?>;
	border-color:<?php echo get_option('mytheme_footersearchbordercolor') ?>;
}
#footer-wrapper .search-wrapper input.submit {
	background-color:<?php echo get_option('mytheme_footersearchiconbgcolor') ?>;
}
#footer-wrapper .searchform input.text {
	color:<?php echo get_option('mytheme_footersearchtextcolor') ?>;
}


#footer-wrapper div[id|="calendar"] caption {
	color:<?php echo get_option('mytheme_footerlinkcolor') ?>;
}


#footer-wrapper .footer-top-wrapper h5 a {
	color:<?php echo get_option('mytheme_footerheadingcolor') ?>;
}
#footer-wrapper .footer-top-wrapper h5 a:hover {
	color:<?php echo get_option('mytheme_footerheadinghovercolor') ?>;
}


#footer-wrapper .widget-recent-portfolio .date {
	color:<?php echo get_option('mytheme_footerrecentportdatecolor') ?>;
	background-color:<?php echo get_option('mytheme_footerdateauthorbgcolor') ?>;
}
#footer-wrapper .widget-recent-post .date{
	color:<?php echo get_option('mytheme_footerrecentpostdatecolor') ?>;
	background-color:<?php echo get_option('mytheme_footerdateauthorbgcolor') ?>;
}
#footer-wrapper .widget-recent-comments .author {
	color:<?php echo get_option('mytheme_footerrecentcommentcolor') ?>;
	background-color:<?php echo get_option('mytheme_footerdateauthorbgcolor') ?>;
}


#footer-wrapper .post-widget-item h5 {
    border-color:<?php echo get_option('mytheme_footerdateauthorbgcolor') ?>;
}


#footer-wrapper .widget-recent-post .details-wrap {
	color:<?php echo get_option('mytheme_footerrecentpostcolor') ?>;
	background-color:<?php echo get_option('mytheme_footerrecentpostbgcolor') ?>;
}


<?php if (get_option('mytheme_footerbordercolor')) { ?>
#footer-wrapper .widget ul li {
	border-bottom-color:<?php echo get_option('mytheme_footerbordercolor') ?>;
}
<?php } ?>


#footer-wrapper .portfolio_cycle_widget  .featured-thumbnail,
#footer-wrapper .post_cycle_widget  .featured-thumbnail {
	background:<?php echo get_option('mytheme_footerframebgcolor') ?>;
}
#footer-wrapper .widget-recent-portfolio .shadow,
#footer-wrapper .post_cycle_widget  .featured-thumbnail {
<?php if (get_option('mytheme_footerframeshadowcolor')) { ?>
	-moz-box-shadow: 0px 0px 5px <?php echo get_option('mytheme_footerframeshadowcolor') ?>;
	-webkit-box-shadow: 0px 0px 5px <?php echo get_option('mytheme_footerframeshadowcolor') ?>;
	box-shadow: 0px 0px 5px <?php echo get_option('mytheme_footerframeshadowcolor') ?>;
<?php } ?>
}


#footer-wrapper .testimonial {
	color:<?php echo get_option('mytheme_footertestimonialtextcolor') ?>;
	background-color:<?php echo get_option('mytheme_footertestimonialbgcolor') ?>;
}
#footer-wrapper .testimonial .testi-name,
#footer-wrapper .testimonial .testi-name a {
	color:<?php echo get_option('mytheme_footertestimonialtextcolor') ?>;
}
#footer-wrapper .testimonial .testi-pic a {
	background:<?php echo get_option('mytheme_footertestimonialimagebgcolor') ?>;
}
#footer-wrapper .testimonial-widget-nav .next,
#footer-wrapper .testimonial-widget-nav .prev {
	background-color:<?php echo get_option('mytheme_footertestimonialnavcolor') ?>;
}


#footer-wrapper #twitter_update_list li {
	color:<?php echo get_option('mytheme_footertwittertextcolor') ?>;
	background-color:<?php echo get_option('mytheme_footertwitterbgcolor') ?>;
<?php if (get_option('mytheme_footertwitterbgcolor')) { ?>
	background-image:url(<?php echo get_template_directory_uri(); ?>/images/tweet-tranparent.png);
<?php } ?>
}
#footer-wrapper #twitter_update_list span {
    border-color:<?php echo get_option('mytheme_footertwittertextcolor') ?>;
}
#footer-wrapper #twitter_update_list li a,
#footer-wrapper #twitter_update_list li a:hover {
	color:<?php echo get_option('mytheme_footertwitterlinkcolor') ?>;
}


#footer-wrapper .flickr-widget a img {
    background-color:<?php echo get_option('mytheme_footerflickrbgcolor') ?>;
}


#footer-wrapper #widget-contactForm input[type='text'],
#footer-wrapper #widget-contactForm textarea {
	color:<?php echo get_option('mytheme_footerwidgetformtextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_footerwidgetformbgcolor'); ?>;
    border-color:<?php echo get_option('mytheme_footerwidgetformbordercolor'); ?>;
<?php if (get_option('mytheme_footerwidgetformshadowcolor')) { ?>
	box-shadow:0px 0px 5px <?php echo get_option('mytheme_footerwidgetformshadowcolor'); ?>;
	-moz-box-shadow:0px 0px 5px <?php echo get_option('mytheme_footerwidgetformshadowcolor'); ?>;
	-webkit-box-shadow:0px 0px 5px <?php echo get_option('mytheme_footerwidgetformshadowcolor'); ?>;
<?php } ?>
}


#footer-wrapper #widget-contactForm input[type='submit'] {
	background-color:<?php echo get_option('mytheme_footerwidgetformbuttonbgcolor'); ?>;
	color:<?php echo get_option('mytheme_footerwidgetformbuttontextcolor'); ?>;
}


#footer-wrapper .footer-bot-wrapper {
	background:<?php echo get_option('mytheme_footercopybgcolor'); ?>;
	color:<?php echo get_option('mytheme_footercopytextcolor'); ?>;
<?php if (get_option('mytheme_footercopytextshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_footercopytextshadowcolor'); ?>;
<?php } ?>
}
#footer-wrapper .footer-bot-wrapper a {
	color:<?php echo get_option('mytheme_footercopylinkcolor'); ?>;
<?php if (get_option('mytheme_footercopytextshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_footercopytextshadowcolor'); ?>;
<?php } ?>
}
#footer-wrapper .footer-bot-wrapper a:hover {
	color:<?php echo get_option('mytheme_footercopylinkhovercolor'); ?>;
}


#logo-wrapper a {
	margin-left:<?php echo get_option('mytheme_logomarginleft'); ?>;
	margin-right:<?php echo get_option('mytheme_logomarginright'); ?>;
	margin-top:<?php echo get_option('mytheme_logomargintop'); ?>;
	margin-bottom:<?php echo get_option('mytheme_logomarginbottom'); ?>;
}

#menu-wrapper {
	background-color:<?php echo get_option('mytheme_mainnavbgcolor'); ?>;
	border-radius:<?php echo get_option('mytheme_mainnavborderradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_mainnavborderradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_mainnavborderradius'); ?>;
}


<?php if (get_option('mytheme_mainnavmenudivideronoff')=='true') { ?>
.sf-menu > li {
	background:url(<?php echo get_template_directory_uri(); ?>/images/menu-div.png) no-repeat left center;
	margin-left:5px;
	padding-left:15px;
}
<?php } ?>


.sf-menu > li:hover > a, 
.sf-menu > li.sfHover > a,
.sf-menu > li.current-menu-item > a {
	border-color:<?php echo get_option('mytheme_mainnavmenubordercolor'); ?>;
}


.sf-menu > li > a {
	color:<?php echo get_option('mytheme_mainnavtextcolor'); ?> !important;
<?php if (get_option('mytheme_mainnavtextshadowcolor')) { ?>
	text-shadow:1px 1px 3px <?php echo get_option('mytheme_mainnavtextshadowcolor'); ?>;
<?php } ?>
	background-color:<?php echo get_option('mytheme_mainnavmenucolor')?>;
}
.sf-menu > li.current-menu-item > a {
	color:<?php echo get_option('mytheme_mainnavtextcurrentcolor'); ?> !important;
	background-color:<?php echo get_option('mytheme_mainnavmenucurrentcolor')?>;
}
.sf-menu > li > a:hover,
.sf-menu > li.sfHover > a {
	color:<?php echo get_option('mytheme_mainnavtexthovercolor'); ?> !important;
	background-color:<?php echo get_option('mytheme_mainnavmenuhovercolor')?>;
}


.sf-menu li ul {
<?php if (get_option('mytheme_mainnavsubmenuradius')) { ?>
	border-radius:<?php echo get_option('mytheme_mainnavsubmenuradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_mainnavsubmenuradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_mainnavsubmenuradius'); ?>;
<?php } ?>
	border-bottom-color:<?php echo get_option('mytheme_mainnavsubmenushadowcolor'); ?>;
	background:<?php echo get_option('mytheme_mainnavsubmenucolor'); ?>;
}


.sf-menu li li a {
	color:<?php echo get_option('mytheme_mainnavsubmenutextcolor'); ?> !important;
}
.sf-menu li li a:hover,
.sf-menu li li.sfHover > a,
.sf-menu li li.current-menu-item > a {
	color:<?php echo get_option('mytheme_mainnavsubmenutexthovercolor'); ?> !important;
	background:<?php echo get_option('mytheme_mainnavsubmenuitemcolor'); ?>;
<?php if (get_option('mytheme_mainnavsubmenuitemradius')) { ?>
	border-radius:<?php echo get_option('mytheme_mainnavsubmenuitemradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_mainnavsubmenuitemradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_mainnavsubmenuitemradius'); ?>;
<?php } ?>
}
<?php if (get_option('mytheme_mainnavtextcolor') || get_option('mytheme_mainnavsubmenutexthovercolor')) { ?>
.sf-menu ul a:focus > .sf-sub-indicator,
.sf-menu ul a:hover > .sf-sub-indicator,
.sf-menu ul a:active > .sf-sub-indicator,
.sf-menu ul li:hover > a > .sf-sub-indicator,
.sf-menu ul li.sfHover > a > .sf-sub-indicator {
    background-image:none;
    text-indent:0;
    top:.6em;
}
<?php } ?>
<?php if (get_option('mytheme_mainnavsubmenutextcolor')) { ?>
.sf-menu ul a > .sf-sub-indicator {
    background-image:none;
    text-indent:0;
    top:.6em;
}
<?php } ?>


.top-search-wrapper {
	background:<?php echo get_option('mytheme_topsearchwrapperbgcolor'); ?>;
}
.search-wrapper input.text {
	color:<?php echo get_option('mytheme_topsearchcolor'); ?>;
	background:<?php echo get_option('mytheme_topsearchbgcolor'); ?>;
}


#error404 h1 {
	color:<?php echo get_option('mytheme_heading404color') ?>;
}
#error404 {
	color:<?php echo get_option('mytheme_text404color') ?>;
<?php if (get_option('mytheme_text404shadowcolor')) { ?>
	text-shadow:0 0 4px <?php echo get_option('mytheme_text404shadowcolor') ?>;
<?php } ?>
}
#error404 .search-wrapper {
	background-color:<?php echo get_option('mytheme_search404bgcolor') ?>;
	border-color:<?php echo get_option('mytheme_search404bordercolor') ?>;
}
#error404 .search-wrapper input.submit {
	background-color:<?php echo get_option('mytheme_search404iconbgcolor') ?>;
}
#error404 .searchform input.text {
	color:<?php echo get_option('mytheme_search404textcolor') ?>;
}


.posts .featured-thumbnail {
	background-color:<?php echo get_option('mytheme_postframebgcolor'); ?>;
}
.post-info {
	color:<?php echo get_option('mytheme_postinfotextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_postinfobgcolor'); ?>;
}
.post-info a,
.post-info a:hover  {
	color:<?php echo get_option('mytheme_postinfolinkcolor'); ?>;
}
.posts .post-icon,
.posts.single .post-icon {
	background-color:<?php echo get_option('mytheme_postinfoiconcolor'); ?>;
}
.posts .featured-thumbnail-wrapper .date-wrap,
.posts.single .featured-thumbnail-wrapper .date-wrap {
	color:<?php echo get_option('mytheme_postdatecolor'); ?>;
	background-color:<?php echo get_option('mytheme_postdatebgcolor'); ?>;
}
<?php if (get_option('mytheme_contentwrappercolor')) { ?>
.posts .featured-thumbnail-wrapper .date-wrapper .triangle {
	border-color:transparent transparent transparent <?php echo get_option('mytheme_contentwrappercolor'); ?>;
}
<?php } ?>


.older-newer {
	background-color:<?php echo get_option('mytheme_oldernewerbgcolor'); ?>;
}
.older-newer a {
	color:<?php echo get_option('mytheme_oldernewertextcolor'); ?>;
}
.older-newer a:hover {
	color:<?php echo get_option('mytheme_oldernewertexthovercolor'); ?>;
}


.author-info {
	color:<?php echo get_option('mytheme_authortextcolor'); ?>;
	background:<?php echo get_option('mytheme_authorbgcolor'); ?>;
	border-color:<?php echo get_option('mytheme_authorbordercolor'); ?>;
}
.author-info h3 {
	color:<?php echo get_option('mytheme_authorhcolor'); ?>;
}
.author-info a,
.author-info h3 a {
	color:<?php echo get_option('mytheme_authorlinkcolor'); ?>;
}


.featured-thumbnail .zoom-icon.related-post h3 {
	color:<?php echo get_option('mytheme_relatedpostcolor'); ?>;
}
.featured-thumbnail .zoom-icon.related-post {
    background-color:<?php echo get_option('mytheme_relatedpostbgcolor'); ?>;
}
.ports .related .zoom-icon {
	background-color:<?php echo get_option('mytheme_relatedposticoncolor'); ?>;
}


ol.commentlist li.comment  {
	color:<?php echo get_option('mytheme_commenttextcolor'); ?>;
	background:<?php echo get_option('mytheme_commentbgcolor'); ?>;
<?php if (get_option('mytheme_commentbordercolor')) { ?>
	border:1px solid <?php echo get_option('mytheme_commentbordercolor'); ?>;
<?php } ?>
}
ol.commentlist li.comment  a {
	color:<?php echo get_option('mytheme_commentlinkcolor'); ?>;
}


#respond form div,
#contact-form form > div {
<?php if (get_option('mytheme_contactshadowcolor')) { ?>
	box-shadow:0px 0px 5px <?php echo get_option('mytheme_contactshadowcolor'); ?>;
	-moz-box-shadow:0px 0px 5px <?php echo get_option('mytheme_contactshadowcolor'); ?>;
	-webkit-box-shadow:0px 0px 5px <?php echo get_option('mytheme_contactshadowcolor'); ?>;
<?php } ?>
	background-color:<?php echo get_option('mytheme_contactbgcolor'); ?>;
}
<?php if (get_option('mytheme_contactbordercolor')) { ?>
#respond form div,
#contact-form form > div {
	background-image:none;
    border-color:<?php echo get_option('mytheme_contactbordercolor'); ?>;
}
<?php } ?>
#respond form input[type='text'],
#respond form textarea,
#contact-form input[type='text'],
#contact-form textarea {
	color:<?php echo get_option('mytheme_contacttextcolor'); ?>;
}

input[type='submit'] {
	color:<?php echo get_option('mytheme_contactbuttontextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_contactbuttonbgcolor'); ?>;
}


.ports .featured-thumbnail {
	background-color:<?php echo get_option('mytheme_portframebgcolor'); ?>;
}
#port-details-wrapper .date-wrapper {
    color:<?php echo get_option('mytheme_portdetailsdatecolor'); ?>;
    background-color:<?php echo get_option('mytheme_portdetailsdatebgcolor'); ?>;
}
#port-details-wrapper .date-wrapper .post-icon  {
    background-color:<?php echo get_option('mytheme_portdetailsiconcolor'); ?>;
}
#port-details span.sub-title {
	color:<?php echo get_option('mytheme_portdetailstitlecolor'); ?>;
}


.portfolio-item-wrapper.default h2 {
	color:<?php echo get_option('mytheme_portdefaulthcolor'); ?>;
}
.portfolio-item-wrapper.default .portfolio-item-category a {
	color:<?php echo get_option('mytheme_portdefaultcatcolor'); ?>;
}
.portfolio-item-wrapper.default .normal-button {
	color:<?php echo get_option('mytheme_portdefaultbuttontextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_portdefaultbuttonbgcolor'); ?>;
}
.portfolio-item-wrapper.default .portfolio-item-context {
	color:<?php echo get_option('mytheme_portdefaulttextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_portdefaultbgcolor'); ?>;
	border-color:<?php echo get_option('mytheme_portdefaultbordercolor'); ?>;
}


.portfolio-item-wrapper.simple .date-wrapper {
    color:<?php echo get_option('mytheme_portsimpledatecolor'); ?>;
    background:<?php echo get_option('mytheme_portsimpledatebgcolor'); ?>;
}
.portfolio-item-wrapper.simple .portfolio-item-category a {
	color:<?php echo get_option('mytheme_portsimplecatcolor'); ?>;
}
.portfolio-item-wrapper.simple .normal-button {
	color:<?php echo get_option('mytheme_portsimplebuttontextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_portsimplebuttonbgcolor'); ?>;
}


.portfolio-item-wrapper.style1 h2,
.portfolio-item-wrapper.style2 h2 {
    color:<?php echo get_option('mytheme_portstyleshcolor'); ?>;
    background:<?php echo get_option('mytheme_portstyleshbgcolor'); ?>;
}
.portfolio-item-wrapper.style1 .portfolio-item-category a,
.portfolio-item-wrapper.style2 .portfolio-item-category a {
	color:<?php echo get_option('mytheme_portstylescatcolor'); ?>;
}
.portfolio-item-wrapper.style1 .portfolio-item-context,
.portfolio-item-wrapper.style2 .portfolio-item-context {
	color:<?php echo get_option('mytheme_portstylestextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_portstylestextbgcolor'); ?>;
	border-color:<?php echo get_option('mytheme_portdatebgcolor'); ?>;
}
.portfolio-item-wrapper.style1 .normal-button,
.portfolio-item-wrapper.style2 .normal-button {
	color:<?php echo get_option('mytheme_portstylesbuttontextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_portstylesbuttonbgcolor'); ?>;
}


.portfolio-item-wrapper.gallery h2 {
	color:<?php echo get_option('mytheme_portgalleryhcolor'); ?>;
<?php if (get_option('mytheme_portgalleryhshadowcolor')) { ?>
    text-shadow:1px 1px 3px <?php echo get_option('mytheme_portgalleryhshadowcolor'); ?>;
<?php } ?>
}
.featured-thumbnail .zoom-icon.gallery-port {
    background-color:<?php echo get_option('mytheme_portgallerybgcolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port .iconcontainer span {
	background-color:<?php echo get_option('mytheme_portgalleryiconcolor'); ?>;
<?php if (get_option('mytheme_portgalleryiconshadowcolor')) { ?>
	box-shadow:0 0 5px <?php echo get_option('mytheme_portgalleryiconshadowcolor'); ?>;
<?php } ?>
}
.featured-thumbnail .zoom-icon.gallery-port .iconcontainer span:hover {
	background-color:<?php echo get_option('mytheme_portgalleryiconhovercolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port {
    border-color:<?php echo get_option('mytheme_portgallerycatbgcolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port .port-cat {
    color:<?php echo get_option('mytheme_portgallerycatcolor'); ?>;
    background-color:<?php echo get_option('mytheme_portgallerycatbgcolor'); ?>;
}
<?php if (get_option('mytheme_portgallerycatbgcolor')) { ?>
.featured-thumbnail .zoom-icon.gallery-port .port-cat .triangle {
    border-color:transparent transparent <?php echo get_option('mytheme_portgallerycatbgcolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port > .triangle {
    border-color:<?php echo get_option('mytheme_portgallerycatbgcolor'); ?> transparent transparent;
}
<?php } ?>


.portfolio-item-wrapper.gallery.border h2 {
	color:<?php echo get_option('mytheme_portgallerybhcolor'); ?>;
<?php if (get_option('mytheme_portgallerybhshadowcolor')) { ?>
    text-shadow:1px 1px 3px <?php echo get_option('mytheme_portgallerybhshadowcolor'); ?>;
<?php } ?>
}
.ports .portfolio-item-wrapper.gallery.border .featured-thumbnail {
    background-color:<?php echo get_option('mytheme_portgallerybbordercolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port.border {
    background-color:<?php echo get_option('mytheme_portgallerybbgcolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port.border .iconcontainer span {
	background-color:<?php echo get_option('mytheme_portgallerybiconcolor'); ?>;
<?php if (get_option('mytheme_portgallerybiconshadowcolor')) { ?>
	box-shadow:0 0 5px <?php echo get_option('mytheme_portgallerybiconshadowcolor'); ?>;
<?php } ?>
}
.featured-thumbnail .zoom-icon.gallery-port.border .iconcontainer span:hover {
	background-color:<?php echo get_option('mytheme_portgallerybiconhovercolor'); ?>;
}
.featured-thumbnail .zoom-icon.gallery-port .port-icon-wrapper a {
    color:<?php echo get_option('mytheme_portgallerycatcolor'); ?>;
}


#load-portfolio a {
	color:<?php echo get_option('mytheme_portfiltertextcolor'); ?>;
}
#load-portfolio a:hover,
#load-portfolio a.active {
	color:<?php echo get_option('mytheme_portfilteractivetextcolor'); ?>;
	border-color:<?php echo get_option('mytheme_portfilteractivetextcolor'); ?>;
}


#pagination span, #pagination a {
	color:<?php echo get_option('mytheme_paginationtextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_paginationbgcolor'); ?>;
}
#pagination a:hover{
	color:<?php echo get_option('mytheme_paginationhovertextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_paginationhoverbgcolor'); ?>;
}
#pagination .current{
	color:<?php echo get_option('mytheme_paginationactivetextcolor'); ?>;
	background-color:<?php echo get_option('mytheme_paginationactivebgcolor'); ?>;
}


.stunningtext-title {
	font-family:<?php $fontstunning = explode('|', get_option('mytheme_fontstunningtext')); if (isset($fontstunning[1]) && $fontstunning[1] == 'googlefont') echo $fontstunning[0]; ?>;
	font-size:<?php echo get_option('mytheme_stunningtextfontsize') ?>;
}


#backtotop {
	bottom:<?php echo get_option('mytheme_backtotopbottom'); ?>;
<?php if (get_option('mytheme_backtotopside') == 'left') { ?>
	right:auto;
	left:<?php echo get_option('mytheme_backtotopmargin'); ?>;
<?php } else { ?>
	right:<?php echo get_option('mytheme_backtotopmargin'); ?>;
} ?>
	background-color:<?php echo get_option('mytheme_backtotopbgcolor'); ?>;
	border-color:<?php echo get_option('mytheme_backtotopbordercolor'); ?>;
}
<?php } ?>



#nivoslider-wrapper {
	background-color:<?php echo get_option('mytheme_nivobgcolor'); ?>;
	margin-top:<?php echo get_option('mytheme_nivotopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_nivobottommargin'); ?>;
}

<?php if (get_option('mytheme_nivocontrolnavthumbs')=='true') { ?>
#nivoslider-wrapper .nivo-controlNav.nivo-thumbs-enabled {
	top:<?php echo get_option('mytheme_nivocontrolnavthumbstop'); ?>;
	left:<?php echo get_option('mytheme_nivocontrolnavthumbsleft'); ?>;
}
#nivoslider-wrapper .nivo-controlNav a {
	width:<?php if (get_option('mytheme_nivocontrolnavthumbswidth')) echo get_option('mytheme_nivocontrolnavthumbswidth'); else { echo "90px"; } ?>;
	height:<?php if (get_option('mytheme_nivocontrolnavthumbsheight')) echo get_option('mytheme_nivocontrolnavthumbsheight'); else { echo "50px"; } ?>;
	margin-right:<?php if (get_option('mytheme_nivocontrolnavthumbsmarginr')) echo get_option('mytheme_nivocontrolnavthumbsmarginr'); else { echo "6px"; } ?>;
	margin-bottom:<?php if (get_option('mytheme_nivocontrolnavthumbsmarginb')) echo get_option('mytheme_nivocontrolnavthumbsmarginb'); else { echo "6px"; } ?>;
	background:none;
	<?php if (get_option('mytheme_nivocontrolnavthumbsv')=='true') echo "clear:both;" ?> 
}
#nivoslider-wrapper .nivo-control.active {
	opacity:0.5;
}
<?php } ?>


<?php if (get_option('mytheme_nivocaptiononoff')=='true') { ?>
#nivoslider .nivo-caption {
	bottom:<?php echo get_option('mytheme_nivocaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_nivocaptiontop'); ?>;
	left:<?php echo get_option('mytheme_nivocaptionleft'); ?>;
	right:<?php echo get_option('mytheme_nivocaptionright'); ?>;
	background-color:<?php echo get_option('mytheme_nivocaptionbgcolor'); ?>;
	background-image:<?php if (get_option('mytheme_nivocaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	color:<?php echo get_option('mytheme_nivocaptiontextcolor'); ?>;
	text-align:<?php echo get_option('mytheme_nivocaptiontextalign'); ?>;
	width:<?php echo get_option('mytheme_nivocaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_nivocaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_nivocaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_nivocaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_nivocaptionradius'); ?>;
<?php if (get_option('mytheme_nivocaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_nivocaptiontextshadowcolor'); ?>;
<?php } ?>
}
#nivoslider .nivo-caption > p {
	padding:<?php echo get_option('mytheme_nivocaptionpadding')?>;
}
#nivoslider .nivo-caption .nivo-title,
#nivoslider .nivo-caption .nivo-title a {
	color:<?php echo get_option('mytheme_nivocaptiontitlecolor')?>;
<?php if (get_option('mytheme_nivocaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 0px <?php echo get_option('mytheme_nivocaptiontitleshadowcolor'); ?>;
<?php } ?>
}
<?php } ?>
<?php if (get_option('mytheme_nivocaptiononoff')=='false') { ?>
#nivoslider .nivo-caption {
	display:none !important;
}
<?php } ?>


#kwicks-wrapper {
	margin-top:<?php echo get_option('mytheme_kwickstopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_kwicksbottommargin'); ?>;
}
<?php if (get_option('mytheme_kwickscaptiononoff')=='true') { ?>
.kwicks .kwicks-caption {
	bottom:<?php echo get_option('mytheme_kwickscaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_kwickscaptiontop'); ?>;
	left:<?php echo get_option('mytheme_kwickscaptionleft'); ?>;
	right:<?php echo get_option('mytheme_kwickscaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_kwickscaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_kwickscaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_kwickscaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_kwickscaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_kwickscaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_kwickscaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_kwickscaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_kwickscaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_kwickscaptionradius'); ?>;
<?php if (get_option('mytheme_kwickscaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_kwickscaptiontextshadowcolor'); ?>;
<?php } ?>
}
.kwicks .kwicks-title,
.kwicks .kwicks-title a {
	color:<?php echo get_option('mytheme_kwickscaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_kwickscaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_kwickscaptiontitleshadowcolor'); ?>;
<?php } ?>
}
.kwicks .kwicks-content {
	text-align:<?php echo get_option('mytheme_kwickscaptiontextalign'); ?>;
	padding:<?php echo get_option('mytheme_kwickscaptionpadding'); ?>;
<?php if (get_option('mytheme_kwickscaptioncontentpos')=='true') { ?>
	position:static;
<?php } ?>
}
.kwicks .inner { 
	height:<?php $a=get_option('mytheme_kwickscaptionheight'); $a=$a-20; echo $a.'px'; ?>;
<?php if (get_option('mytheme_kwickscaptionleft') || get_option('mytheme_kwickscaptionradius')) { ?>
	background:none;
<?php } ?>
}
<?php if (get_option('mytheme_kwickscaptionheight')) { ?>
.kwicks .inner .kwicks-content { 
	height:auto;
}
<?php } ?>
<?php } ?>

.kwicks .link {
	color:<?php echo get_option('mytheme_kwickscaptionlinkcolor'); ?>;
}

<?php if (get_option('mytheme_kwicksvertical')=='true') { ?>
.kwicks {
	height:380px;
}
.kwicks li {
	height:76px;
	width:940px;
}
.kwicks-info {
	display:none;
}
.kwicks .kwicks-caption .inner { 
	background:none;
}
.kwicks li:first-child {
	border-radius:6px 6px 0 0;
}
.kwicks li.last {
	border-radius:0 0 6px 6px;
}
.kwicks .kwicks-caption {
	background-image:none;
	background-color:transparent;
<?php if (!get_option('mytheme_kwickscaptiontop') && !get_option('mytheme_kwickscaptionbottom') && !get_option('mytheme_kwickscaptionleft') && !get_option('mytheme_kwickscaptionright') && !get_option('mytheme_kwickscaptionwidth')) { ?>
	width:940px;
<?php } ?>
}
.kwicks li:hover .kwicks-caption {
	background-image:<?php if (get_option('mytheme_kwickscaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>
	background-position:0 bottom;
	background-repeat:repeat-x;
	background-color:<?php if (!get_option('mytheme_kwickscaptionbgcolor')) echo 'rgba(255,255,255,.8)'; else echo get_option('mytheme_kwickscaptionbgcolor');?>;
}
<?php } ?>


#showcase-holder {
	margin-top:<?php echo get_option('mytheme_showcasetopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_showcasebottommargin'); ?>;
}

<?php if (get_option('mytheme_showcasethumbalign')=='vertical') { ?>
.showcase-load {
	width:800px;
}
#showcase-holder {
	width:940px;
	height:380px;
}
.showcase {
	height:380px;
}
.showcase-thumbnail {
	margin:10px 10px 0;
}
.showcase-thumbnail-button-backward,
.showcase-thumbnail-button-forward {
	padding:0;
}
.showcase-thumbnail-button-backward {
	padding-bottom: 5px;
	padding-top: 15px;
	margin:0 53px;
}
.showcase-thumbnail-button-forward {
	padding-bottom: 15px;
	padding-top: 5px;
	margin:10px 53px 0;
}
<?php } ?>

.showcase-caption {
	bottom:<?php echo get_option('mytheme_showcasecaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_showcasecaptiontop'); ?>;
	left:<?php echo get_option('mytheme_showcasecaptionleft'); ?>;
	right:<?php echo get_option('mytheme_showcasecaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_showcasecaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_showcasecaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_showcasecaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_showcasecaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_showcasecaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_showcasecaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_showcasecaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_showcasecaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_showcasecaptionradius'); ?>;
	padding:<?php echo get_option('mytheme_showcasecaptionpadding'); ?>;
	text-align:<?php echo get_option('mytheme_showcasecaptiontextalign'); ?>;
<?php if (get_option('mytheme_showcasecaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_showcasecaptiontextshadowcolor'); ?>;
<?php } ?>
}
.showcase-caption .showcase-title,
.showcase-caption .showcase-title a {
	color:<?php echo get_option('mytheme_showcasecaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_showcasecaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_showcasecaptiontitleshadowcolor'); ?>;
<?php } ?>
}

.showcase-thumbnail {
	border-color:<?php echo get_option('mytheme_showcasethumbbordercolor'); ?>;
}
.showcase-thumbnail:hover, .showcase-thumbnail.active {
	border-color:<?php echo get_option('mytheme_showcasethumbactivebordercolor'); ?>;
}
.showcase-thumbnail-container {
	background-color:<?php echo get_option('mytheme_showcasethumbbgcolor'); ?>;
}
#showcase-holder {
	background-color:<?php echo get_option('mytheme_showcasebgcolor'); ?>;
}


.cycle-wrapper {
	margin-top:<?php echo get_option('mytheme_cycletopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_cyclebottommargin'); ?>;
	background-color:<?php echo get_option('mytheme_cyclebgcolor'); ?>;
}
.cycle-caption {
	bottom:<?php echo get_option('mytheme_cyclecaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_cyclecaptiontop'); ?>;
	left:<?php echo get_option('mytheme_cyclecaptionleft'); ?>;
	right:<?php echo get_option('mytheme_cyclecaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_cyclecaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_cyclecaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_cyclecaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_cyclecaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_cyclecaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_cyclecaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_cyclecaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_cyclecaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_cyclecaptionradius'); ?>;
	padding:<?php echo get_option('mytheme_cyclecaptionpadding'); ?>;
	text-align:<?php echo get_option('mytheme_cyclecaptiontextalign'); ?>;
<?php if (get_option('mytheme_cyclecaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_cyclecaptiontextshadowcolor'); ?>;
<?php } ?>
}
.cycle-caption .cycle-title,
.cycle-caption .cycle-title a {
	color:<?php echo get_option('mytheme_cyclecaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_cyclecaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_cyclecaptiontitleshadowcolor'); ?>;
<?php } ?>
}


#roundaboutslider {
	margin-top:<?php echo get_option('mytheme_roundabouttopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_roundaboutbottommargin'); ?>;
}
.roundabout-caption {
	bottom:<?php echo get_option('mytheme_roundaboutcaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_roundaboutcaptiontop'); ?>;
	left:<?php echo get_option('mytheme_roundaboutcaptionleft'); ?>;
	right:<?php echo get_option('mytheme_roundaboutcaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_roundaboutcaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_roundaboutcaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_roundaboutcaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_roundaboutcaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_roundaboutcaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_roundaboutcaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_roundaboutcaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_roundaboutcaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_roundaboutcaptionradius'); ?>;
	padding:<?php echo get_option('mytheme_roundaboutcaptionpadding'); ?>;
	text-align:<?php echo get_option('mytheme_roundaboutcaptiontextalign'); ?>;
<?php if (get_option('mytheme_roundaboutcaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_roundaboutcaptiontextshadowcolor'); ?>;
<?php } ?>
}
.roundabout-caption .roundabout-title,
.roundabout-caption .roundabout-title a {
	color:<?php echo get_option('mytheme_roundaboutcaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_roundaboutcaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_roundaboutcaptiontitleshadowcolor'); ?>;
<?php } ?>
}


.roundabout-moveable-item {
	border-bottom-color:<?php echo get_option('mytheme_roundaboutbordercolor'); ?>;
}
<?php if (get_option('mytheme_roundaboutcaptionontop') == 'true') { ?>
.roundabout-caption {
	padding:0;
	position:relative;
	background:transparent;
}
<?php } ?>


<?php if (get_option('mytheme_roundaboutshape') == 'conveyorBeltLeft') { ?>
.roundabout-holder {
	margin: 0 0 0 -204px;
}
<?php } elseif (get_option('mytheme_roundaboutshape') == 'conveyorBeltRight') { ?>
.roundabout-holder {
	margin: 0 0 0 -436px;
}
<?php } ?>


#liteaccordion {
	margin-top:<?php echo get_option('mytheme_liteaccordiontopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_liteaccordionbottommargin'); ?>;
}
.liteaccordion-caption {
	bottom:<?php echo get_option('mytheme_liteaccordioncaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_liteaccordioncaptiontop'); ?>;
	left:<?php echo get_option('mytheme_liteaccordioncaptionleft'); ?>;
	right:<?php echo get_option('mytheme_liteaccordioncaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_liteaccordioncaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_liteaccordioncaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_liteaccordioncaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_liteaccordioncaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_liteaccordioncaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_liteaccordioncaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_liteaccordioncaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_liteaccordioncaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_liteaccordioncaptionradius'); ?>;
	padding:<?php echo get_option('mytheme_liteaccordioncaptionpadding'); ?>;
	text-align:<?php echo get_option('mytheme_liteaccordioncaptiontextalign'); ?>;
<?php if (get_option('mytheme_liteaccordioncaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_liteaccordioncaptiontextshadowcolor'); ?>;
<?php } ?>
}
#liteaccordion ol li > h2 {
	background:<?php echo get_option('mytheme_liteaccordionbgcolor'); ?>;
	border-left-color:<?php echo get_option('mytheme_liteaccordionbordercolor'); ?>;
}
#liteaccordion ol li > div > div {
	border-left-color:<?php echo get_option('mytheme_liteaccordionactivebordercolor'); ?>;
}
#liteaccordion ol li > h2 > span.slide_name {
	color:<?php echo get_option('mytheme_liteaccordionnamecolor'); ?>;
}
#liteaccordion ol li > h2.selected > span.slide_name {
	color:<?php echo get_option('mytheme_liteaccordionactivenamecolor'); ?>;
}
#liteaccordion ol li > h2 > span.slide_number {
	color:<?php echo get_option('mytheme_liteaccordionnumbercolor'); ?>;
}
#liteaccordion ol li > h2.selected > span.slide_number {
	color:<?php echo get_option('mytheme_liteaccordionactivenumbercolor'); ?>;
}
.liteaccordion-caption .liteaccordion-title,
.liteaccordion-caption .liteaccordion-title a {
	color:<?php echo get_option('mytheme_liteaccordioncaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_liteaccordioncaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_liteaccordioncaptiontitleshadowcolor'); ?>;
<?php } ?>
}


#tmslider-holder {
	margin-top:<?php echo get_option('mytheme_tmtopmargin'); ?>;
	margin-bottom:<?php echo get_option('mytheme_tmbottommargin'); ?>;
	background-color:<?php echo get_option('mytheme_tmbgcolor'); ?>;
}


#tmslider-wrapper {
	width:<?php echo get_option('mytheme_tmwidth'); ?>;
}


.tm-caption {
	bottom:<?php echo get_option('mytheme_tmcaptionbottom'); ?>;
	top:<?php echo get_option('mytheme_tmcaptiontop'); ?>;
	left:<?php echo get_option('mytheme_tmcaptionleft'); ?>;
	right:<?php echo get_option('mytheme_tmcaptionright'); ?>;
	background-image:<?php if (get_option('mytheme_tmcaptionbgimage')=='true') echo 'url('.get_template_directory_uri().'/images/slider-caption.png)'; ?>;
	background-color:<?php echo get_option('mytheme_tmcaptionbgcolor');?>;
	opacity:<?php echo get_option('mytheme_tmcaptionopacity'); ?>;
	color:<?php echo get_option('mytheme_tmcaptiontextcolor'); ?>;
	width:<?php echo get_option('mytheme_tmcaptionwidth'); ?>;
	height:<?php echo get_option('mytheme_tmcaptionheight'); ?>;
	border-radius:<?php echo get_option('mytheme_tmcaptionradius'); ?>;
	-webkit-border-radius:<?php echo get_option('mytheme_tmcaptionradius'); ?>;
	-moz-border-radius:<?php echo get_option('mytheme_tmcaptionradius'); ?>;
	padding:<?php echo get_option('mytheme_tmcaptionpadding'); ?>;
	text-align:<?php echo get_option('mytheme_tmcaptiontextalign'); ?>;
<?php if (get_option('mytheme_tmcaptiontextshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_tmcaptiontextshadowcolor'); ?>;
<?php } ?>
<?php if (get_option('mytheme_tmcaptiononoff')=='false') { ?>
	display:none;
<?php } ?>
}
.tm-caption .tm-title,
.tm-caption .tm-title a {
	color:<?php echo get_option('mytheme_tmcaptiontitlecolor'); ?>;
<?php if (get_option('mytheme_tmcaptiontitleshadowcolor')) { ?>
	text-shadow:1px 1px 1px <?php echo get_option('mytheme_tmcaptiontitleshadowcolor'); ?>;
<?php } ?>
}


<?php if (get_option('mytheme_bgstretcherposition')=='true') { ?>
#stretcher {
	position:absolute;
}
.sliderNav {
	position:absolute;
}
<?php } ?>
.sliderNav {
    top:<?php echo get_option('mytheme_bgstretcherpaginationtop'); ?>;
    left:<?php echo get_option('mytheme_bgstretcherpaginationleft'); ?>;
    margin:<?php echo get_option('mytheme_bgstretcherpaginationmargin'); ?>;
}
.sliderNav #nav ul li a {
	background-color:<?php echo get_option('mytheme_bgstretcherpaginationcolor'); ?>;
<?php if (get_option('mytheme_bgstretcherpaginationshadowcolor')) { ?>
	box-shadow:0 0 5px <?php echo get_option('mytheme_bgstretcherpaginationshadowcolor'); ?>;
<?php } ?>
}
.sliderNav #nav ul li.showPage a {
	background-color:<?php echo get_option('mytheme_bgstretcherpaginationactivecolor'); ?>;
}

<?php } /* end of styling on/off */?>


<?php
// add custom css
if (get_option('mytheme_customcssonoff')=='true') {
	echo stripcslashes(get_option('mytheme_customcss'));
}
?>