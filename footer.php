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
            <div class="py8 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl">
                <p>Hier komen USP's</p>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_widgets']) { ?>

        <section id="footer-widgets" class="w-full">
            <div class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-4">
                <?php if ($footer_widgets['show_contact']) { ?>
                    <div class="col-auto">
                        <h5>Contact</h5>
                    </div>
                <?php } ?>

                <?php if ($footer_widgets['show_service']) { ?>
                    <div class="col-auto">
                        <h5>Klantenservice</h5>
                    </div>
                <?php } ?>
            </div>
        </section>

    <?php } ?>

    <?php if ($footer_settings['show_copyright']) { ?>

        <section id="footer-copyright" class="w-full">
            <div class="py-6 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-2 text-sm">
                <div class="col-auto">
                    <p>Copyright &copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
                </div>

                <?php if ($footer_settings['show_payment_methods']) { ?>
                    <div class="inline-flex flex-auto">
                    <?php print_r($footer_payment_methods['payment_methods']['ideal']); ?>
                        <?php if ($footer_payment_methods['payment_methods']['ideal']) { ?>
                            <svg height="35">
                                <image href="https://woomarqt.nl/wp-content/themes/woomarqt/assets/img/payment-methods/ideal.svg" height="35" />
                            </svg>
                        <?php } ?>
                        <?php if ($footer_payment_methods['payment_methods']['paypal']) { ?>
                            <svg height="35">
                                <image href="https://woomarqt.nl/wp-content/themes/woomarqt/assets/img/payment-methods/paypal.svg" height="35" />
                            </svg>
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
