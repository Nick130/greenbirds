jQuery(document).ready(function() { 
	"use strict";

	// Decide to show select-image-none element for each image chooser
	jQuery('.image-picker').each(function() {
		if ( jQuery(this).find('.selected-image ul li').length == 1 ) {
			jQuery(this).find('.selected-image').addClass('empty');
		}
	});

	// Confirm for delete button
	jQuery('.unpick-image').click(function(){
		jQuery(this).bindImagePickerUnpick();
	});
	jQuery.fn.bindImagePickerUnpick = function(){

		var a,
			elem = jQuery(this),
			parent = elem.parents('.selected-image');

			jQuery.confirm({
			'title'	  : parent.data('title'),
			'message'	: parent.data('message'),
			'buttons'	: {
			'Yes'		: {
			'class'	  : 'confirm-yes',
			'action'	 : function(){

								elem.parents('.slider-image-init').fadeOut(200,function(){
									jQuery(this).remove();

									a = '';
									parent.find('li:not(".default") img').each(function(){
										a += jQuery(this).data('id') + ',';
									});
									parent.parents('.image-picker-wrapper').siblings('input').val(a);

								});
								if ( parent.find('li').length == 2 ){
									parent.addClass('empty');
								}
								parent.siblings('.slider-num').attr('value',function(){
									return parseInt(jQuery(this).attr('value'), 10) - 1;
								});
							}
						},
			'No'		 : {
			'class'	  : 'confirm-no',
			'action'	 : function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	};

	// Create element Sortable
	jQuery('.selected-image ul').sortable( { 
		tolerance: 'pointer',
		forcePlaceholderSize: true,
		placeholder: 'slider-placeholder',
		cancel: '.slider-detail-wrapper',
		update: function() {
					var a = '';
					jQuery(this).find('li:not(".default") img').each( function() {
						a += jQuery(this).data('id') + ',';
					});
					jQuery(this).parents('.image-picker-wrapper').siblings('input').val(a);
				} 
	});

	// Bind the navigation bar and call server using ajax to get the media for each page
	jQuery(document).on('click', '.media-gallery-nav ul li:not(".current")', function() {
		jQuery(this).bindImagePickerClickPage();
	});
	jQuery.fn.bindImagePickerClickPage = function(){
		var image_picker = jQuery(this).parents('.image-picker'),
			current_gallery = image_picker.find('.media-image-gallery'),
			paged = jQuery(this).data('page');
			
		current_gallery.slideUp(200);
		image_picker.find('.show-media').addClass('loading-image');
		jQuery.post(ajaxurl,{ action:'get_media_image', page: paged },function(data){
			paged = '';
			current_gallery.html(data);
			current_gallery.slideDown(200);
			image_picker.find('.show-media').removeClass('loading-image');
		});
	};

	// Bind the image when user choose item
	jQuery(document).on('click', '.media-image-gallery > ul li img', function() {
		jQuery(this).bindImagePickerChooseItem();
	});
	jQuery.fn.bindImagePickerChooseItem = function(){
		var a = '',
			parent = jQuery(this).parents('.image-picker'),
			clone = parent.find('.slider-image-init.default').clone(true);
			
		clone.find('input, textarea, select').attr('name',function(){
			return jQuery(this).attr('id');
		});

		clone.removeAttr('id').removeClass('default').css('display','none');
		clone.find('img').data('id',jQuery(this).data('id'));
		clone.find('img').attr('src',jQuery(this).data('src'));
		parent.find('.selected-image.empty').removeClass('empty');
		parent.find('.selected-image ul').append(clone);
		parent.find('.selected-image ul li').not('.default').fadeIn('200');
		parent.find('.slider-num').attr('value',function(){
			return parseInt(jQuery(this).attr('value'), 10) + 1;
		});
				    
		jQuery(this).parents('.image-picker-wrapper').find('.selected-image li:not(".default") img').each(function(){
			a += jQuery(this).data('id') + ',';
		});
		jQuery(this).parents('.image-picker-wrapper').siblings('input').val(a);
	};
});