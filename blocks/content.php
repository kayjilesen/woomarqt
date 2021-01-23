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
    $labels = get_field('labels', 'option');
    $productblock = get_field('productblock', 'option');

    $blockIndex = 1;

    foreach(get_field('blok') as $layout){ 
        if($layout['acf_fc_layout'] === 'producten'){

            $filter = $layout['type'];
            if($filter === 'category') {
                foreach ( $layout['categorie'] as $term => $val ) $cats_array[] = $val;
                $productQuery = new WP_Query( array(
                    'posts_per_page' => $layout['styling']['aantal_in_rij']['label'],
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'tax_query' => array( 
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'id',
                            'terms' => $layout['categorie']
                        )),
                ));
            } else if($filter === 'new'){
                $productQuery = new WP_Query( array(
                    'posts_per_page' => $layout['styling']['aantal_in_rij']['label'],
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
            } else if($filter === 'popular'){
                $productQuery = new WP_Query( array(
                    'posts_per_page' => $layout['styling']['aantal_in_rij']['label'],
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                ));
            }

            echo '<section id="block' . $blockIndex . '" class="product py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row ' . $layout['styling']['width'] . ' mx-auto px-4 lg:px-0">';
                    if($productQuery->have_posts()) :
                        echo '<ul class="products grid grid-cols-' . $layout['styling']['aantal_in_rij_mobiel']['value'] . ' md:grid-cols-2 lg:auto-cols-fr lg:grid-flow-col gap-6">';
                        while($productQuery->have_posts()) : $productQuery->the_post();
                            global $product;
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                            $price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) );
                            $onSale = $product->get_sale_price();
                            $sale = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) ) );
        
                            echo '<div class="productBlock py-' . $layout['productstyling']['padding_y'] . ' px-' . $layout['productstyling']['padding_x'] . ' bg-white ' . $layout['productstyling']['border_radius'] . '">';
                                echo '<a href="' . get_the_permalink() . '" class="imageWrapper">';
                                    echo '<img src="' . $image[0] . '" alt="">';
                                echo '</a>';
                                echo '<div class="infoWrapper mt-6">';
                                    echo '<h4 class="text-lg"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
                                    echo $onSale !== '' ? '<del class="text-opacity-25">' . $price . '</del> ' . $sale : $price;
                                    echo '<div class="w-full add_to_cart_button text-white text-center mt-3 rounded relative single-add-to-cart-button" data-product-id="' . get_the_ID() . '"><span class="add">' . $labels['add_to_cart'] . '</span><span class="loading">' . $labels['add_to_cart_loading'] . '</span><span class="added">' . $labels['add_to_cart_finished'] . '</span></div>';
                                echo '</div>';
                            echo '</div>';
                        endwhile;   
                        echo '</ul>';
                    endif;
                echo '</div>';
            echo '</section>';
        } else if($layout['acf_fc_layout'] === 'custom'){

            echo '<section id="block' . $blockIndex . '" class="custom py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row  sm:px-3 flex flex-wrap ' . $layout['styling']['width'] . ' ' . ($layout['styling']['same_height'] ? '' : ' ' . $layout['styling']['uitlijning'] ) . ' mx-auto px-4 lg:px-0">';     
                    foreach($layout['kolommen'] as $kolom){
                        echo '<div class="column lg:' . $kolom['breedte'] . ' flex flex-col bg-white' . ($layout['styling']['same_height'] ? '' : ' h-full') . '">';
                            if(!empty($kolom['subblokken'])){
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
                            }

                        echo '</div>';
                    }
                echo '</div>';
            echo '</section>';
        } else if($layout['acf_fc_layout'] === 'categorieen'){

            echo '<section id="block' . $blockIndex . '" class="custom py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                if($layout['show_title']) echo '<div class="text-center"><h2>' . $layout['title'] . '</h2></div>';
                echo '<div class="row grid lg:grid-cols-' . count($layout['categorie']) . ' gap-' . $layout['blokstyling']['margin_x'] . ' my-' . $layout['blokstyling']['margin_y'] . ' sm:px-3 flex flex-wrap ' . $layout['styling']['width'] . ' ' . ($layout['styling']['same_height'] ? '' : ' ' . $layout['styling']['uitlijning'] ) . ' mx-auto px-4 lg:px-0">';     
                    foreach($layout['categorie'] as $cat){
                        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                        echo '<div class="column flex justify-between flex-col bg-white' . ($layout['styling']['same_height'] ? '' : ' h-full') . ' px-' . $layout['blokstyling']['padding_x'] . ' py-' . $layout['blokstyling']['padding_y'] . ' ' . $layout['blokstyling']['align_text'] . ' ' . $layout['blokstyling']['border_radius'] . '" style="background-color:' . $layout['blokstyling']['background_color'] . ';">';
                            echo '<a href="' . $cat->slug . '"><h3>' . $cat->name . '</h3></a>';
                            echo '<a href="' . $cat->slug . '"><img src="' . $image . '"></a>';
                            echo '<a class="button " href="' . $cat->slug . '">Bekijk producten</a>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</section>';
        } else if($layout['acf_fc_layout'] === 'code'){
            echo '<section id="' . $layout['section_id'] . '" class="' . $layout['section_class'] . ' custom">';
                echo $layout['code'];
            echo '</section>';
        }
        $blockIndex++;
    }