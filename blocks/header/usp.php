<div id="usp" class="navigation-bar lightColor w-full <?php echo ( $uspbar['styling']['height'] === 'auto' ? '' : 'h-' . $uspbar['styling']['height'] ); ?>">
    <div class="innerWrapper flex py-<?php echo $uspbar['styling']['padding_y']; ?> px-<?php echo $uspbar['styling']['padding_x']; ?> mx-auto <?php echo $menuStyling['width']; ?> w-full">
        <?php   
        if(!empty($uspbar['usps'])) :
            foreach($uspbar['usps'] as $usp){
                echo '<div class="uspBlock flex items-center text-sm mr-8"><div class="mr-1">' . getIcon( $usp['icon'], '1.6em' ) .  '</div>' . $usp['usp'] . '</div>';
            }
        endif;
        ?>
    </div>
</div>