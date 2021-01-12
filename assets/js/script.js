/*
    Base JS 
*/

;(function($){

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
        searchAJAX(data);
        // Prevent the default behavior for the link
        e.preventDefault();
    });

    // AJAX Search
    jQuery(document).find('input[name="search"]').keyup(function(e){
        if(jQuery(this).val().length > 2){
            var data = {
                search:  jQuery(this).val(),
                action: 'ajax_search'
            }
            searchAJAX(data);
            // Prevent the default behavior for the link
            e.preventDefault();
        }
    });

    function searchAJAX(data){
        // Open Search
        jQuery('body').addClass('show-search');
        jQuery('body').one('click', function(event){
            jQuery(this).removeClass('show-search');
        });
        // Post to the server
        jQuery.post( admin_url, data, function( data ) {

            // Parse the XML response with jQuery
            // Get the Status
            var status = jQuery( data ).find( 'response_data' ).text();
            // Get the Message
            var message = jQuery( data ).find( 'supplemental message' ).text();
            // If we are successful, add the success message and remove the link
            if( status == 'success' ) {
                jQuery('#searchProducts').html(data);
            } else {
                // An error occurred, alert an error message
                jQuery('#searchProducts').html(data);
            }
        });
    }

    /* -----------------
    // AJAX Add To Cart
    ------------------ */
    jQuery('.single-add-to-cart-button').click(function(e){ 
    
        var thisbutton = jQuery(this);
        var id = thisbutton.val();
        var product_qty = 1;
        var product_id = thisbutton.attr('data-product-id');
        var variation_id = thisbutton.find('input[name=variation_id]').val() || 0;
        var data = {
                action: 'ajax_add_to_cart',
                product_id: product_id,
                quantity: product_qty,
                variation_id: variation_id,   
        };
        
        if(thisbutton.hasClass('added')) thisbutton.removeClass('added');
        thisbutton.addClass('loading');
        jQuery.post( admin_url, data, function( data ) {

            // Get the Status
            var status = jQuery( data ).find( 'response_data' ).text();
            // Get the Message
            var message = jQuery( data ).find( 'supplemental message' ).text();
            // If we are successful, add the success message and remove the link
            if( status == 'success' ) {
                jQuery('#cartProducts').html(data);
                jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                thisbutton.addClass('added');
                thisbutton.removeClass('loading');
                console.log(jQuery('.cartItemsCount').innerHTML);
                jQuery('#itemAmount').text(parseInt(jQuery('#itemAmount').text()) + 1);
            } else {
                // An error occurred, alert an error message
                jQuery('#cartProducts').html(data);
                thisbutton.addClass('added');
                thisbutton.removeClass('loading');
                console.log(jQuery('#itemAmount'));
                jQuery('#itemAmount').text(parseInt(jQuery('#itemAmount').text()) + 1);
            }
        });
        e.preventDefault();
    });


    // Open Cart 
    var cartSide = document.getElementById('cartSide');
    var openCartSide = document.getElementById('openCartButton');
    var closeCartSide = document.getElementById('closeCartSide');
    jQuery('#closeCartSide').on('click', function(){
        cartSide.classList.remove('open');
    });
    console.log(jQuery('#openCartButton'));
    jQuery('#openCartButton').on('click', function(){
        if(cartSide.classList.contains('open')){
            cartSide.classList.remove('open');
        } else {
            cartSide.classList.add('open');
        }
    });


})(jQuery);