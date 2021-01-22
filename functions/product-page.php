<?php

    $settings = get_field('settings', 'option');

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
            echo '<div class="mb-2"><span class="productStock greenText">' . $settings['show_stock_label'] . '</span></div>';
        };     
        add_action( 'woocommerce_single_product_summary', 'woomarqt_show_product_stock', 15 ); 
    }

