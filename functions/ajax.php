<?php 
    // AJAX Search
    function ajax_search(){

        $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['search'] ), 'post_type' => 'product' ) );

        if( $the_query->have_posts() ) {
            echo '<div class="productWrapper flex flex-col mx-auto my-6 border border-b-0 border-gray-500">';
            while( $the_query->have_posts() ): $the_query->the_post();
                global $product;
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                $price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) );
                ?>

                <div class="foundProduct flex justify-start items-center py-2 px-2 border-b border-gray-500">
                    <a href="<?php echo get_the_permalink(); ?>" class="foundProductImage mr-8"><img src="<?php echo $image[0]; ?>"></a>
                    <div class="foundProductInfo flex flex-col justify-start">
                        <h2><a href="<?php echo esc_url( post_permalink() ); ?>" class="text-black"><?php the_title();?></a></h2>
                        <h4 class="text-sm text-gray-500"><?php echo $price; ?></h4>
                    </div>
                </div>

            <?php endwhile;
            echo '</div>';
            wp_reset_postdata();  
        } else {
            echo '<div class="nothingFoundWrapper">Niks gevonden</div>';
        }

        die();
    }
    add_action('wp_ajax_ajax_search' , 'ajax_search');
    add_action('wp_ajax_nopriv_ajax_search','ajax_search');

    // AJAX Add To Cart
    
    function ajax_add_to_cart() {

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
        $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
        $variation_id = absint($_POST['variation_id']);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        $product_status = get_post_status($product_id);

        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
            do_action('woocommerce_ajax_added_to_cart', $product_id);
            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                wc_add_to_cart_message(array($product_id => $quantity), true);
            }
            //WC_AJAX :: get_refreshed_fragments();
            global $woocommerce;
            $items = $woocommerce->cart->get_cart();

            if(!empty($items)){
                echo '<div class="cartWrapper flex flex-col">';
                foreach($items as $item => $values) { 
                    echo '<div class="cartProduct flex items-center hover:shadow-md p-2 my-2 hover:border border-gray-200">';
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['data']->get_id() ), 'single-post-thumbnail' );
                        echo '<a class="cartImage mr-3" href="' . get_the_permalink($values['data']->get_id()) . '"><img src="' . $image[0] . '"></a>';
                        echo '<div class="cartProductInfo flex justify-between items-center w-full">';
                            $_product =  wc_get_product( $values['data']->get_id()); 
                            echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle font-bold text-sm w-full">' . $_product->get_title() .'</a>';
                            echo '<div class="productPricing flex justify-end">';
                                echo '<div class="cartProductQuantity text-sm mr-2 w-8 text-right">' .$values['quantity']. ' x</div>'; 
                                $price = get_post_meta($values['product_id'] , '_price', true) * $values['quantity'];
                                echo '<div class="cartProductPrice text-sm w-16 text-right">€ ' . $price . '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                } 
                echo '</div>';
            }


        } else {
            echo 'Error!';
            die();
            $data = array(
                'error' => true,
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
            echo wp_send_json($data);
        }
        wp_die();
    }

    add_action( 'wp_ajax_ajax_add_to_cart', 'ajax_add_to_cart' );
    add_action( 'wp_ajax_nopriv_ajax_add_to_cart', 'ajax_add_to_cart' );