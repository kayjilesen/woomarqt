<?php

    if($subbar['show_menu_items']){

        $firstParent = true;
        $firstChild = true;
    
        $menu = wp_get_nav_menu_object( get_nav_menu_locations()[ $subbar['menu_type'] . '-menu' ] );
        $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
    }

?>

<div id="sub" class="navigation-bar <?php if($subbar['sticky_subbar']) echo 'sticky'; ?>">
    <div class="wrapper <?php echo $menuStyling['width']; ?> w-full mx-auto">
        <nav class="hidden md:flex space-x-3 menuCol">
            <?php
                for($i = 0; $i < count($menuitems); $i++){
                    if($menuitems[$i]->menu_item_parent == 0){
                        $firstChild = true;
                        echo ($firstParent == true ? $firstParent = false : '</div>');
                        echo '<div class="nav-item py-' . $subbar['styling']['padding_y'] . ' ' . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? 'dropdown' : ''):'') . ($menuitems[$i]->title == 'Contact' ? 'contact ' : '') . (get_the_title() ===  $menuitems[$i]->title ? 'active' : '') . ( $subbar['styling']['height'] === ' auto' ? '' : ' lg:h-' . $subbar['styling']['height'] ) . '">';
                            echo '<div class="itemWrapper">';
                                echo '<a title="' . get_bloginfo( ) . ' Pagina ' . $menuitems[$i]->title . '" href="' .  $menuitems[$i]->url . '" class="nav-link flex items-center title">';
                                    echo ($subbar['show_icons'] && !empty($menuitems[$i]->classes[0]) ? '<div class="menuIcon mr-2">' . getIcon($menuitems[$i]->classes[0], '1em') . '</div>' : '' ) . '<h3>' . $menuitems[$i]->title . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? '' : ''): '') . '</h3>';
                                echo '</a>';
                                if(!empty($menuitems[$i + 1])) echo ($menuitems[$i + 1]->menu_item_parent != 0 ? '<div class="openDropdown flex justify-center items-center">' . getIcon('chevron-down', '1em') . '</div>' : '');
                            echo '</div>';
                    } else {
                        if($firstChild == true){
                            $firstChild = false;
                            echo '<div class="dropdown-menu">';
                        }
                        echo '<a class="dropdown-item" title="' . get_bloginfo(  ) . ' Pagina ' . $menuitems[$i]->title . '" href="' . $menuitems[$i]->url . '"><h6>' . $menuitems[$i]->title . '</h6></a>';
                        echo (!empty($menuitems[$i + 1]) && $menuitems[$i + 1]->menu_item_parent == 0 ? '</div>' : '');
                    }
                }
                echo '</div>';
            ?> 
        </nav>
    </div>
</div>