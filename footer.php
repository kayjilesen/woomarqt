<?php
/**
 *	Footer
 */

//  Define Variables
$toon_usps = get_field('toon_usps', 'option');
$usps_overnemen = get_field('usps_overnemen', 'option');
$toon_widgets = get_field('toon_widgets', 'option');
$toon_copyright = get_field('toon_copyright', 'option');
$toon_betaalmethodes = get_field('toon_betaalmethodes', 'option');
$betaalmethodes = get_field('betaalmethodes', 'option');
$toon_vervoerders = get_field('toon_vervoerders', 'option');
$toon_contact = get_field('toon_contact', 'option');
$toon_klantenservice = get_field('toon_klantenservice', 'option');

?>

<footer id="footer" class="w-full">
    <section id="footer-widgets" class="w-full">
        <?php if ($toon_widgets) { ?>
            <div class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-4">
                <?php if ($toon_contact) { ?>
                    <div class="col-auto">
                        <h5>Contact</h5>
                    </div>
                <?php } ?>
                <?php if ($toon_klantenservice) { ?>
                    <div class="col-auto">
                        <h5>Klantenservice</h5>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </section>

    <section id="footer-copyright" class="w-full">
        <?php if ($toon_copyright) { ?>
            <div class="py-6 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-2 text-sm">
                <?php if ($toon_copyright) { ?>
                    <div class="col-auto">
                        <p>Copyright &copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
                    </div>
                <?php } ?>

                <?php if ($toon_betaalmethodes) { ?>
                    <div class="col-auto">
                        <?php if ($betaalmethodes['ideal']) { ?>
                            <img src="/wp-content/themes/woomarqt/assets/img/payment-methods/ideal.svg">
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
</footer>


<?php wp_footer(); ?>

</body>
</html>
