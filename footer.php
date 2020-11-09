<?php
/**
 *	Footer
 */

//  Define Variables
$preset = get_field('footer_preset', 'option');
$copyright = get_field('copyright', 'option');
$betaalmethodes = get_field('betaalmethodes', 'option');
$vervoerders = get_field('vervoerders', 'option');

if ($preset === 'Footer 1') { ?>
    <section class="footer container bg-gray-200">
        <p>Test</p>
    </section>
<?php } else if ($preset === 'Footer 2') {
    print_r('Footer 2');
}

?>



<?php wp_footer(); ?>

</body>
</html>
