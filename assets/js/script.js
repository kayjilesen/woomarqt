jQuery(document).ready(function(){

    checkMenu();

    jQuery('.headerOverlay').click(function(e){
        if(jQuery('body').hasClass('show-menu')){
            jQuery('body').removeClass('show-menu');
        }
    });

    jQuery('#toggleMenu').click(function(e){
        if(jQuery('body').hasClass('show-menu')){
            jQuery('body').removeClass('show-menu');
        } else {
            jQuery('body').addClass('show-menu');
        }
    });

    jQuery('.openDropdown').click(function(e){
        var parent = jQuery(this).parent().parent();
        parent.toggleClass('open');
    });

    // Check Menu on Scroll
    jQuery(window).scroll(function() {
        checkMenu();
    });

    // Make Menu Sticky
    function checkMenu(){
        if(window.scrollY < (jQuery(window).height() - 200)){
            var top = true;
        } else {
            var top = false;
        }

        if(!jQuery('body').hasClass('menu-fixed')){
            if(!top && !window.scrollY==0){
                jQuery('body').addClass('sticky-menu');
                top = false;
                return false;
            } else if (top){
                jQuery('body').removeClass('sticky-menu');
                return true;
            }
        }
        return false;
    }

    // USP Slider 
    function initSlick(){
        let uspSlider = document.getElementById('uspSlider');
        if(uspSlider && jQuery(window).width() < 769){
            jQuery('.autoplay').slick({
                slidesToShow: 1,
                slidesToScroll: 1, 
                autoplay: true,
                autoplaySpeed: 2000,
            });
        }
    }
    initSlick();

    // AJAX Search
    jQuery('#searchForm').submit(function(e){
        var data = {
            search:  jQuery(this).find('input[name="search"]').val(),
            action: 'ajax_search'
        }
        // Post to the server
        jQuery.post( admin_url, data, function( data ) {

			// Parse the XML response with jQuery
            // Get the Status
			var status = jQuery( data ).find( 'response_data' ).text();
			// Get the Message
			var message = jQuery( data ).find( 'supplemental message' ).text();
			// If we are successful, add the success message and remove the link
			if( status == 'success' ) {
                jQuery('#search').html(data);
			} else {
                // An error occurred, alert an error message
                jQuery('#search').html(data);
			}
		});
        // Prevent the default behavior for the link
        e.preventDefault();
    });

});