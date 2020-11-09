<?php 

    $firstParent = true;
    $firstChild = true;

?>

<div id="head" class="navigation-bar priColor <?php if($header['sticky_head']) echo 'sticky'; ?>">

    <div class="navbar-nav max-w-7xl mx-auto px-4 sm:px-6m max-w-screen-xl">
        <div class="flex justify-between items-center py-3 md:justify-start md:space-x-10">
            <div class="hidden md:flex items-center justify-start space-x-8 md:flex-1 lg:w-0 logoCol">
                <?php  if(!empty($huisstijl['logo'])) echo ($header['kleur_logo'] ? '<img src="' . $huisstijl['logo']['url'] . '" alt="' . $huisstijl['logo']['alt'] . '">' : '<img src="' . $huisstijl['logo_light']['url'] . '" alt="' . $huisstijl['logo_light']['alt'] . '">' ); ?>
            </div>
            <nav class="hidden md:flex space-x-10 menuCol">
                <?php
                    for($i = 0; $i < count($menuitems); $i++){
                        if($menuitems[$i]->menu_item_parent == 0){
                            $firstChild = true;
                            echo ($firstParent == true ? $firstParent = false : '</div>');
                            echo '<div class="nav-item ' . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? 'dropdown' : ''):'') . ($menuitems[$i]->title == 'Contact' ? 'contact ' : '') . (get_the_title() ===  $menuitems[$i]->title ? 'active' : '') . '">';
                                echo '<a title="Hous Pagina ' . $menuitems[$i]->title . '" href="' .  $menuitems[$i]->url . '" class="nav-link title">';
                                    echo '<h3>' .  $menuitems[$i]->title . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? '<i class="fas fa-chevron-down"></i>' : ''): '') . '</h3>';
                                echo '</a>';
                        } else {
                            if($firstChild == true){
                                $firstChild = false;
                                echo '<div class="dropdown-menu">';
                            }
                            echo '<a class="dropdown-item" title="Hous Pagina ' . $menuitems[$i]->title . '" href="' . $menuitems[$i]->url . '"><h6>' . $menuitems[$i]->title . '</h6></a>';
                            echo ($menuitems[$i + 1]->menu_item_parent == 0 ? '</div>' : '');
                        }
                    }
                    echo '</div>';
                ?> 
                </nav>
                <div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0 searchCol">
                    <?php if($header['show_searchbar']) echo '<input type="text" name="search" placeholder="" value="">'; ?>
                </div>
            </div>
        </div>
    </div>
</div>