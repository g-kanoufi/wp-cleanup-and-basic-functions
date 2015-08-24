(function( $ ) {
	'use strict';


	 $(function() {
	 	// tabs
		var $tabBoxes = $('.wp_cbf-metaboxes'),
		       $tabLinkActive,
		       $currentTab,
		       $currentTabLink,
		       $tabContent,
		       $hash,
                       $showChild = $(".show-child-if-checked"),

                       // Media vars
                       frame,
                       imgUploadButton = $tabBoxes.find( '#upload_login_logo_button' ),    
                       imgContainer = $tabBoxes.find( '#upload_logo_preview' ),
                       imgIdInput = $tabBoxes.find( '#login_logo_id' ),
                       imgPreview = $tabBoxes.find('#upload_logo_preview'),        
                       imgDelButton = $tabBoxes.find('#wp_cbf-delete_logo_button'),
                       // Color Pickers Inputs
                       colorPickerInputs = $tabBoxes.find( '.wp-cbf-color-picker' ),

                       // Smtp
                       hideBtn = $(".wp-hide-pw"),
                       hideBtnIcon = hideBtn.find('.dashicons'),
                       hideBtnText = hideBtn.find('.text'),
                       passInput = hideBtn.prev('input'),
                       testEmailBtn = $('#wp-cbf-send-smtp-test'),
                       smtpResults = $('.smtp-ajax-results'),
                       smtpResultsContent = smtpResults.find('.smtp-results-content'),
                       debugLogButton = smtpResults.find('.button'),
                       debugLog = smtpResults.find('.smtp-results-debug');





		// Tabs on load
	 	if(window.location.hash){
	 		$hash = window.location.hash;
	 		$tabBoxes.addClass('hidden');
			$currentTab = $($hash).toggleClass('hidden');
			$('.nav-tab').removeClass('nav-tab-active');
			$('.nav-tab[href='+$hash+']').addClass('nav-tab-active');
	 	}
	 	//Tabs on click
	 	$('.nav-tab-wrapper').on('click', 'a', function(e){
			e.preventDefault();
			$tabContent = $(this).attr('href');
			$('.nav-tab').removeClass('nav-tab-active');
			$tabBoxes.addClass('hidden');
			$currentTab = $($tabContent).toggleClass('hidden');
			$(this).addClass('nav-tab-active');
			 if(history.pushState) {
				history.pushState(null, null, $tabContent);
			}
			else {
				location.hash = $tabContent;
			}
		})

	 	// Fields showing after parent is checked
		$showChild.on('change', function() {
		    if(this.checked) {
			$(this).parent().next('fieldset').removeClass('hidden');
		    }else{
			$(this).parent().next('fieldset').addClass('hidden');
		    }
		});

                // Show/Hide password for smtp
                hideBtn.on('click', function(e){
                    e.preventDefault(); 
                    if(hideBtnText.html() === 'Show'){
                        hideBtnIcon.removeClass('dashicons-visibility').addClass('dashicons-hidden'); 
                        hideBtnText.html('Hide'); 
                        passInput.attr('type', 'text');
                    }else{
                        hideBtnIcon.removeClass('dashicons-hidden').addClass('dashicons-visibility'); 
                        hideBtnText.html('Show'); 
                        passInput.attr('type', 'password');
                    }
                });

                testEmailBtn.on('click', function(e){
                    e.preventDefault();
                    var emailTestAddr = $('#wp-cbf-smtp-test-email'),
                        reg = /^(([a-zA-Z]|[0-9])|([-]|[_]|[.]))+[@](([a-zA-Z0-9])|([-])){2,63}[.](([a-zA-Z0-9]){2,63})+$/gi,
                        data = {
                           'action' : 'wp_cbf_send_test_email',
                           'email_addr' : emailTestAddr.val(),
                        };
                    
                    if(reg.test(emailTestAddr.val())){
                        jQuery.post(ajaxurl, data, function(response) {
                            response = $.parseJSON(response);
                            if(response.result){
                                var result = "Email sent succesfully";
                                testEmailBtn.addClass('hidden');
                            };
                            smtpResults.removeClass('hidden');
                            smtpResultsContent.html(result);
                            debugLog.html('<pre>'+response.debug+'</pre>');
                        });

                    }else{
                        emailTestAddr.addClass('short').attr('placeholder', 'Enter a valid email address');
                        return false;
                    }
                });
                debugLogButton.on('click', function(e){
                    e.preventDefault();
                    debugLog.removeClass('hidden');
                    $(this).addClass('hidden');
                });



                 // WordPress specific plugins - color picker and image upload
                 colorPickerInputs.wpColorPicker();

                // wp.media add Image
                 imgUploadButton.on( 'click', function( event ){
                    
                    event.preventDefault();
                    
                    // If the media frame already exists, reopen it.
                    if ( frame ) {
                      frame.open();
                      return;
                    }
                    
                    // Create a new media frame
                    frame = wp.media({
                      title: 'Select or Upload Media for your Login Logo',
                      button: {
                        text: 'Use as my Login page\'s Logo'
                      },
                      multiple: false  // Set to true to allow multiple files to be selected
                    });
                    // When an image is selected in the media frame...
                    frame.on( 'select', function() {
                      
                      // Get media attachment details from the frame state
                      var attachment = frame.state().get('selection').first().toJSON();
                        

                      // Send the attachment URL to our custom image input field.
                      imgPreview.find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

                      // Send the attachment id to our hidden input
                      imgIdInput.val( attachment.id );

                      // Hide upload button
                      imgUploadButton.addClass( 'hidden' );

                      // Unhide the remove image link
                      imgPreview.removeClass( 'hidden' );
                    });

                    // Finally, open the modal on click
                    frame.open();
                });


                // Erase image url and age preview
                imgDelButton.on('click', function(e){
                    e.preventDefault();
                    imgIdInput.val('');
                    imgPreview.find( 'img' ).attr( 'src', '' );
                    imgPreview.addClass('hidden');
                    imgUploadButton.removeClass( 'hidden' );
                });

	});

})( jQuery );
