// Upload
jQuery(document).ready(function($) { 
	
    /* Image uploader */
  if ($('.image-upload').length > 0) {
        
        $('.image-upload').each(function (index) {
            
            // Define the buttons for this specific group
            var add_media = $(this).find('.upload_button'),
                value_input = $(this).find('.upload-url'),
                title = $(this).data('title'),
                type = $(this).data('type'),
                button = $(this).data('button'),
                multiple = $(this).data('multiple'),
                frame;
            
            // Click function
            add_media.click(function (e) {

                e.preventDefault();

                // If the media frame already has been opened before, it can just be reopened.
                if (frame) {
                    frame.open();
                    return;
                }

                // Create the media frame.
                frame = wp.media.frames.frame = wp.media({

                    // Determine the title for the modal window
                    title: title,

                    // Show only the provided types
                    library: {
                        type: type
                    },

                    // Determine the submit button text
                    button: {
                        text: button
                    },
                    
                    // Can we select multiple or only one?
                    multiple: multiple

                });
                
                // If media is selected, add the input value
                frame.on('select', function () {

                    // Grab the selected attachment.
                    var attachments = frame.state().get('selection').toJSON(),
                        attachment_ids = value_input.val(),
                        attachment_urls = value_input.val(),
                        loop_counter = 0;
                    
                    // We store the ids for each image
                    attachments.forEach(function (attachment) {
                        
                        console.log(attachment);
                        
                        attachment_ids += attachment.id + ',';
                        attachment_urls += attachment.url;
                    });
                    
                    value_input.val(attachment_urls);

                });
                
                // Open the media upload modal
                frame.open();

            });
            
        });
        
    }    
        
    var locationHash = window.location.hash;
    
	/* Tabs in themesettings*/
    if (locationHash && locationHash.indexOf('tab=') > -1) { 
        target = locationHash.replace('tab=', '');
        
        $('.tab-nav a[href="' + target + '"]').addClass("active");
        $('.tabs ' + target).addClass("active");  
        
    } else {
        $(".tab-nav a:first ").addClass("active");
        $(".tabs .single-tab:first ").addClass("active");        
    }
    
    // Hide tabs on clicking
    $(".tab-nav a").click(function(event){
        
        event.preventDefault();      
		
        $(".tab-nav a").removeClass("active");
        $(".single-tab").removeClass("active");
        
        $(this).addClass("active");

        var activeTab = $(this).attr("href");
                
        $(activeTab).addClass("active")
        
        // Adds active tab to the window location.
        window.location.hash = 'tab=' + activeTab.replace('#', '');          

        console.log(window.location.hash);

       
        return false;
	});	

	/* Provide possibilities for colorpicker */
	$('.msign-color-field').wpColorPicker();
});