(function() {
    tinymce.create('tinymce.plugins.allshortcodes', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			
			for (i=0; i<popups.length; i++) {
				
				jQuery.each(popups[i], function(index, popup) {
					var shortcode = popups[i]['code'];
						
					// Register example button
					ed.addButton(popups[i]['name'], {
						title : popups[i]['title'],
						image : url + '/images/' + popups[i]['name'].replace('_', '-') + '.png',
						onclick : function() {
							ed.focus();
							ed.selection.setContent( shortcode );
						}
					});
				});
			}
		},
		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		}
	});
	
	// Register plugin
	tinymce.PluginManager.add('allshortcodes', tinymce.plugins.allshortcodes);
	
})(); 



var popups = [
	{
		'name' : 'accordion', 
		'title' : 'Shortcode Accordion', 
		'code' : '[accordion titlecolor="" titlebackground="" signcolor="" signbackground="" contentcolor="" contentbackground=""]<br/> \
		[ac-item title="your title" active=""]your content[/ac-item]<br/> \
		[ac-item title="your title" active=""]your content[/ac-item]<br/> \
		[ac-item title="your title" active=""]your content[/ac-item]<br/> \
		[ac-item title="your title" active=""]your content[/ac-item]<br/> \
		[/accordion]<br/>'
	}, {
		'name' : 'buttons', 
		'title' : 'Shortcode Button', 
		'code' : '[buttons text="READ MORE" href="" size="" class=""]<br/>'
	}, {
		'name' : 'client', 
		'title' : 'Shortcode Client', 
		'code' : '[client class="" showcarousel="" navigation="" visiblenumber="5" showdivider="" background=""]<br/> \
		[cl-item href="#" image=""]<br/> \
		[cl-item href="#" image=""]<br/> \
		[cl-item href="#" image=""]<br/> \
		[cl-item href="#" image=""]<br/> \
		[cl-item href="#" image=""]<br/> \
		[/client]<br/>'
	}, {
		'name' : 'column', 
		'title' : 'Shortcode Column', 
		'code' : '[column size="1/1"]your content[/column]<br/>'
	}, {
		'name' : 'percent_column', 
		'title' : 'Shortcode Percent Column', 
		'code' : '[percent-column width="25%" paddingright="" paddingleft=""]your content[/percent-column]<br/>'
	}, {
		'name' : 'contact_info', 
		'title' : 'Shortcode Contact Info', 
		'code' : '[contact-info size="1/1" style="" address="" phone="" email="" web=""]<br/>'
	}, {
		'name' : 'counter', 
		'title' : 'Shortcode Counter', 
		'code' : '[counter size="1/4" start="1" end="100" color="" speed="2000"]your content[/counter]<br/>'
	}, {
		'name' : 'divider', 
		'title' : 'Shortcode Divider', 
		'code' : '[divider width="" class="" color="" text="" textalign="right" textcolor="" textsize=""]<br/>'
	}, {
		'name' : 'dropcap', 
		'title' : 'Shortcode Dropcap', 
		'code' : '[dropcap type="" color="" background=""]N[/dropcap]<br/>'
	}, {
		'name' : 'faq', 
		'title' : 'Shortcode FAQ', 
		'code' : '[faq]<br/> \
		[fa-item q=""]your answer[/fa-item]<br/> \
		[fa-item q=""]your answer[/fa-item]<br/> \
		[fa-item q=""]your answer[/fa-item]<br/> \
		[/faq]<br/>'
	}, {
		'name' : 'frame', 
		'title' : 'Shortcode Frame', 
		'code' : '[frame image="" width="210" height="120" align="left" showlightbox="off" linktype="" href="" showborder="off" background="" title=""]<br/>'
	}, {
		'name' : 'h1', 
		'title' : 'Shortcode H1', 
		'code' : '[h1 icon="" subtitle=""]your title[/h1]<br/>'
	}, {
		'name' : 'h2', 
		'title' : 'Shortcode H2', 
		'code' : '[h2 icon="" subtitle=""]your title[/h2]<br/>'
	}, {
		'name' : 'h3', 
		'title' : 'Shortcode H3', 
		'code' : '[h3 icon="" subtitle=""]your title[/h3]<br/>'
	}, {
		'name' : 'h4', 
		'title' : 'Shortcode H4', 
		'code' : '[h4 icon="" subtitle=""]your title[/h4]<br/>'
	}, {
		'name' : 'h5', 
		'title' : 'Shortcode H5', 
		'code' : '[h5 icon="" subtitle=""]your title[/h5]<br/>'
	}, {
		'name' : 'h6', 
		'title' : 'Shortcode H6', 
		'code' : '[h6 icon="" subtitle=""]your title[/h6]<br/>'
	}, {
		'name' : 'highlight', 
		'title' : 'Shortcode Highlight', 
		'code' : '[highlight color="" background=""]your content[/highlight]<br/>'
	}, {
		'name' : 'list', 
		'title' : 'Shortcode List', 
		'code' : '[list icon="icon-checkmark2" color="" background=""]<br/> \
		[li]your text[/li]<br/> \
		[li]your text[/li]<br/> \
		[li]your text[/li]<br/> \
		[/list]<br/>'
	}, {
		'name' : 'message_box', 
		'title' : 'Shortcode Message Box', 
		'code' : '[message-box type="red" class=""]your content[/message-box]<br/>'
	}, {
		'name' : 'personnel', 
		'title' : 'Shortcode Personnel', 
		'code' : '[personnel name="" post="" image="" size="1/3" class="" background=""]your content[/personnel]<br/>'
	}, {
		'name' : 'portfolio', 
		'title' : 'Shortcode Portfolio', 
		'code' : '[portfolio number="3" size="1/3" column="3" category="" showcategory="" showfilter="" titlelength="30" excerptlength="0" textalign="center" showloadmore="" counter="1"]<br/>'
	}, {
		'name' : 'post', 
		'title' : 'Shortcode Post', 
		'code' : '[post number="3" size="1/3" column="3" category="" titlelength="" excerptlength="40" showimage="" showdate="" showbutton="" showloadmore="" counter="1"]<br/>'
	}, {
		'name' : 'price_table', 
		'title' : 'Shortcode Price Table', 
		'code' : '[price-table]<br/> \
		[pr-item size="1/5" width="" title="your title" price="$99" pricetext="Your Text" buttontext="SUBMIT" href="" active=""]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[/pr-item]<br/> \
		[pr-item size="1/5" width="" title="your title" price="$99" pricetext="Your Text" buttontext="SUBMIT" href="" active=""]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[/pr-item]<br/> \
		[pr-item size="1/5" width="" title="your title" price="$99" pricetext="Your Text" buttontext="SUBMIT" href="" active="active"]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[/pr-item]<br/> \
		[pr-item size="1/5" width="" title="your title" price="$99" pricetext="Your Text" buttontext="SUBMIT" href="" active=""]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[/pr-item]<br/> \
		[pr-item size="1/5" width="" title="your title" price="$99" pricetext="Your Text" buttontext="SUBMIT" href="" active=""]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[pr-text]your content[/pr-text]<br/> \
		[/pr-item]<br/> \
		[/price-table]<br/>'
	}, {
		'name' : 'progress_bar', 
		'title' : 'Shortcode Progress Bar', 
		'code' : '[progress-bar title="" titlecolor="" showtitleinside="" value="" showvalue="" barcolor="" background="" showradius=""]<br/>'
	}, {
		'name' : 'quote', 
		'title' : 'Shortcode Quote', 
		'code' : '[quote type="" color="" background="" width="" align="" textshadow=""]your content[/quote]<br/>'
	}, {
		'name' : 'row', 
		'title' : 'Shortcode Container', 
		'code' : '[row textalign="" color="" background="" image="" padding="0 0 0 0" margin="0 0 0 0" showparallax="off"]your content[/row]<br/>'
	}, {
		'name' : 'service1', 
		'title' : 'Shortcode Service1', 
		'code' : '[service1 size="1/3" title="your title" icon="" background="" buttontitle="DETAILS" href=""]your content[/service1]<br/> \
		[service1 size="1/3" title="your title" icon="" href=""]your content[/service1]<br/> \
		[service1 size="1/3" title="your title" icon="" href=""]your content[/service1]<br/>'
	}, {
		'name' : 'service2', 
		'title' : 'Shortcode Service2', 
		'code' : '[service2 size="1/3" title="your title" type="" icon="" href=""]your content[/service2]<br/> \
		[service2 size="1/3" title="your title" type="" icon="" href=""]your content[/service2]<br/> \
		[service2 size="1/3" title="your title" type="" icon="" href=""]your content[/service2]<br/>'
	}, {
		'name' : 'service3', 
		'title' : 'Shortcode Service3', 
		'code' : '[service3 size="1/4" type="" title="your title" icon="" href="" buttontext="Read More"]your content[/service3]<br/> \
		[service3 size="1/4" type="" title="your title" icon="" href="" buttontext="Read More"]your content[/service3]<br/> \
		[service3 size="1/4" type="" title="your title" icon="" href="" buttontext="Read More"]your content[/service3]<br/> \
		[service3 size="1/4" type="" title="your title" icon="" href="" buttontext="Read More"]your content[/service3]<br/>'
	}, {
		'name' : 'slider', 
		'title' : 'Shortcode Slider', 
		'code' : '[slider images="id1,id2,id3" width="210" height="120" effect="fade" align="left" showcaption="off" showborder="off" showdirection="off" showcontrol=""]<br/>'
	}, {
		'name' : 'social', 
		'title' : 'Shortcode Social', 
		'code' : '[social type="" text="" style="" class="light"]your link[/social]<br/>'
	}, {
		'name' : 'space', 
		'title' : 'Shortcode Space', 
		'code' : '[space height="40px"]<br/>'
	}, {
		'name' : 'step', 
		'title' : 'Shortcode Step', 
		'code' : '[step size="1/4" class="topleft" number="1" title="your title" icon=""]your content[/step]<br/>'
	}, {
		'name' : 'stunning', 
		'title' : 'Shortcode Stunning Text', 
		'code' : '[stunning class="" color="" background="" bordercolor=""]your content[/stunning]<br/>'
	}, {
		'name' : 'tab', 
		'title' : 'Shortcode Tab', 
		'code' : '[tab type="" titlecolor="" titlebackground="" titlebordercolor="" contentcolor="" contentbackground="" contentbordercolor=""]<br/> \
		[tab_item title="your title"]your content[/tab_item]<br/> \
		[tab_item title="your title"]your content[/tab_item]<br/> \
		[tab_item title="your title"]your content[/tab_item]<br/> \
		[tab_item title="your title"]your content[/tab_item]<br/> \
		[/tab]<br/>'
	}, {
		'name' : 'testimonial', 
		'title' : 'Shortcode Testimonial', 
		'code' : '[testimonial class="" showcarousel="" effect="scroll" navigation="" showimage="" number="" contentlength="40" color="" background="" infocolor=""]<br/>'
	}, {
		'name' : 'toggle', 
		'title' : 'Shortcode Toggle', 
		'code' : '[toggle titlecolor="" titlebackground="" signcolor="" signbackground="" contentcolor="" contentbackground=""]<br/> \
		[to-item title="your title" active=""]your content[/to-item]<br/> \
		[to-item title="your title" active=""]your content[/to-item]<br/> \
		[to-item title="your title" active=""]your content[/to-item]<br/> \
		[to-item title="your title" active=""]your content[/to-item]<br/> \
		[/toggle]<br/>'
	}, {
		'name' : 'twitter', 
		'title' : 'Shortcode Twitter', 
		'code' : '[twitter id="" consumerkey="" consumersecret="" accesstoken="" accesstokensecret="" showcarousel="" effect="fade" number="3" navigation="" showbutton="" buttontext="" color=""]<br/>'
	}, {
		'name' : 'vimeo', 
		'title' : 'Shortcode Vimeo', 
		'code' : '[vimeo video="" width="210" height="120" align="" showborder="off" autoplay="off" portrait="off" title="off" byline="off" color=""]<br/>'
	}, {
		'name' : 'youtube', 
		'title' : 'Shortcode Youtube', 
		'code' : '[youtube video="" width="210" height="120" align="left" showborder="off" autoplay="off"]<br/>'
	}
];