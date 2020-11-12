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

?>

<footer id="footer" class="w-full">
    <?php if ($footer_settings['show_usps']) { ?>

        <section id="footer-usps" class="w-full">
            <div class="py-8 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid">
                <p>Hier komen USP's</p>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_widgets']) { ?>

        <section id="footer-widgets" class="w-full">
            <div class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-4">
                <?php if ($footer_widgets['show_contact']) { ?>
                    <div class="">
                        <h5 class="mb-4 text-xl">Contact</h5>
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
        <section id="footer-copyright" class="w-full">
            <div class="py-6 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-2 text-sm">
                <div class="grid self-center">
                    <p>Copyright &copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
                </div>

                <?php if ($footer_settings['show_payment_methods'] || $footer_settings['show_carriers']) { ?>
                    <div class="grid grid-flow-col auto-cols-min gap-3 justify-end">
                        <?php if ($footer_settings['show_payment_methods']) { ?>
                            <?php foreach (get_field('footer_payment_methods', 'option') as $payment_method) { ?>
                                <?php foreach ($payment_method as $key => $value) { ?>
                                    <?php if ($value) { ?>
                                        <img src="https://woomarqt.nl/wp-content/themes/woomarqt/assets/img/payment-methods/<?php echo $key; ?>.png" alt="<?php echo $key; ?>">
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <?php if ($footer_settings['show_carriers']) { ?>
                            <?php foreach (get_field('footer_carriers', 'option') as $carrier) { ?>
                                <?php foreach ($carrier as $key => $value) { ?>
                                    <?php if ($value) { ?>
                                        <img src="https://woomarqt.nl/wp-content/themes/woomarqt/assets/img/carriers/<?php echo $key; ?>.png" alt="<?php echo $key; ?>">
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

<?php wp_footer(); ?>

</body>
</html>