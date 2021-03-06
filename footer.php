<?php
    /**
     *	Footer
    */

    $footer_settings            =   get_field('footer_settings', 'option');
    $footer_usps                =   get_field('footer_usps', 'option');
    $footer_widgets             =   get_field('footer_widgets', 'option');
    $footer_copyright           =   get_field('footer_copyright', 'option');
    $footer_payment_methods     =   get_field('footer_payment_methods', 'option');
    $footer_carriers            =   get_field('footer_carriers', 'option');

    $huisstijl = get_field('huisstijl', 'option');

    if($footer_usps['inherit_usps']) $usps = get_field('usp', 'option');
    
    // Insert Custom added Blocks Content
    if(!empty(get_field('blok'))) include 'blocks/content.php'; 

?>

<footer id="footer" class="w-full">
    <?php if ($footer_settings['show_usps']) { ?>

        <section id="footer-usps" class="w-full px-4 lg:px-0">
            <div class="py-8 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid">
                <?php 
                    if($footer_usps['inherit_usps']) {
                        echo '<div class="navigation-bar w-full ' . ( $usps['styling']['height'] === 'auto' ? '' : 'h-' . $usps['styling']['height'] ) . '">';
                            echo '<div id="uspSlider" class="innerWrapper sm:px-3 md:flex py-' . $usps['styling']['padding_y'] . ' lg:px-' . $usps['styling']['padding_x'] . ' justify-center mx-auto">';
                            foreach($usps['usps'] as $usp){
                                echo '<div class="w-full flex md:w-auto"><div class="uspBlock flex justify-center md:justify-start witems-center text-sm md:mr-8 text-center md:text-left"><div class="mr-1">' . getIcon( $usp['icon'], '1.6em' ) .  '</div>' . $usp['usp'] . '</div></div>';
                            }
                            echo '</div>';
                        echo '</div>';
                    } else {
                        echo 'Eigen USP\'s';
                    }
                ?>  
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_widgets']) { ?>

        <section id="footer-widgets" class="w-full px-4 lg:px-0">
            <div class="py-<?php echo $footer_widgets['styling']['padding_y']; ?> px-<?php echo $footer_widgets['styling']['padding_x']; ?> mx-auto max-w-screen-sm max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <?php if ($footer_widgets['show_contact']) { ?>
                    <div class="">
                        <h5 class="mb-6 text-xl font-medium">Contact</h5>

                        <?php
                            $company = get_field('company', 'option');
                            $address = get_field('address', 'option');
                            $zip = get_field('zip', 'option');
                            $city = get_field('city', 'option');
                            $email_address = get_field('email_address', 'option');
                            $phone = get_field('phone', 'option');
                            $coc = get_field('coc', 'option');
                            $vat = get_field('vat', 'option');
                        ?>
                        <ul>
                        <?php if ($company) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'company', '1em' ), $company; ?>
                            </li>
                        <?php } ?>

                        <?php if ($address) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'address', '1em' ), $address; ?>
                            </li>
                        <?php } ?>

                        <?php if ($zip && $city) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'city', '1em' ), $zip . ' ' . $city; ?>
                            </li>
                        <?php } ?>

                        <?php if ($email_address) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'email', '1em' ), $email_address; ?>
                            </li>
                        <?php } ?>

                        <?php if ($phone) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'phone', '1em' ), $phone; ?>
                            </li>
                        <?php } ?>

                        <?php if ($coc) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'coc', '1em' ), $coc; ?>
                            </li>
                        <?php } ?>

                        <?php if ($vat) { ?>
                            <li class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'vat', '1em' ), $vat; ?>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if ($footer_widgets['show_service']) { ?>
                    <div class="">
                        <h5 class="mb-6 text-xl font-medium"><a href="/klantenservice">Klantenservice</a></h5>
                        <?php
                            if ($footer_widgets['service_menu']) :
                                echo '<ul>';
                                    foreach ($footer_widgets['service_menu'] as $page => $page_value) { 
                                        if($page_value['page']->post_title !== 'Klantenservice') echo '<li class="mb-2"><a href="' . esc_url(get_permalink($page_value['page']->ID)) . '">' . $page_value['page']->post_title . '</a></li>';
                                    }
                                echo '</ul>';
                            endif;
                        ?>
                    </div>
                <?php } ?>

                <?php if ($footer_widgets['show_products']) { ?>
                    <div class="col-products">
                        <h5 class="mb-6 text-xl font-medium">Producten</h5>
                        <?php
                            if ($footer_widgets['products_menu']) :
                                echo '<ul>';
                                    foreach ($footer_widgets['products_menu'] as $cats) {
                                        foreach($cats['category'] as $cat){
                                            echo '<li class="mb-2"><a href="' . site_url() . '/categorie/' . get_term_by( 'id', $cat, 'product_cat' )->slug . '">' . get_term_by( 'id', $cat, 'product_cat' )->name . '</a></li>';
                                        }
                                        //if($page_value['page']->post_title !== 'Klantenservice') echo '<li class="mb-2"><a href="' . esc_url(get_permalink($page_value['page']->ID)) . '">' . $page_value['page']->post_title . '</a></li>';
                                    }
                                echo '</ul>';
                            endif;
                        ?>
                    </div>
                <?php } ?>

                <?php if ($footer_widgets['logo_column']) { ?>
                    <div class="col-logo text-left md:text-left">
                        <a href="/"><img class="w-2/3 inline-block object-contain" src="<?php echo $huisstijl['logo_light']['url']; ?>" alt="<?php echo $huisstijl['logo_light']['alt']; ?>"></a>
                    </div>
                <?php } ?>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_copyright']) { ?>
        <section id="footer-copyright" class="w-full px-4 lg:px-0">
            <div class="py-6 mx-auto max-w-screen-sm max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl grid grid-cols-1 lg:grid-flow-col text-sm">
                <div class="grid self-center">
                    <p class="text-center lg:text-left">&copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
                </div>

                <?php if ($footer_settings['show_payment_methods'] || $footer_settings['show_carriers']) { ?>
                    <div class="grid grid-flow-col auto-cols-min gap-3 justify-center lg:justify-end mt-4 lg:mt-0">
                        <?php if ($footer_settings['show_payment_methods']) { ?>
                            <?php foreach (get_field('footer_payment_methods', 'option') as $payment_method) { ?>
                                <?php foreach ($payment_method as $key => $value) { ?>
                                    <?php if ($value) { ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/payment-methods/<?php echo $key; ?>.png" alt="<?php echo $key; ?>" class="max-w-none h-8">
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <?php if ($footer_settings['show_carriers']) { ?>
                            <?php foreach (get_field('footer_carriers', 'option') as $carrier) { ?>
                                <?php foreach ($carrier as $key => $value) { ?>
                                    <?php if ($value) { ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/carriers/<?php echo $key; ?>.png" alt="<?php echo $key; ?>" class="max-w-none h-8">
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php } ?>

</footer>

<script type="text/javascript">
    var admin_url = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<?php echo '<script src="' . get_stylesheet_directory_uri() . '/assets/js/script.js?v=' . filemtime(get_stylesheet_directory() . '/assets/js/script.js') . '" type="text/javascript">'; ?>

<?php wp_footer(); ?>

</body>
</html>