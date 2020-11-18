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

    if(!empty(get_field('blok'))) include 'blocks/content.php'; 

?>

<footer id="footer" class="w-full">
    <?php if ($footer_settings['show_usps']) { ?>

        <section id="footer-usps" class="w-full px-4 lg:px-0">
            <div class="py-8 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid">
                <p>Hier komen USP's</p>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_widgets']) { ?>

        <section id="footer-widgets" class="w-full px-4 lg:px-0">
            <div class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <?php if ($footer_widgets['show_contact']) { ?>
                    <div class="">
                        <h5 class="mb-4 text-xl">Contact</h5>

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

                        <?php if ($company) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'company', '1em' ), $company; ?>
                            </div>
                        <?php } ?>

                        <?php if ($address) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'address', '1em' ), $address; ?>
                            </div>
                        <?php } ?>

                        <?php if ($zip && $city) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'city', '1em' ), $zip . ' ' . $city; ?>
                            </div>
                        <?php } ?>

                        <?php if ($email_address) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'email', '1em' ), $email_address; ?>
                            </div>
                        <?php } ?>

                        <?php if ($phone) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-4">
                                <?php echo getIcon( 'phone', '1em' ), $phone; ?>
                            </div>
                        <?php } ?>

                        <?php if ($coc) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'coc', '1em' ), $coc; ?>
                            </div>
                        <?php } ?>

                        <?php if ($vat) { ?>
                            <div class="grid grid-flow-col auto-cols-max gap-4 items-center mb-2">
                                <?php echo getIcon( 'vat', '1em' ), $vat; ?>
                            </div>
                        <?php } ?>
                        
                    </div>
                <?php } ?>

                <?php if ($footer_widgets['show_service']) { ?>
                    <div class="">
                        <h5 class="mb-4 text-xl">Klantenservice</h5>
                        <?php
                            if ($footer_widgets['service_menu']) :
                                ?> <ul> <?php
                                    foreach ($footer_widgets['service_menu'] as $page => $page_value) {
                                        ?> <li class="mb-2"><a href="<?php echo esc_url(get_permalink($page_value['page']->ID)) ?>"> <?php echo $page_value['page']->post_title; ?> </a></li> <?php
                                    }
                                ?> </ul> <?php
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_copyright']) { ?>
        <section id="footer-copyright" class="w-full px-4 lg:px-0">
            <div class="py-6 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-1 lg:grid-flow-col text-sm">
                <div class="grid self-center">
                    <p class="text-center lg:text-left">Copyright &copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
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

<?php wp_footer(); ?>

</body>
</html>