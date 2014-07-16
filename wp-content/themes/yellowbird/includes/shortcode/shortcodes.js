(function() {

	var popups = [ 'accordion', 'buttons', 'client', 'column', 'percent_column', 'contact_info', 'counter', 'divider', 'dropcap', 'faq', 'frame', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'highlight', 'list', 'message_box', 'personnel', 'portfolio', 'post', 'price_table', 'progress_bar', 'quote', 'row', 'service1', 'service2', 'service3', 'slider', 'social', 'space','step', 'stunning', 'tab', 'testimonial', 'toggle', 'twitter', 'vimeo', 'youtube' ];

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
			
			jQuery.each(popups, function(index, popup) {
				
				// Register example button
				ed.addButton(popup, {
					title : 'Shortcode ' + popup.replace('_',' '),
					image : url + '/images/' + popup.replace('_','-') + '.png',
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 112;
						
						tb_show(popup.replace('_',' '), url + '/popup.php?popup=' + popup + '&width=' + W + '&height=' + H);
						jQuery(window).resize(function() { 
							jQuery('#TB_ajaxContent').width('auto');
						});
					}
				});

				// executes this when the DOM is ready
				jQuery(function(){
					
					var form = jQuery('#shortcode-form-'+popup);
					
					form.find('a.remove-clone').livequery('click', function() {
						jQuery(this).parents('table').remove();
						return false;
					});
					
					form.find('#shortcode-clone').livequery('click', function(){
						jQuery('#sample-clone').clone().appendTo('#wrapper-clone').removeClass('display-none').attr('id','');
					});
					
					// handles the click event of the submit button
					form.find('#shortcode-submit').livequery('click', function(){
							
						var shortcode = '[' + popup.replace('_','-');
						
						jQuery('#shortcode-table .short-input').not('textarea').each(function() {
							
							var index = jQuery(this).attr('id');
							var def   = jQuery(this).attr('data-rel');
							var value = jQuery(this).val();
							
							// attaches the attribute to the shortcode only if it's different from the default value
							if ( value !== def )
								shortcode += ' ' + index + '="' + value + '"';
								
						});
						
						var content = jQuery('#shortcode-table textarea.short-input').val();
						if (content && content != '')
						shortcode += ']' + content;
						else
						shortcode += ']<br/>';
						
							// create child shortcode
							jQuery('.table-clone').not('.display-none').each(function() {
								
								shortcode += '[' + jQuery('#pa_cshortcode').text();
						
								jQuery(this).find('.short-input').not('textarea').each(function() {
									
									var cindex = jQuery(this).attr('id');
									var cdef   = jQuery(this).attr('data-rel');
									var cvalue = jQuery(this).val();
									
									// attaches the attribute to the shortcode only if it's different from the default value
									if ( cvalue !== cdef )
										shortcode += ' ' + cindex + '="' + cvalue + '"';
										
								});
								
								var ccontent = jQuery('#wrapper-clone textarea.short-input').val();
								if (ccontent && ccontent != '')
								shortcode += ']' + ccontent + '[/' + jQuery('#pa_cshortcode').text() + ']<br/>';
								else
								shortcode += ']<br/>';
							
							});
						
						if (jQuery('#pa_close').text() == 'true')
							shortcode += '[/' + popup.replace('_','-') + ']<br/>';
						
						// inserts the shortcode into the active editor
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
						
						// closes Thickbox
						tb_remove();
					});
				});
				
			});
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