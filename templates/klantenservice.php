<?php

    $data = get_field('klantenservice', 'option');

    //print_r($data);

?>

    <div class="<?php echo $data['container_width']; ?> flex mx-auto <?php echo ($data['show_sidebar'] ? 'flex-row' : '' ); ?> my-<?php echo $data['styling']['margin_y']; ?>">
        <?php 
            if($data['show_sidebar']){
                echo '<div class="sidebar pr-' . $data['styling_sidebar']['padding_x'] . ' py-' . $data['styling_sidebar']['padding_y'] . '">';
                    $pageMenu = get_pages(array('child_of' => $wp_query->post->post_parent));
                    echo '<div class="innerWrapper flex flex-col">';
                            
                        foreach($pageMenu as $item){
                            echo '<a href="/klantenservice/' . $item->post_name . '" class="page">' . $item->post_title . '</a>';
                        }
                    echo '</div>';
                echo '</div>';
                wp_reset_postdata();
            } 
        ?>
        <div class="pageContent px-<?php echo $data['styling']['padding_x']; ?> py-<?php echo $data['styling']['padding_y']; ?>">
            <?php if($data['show_title']) echo '<div class="' . $data['font_size'] . '">' . get_the_title() . '</div>'; ?>
            <?php the_content($wp_query->post->ID); ?>
        </div>
    </div>