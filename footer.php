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
$toon_vervoerders = get_field('toon_vervoerders', 'option');
$toon_contact = get_field('toon_contact', 'option');
$toon_klantenservice = get_field('toon_klantenservice', 'option');

?>

<footer>
    <section id="footer" class="w-full bg-gray-200">
    <?php if ($toon_widgets) { ?>
        <div id="footer-widgets" class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid grid-cols-4">
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
        <?php if ($toon_copyright) { ?>
        <div id="footer-copyright" class="py-10 mx-auto max-w-screen-sm max-w-screen-md max-w-screen-lg max-w-screen-xl grid">
            <?php if ($toon_contact) { ?>
                <div class="col-auto">
                    <p>Copyright &copy; <?php echo date("Y") . " " . get_bloginfo('name') . " | " . "powered by <a href='#'>WooMarqt</a>" ?></p>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
</footer>


<?php wp_footer(); ?>

</body>
</html>
