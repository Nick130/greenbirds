jQuery(document).ready(function() {
	'use strict';

	/* Menu element effects
	================================================== */
	jQuery( '#welcome-section' ).show().siblings().hide();

	// Height function for tab
	function equalHeight() {
		var a = jQuery( '.custom-form' ).height(),
			b = jQuery( '.panelsidebar' ).height();
			
		if ( b > a ) {
			jQuery( '.custom-form' ).css( 'min-height', b );
		} else {
			jQuery( '.panelsidebar' ).css( 'min-height', b );
		}
	}

	// Accordion
	jQuery( 'ul.pa-accordion li' ).each(function() {
		jQuery(this).children( '.accordion-content' ).css( 'height', function() { 
			return jQuery(this).height(); 
		});

		if ( jQuery(this).index() > 0 ) {
			jQuery(this).children( '.accordion-content' ).css( 'display', 'none' );
		} else {
			jQuery(this).children( '.accordion-head' ).addClass( 'active' );
		}

		jQuery(this).children( '.accordion-head' ).bind( 'click', function() {
			jQuery(this).children().addClass(function() {
				if ( jQuery(this).hasClass( 'active' ) ) {
					return '';
				}
				return 'active';
			});
			
			jQuery(this).parent().siblings( 'li' ).children( '.accordion-content' ).slideUp();
			jQuery(this).parent().siblings( 'li' ).find( '.active' ).removeClass( 'active' );
			jQuery(this).siblings( '.accordion-content' ).slideDown(function() {
				equalHeight();
			});
		});
	});

	// Tab
	jQuery( 'ul.tabs' ).each(function() {

		var tab = jQuery(this).find( '> li > a' );

		tab.click(function( e ) {

			var content = jQuery(this).html(),
				location = jQuery(this).attr( 'href' );

			if ( location.charAt(0) == '#' ) {
				e.preventDefault();

				tab.removeClass( 'active' );
				jQuery(this).addClass( 'active' );

				jQuery( location ).fadeIn( 1000 ).addClass( 'active' ).siblings().hide().removeClass( 'active' );
				jQuery( location ).find( 'h2' ).html( content );

				equalHeight();
			}
		});
	});


	/* Radio and Checkbox effects
	================================================== */
	var radiolabels = jQuery( '.custom-form input:radio' ).prev( 'label' ),
		checklabels = jQuery( '.custom-form input:checkbox' ).siblings( 'label' );

	// Radio inputs
	jQuery.each( radiolabels, function() {
		jQuery(this).addClass( 'radioarea' );
		jQuery(this).click(function() {
			jQuery(this).removeClass( 'radioarea' ).addClass( 'radioareachecked' );
			jQuery(this).siblings( 'label' ).removeClass( 'radioareachecked' ).addClass( 'radioarea' );
		});
	});

	// Checkbox inputs
	jQuery.each( checklabels, function() {
		jQuery(this).addClass( 'checkboxarea' );
		jQuery(this).click(function() {
			if ( jQuery(this).hasClass( 'checkboxarea' ) ) {
				jQuery(this).removeClass( 'checkboxarea' ).addClass( 'checkboxareachecked' );
			} else {
				jQuery(this).removeClass( 'checkboxareachecked' ).addClass( 'checkboxarea' );
			}
		});
	});

	jQuery( '.custom-form input:radio:checked' ).prev( 'label' ).removeClass( 'radioarea' ).addClass( 'radioareachecked' );
	jQuery( '.custom-form input:checkbox:checked' ).siblings( 'label' ).removeClass( 'checkboxarea' ).addClass( 'checkboxareachecked' );


	/* Ajax save theme option
	================================================== */
	jQuery( '#pa-panel-option' ).submit(function() {

		jQuery( '.paneloverlay' ).addClass( 'active' );
		var p = jQuery( '.paneloverlay p' );

		jQuery.post( ajaxurl, jQuery(this).serialize(), function( data ) {

			if ( data != 'true' ) {
				p.removeClass( 'loading' ).html( p.data( 'fail' ) );
			} else {
				p.removeClass( 'loading' ).html( p.data( 'success' ) );
			}	

			jQuery( '.paneloverlay' ).delay( 500 ).fadeOut( 300, 'linear', function() { 
				jQuery(this).removeClass( 'active' ).removeAttr( 'style' );
				p.addClass( 'loading' ).html( '' );
			});
		});

		return false;
	});


	/* Create sortable social network
	================================================== */
	jQuery.fn.bindSocialSort = function() {
		if ( jQuery( '#socialnetworksort' ).length < 1 ) {
			return false;
		}
		var i,
			val = jQuery( '#socialnetworksort' ).val().split( ',' ),
			parent = jQuery( '#socialnetworksort' ).parent();

		for ( i = 0; i < val.length; i++ ) {
			jQuery( '#' + val[ i ] + 'network' ).parent().appendTo( parent );
		}
	};
	jQuery.fn.bindSocialSort();

	jQuery( '#socialnetwork-section > div:gt(1)' ).sortable({
		items: 'div.row',
		containment: 'parent',
		tolerance: 'pointer',
		forcePlaceholderSize: true,
		update: function() {
					var a = [];
					jQuery(this).find( '> div input[type="text"]' ).each( function() {
						a.push( jQuery(this).attr( 'id' ).replace( 'network', '' ) );
					});
					jQuery(this).find( '#socialnetworksort' ).val( a );
				}
	});


	/* Select Icon
	================================================== */
	jQuery('#example-icon').addClass( jQuery( '.select-font-icon' ).val() );
	
	jQuery( '.select-font-icon' ).live( 'click', function() {
		jQuery(this).siblings().toggle();
	});
	jQuery( '.font-icon span' ).live( 'click', function() {
		var className = jQuery(this).attr( 'class' );
		jQuery(this).siblings().removeClass( 'active' );
		jQuery(this).parents( 'label' ).siblings().removeClass();
		jQuery(this).addClass( 'active' ).parent().siblings( 'select' ).find( 'option' ).val( className ).html( className );
		jQuery(this).parents( 'label' ).siblings().addClass( className );
		jQuery(this).parent().toggle();
	});


	/* Upload Button for images, gallery, font
	================================================== */
	jQuery( '.upload-button.image, .upload-button.gallery' ).each(function() {
		var value = jQuery(this).siblings( '.upload-text' ).val();
		if ( value != '' ) {
			jQuery(this).addClass( 'full' );
		}
	});

	jQuery( '.upload-button' ).live( 'click', function( event ) {
		var file_frame,
			attachment,
			button = jQuery(this),
			image = button.parent().siblings( '.example-image' ),
			text = button.siblings( '.upload-text' ),
			font = button.parent().siblings( '#fontadd' );

		if ( button.hasClass( 'full' ) ) {
			text.val( '' );
			image.hide();
			button.removeClass( 'full' );
			if ( button.hasClass( 'button-primary' ) ) {
				button.val( 'Upload' );
			}

		} else {

			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery(this).data( 'title' ),
				button: {
					text: jQuery(this).data( 'button' )
				},
				library: { 
					type : ( button.hasClass( 'font' ) ? 'application/javascript' : 'image' )
				},
				multiple: ( button.hasClass( 'gallery' ) ? true : false )  // Set to true to allow multiple files to be selected
			});

			if ( button.hasClass( 'image' ) ) {

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get( 'selection' ).first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					text.val( attachment.id );
					image.html( '<img src="' + attachment.url + '" alt="" />' ).show();
					button.addClass( 'full' );
					if ( button.hasClass( 'button-primary' ) ) {
						button.val( 'Clear' );
					}
				});

			} else if ( button.hasClass( 'gallery' ) ) {

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					var ids = '',
						selection = file_frame.state().get( 'selection' );

					selection.map(function( attachment ) {
						attachment = attachment.toJSON();

						// Do something with attachment.id and/or attachment.url here
						ids += attachment.id + ',';
					});
					text.val( ids.substring( 0, ids.length - 1 ) );
					button.addClass( 'full' );
					if ( button.hasClass( 'button-primary' ) ) {
						button.val( 'Clear' );
					}
				});

			} else if ( button.hasClass( 'font' ) ) {

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					var font_url = '',
						selection = file_frame.state().get( 'selection' );

					selection.map(function( attachment ) {
						attachment = attachment.toJSON();

						// Do something with attachment.id and/or attachment.url here
						font_url = attachment.url;
						text.val( font_url );

					});
					jQuery.get( font_url, function( data ) {
						var start_name = data.indexOf( '"font-family":"' ) + 15,
							end_name = data.indexOf( '"', start_name + 1 ),
							font_name = data.substring( start_name, end_name );
						font.val( font_name );
						jQuery( '.add-font' ).trigger( 'click' );

					});
				});
			}

			// Finally, open the modal
			file_frame.open();
		}
	});


	/* Font element effects
	================================================== */
	// Add script element for cufon fonts in <head>
	jQuery( '#fonth option' ).each(function() {

		var cufon_font = jQuery(this).val().split( '|' ),
			address_script = document.createElement( 'script' );

		if ( cufon_font[1] == 'cufonfont' ) {
			address_script.type = 'text/javascript';
			address_script.src = cufon_font[2];
			document.getElementsByTagName( 'head' )[0].appendChild( address_script );
		}
	});

	// Creat example font viewer on load page
	jQuery( '#font' ).click(function () {

		jQuery( '#fontfamily-section select' ).each(function() {
			jQuery(this).trigger( 'change' );
		});

	});

	// Creat example font viewer on change option
	jQuery( '#fontfamily-section select' ).change(function() {

		var url,
			target_id,
			cufon_script,
			font_family = jQuery(this).find( 'option:selected' ).val().split( '|' );

		jQuery(this).siblings( 'link' ).remove();
		jQuery( '#' + target_id + '-script' ).remove();
		jQuery(this).siblings( '.font-example' ).html( 'The Sample Text' ).css( 'font-family', '' );

		if ( font_family[1] == 'googlefont' ) {

			url = 'http://fonts.googleapis.com/css?family=' + font_family[0];
			jQuery(this).siblings( 'link' ).attr( 'href', url );
			jQuery(this).siblings( '.font-example' ).css( 'font-family', font_family[0] ).after( '<link href="' + url + '" rel="stylesheet" type="text/css">' );

		} else {

			target_id = jQuery(this).attr( 'id' );

			if ( font_family[0] != '' ) {

				cufon_script = document.createElement( 'script' );
				cufon_script.innerHTML = 'Cufon.replace("#' + target_id + '-example", { fontFamily:"' + font_family[0] + '" })';
				cufon_script.type = 'text/javascript';
				cufon_script.id = target_id + '-script';
				document.getElementsByTagName( 'head' )[0].appendChild( cufon_script );
			}
		}
	});


	/* New title for mce buton
	================================================== */
	// create new title for mce buton
	jQuery(window).bind( 'load', function() {
		jQuery( '.mceButton.mceButtonEnabled' ).each(function() {
			var title = jQuery(this).attr( 'title' );
			jQuery(this).append( '<span class="stylish-title">' + title + '</span>' );
		});
		jQuery( '.mceButton.mceButtonEnabled' ).attr( 'title', '' );
	});


	/* Call colorpicker for inputs
	================================================== */
	jQuery( 'input.coloring' ).livequery( 'focusin', function() {
		jQuery(this).ColorPicker({
			onSubmit: function( hsb, hex, rgb, el ) {
				jQuery( el ).val( '#' + hex );
				jQuery( el ).ColorPickerHide();
				/*jQuery( el ).css( 'background-color', '#' + hex );*/
			},
			onBeforeShow: function() {
				jQuery(this).ColorPickerSetColor( this.value );
			}
		});
	})
	.bind( 'keyup', function() {
		jQuery(this).ColorPickerSetColor( this.value );
	});
	
	// Create colored inputs
	/*jQuery( 'input.coloring' ).each(function () {
		jQuery(this).css( 'background-color', jQuery(this).val() );
	});*/


	/* Post thumbnail type input text
	================================================== */
	jQuery(window).bind( 'load', function() {
		jQuery( '#postinthumbtype, #postthumbtype, #portinthumbtype, #portthumbtype, #portthumbimage' ).trigger( 'change' );
	});

	jQuery( '#postinthumbtype, #postthumbtype, #portinthumbtype, #portthumbtype' ).change(function() {
		var value = jQuery(this).val(),
			parent = jQuery(this).parent(),
			id = jQuery(this).attr( 'id' ),
			elm = '#' + id.replace( 'type', value );

		if ( jQuery( elm ).length != 0 ) {
			jQuery( elm ).parents( '.row' ).slideDown( 300 ).siblings( '.row' ).not( parent ).slideUp( 300 );
		} else {
			jQuery(this).parents( '.row' ).siblings( '.row' ).not( parent ).slideUp( 300 );
		}
	});


	/* Portfolio thumbnail image url input text
	================================================== */
	jQuery( '#portthumbimage' ).change(function() {
		var value = jQuery(this).val();
		if ( value == 'url' || value == 'picture' || value == 'video' ) {
			jQuery( '#portthumbimageurl' ).parent().slideDown(300);
		} else {
			jQuery( '#portthumbimageurl' ).parent().slideUp(300);
		}
	});


	/* Slider link type
	================================================== */
	jQuery(window).bind( 'load', function() {
		jQuery( '#sliderlinktype' ).trigger( 'change' );
	});
	jQuery( '#sliderlinktype' ).change(function() {
		var value = jQuery( '#sliderlinktype' ).val(),
			parent = jQuery( '#sliderlinktype' ).parent();
			
		if ( value == 'url' || value == 'video' ) {
			jQuery( '#sliderlink' + value ).parent().slideDown( 300 ).siblings( '.row' ).not( parent ).slideUp( 300 );
		} else {
			jQuery( '#sliderlinkurl, #sliderlinkvideo' ).parent().slideUp( 300 );
		}
	});


	/* Hide portfolio/gallery size option for 1/3 & 1/4 on load
	================================================== */
	jQuery(window).bind( 'load', function() {
		if ( jQuery( '.custom-form #pagesidebar label.radioareachecked' ).siblings( 'input' ).val() == 'both' ) {
			// hide portfolio size option for 1/3 & 1/4
			jQuery( '#port-size select option[value="13"]' ).hide();
			jQuery( '#port-size select option[value="14"]' ).hide();
			jQuery( '#gallery-size select option[value="13"]' ).hide();
			jQuery( '#gallery-size select option[value="14"]' ).hide();
		}
	});

	// hide portfolio/gallery size option for 1/3 & 1/4 on sidebar click
	jQuery( '.custom-form #pagesidebar label' ).click(function () {
		if ( jQuery(this).siblings( 'input' ).val() == 'both' ) {
			// hide portfolio size option for 1/3 & 1/4
			jQuery( '#port-size select option[value="13"]' ).hide();
			jQuery( '#port-size select option[value="14"]' ).hide();
			jQuery( '#gallery-size select option[value="13"]' ).hide();
			jQuery( '#gallery-size select option[value="14"]' ).hide();
		} else {
			// show portfolio size option for 1/3 & 1/4
			jQuery( '#port-size select option[value="13"]' ).show();
			jQuery( '#port-size select option[value="14"]' ).show();
			jQuery( '#gallery-size select option[value="13"]' ).show();
			jQuery( '#gallery-size select option[value="14"]' ).show();
		}
	});


	/* Template option effects
	================================================== */
	jQuery(window).bind( 'load', function() {
		jQuery( 'select#page_template' ).trigger( 'change' );
	});
	// show/hide page option based on template on change
	jQuery( 'select#page_template' ).change(function () {
		var value = jQuery(this).val();
		value = value.replace( 'page-', '' ).replace( '.php', '' );
		
		jQuery( '#pageoption-section' ).fadeIn().siblings().hide();
		jQuery( '.pagelength-wrapper' ).parent().hide();
			
		if ( 'blog' == value || 'portfolio' == value || 'contact' == value || 'gallery' == value ) {
			jQuery( 'a[href="#' + value + 'pageoption-section"]' ).fadeIn().parent().siblings().children().not( '.general' ).hide();
		} else {
			jQuery( '.pagelength-wrapper' ).parent().show();
			jQuery( 'a[href="#pageoption-section"]' ).fadeIn().parent().siblings().children().not( '.general' ).hide();
		}
	});


	/* Set/Select sidebar
	================================================== */
	// for sidebar toggle on load
	jQuery(window).bind( 'load', function() {
		if ( jQuery( '.custom-form label.setsidebar.radioareachecked' ).hasClass( 'sidebarright' ) ) {
			jQuery( '.sidebar-selection-right' ).show();
			jQuery( '.sidebar-selection-left' ).hide();
		} else if ( jQuery( '.custom-form label.setsidebar.radioareachecked' ).hasClass( 'sidebarleft' ) ) {
			jQuery( '.sidebar-selection-right' ).hide();
			jQuery( '.sidebar-selection-left' ).show();
		} else if ( jQuery( '.custom-form label.setsidebar.radioareachecked' ).hasClass( 'sidebarboth' ) ) {
			jQuery( '.sidebar-selection-right, .sidebar-selection-left' ).show();
		} else {
			jQuery( '.sidebar-selection-right, .sidebar-selection-left' ).hide();
		}
	});

	// for sidebar toggle on click
	jQuery( '.custom-form label.setsidebar' ).click(function () {
		if ( jQuery(this).hasClass( 'sidebarright' ) ) {
			jQuery( '.sidebar-selection-right' ).slideDown( 300 ).siblings( '.sidebar-selection-left' ).slideUp( 300 );
		} else if ( jQuery(this).hasClass( 'sidebarleft' ) ) {
			jQuery( '.sidebar-selection-right' ).slideUp( 300 ).siblings( '.sidebar-selection-left' ).slideDown( 300 );
		} else if ( jQuery(this).hasClass( 'sidebarboth' ) ) {
			jQuery( '.sidebar-selection-right, .sidebar-selection-left' ).slideDown( 300 );
		} else {
			jQuery( '.sidebar-selection-right, .sidebar-selection-left' ).slideUp( 300 );
		}
	});


	/* Copyright effects
	================================================== */
	jQuery(window).bind( 'load', function() {
		if ( jQuery( '.copyright-left-right' ).hasClass( 'radioareachecked' ) ) {
			jQuery( '.copybox1' ).hide();
			jQuery( '.copybox2' ).show();
		} else {
			jQuery( '.copybox2' ).hide();
			jQuery( '.copybox1' ).show();
		}
	});

	// Copyright toggle on click
	jQuery( '.custom-form .copyright-left-right' ).click(function () {
		jQuery( '.copybox1' ).slideUp( 300 );
		jQuery( '.copybox2' ).slideDown( 300 );
	});
	jQuery( '.custom-form .copyright-middle' ).click(function () {
		jQuery( '.copybox2' ).slideUp( 300 );
		jQuery( '.copybox1' ).slideDown( 300 );
	});


	/* Create sidebar item
	================================================== */
	jQuery( '.add-sidebar' ).click(function() {

		var clone_item = jQuery(this).parent().siblings( '#added-sidebar-wrapper' ).find( '.sample-sidebar-item' ).clone( true ),
			clone_val = jQuery(this).siblings( 'input#sidebaradd' ).val(),
			a = jQuery(this).siblings( 'input#sidebaraddvalues' ).val();

		if ( clone_val == '' ) {
			return;
		}
		a = jQuery(this).siblings( 'input#sidebaraddvalues' ).val();
		a = a + clone_val + '|' ;
		jQuery(this).siblings( 'input#sidebaraddvalues' ).val( a );

		if ( clone_val == '' ) {
			return;
		}
		clone_item.removeClass( 'sample-sidebar-item' ).addClass( 'added-sidebar-item' );
		clone_item.find( 'input' ).attr( 'name', function() {
			return jQuery(this).attr( 'id' );
		});
		clone_item.find( 'input' ).attr( 'value', clone_val );
		clone_item.find( '.added-sidebar-item-title' ).html( clone_val );
		jQuery( '#added-sidebar-wrapper' ).append( clone_item );
		jQuery( '.added-sidebar-item' ).slideDown();

		jQuery(this).siblings( 'input#sidebaradd' ).val( '' );
	});
	jQuery( '.added-sidebar-item' ).css( 'display', 'block' );
	jQuery( '.added-sidebar-item-del' ).click(function() {

		var elem = jQuery(this),
			parent = jQuery(this).parents( '#added-sidebar-wrapper' );

			jQuery.confirm({
			'title'	  : parent.data( 'title' ),
			'message'	: parent.data( 'message' ),
			'buttons'	: {
			'Yes'		: {
			'class'	  : 'confirm-yes',
			'action'	 : function() {

								var a = elem.siblings( 'input' ).val() + '|',
									b = parent.siblings( 'label' ).children( '#sidebaraddvalues' ).val(),
									c = b.replace( a, '' );
									
								parent.siblings( 'label' ).children( '#sidebaraddvalues' ).val( c );
								elem.parent().slideUp( 300, function() {
									jQuery(this).remove();
								});
							}
						},
			'No'		 : {
			'class'	  : 'confirm-no',
			'action'	 : function() {}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	});


	/* Create font item
	================================================== */
	jQuery( '.add-font' ).click(function() {

		var clone_item = jQuery(this).siblings( '#added-font-wrapper' ).find( '.sample-font-item' ).clone( true ),
			clone_val = jQuery(this).siblings( 'input#fontadd' ).val(),
			clone_path = jQuery(this).siblings( 'label' ).children( 'input#fontaddpath' ).val(),
			a = jQuery(this).siblings( 'input#fontaddvalues' ).val(),
			b = clone_val + '~' + clone_path + '|';

		a = a + b;
		jQuery(this).siblings( 'input#fontaddvalues' ).val( a );

		if ( clone_val == '' ) { return; }
		clone_item.removeClass( 'sample-font-item' ).addClass( 'added-font-item' );
		clone_item.find( 'input' ).attr( 'name', function() {
			return jQuery(this).attr( 'id' );
		});
		clone_item.find( 'input' ).attr( 'value', b );
		clone_item.find( '.added-font-item-title' ).html( clone_val );
		jQuery( '#added-font-wrapper' ).append( clone_item );
		jQuery( '.added-font-item' ).slideDown();

		jQuery(this).siblings( '#fontadd' ).val( '' );
		jQuery(this).siblings( 'label' ).children( 'input#fontaddpath' ).val( '' );
	});
	jQuery( '.added-font-item' ).css( 'display', 'block' );
	jQuery( '.added-font-item-del' ).click(function() {

		var elem = jQuery(this),
			parent = jQuery(this).parents( '#added-font-wrapper' );

			jQuery.confirm({
			'title'	  : parent.data( 'title' ),
			'message'	: parent.data( 'message' ),
			'buttons'	: {
			'Yes'		: {
			'class'	  : 'confirm-yes',
			'action'	 : function() {

								var a = elem.siblings( 'input' ).val(),
									b = parent.siblings( '#fontaddvalues' ).val(),
									c = b.replace( a, '' );

								parent.siblings( '#fontaddvalues' ).val( c );
								elem.parent().slideUp( 300, function() {
									jQuery(this).remove();
								});
							}
						},
			'No'		 : {
			'class'	  : 'confirm-no',
			'action'	 : function() {}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	});

});