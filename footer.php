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

if ($toon_widgets) { ?>
    <section class="footer container bg-gray-200 grid-cols-4 gap-8 grid-flow-row">
        <?php if ($toon_contact) { ?>
            <div class="col-auto">
                <p>Toon contact</p>
            </div>
        <?php } ?>
        <?php if ($toon_klantenservice) { ?>
            <div class="col-auto">
                <p>Toon klantenservice</p>
            </div>
        <?php } ?>
    </section>
<?php } ?>



<?php wp_footer(); ?>

</body>
</html>
