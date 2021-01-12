<div id="usp" class="navigation-bar w-full <?php echo ( $uspbar['styling']['height'] === 'auto' ? '' : 'h-' . $uspbar['styling']['height'] ); ?>">
    <div id="uspSlider" class="autoplay innerWrapper sm:px-3 md:flex py-<?php echo $uspbar['styling']['padding_y']; ?> lg:px-<?php echo $uspbar['styling']['padding_x']; ?> mx-auto md:<?php echo $menuStyling['width']; ?> md:w-full">
        <?php   
        if(!empty($uspbar['usps'])) :
            foreach($uspbar['usps'] as $usp){
                echo '<div class="w-full flex md:w-auto"><div class="uspBlock flex justify-center md:justify-start witems-center text-sm md:mr-8 text-center md:text-left"><div class="mr-1">' . getIcon( $usp['icon'], '1.6em' ) .  '</div>' . $usp['usp'] . '</div></div>';
            }
        endif;
        ?>
    </div>
</div>