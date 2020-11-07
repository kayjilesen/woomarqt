<?php
/**
 *	Footer
 */

//  Define Variables
$copyright = get_field('copyright', 'option');
$betaalmethodes = get_field('betaalmethodes', 'option');
$vervoerders = get_field('vervoerders', 'option');

?>

<?php if( have_rows('betaalmethodes', 'option') ): ?>

<ul>

<?php while( have_rows('betaalmethodes', 'option') ): the_row(); ?>
    <?php print_r(the_sub_field('betaalmethodes')); ?>
    <li><img src="/wp-content/themes/woomarqt/assets/img/payment-methods/<?php the_sub_field('title'); ?>.svg"></li>

<?php endwhile; ?>

</ul>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
