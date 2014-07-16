jQuery(document).ready(function( e ) {
	'use strict';

	/* Add prettyphoto to images
	================================================== */
	jQuery.fn.bindPrettyPhoto = function() {
		jQuery( 'a[data-rel^="prettyPhoto"]' ).prettyPhoto({
			hook: 'data-rel',	/* the attribute tag to use for prettyPhoto hooks. default: 'rel'. For HTML5, use "data-rel" or similar. */
			animation_speed: 'fast',
			slideshow: 3000,
			autoplay_slideshow: false,
			opacity: 0.80,
			show_title: false,
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			overlay_gallery: false,
			social_tools: false
		});
	};
	jQuery.fn.bindPrettyPhoto();


	/* Superfish menu
	================================================== */
	jQuery( 'ul.sf-menu' ).supersubs({ 
		minWidth: 18.4,	// minimum width of sub-menus in em units 
		maxWidth: ( superfish_setting.maxwidth == '' ) ? 27 : superfish_setting.maxwidth,	// maximum width of sub-menus in em units 
		extraWidth: 1	// extra width can ensure lines don't sometimes turn over due to slight rounding differences and font-family 
	}).superfish({	// main navigation init
		delay: ( superfish_setting.delay == '' ) ? 200 : superfish_setting.delay,	// one second delay on mouseout 
		animation: {
			opacity: 'show',
			height: 'show'
		},	// fade-in and slide-down animation 
		speed: ( superfish_setting.speed == '' ) ? 'normal' : superfish_setting.speed,	// faster animation speed 
		autoArrows: ( superfish_setting.autoarrows == 'true' ) ? true : false,	// generation of arrow mark-up (for submenu) 
		dropShadows: false	// drop shadows (for submenu)
	});


	/* Slogan
	================================================== */
	jQuery( '#slogan ul' ).carouFredSel({
		items: 1,
		prev: {
			button: '#slogan .slogan-next',
			key: 'left'
		},
		next: {
			button: '#slogan .slogan-prev',
			key: 'right'
		},
		responsive: true,
		scroll: {
			items: 1,
			fx: 'fade',
			duration: 500
		},
		auto: {
			timeoutDuration: ( slogan_setting.speed == '' ) ? 5000 : slogan_setting.speed
		}
	});


	/* Onepage menu effect
	================================================== */
	jQuery( '#main-nav > li > a' ).click(function(){
		var url = jQuery(this).attr( 'href' ).split( '#' )[1],
			section = jQuery( '#' + url ).offset().top;

		if ( url ) {
			if ( url === jQuery('section.row:first-child').attr( 'id' ) ) {
				jQuery( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
			} else {
				jQuery( 'html, body' ).animate( { scrollTop: section - ( ( onepage_menu.sticky == 'true' ) ? 80 : 0 ) }, 'slow' );
			}
		} else {
			window.location = jQuery(this).attr( 'href' );
		}
	});

	// add style to active menu item
	var menus = jQuery( '#main-nav > li > a' ),
		sections = menus.map(function () {
			var url = jQuery(this).attr( 'href' ).split( '#' )[1],
				section = jQuery( '#' + url );

			if ( url ) {
				if ( section.length ) { return section; }
			}
		});

	jQuery(window).scroll(function () {
		var id,
			current,
			customTop = jQuery(this).scrollTop() + jQuery( '#main-nav' ).outerHeight();

		current = sections.map(function () {
			if ( jQuery(this).offset().top < customTop ) {
				return this;
			}
		});
		current = current[ current.length - 1 ];
		id = ( current && current.length ) ? current.attr( 'id' ) : '';
		menus.filter( '[href$=#' + id + ']' ).parent().addClass( 'current-menu-item' ).siblings().removeClass( 'current-menu-item' );
	});


	/* Remove image width and height attribute
	================================================== */
	if ( jQuery(window).width() < 980 ) {
		jQuery( 'img:not(.flickr-widget img, .service-3 .icon img)' ).removeAttr( 'width' ).removeAttr( 'height' );
	}
	jQuery(window).resize(function() {
		if ( jQuery(window).width() < 980 ) {
			jQuery( 'img:not(.flickr-widget img, .service-3 .icon img)' ).removeAttr( 'width' ).removeAttr( 'height' );
		}
	});


	/* Add tooltip
	================================================== */
	jQuery( 'a[data-rel="tipsy"]' ).tipsy({
		fade: true,
		gravity: 's',
		offset: 5
	});


	/* Create select responsive menu
	================================================== */
	// DOM ready
	jQuery(function() {

		// Create the dropdown base
		jQuery( '<div><select />' ).appendTo( '#menu-wrapper > div' );

		// Create default option "Go to..."
		jQuery( '<option />', {
			'selected': 'selected',
			'value': '',
			'text': 'Go to...'
		}).appendTo( '#menu-wrapper select' );

		// Populate dropdown with menu items
		jQuery( '#menu-wrapper a' ).each(function() {
			var el = jQuery(this);
	
			if ( jQuery( el ).parents( '.sub-menu .sub-menu .sub-menu' ).length >= 1 ) {
				jQuery( '<option />', {
					'value': el.attr( 'href' ),
					'text': '- - - ' + el.text()
				}).appendTo( '#menu-wrapper select' );
			}
			else if ( jQuery( el ).parents( '.sub-menu .sub-menu' ).length >= 1 ) {
				jQuery( '<option />', {
					'value': el.attr( 'href' ),
					'text': '- - ' + el.text()
				}).appendTo( '#menu-wrapper select' );
			}
			else if ( jQuery( el ).parents( '.sub-menu' ).length >= 1 ) {
				jQuery( '<option />', {
					'value': el.attr( 'href' ),
					'text': '- ' + el.text()
				}).appendTo( '#menu-wrapper select' );
			}
			else {
				jQuery( '<option />', {
					'value': el.attr( 'href' ),
					'text': el.text()
				}).appendTo( '#menu-wrapper select' );
			}

		});

		// To make dropdown actually work
		// To make more unobtrusive: http: //css-tricks.com/4064-unobtrusive-page-changer/
		jQuery( '#menu-wrapper select' ).change(function() {
			window.location = jQuery(this).find( 'option:selected' ).val();
		});
	});


	/* Google map toggle
	================================================== */
	jQuery( '.google-map .sign-wrapper' ).click(function() {
		if ( jQuery( '.google-map' ).hasClass( 'close' ) ) {
			jQuery( '.google-map' ).removeClass('close');
		} else {
			jQuery( '.google-map' ).addClass('close');
		}
	});


	/* Scroll top
	================================================== */
	jQuery(window).scroll(function() {
		if ( jQuery(this).scrollTop() > 300 ) {
			jQuery( '#backtotop' ).fadeIn();
		} else {
			jQuery( '#backtotop' ).fadeOut();
		}
	});

	jQuery( '#backtotop, .divider-gotop' ).click(function() {
		jQuery( 'body, html' ).stop( false, false ).animate( { scrollTop: 0 }, 800 );
		return false;
	});


	/* Flickr preview
	================================================== */
	jQuery.fn.flickrImagePreview = function() {
		var flickrImage,
			xOffset = 30,
			yOffset = 10,
			winwid = jQuery(window).width();

		winwid = winwid/2;

		jQuery( 'a.flickr-image' ).hover(function( e ) {
			jQuery( 'body' ).append( '<div id="flickr-preview"><img src="' + jQuery(this).attr( 'alt' ) + '" alt="preview" /></div>' );	

			if ( e.pageX < winwid ) {
				flickrImage = ( e.pageX + xOffset );
			} else {
				flickrImage = ( e.pageX - xOffset - jQuery( '#flickr-preview img' ).width() );
			}
			jQuery( '#flickr-preview' )
				.css( 'top', ( e.pageY - yOffset ) + 'px' )
				.css( 'left', flickrImage + 'px' )
				.fadeIn( 'fast' );						
		},
		function() {
			jQuery( '#flickr-preview' ).remove();
		});

		jQuery( 'a.flickr-image' ).mousemove(function( e ) {

			if ( e.pageX < winwid ) {
				flickrImage = ( e.pageX + xOffset );
			} else {
				flickrImage = ( e.pageX - xOffset - jQuery( '#flickr-preview img' ).width() );
			}
			jQuery( '#flickr-preview' )
				.css( 'top', ( e.pageY - yOffset ) + 'px' )
				.css( 'left', flickrImage + 'px' );
		});			
	};
	jQuery.fn.flickrImagePreview();


	/* Accordion
	================================================== */
	jQuery( 'ul.pa-accordion li' ).each(function() {
		jQuery(this).children( '.accordion-content' ).css( 'height', function() { 
			return jQuery(this).innerHeight(); 
		});

		if ( jQuery(this).hasClass( 'active' ) ) {
			jQuery(this).find( '.accordion-head-sign' ).html( '&minus;' );
		} else {
			jQuery(this).find( '.accordion-head-sign' ).html( '&#43;' );
			jQuery(this).children( '.accordion-content' ).addClass( 'display-none' );
		}

		jQuery(this).children( '.accordion-head' ).bind( 'click', function() {
			jQuery(this).parent().addClass(function() {
				if ( jQuery(this).hasClass( 'active' ) ) {
					return '';
				}
				return 'active';
			});
			jQuery(this).siblings( '.accordion-content' ).slideDown();
			jQuery(this).parent().find( '.accordion-head-sign' ).html( '&minus;' );
			jQuery(this).parent().siblings( 'li' )
				.removeClass( 'active' )
				.children( '.accordion-content' )
					.slideUp()
				.end()
				.find( '.accordion-head-sign' )
					.html( '&#43;' );
		});
	});


	/* Toggle
	================================================== */
	jQuery( 'ul.pa-toggle li' ).each(function() {
		jQuery(this).children( '.toggle-content' ).css( 'height', function() { 
			return jQuery(this).innerHeight(); 
		});

		jQuery(this).children( '.toggle-content' ).css( 'display', 'none' );
		jQuery(this).find( '.toggle-head-sign' ).html( '&#43;' );

		jQuery(this).children( '.toggle-head' ).bind( 'click', function() {

			if ( jQuery(this).parent().hasClass( 'active' ) ) {
				jQuery(this).parent().removeClass( 'active' );
			} else {
				jQuery(this).parent().addClass( 'active' );
			}

			jQuery(this).find( '.toggle-head-sign' ).html(function() {
				if ( jQuery(this).parent().parent().hasClass( 'active' ) ) {
					return '&minus;';
				}
				return '&#43;';
			});
			jQuery(this).siblings( '.toggle-content' ).slideToggle();
		});
	});

	jQuery( 'ul.pa-toggle' ).find( '.toggle-content.active' ).siblings( '.toggle-head' ).trigger( 'click' );


	/* Tab
	================================================== */
	jQuery( 'ul.pa-tabs' ).each(function() {
		// get tabs
		var tab = jQuery(this).find( '> li > a' );
		tab.click(function( e ) {
			// get tab's location
			var contentLocation = jQuery(this).attr( 'href' );
			// Let go if not a hashed one
			if ( contentLocation.charAt(0) === '#' ) {
				e.preventDefault();
				// add class active
				tab.removeClass( 'active' );
				jQuery(this).addClass( 'active' );
				// show tab content & add active class
				jQuery( contentLocation ).fadeIn( 1000 ).addClass( 'active' ).siblings().hide().removeClass( 'active' );

			}
		});
	});


	/* Create equal height for portfolio item
	================================================== */
	function equalHeight( group ) {
		var tallest = 0;
		group.each(function() {
			var thisHeight = jQuery(this).height();
			if ( thisHeight > tallest ) {
				tallest = thisHeight;
			}
		});
		group.height(tallest);
	}

	if ( jQuery(document).width() > 980 && jQuery( '#port-content-wrapper > div' ).length > 1 ) {
		equalHeight( jQuery( '#port-content-wrapper > div' ) );
	}


	/* Counter
	================================================== */
	jQuery(window).scroll(function() {
		jQuery( '.counter-number.once' ).each( function() {
			if ( jQuery(this).offset().top < jQuery(window).scrollTop() + jQuery(window).outerHeight() ) {
				jQuery(this).countTo({
					onComplete: function(value) {
						jQuery(this).removeClass('once');
					}
				});
			}
		});
	});


	/* Progress bar
	================================================== */
	jQuery(window).scroll(function() {
		jQuery( '.progress-bar-wrapper.once' ).each( function() {
			if ( jQuery(this).offset().top < jQuery(window).scrollTop() + jQuery(window).outerHeight() ) {
				jQuery(this).find( '.progress-bar-meter' )
					.css({
						width: 0,
						display: 'block'
					})
					.delay( 1000 )
					.animate({
						'width': jQuery(this).find( '.value' ).text()
					},function() {
						jQuery(this).parents('.progress-bar-wrapper.once').removeClass('once');
					});
			}
		});
	});


	/* Contact form
	================================================== */
	jQuery( '#contact-form' ).submit(function() {
		jQuery( '#contact-form .error-message' ).remove();
		var formInput,
			hasError = false,
			emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
			responseField = jQuery( 'input#recaptcha_response_field' ).val(),
			challengeField = jQuery( 'input#recaptcha_challenge_field' ).val();

		jQuery( '#contact-form .requiredfield' ).each(function() {
			var fieldError,
				emailError,
				messageError;

			if ( jQuery.trim( jQuery(this).val() ) === '' ) {
				fieldError = true;
				messageError = jQuery(this).data( 'message' );
			}
			if ( jQuery(this).hasClass( 'email' ) && ! emailReg.test( jQuery.trim( jQuery(this).val() ) ) ) {
				emailError = true;
				messageError = jQuery(this).data( 'email' );
			}

			if ( fieldError == true || emailError == true ) {
				jQuery(this).parent()
					.append( '<span class="error-message">' + messageError + '</span>' )
					.find( '.error-message' )
						.width( jQuery(this).width() )
						.height( jQuery(this).height() )
						.hover(function() {
							jQuery(this).fadeOut( 300 );
						});
				jQuery(this).addClass( 'inputError' );
				hasError = true;
			}
		});

		if ( ! hasError ) {

			if ( jQuery( '#contact-recaptcha' ).hasClass( 'true' ) ) {
				jQuery.post( the_ajax_script.ajaxurl, {
					action: 'get_recaptcha',
					recaptcha_challenge_field: challengeField,
					recaptcha_response_field: responseField
				}, function( data ) {
					if ( data == 'true' ) {
						jQuery( '#contact-form #contact-submit' ).fadeOut( 'normal', function() {
							jQuery(this).parent().append( '<div class="wait"></div>' );
						});
						formInput = jQuery( '#contact-form' ).serialize();
						jQuery.post( jQuery( '#contact-form' ).attr( 'action' ), formInput, function() {
							jQuery( '#contact-form' ).slideUp( 'fast', function() {
								jQuery( '#contact-form .wait' ).slideUp( 'fast' );
								jQuery( '#contact-success-message' ).removeClass( 'display-none' );
							});
						});
					} else {
						jQuery( '.recaptcha-error' ).removeClass( 'display-none' ).effect( 'shake' );
					}
				});

			} else {

				jQuery( '#contact-form #contact-submit' ).fadeOut( 'normal', function() {
					jQuery(this).parent().append( '<div class="wait"></div>' );
				});
				formInput = jQuery( '#contact-form' ).serialize();
				jQuery.post( jQuery( '#contact-form' ).attr( 'action' ), formInput, function() {
					jQuery( '#contact-form' ).slideUp( 'fast', function() {
						jQuery( '#contact-form .wait' ).slideUp( 'fast' );
						jQuery( '#contact-success-message' ).removeClass( 'display-none' );
					});
				});
			}
		}

		return false;
	});
	
	
	/* Widget contact form
	================================================== */
	jQuery( '#widget-contact-form' ).submit(function() {
		jQuery( '#widget-contact-form .error-message' ).remove();
		var formInput,
			hasError = false,
			emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		jQuery( '#widget-contact-form .requiredfield' ).each(function() {
			var fieldError,
				emailError,
				messageError;

			if ( jQuery.trim( jQuery(this).val() ) === '' ) {
				fieldError = true;
				messageError = jQuery(this).data( 'message' );
			}
			if ( jQuery(this).hasClass( 'email' ) && ! emailReg.test( jQuery.trim( jQuery(this).val() ) ) ) {
				emailError = true;
				messageError = jQuery(this).data( 'email' );
			}

			if ( fieldError == true || emailError == true ) {
				jQuery(this).parent()
					.append( '<span class="error-message">' + messageError + '</span>' )
					.find( '.error-message' )
						.width( jQuery(this).width() )
						.height( jQuery(this).height() )
						.hover(function() {
							jQuery(this).fadeOut( 300 );
						});
				jQuery(this).addClass( 'inputError' );
				hasError = true;
			}
		});

		if ( ! hasError ) {
			jQuery( '#widget-contact-form #widget-contact-submit' ).fadeOut( 'normal', function() {
				jQuery(this).parent().append( '<div class="wait"></div>' );
			});
			formInput = jQuery(this).serialize();
			jQuery.post( jQuery(this).attr( 'action' ), formInput, function() {
				jQuery( '#widget-contact-form' ).slideUp( 'fast', function() {
					jQuery( '#widget-contact-form .wait' ).slideUp( 'fast' );
					jQuery( '#widgetcontact-success-message' ).removeClass( 'display-none' );
				});
			});
		}
		return false;
	});


	/* Ajax blog
	================================================== */
	jQuery.fn.bindAjaxBlog = function() {
		var container = jQuery(this).parents( '.content' ),
			blogInfo = container.find( '#blog-info' ),
			currentBlog = container.find( '#ajax-blog-wrapper' ),
			pageNew = jQuery(this).data( 'page' ),
			pagesidebarNew = blogInfo.data( 'pagesidebar' ),
			blogcatNew = blogInfo.data( 'blogcat' ),
			blognumfetchNew = blogInfo.data( 'blognumfetch' ),
			blogthumbtitleonoffNew = blogInfo.data( 'blogthumbtitleonoff' ),
			bloglentitleNew = blogInfo.data( 'bloglentitle' ),
			blogthumbexcerptonoffNew = blogInfo.data( 'blogthumbexcerptonoff' ),
			bloglenexcerptNew = blogInfo.data( 'bloglenexcerpt' ),
			blogstyleNew = blogInfo.data( 'blogstyle' ),
			blogcompletecontentonoffNew = blogInfo.data( 'blogcompletecontentonoff' ),
			blogprettyphotoonoffNew = blogInfo.data( 'blogprettyphotoonoff' ),
			bloginfoauthoronoffNew = blogInfo.data( 'bloginfoauthoronoff' ),
			bloginfotagonoffNew = blogInfo.data( 'bloginfotagonoff' ),
			bloginfocommentonoffNew = blogInfo.data( 'bloginfocommentonoff' ),
			blogcontinuelinkonoffNew = blogInfo.data( 'blogcontinuelinkonoff' );

		jQuery( 'html, body' ).animate({ scrollTop: currentBlog.offset().top - 100 }, 200, 'linear', function() {
				currentBlog.fadeOut( 500, function(){
						currentBlog.html('<span class="spinner icon-spinner6 spin"></span>').fadeIn( 10 );
					});
			});

		jQuery.post( the_ajax_script.ajaxurl, {
				action: 'get_blog',
				pagesidebar: pagesidebarNew,
				page: pageNew,
				blogcat: blogcatNew,
				blognumfetch: blognumfetchNew,
				blogthumbtitleonoff: blogthumbtitleonoffNew,
				bloglentitle: bloglentitleNew,
				blogthumbexcerptonoff: blogthumbexcerptonoffNew,
				bloglenexcerpt: bloglenexcerptNew,
				blogstyle: blogstyleNew,
				blogcompletecontentonoff: blogcompletecontentonoffNew,
				blogprettyphotoonoff: blogprettyphotoonoffNew,
				bloginfoauthoronoff: bloginfoauthoronoffNew,
				bloginfotagonoff: bloginfotagonoffNew,
				bloginfocommentonoff: bloginfocommentonoffNew,
				blogcontinuelinkonoff: blogcontinuelinkonoffNew
			}, function( data ) {
				pageNew = '';
				currentBlog.hide().html( data ).fadeIn( 500 );
				jQuery().bindPrettyPhoto();
				jQuery().bindNivo();
				currentBlog.slideDown( 200 );
			}
		);
	};

	jQuery(document).on( 'click', '#pagination.ajax a', function() {
		jQuery(this).bindAjaxBlog();
	});


	/* Ajax loadmore post
	================================================== */
	jQuery.fn.bindLoadmorePost = function() {
		var container = jQuery(this).parents( '.posts-shortcode-wrapper' ),
			postInfo = container.find( '#post-info' ),
			itemsWrap = container.find( '.posts-shortcode ul' ),
			countNew = parseInt( postInfo.data( 'count' ), 10 ),
			offsetNew = parseInt( postInfo.data( 'offset' ), 10 ),
			showimageNew = postInfo.data( 'showimage' ),
			showdateNew = postInfo.data( 'showdate' ),
			counterNew = parseInt( postInfo.data( 'counter' ), 10 ),
			categoryNew = postInfo.data( 'category' ),
			titlelengthNew = parseInt( postInfo.data( 'titlelength' ), 10 ),
			excerptlengthNew = parseInt( postInfo.data( 'excerptlength' ), 10 );
	
		jQuery.post( the_ajax_script.ajaxurl, {
				action: 'loadmore_post',
				offset: offsetNew,
				counter: counterNew,
				showimage: showimageNew,
				showdate: showdateNew,
				category: categoryNew,
				titlelength: titlelengthNew,
				excerptlength: excerptlengthNew
			}, function( data ) {
				postInfo.data( 'offset', offsetNew + counterNew );
				jQuery( data ).hide().appendTo( itemsWrap ).fadeIn( 300 );
				container.find( '.spinner' ).removeClass( 'spin' );
				jQuery().bindNivo();
				if ( offsetNew + counterNew >= countNew ) {
					container.find( '#loadmore-post' ).parent().fadeOut();
				}
			}
		);
	};

	jQuery( '#loadmore-post' ).click(function() {
		jQuery(this).find( '.spinner' ).addClass( 'spin' );
		jQuery(this).bindLoadmorePost();
	});


	/* Ajax loadmore portfolio
	================================================== */
	jQuery.fn.bindLoadmorePortfolio = function() {
		var container = jQuery(this).parents( '.portfolio-shortcode-wrapper' ),
			portfolioInfo = container.find( '#port-info' ),
			itemsWrap = container.find( '.portfolio-item-wrapper' ),
			countNew = parseInt( portfolioInfo.data( 'count' ), 10 ),
			offsetNew = parseInt( portfolioInfo.data( 'offset' ), 10 ),
			counterNew = parseInt( portfolioInfo.data( 'counter' ), 10 ),
			singlemodeNew = portfolioInfo.data( 'singlemode' ),
			sizeNew = portfolioInfo.data( 'size' ),
			columnNew = parseInt( portfolioInfo.data( 'column' ), 10 ),
			categoryNew = portfolioInfo.data( 'category' ),
			showcategoryNew = portfolioInfo.data( 'showcategory' ),
			titlelengthNew = parseInt( portfolioInfo.data( 'titlelength' ), 10 ),
			excerptlengthNew = parseInt( portfolioInfo.data( 'excerptlength' ), 10 ),
			textalignNew = portfolioInfo.data( 'textalign' );

		jQuery.post( the_ajax_script.ajaxurl, {
				action: 'loadmore_portfolio',
				offset: offsetNew,
				counter: counterNew,
				singlemode: singlemodeNew,
				size: sizeNew,
				column: columnNew,
				category: categoryNew,
				showcategory: showcategoryNew,
				titlelength: titlelengthNew,
				excerptlength: excerptlengthNew,
				textalign: textalignNew
			}, function( data ) {
				portfolioInfo.data( 'offset', offsetNew + counterNew );
				jQuery( data ).hide().appendTo( itemsWrap ).fadeIn( 300 );
				container.find( '.spinner' ).removeClass( 'spin' );
				jQuery().bindPrettyPhoto();
				jQuery().bindNivo();
				itemsWrap.masonry( 'reload' );
				if ( offsetNew + counterNew >= countNew ) {
					container.find( '#loadmore-portfolio' ).parent().fadeOut();
				}
			}
		);
	};

	jQuery( '#loadmore-portfolio' ).click(function() {
		jQuery(this).find( '.spinner' ).addClass( 'spin' );
		jQuery(this).bindLoadmorePortfolio();
	});


	/* Ajax outline portfolio
	================================================== */
	jQuery.fn.bindOutlinePortfolio = function() {
		var itemId = jQuery(this).data( 'id' ),
			container = jQuery( '#outlineinfo' );

		jQuery.post( the_ajax_script.ajaxurl, {
			action: 'outline_portfolio',
			id: itemId
			}, function( data ) {
				jQuery( data ).appendTo( container );
				container.find('.spinner').removeClass('spin').fadeOut( 10 );
				container.slideDown( 300, 'linear', function() {
					jQuery( 'html, body' ).animate( { scrollTop: container.offset().top - 100 }, 'slow' );
				});
				container.find( '.close' ).bind( 'click', function() {
					container.slideUp( 300, 'linear', function() {
						/*jQuery(this).html('');*/
					});
				});
	
				jQuery().bindNivo();
				jQuery().bindPrettyPhoto();
			}
		);
	};

	jQuery(document).on( 'click', '.outline-port', function( e ) {
		e.preventDefault();
		var container = jQuery( '#outlineinfo' );
		/*jQuery( '#outlineinfo' ).slideUp( 300 ).html('');*/
		jQuery( 'html, body' ).animate({ scrollTop: container.offset().top - 100 }, 200, 'linear', function() {
			container.fadeOut( 500, function(){
					jQuery(this).html('<span class="spinner icon-spinner6 spin"></span>').fadeIn( 10 );
				});
		});
		jQuery(this).bindOutlinePortfolio();
	});

});


jQuery(window).load(function() {
	'use strict';

	/* Init parallax sections
	================================================== */
	var i,
		para = jQuery( '.parallax' );
	for ( i = 0; i < para.length; i++ ) {
		jQuery( para[ i ] ).parallax( '50%', '0.3' );
	}


	/* Init sliders
	================================================== */
	jQuery.fn.bindNivo = function() {
		jQuery( '.nivoSlider' ).nivoSlider({
			effect: 'fade',
			directionNav: true,
			directionNavHide: true,
			controlNav: false
		});
	};
	jQuery.fn.bindNivo();

});