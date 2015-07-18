$(window).load(function() {
	// Sets height of load container to default screen
	/* Loads portfolio categories with ajax */
	$(".types a").not(".types-all").on('click', function(e) {
		e.preventDefault();
		$('.types a').removeClass('active'); // Removes active class if a certain category has an active class
		$(this).addClass('active');
		
		
		// Interaction animations
		
		$(".postbox").fadeOut(777);
		$('#ajax-load').animate( { height:300} , 777);
		
		// Load content
		var $url = $(this).attr("href") + " .postbox";
		$("#ajax-load").load($url, function(response, status, xhr) {
			if (status == "error") {
				var msg = "Error: ";
				$(".postbox").html(msg + xhr.status + " " + xhr.statusText);
  			}
			// Interaction after loading
			$(".postbox").fadeIn(777);
			$('#ajax-load').animate( { height:500} , 777);
			// Apply masonry for loaded content
			if (document.documentElement.clientWidth > 660) { 
				var $container = $('.postbox'); 
					$container.imagesLoaded(function(){
						$container.masonry({itemSelector : '.boxitem'})
					;}); 
			}
		});
		
	});
});
