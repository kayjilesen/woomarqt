<div id="top" class="navigation-bar <?php if($topbar['sticky_topbar']) echo 'sticky'; ?> w-full <?php echo ( $topbar['styling']['height'] === 'auto' ? '' : 'h-' . $topbar['styling']['height'] ); ?>">
    <div class="flex justify-between items-center px-4 lg:px-0 py-<?php echo $topbar['styling']['padding_y']; ?> lg:px-<?php echo $topbar['styling']['padding_x']; ?> md:justify-start md:space-x-10 mx-auto <?php echo $menuStyling['width']; ?> w-full">
        <?php
            if(!empty($topbar['topbar_options']['text'])) :
        
                echo '<div class="flex items-center justify-start items-center md:flex-1 lg:w-11/12 logoCol">';
                    if(!empty($topbar['topbar_options']['icon'])) echo '<div class="text-sm mr-1 ml-0">' . getIcon($topbar['topbar_options']['icon'], '1.6em') . '</div>';
                    echo '<div class="topbarText text-sm">' . $topbar['topbar_options']['text'] . '</div>';
                echo '</div>';
                
            endif;

            if(!empty($topbar['topbar_options']['telefoon']) || !empty($topbar['topbar_options']['email']) || !empty($topbar['topbar_options']['whatsapp'])) : 
                    echo '<div class="iconWrapper flex items-center justify-end text-sm lg:w-1/12">';
                        if(!empty($topbar['topbar_options']['telefoon'])) echo '<a class="ml-3 topbarIcon" href="tel:' . $topbar['topbar_options']['telefoon'] . '">' . getIcon('telephone-fill', '1em') . '</i></a>';
                        if(!empty($topbar['topbar_options']['email'])) echo '<a class="ml-3 topbarIcon" href="mailto:' . $topbar['topbar_options']['email'] . '">' . getIcon('envelope-fill', '1em') . '</a>';
                        if(!empty($topbar['topbar_options']['whatsapp'])) echo '<a class="ml-3 topbarIcon" href="https://wa.me/' . $topbar['topbar_options']['whatsapp'] . '">' . getIcon('whatsapp', '1em') . '</a>';
                    echo '</div>';
            endif;

        ?>
    </div>
</div>