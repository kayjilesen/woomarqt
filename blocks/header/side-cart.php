<div id="cartSide" class="">
    <div class="cartWrapper">
        <div class="titleBar">
            <span class="cartTitle">Winkelwagen</span>
            <div id="closeCartSide"><i class="fa fa-times"></i></div>
        </div>
        <div id="cartProducts">
            <?php
                global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                $subTotal = 0;
                foreach($items as $item => $values) { 
                    $_product =  wc_get_product( $values['data']->get_id()); 
                    $price = wc_price( wc_get_price_to_display( $_product, array( 'price' => $_product->get_regular_price() * $values['quantity'] ) ) );
                    echo '<div class="cartProduct">';
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['data']->get_id() ), 'single-post-thumbnail' );
                        echo '<a class="cartImage" href="' . get_the_permalink($values['data']->get_id()) . '"><img src="' . $image[0] . '"></a>';
                        echo '<div class="cartProductInfo">';
                            if(!empty($values['yith_booking_data'])){
                                echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle">' . $_product->get_title() .'</a>';
                                echo '<div class="productPricing">';
                                    echo '<div class="cartProductQuantity"><span class="strong">Aantal:</span><span class="amount">' . $values['yith_booking_data']['persons'] . '</span></div>'; 
                                    //$price = get_post_meta($values['product_id'] , '_price', true) * $values['quantity'];
                                    echo '<div class="cartProductPrice">' . $price . '</div>';
                                echo '</div>';
                                $subTotal += $values['line_total'] * $values['yith_booking_data']['persons'];
                            } else {
                                if(!empty($values['variation_id'])){
                                    $variation = wc_get_product($values['variation_id']);
                                        echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle">' . $variation->get_name() .'</a>';
                                } else {
                                    echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle">' . $_product->get_title() .'</a>';
                                }
                                //$price = wc_price( wc_get_price_to_display( $_product, array( 'price' => $values['line_total'] * $values['yith_booking_data']['persons']) ) );
                                echo '<div class="productPricing">';
                                    echo '<div class="cartProductQuantity"><span class="strong">Aantal:</span><span class="amount">' . $values['quantity'] . '</span></div>'; 
                                    //$price = get_post_meta($values['product_id'] , '_price', true) * $values['quantity'];
                                    echo '<div class="cartProductPrice">' . wc_price( $values['line_subtotal'] ) . '</div>';
                                echo '</div>';
                                $subTotal += $values['line_subtotal'];
                            }
                        
                        echo '</div>';
                    echo '</div>';
                }
                wp_reset_query();
            ?>
        </div>
        <div class="cartBottom">
            <div class="subTotalRow">
                <span class="subTotalSpan">Subtotaal</span>
                <span class="subTotalSpan"><?php echo wc_price( $subTotal ); ?></span>
            </div>
            <div class="buttonRow">
                <a href="/winkelmand" class="cartButton viewCart">Winkelmand bekijken</a>
                <a href="/afrekenen" class="cartButton checkout">Afrekenen</a>
            </div>
        </div>
    </div>
</div>