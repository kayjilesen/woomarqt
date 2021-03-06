<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$category = get_queried_object();
$categoryStyling = get_field('categorie', 'option');

get_header( );

?>

<section id="productCategory w-full">
    <div class="max-w-screen-xl w-full mx-auto mb-20">

        <?php
            /**
            * Hook: woocommerce_before_main_content.
            *
            * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
            * @hooked woocommerce_breadcrumb - 20
            * @hooked WC_Structured_Data::generate_website_data() - 30
            */
            if(!is_shop()) do_action( 'woocommerce_before_main_content' );
        ?>

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php echo (is_shop() ? 'Alle producten' : woocommerce_page_title() . ' kopen?' ); ?></h1>
        <?php endif; ?>

        <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            
            if ( woocommerce_product_loop() ) {

                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            }

            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );

            ?>


    </div>
</section>

<?php

    if(!empty($category->term_id) && !empty(get_field('beschrijving', 'term_' . $category->term_id))) :
        echo '<section id="omschrijving" class="w-full" style="background-color:' . $categoryStyling['styling']['background_color'] . '">';
            echo '<div class="container w-full lg:max-w-screen-lg xl:max-w-screen-xl mx-auto py-' . $categoryStyling['styling']['margin_y'] . '">';
                echo '<div class="categorieOmschrijving">' . get_field('beschrijving', 'term_' . $category->term_id) . '</div>';
            echo '</div>';
        echo '</section>';
    endif;

get_footer();
