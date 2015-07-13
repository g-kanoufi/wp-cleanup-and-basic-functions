(function( $ ) {
	'use strict';


	 $(function() {
	 	// tabs
		var $tabBoxes = $('.wp_cbf-metaboxes'),
		       $tabLinks = $('.nav-tab'),
		       $tabLinkActive,
		       $currentTab,
		       $currentTabLink,
		       $tabContent,
		       $hash;


		// Tabs on load
	 	if(window.location.hash){
	 		$hash = window.location.hash;
	 		$tabBoxes.addClass('hide');
			$currentTab = $($hash).toggleClass('hide');
			$tabLinks.removeClass('nav-tab-active');
			$('.nav-tab[href='+$hash+']').addClass('nav-tab-active');
	 	}
	 	//Tabs on click
	 	$('.nav-tab-wrapper').on('click', 'a', function(e){
			e.preventDefault();
			$tabContent = $(this).attr('href');
			$tabLinks.removeClass('nav-tab-active');
			$tabBoxes.addClass('hide');
			$currentTab = $($tabContent).toggleClass('hide');
			$(this).addClass('nav-tab-active');
			 if(history.pushState) {
				history.pushState(null, null, $tabContent);
			}
			else {
				location.hash = $tabContent;
			}
		})

	 	// Fields showing after parent is checked
		$(".show-child-if-checked").on('change', function() {
		    if(this.checked) {
			$(this).parent().next('fieldset').removeClass('hide');
		    }else{
			$(this).parent().next('fieldset').addClass('hide');
		    }
		});

		// Wordpress specific plugins - color picker and image upload
		$('.wp_cbf_options-color-picker').wpColorPicker();

		$('#upload_login_logo_button').on('click', function() {
			tb_show('Upload a login logo', 'media-upload.php?referer=wp_cbf_upload-settings&type=image&TB_iframe=true&post_id=0', false);
			return false;
		});
		// Erase image url and age preview
		$('#wp_cbf-delete_logo_button').on('click', function(){
			$('#login_logo_url').val('');
			$('#upload_logo_preview').addClass('hide');
		});

	 });

	 window.send_to_editor = function(html) {
		var image_url = ($('img', html).attr('src') !== undefined)? $('img', html).attr('src') : $(html).attr('href');
		$('#login_logo_url').val(image_url);
		$('#upload_logo_preview').removeClass('hide');
		$('#upload_logo_preview img').attr('src', image_url);
		tb_remove();
	}

})( jQuery );
