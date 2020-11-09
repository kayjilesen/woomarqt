<div id="top" class="navigation-bar <?php if($topbar['sticky_topbar']) echo 'sticky'; ?>">
    <div class="flex justify-between items-center px-4 py-1 md:justify-start md:space-x-10 mx-auto max-w-screen-xl">
        <?php
            if(!empty($topbarOptions['text'])) :
        
                echo '<div class="md:flex items-center justify-start md:flex-1 lg:w-9/12 logoCol">';
                    if(!empty($topbarOptions['icon'])) echo '<i class="text-sm ' . $topbarOptions['icon'] . ' mr-2 ml-0"></i>';
                    echo '<div class="topbarText text-sm">' . $topbarOptions['text'] . '</div>';
                echo '</div>';
                
            endif;

            if(!empty($topbarOptions['telefoon']) || !empty($topbarOptions['email']) || !empty($topbarOptions['whatsapp'])) : 
                    echo '<div class="iconWrapper flex justify-end text-sm lg:w-3/12">';
                        if(!empty($topbarOptions['telefoon'])) echo '<a class="ml-3 topbarIcon" href="tel:' . $topbarOptions['telefoon'] . '"><i class="fa fa-phone"></i></a>';
                        if(!empty($topbarOptions['email'])) echo '<a class="ml-3 topbarIcon" href="mailto:' . $topbarOptions['email'] . '"><i class="fa fa-envelope"></i></a>';
                        if(!empty($topbarOptions['whatsapp'])) echo '<a class="ml-3 topbarIcon" href="https://wa.me/' . $topbarOptions['whatsapp'] . '"><i class="fab fa-whatsapp"></i></a>';
                    echo '</div>';
            endif;

        ?>
    </div>
</div>