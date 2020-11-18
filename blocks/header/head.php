<?php 

    $firstParent = true;
    $firstChild = true;

?>

<div id="head" class="navigation-bar <?php if($header['sticky_head']) echo 'sticky '; ?><?php echo $header['custom_volgorde'] . ( $header['styling']['height'] === 'auto' ? '' : 'h-' . $header['styling']['height'] ); ?> items-center flex flex-row w-full">

    <div class="navbar-nav sm:px-3 mx-auto sm:px-6m <?php echo $menuStyling['width']; ?> w-full">
        <div class="flex flex-wrap justify-between items-center py-<?php echo $header['styling']['padding_y']; ?> px-<?php echo $header['styling']['padding_x']; ?> lg:justify-start md:space-x-10">
            <div class="md:flex items-center justify-start space-x-8 md:flex-1 lg:w-3/12 logoCol">
                <?php  if(!empty($huisstijl['logo'])) echo '<a href="' . home_url() . '">' . ($header['kleur_logo'] ? '<img src="' . $huisstijl['logo']['url'] . '" alt="' . $huisstijl['logo']['alt'] . '">' : '<img src="' . $huisstijl['logo_light']['url'] . '" alt="' . $huisstijl['logo_light']['alt'] . '">' ) . '</a>'; ?>
            </div>
            <div class="md:flex mobileNavContainer">
                <nav class="hidden md:flex space-x-10 menuCol lg:w-6/12 justify-center">
                    <?php
                        for($i = 0; $i < count($menuitems); $i++){
                            if($menuitems[$i]->menu_item_parent == 0){
                                $firstChild = true;
                                echo ($firstParent == true ? $firstParent = false : '</div>');
                                echo '<div class="nav-item ' . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? 'dropdown' : ''):'') . ($menuitems[$i]->title == 'Contact' ? 'contact ' : '') . (get_the_title() ===  $menuitems[$i]->title ? 'active' : '') . '">';
                                    echo '<div class="itemWrapper">';
                                        echo '<a title="' . get_bloginfo( ) . ' Pagina ' . $menuitems[$i]->title . '" href="' .  $menuitems[$i]->url . '" class="nav-link flex items-center title">';
                                            echo '<h3>' .  $menuitems[$i]->title . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? '' : ''): '') . '</h3>';
                                        echo '</a>';
                                        echo ($menuitems[$i + 1]->menu_item_parent != 0 ? '<div class="openDropdown flex justify-center items-center">' . getIcon('chevron-down', '1em') . '</div>' : '');
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
                <div class="md:flex items-center justify-end space-x-8 md:flex-1 lg:w-3/12 searchCol">
                    <?php if($header['show_searchbar']) echo '<input type="text" name="search" placeholder="" value="">'; ?>
                </div>
            </div>
            <div class="flex lg:hidden mobileNav">
                <button class="navbar-toggler" id="toggleMenu" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="navbar-bar bar1"></div>
                    <div class="navbar-bar bar2"></div>
                    <div class="navbar-bar bar3"></div>
                </button>
            </div>
        </div>
    </div>
</div>