<?php
	/*
	* File: content.php
	* Created: 12/11/2020
	* Author: Kay Jilesen (info@averex.nl)
	* -----
	* Last Modified: 12/11/2020
	* -----
	* © 2020 Averex
    */
    
    $page_id = get_queried_object_id();

    $blockIndex = 1;

    foreach(get_field('blok') as $layout){
        if($layout['acf_fc_layout'] === 'producten'){
            $filter = $layout['type'];
            $productQuery = new WP_Query( array(
                'posts_per_page' => $layout['styling']['aantal_in_rij']['label'],
                'post_type' => 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            ) );

            echo '<section id="block' . $blockIndex . '" class="product bg-gray-300 py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row ' . $layout['styling']['width'] . ' mx-auto">';
                    if($productQuery->have_posts()) :
                        echo '<div class="grid grid-flow-col auto-cols-fr gap-6">';
                        while($productQuery->have_posts()) : $productQuery->the_post();
                            global $product;
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                            $price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) );
                            $onSale = $product->get_sale_price();
                            $sale = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) ) );
        
                            echo '<div class="productBlock' . ($layout['productstyling']['shadow'] ? ' shadow-lg' : '') . ' py-' . $layout['productstyling']['padding_y'] . ' px-' . $layout['productstyling']['padding_x'] . ' bg-white ' . $layout['productstyling']['border_radius'] . '">';
                                echo '<a href="' . get_the_permalink() . '" class="imageWrapper">';
                                    echo '<img src="' . $image[0] . '" alt="">';
                                echo '</a>';
                                echo '<div class="infoWrapper mt-6">';
                                    echo '<h4 class="text-lg"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
                                    echo $onSale !== '' ? '<del class="text-opacity-25">' . $price . '</del> ' . $sale : $price;
                                    echo '<div class="w-full bg-green-600 text-white text-center py-3 mt-3 rounded single-add-to-cart-button">In winkelwagen</div>';
                                echo '</div>';
                            echo '</div>';
                        endwhile;   
                        echo '</div>';
                    endif;
                echo '</div>';
            echo '</section>';
        }
        if($layout['acf_fc_layout'] === 'custom'){

            echo '<section id="block' . $blockIndex . '" class="custom bg-gray-600 py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row flex flex-wrap ' . $layout['styling']['width'] . ' mx-auto">';     
                    foreach($layout['kolommen'] as $kolom){
                        echo '<div class="column lg:' . $kolom['breedte'] . ' flex flex-col">';

                            foreach($kolom['subblokken'] as $subblok){
                                echo '<div class="subblock ' . 'py-' . $subblok['styling']['padding_y'] . ' px-' . $subblok['styling']['padding_x'] . '">';

                                    foreach($subblok['sub_content'] as $content){
                                        if($content['acf_fc_layout'] === 'titel'){
                                            echo '<' . $content['type'] . '>' . $content['tekst'] . '</' . $content['type'] . '>';
                                        } else if($content['acf_fc_layout'] === 'cta'){
                                            if($content['type'] === 'button'){
                                                echo '<a class="button" href="' . $content['link']['url'] . '">' . $content['tekst'] . '</a>';
                                            } else if($content['type'] === 'text'){
                                                echo '<a class="text" href="' . $content['link']['url'] . '">' . $content['tekst'] . '</a>';
                                            }
                                        }
                                    }

                                echo '</div>';
                            }

                        echo '</div>';
                    }
                echo '</div>';
            echo '</section>';

        }
        $blockIndex++;
    }