<?php

    $settings = get_field('settings', 'option');
    $labels = get_field('labels', 'option');
    $voordelen = get_field('voordelen', 'option');

    // Product Show UPS's
    function woomarqt_show_product_usps() { 
        global $settings;
        if(get_field('gratis_verzending') || get_field('fabrieksgarantie') || get_field('premium')) :
            echo '<div class="productUspWrapper my-3">';
                //echo '<span class="productStock">' .  . '</span>';
                if(get_field('gratis_verzending')) echo '<div class="flex items-center"><span class="greenText mr-1">' . getIcon('check', '1.5em') . '</span> <span class="greenText">Gratis</span>&nbsp;verzending' . '</div>';
                if(get_field('fabrieksgarantie')) echo '<div class="flex items-center"><span class="greenText mr-1">' . getIcon('check', '1.5em') . '</span> 3 jaar fabrieksgarantie' . '</div>';
                if(get_field('premium')) echo '<div class="flex items-center"><span class="greenText mr-1">' . getIcon('check', '1.5em') . '</span> Premium kwaliteit' . '</div>';
            echo '</div>';
        endif;
    };     
    add_action( 'woocommerce_single_product_summary', 'woomarqt_show_product_usps', 15 ); 

    // Product in Stock label
    if($settings['show_stock']){
        function woomarqt_show_product_stock() { 
            global $settings;
            echo '<div id="stockLabel" class="mb-0"><span class="productStock greenText">' . $settings['show_stock_label'] . '</span></div>';
        };     
        add_action( 'woocommerce_single_product_summary', 'woomarqt_show_product_stock', 15 ); 
    }

    // Product Add to Cart Button
    function woocommerce_custom_single_add_to_cart_text() {
        global $labels;
        $icon = getIcon($labels['cart_icon_menu'], '1.5em');
        return __( esc_html($labels['add_to_cart']), 'woocommerce' ); 
    }
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 


    // Product Voordelen
    function woomarqt_add_product_advantages() {
        global $voordelen;
        if(have_rows('voordelen')) : 
            echo '<div class="voordelenWrapper">';
            echo '<h2>Voordelen</h2>';
            while(have_rows('voordelen')) : the_row();
                echo '<div class="voordeelRow mb-2 flex"><div class="voordeelIcon mr-2">' . getIcon($voordelen['icon'], '1.5em') . '</div>' . get_sub_field('voordeel') . '</div>';
            endwhile;
            echo '</div>';
        endif;
    }
    add_action( 'woocommerce_after_single_product_summary', 'woomarqt_add_product_advantages', 9); 

    // Product Omschrijving kop
    function woomarqt_add_omschrijving_head(){
            echo '<h3 class="omschrijvingHead font-bold">Product omschrijving</h3>';
    }
    add_filter( 'woocommerce_single_product_summary', 'woomarqt_add_omschrijving_head', 15); 
    