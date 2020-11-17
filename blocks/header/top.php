<div id="top" class="navigation-bar <?php if($topbar['sticky_topbar']) echo 'sticky'; ?> w-full <?php echo ( $topbar['styling']['height'] === 'auto' ? '' : 'h-' . $topbar['styling']['height'] ); ?>">
    <div class="flex justify-between items-center sm:px-3 py-<?php echo $topbar['styling']['padding_y']; ?> lg:px-<?php echo $topbar['styling']['padding_x']; ?> md:justify-start md:space-x-10 mx-auto <?php echo $menuStyling['width']; ?> w-full">
        <?php
            if(!empty($topbarOptions['text'])) :
        
                echo '<div class="flex items-center justify-start items-center md:flex-1 lg:w-11/12 logoCol">';
                    if(!empty($topbarOptions['icon'])) echo '<div class="text-sm mr-1 ml-0">' . getIcon($topbarOptions['icon'], '1.6em') . '</div>';
                    echo '<div class="topbarText text-sm">' . $topbarOptions['text'] . '</div>';
                echo '</div>';
                
            endif;

            if(!empty($topbarOptions['telefoon']) || !empty($topbarOptions['email']) || !empty($topbarOptions['whatsapp'])) : 
                    echo '<div class="iconWrapper flex items-center justify-end text-sm lg:w-1/12">';
                        if(!empty($topbarOptions['telefoon'])) echo '<a class="ml-3 topbarIcon" href="tel:' . $topbarOptions['telefoon'] . '">' . getIcon('telephone-fill', '1em') . '</i></a>';
                        if(!empty($topbarOptions['email'])) echo '<a class="ml-3 topbarIcon" href="mailto:' . $topbarOptions['email'] . '">' . getIcon('envelope-fill', '1em') . '</a>';
                        if(!empty($topbarOptions['whatsapp'])) echo '<a class="ml-3 topbarIcon" href="https://wa.me/' . $topbarOptions['whatsapp'] . '">' . getIcon('whatsapp', '1em') . '</a>';
                    echo '</div>';
            endif;

        ?>
    </div>
</div>