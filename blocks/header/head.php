<?php 

    $firstParent = true;
    $firstChild = true;

?>

<div id="head" class="navigation-bar <?php if($header['sticky_head']) echo 'sticky '; ?><?php echo $header['custom_volgorde']; ?> items-center flex flex-row w-full">

    <div class="navbar-nav sm:px-3 mx-auto sm:px-6m <?php echo $menuStyling['width']; ?> w-full">
        <div class="flex flex-wrap justify-between py-2 lg:py-0 px-4 lg:px-<?php echo $header['styling']['padding_x']; ?> lg:justify-start md:space-x-10">
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
                                echo '<div class="nav-item py-' . $header['styling']['padding_y'] . ' ' . ($i < (count($menuitems)-1)?($menuitems[$i + 1]->menu_item_parent != 0 ? 'dropdown' : ''):'') . ($menuitems[$i]->title == 'Contact' ? 'contact ' : '') . (get_the_title() ===  $menuitems[$i]->title ? 'active' : '') . ( $header['styling']['height'] === ' auto' ? '' : ' lg:h-' . $header['styling']['height'] ) . '">';
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
                    <?php if($header['show_searchbar']) echo '<form id="searchForm" action="' . get_permalink() . '" method="GET"><input type="text" class="focus:outline-none" name="search" placeholder="Zoeken..." value=""><button type="submit" class="searchSubmit flex items-center justify-center">' . getIcon('search', '1em') . '</button></form>'; ?>
                </div>
            </div>
            <div class="flex lg:hidden mobileNav">
                <button class="navbar-toggler" id="toggleMenu" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="navbar-bar bar1"></div>
                    <div class="navbar-bar bar2"></div>
                    <div class="navbar-bar bar3"></div>
                </button>
            </div>
            <div class="flex iconRow">
                <div class="icon cart flex items-center dropdown px-2">
                    <?php echo getIcon('cart', '1.3em'); ?>
                    <div class="cartDropdown shadow-lg">
                        <div class="cartContentWrapper bg-white border text-black p-4">
                            <span class="text-xl font-bold mt-6 mb-8 pl-2">Winkelwagen</span>
                            <div id="cartProducts">
                                <?php
                                    global $woocommerce;
                                    $items = $woocommerce->cart->get_cart();
                                    foreach($items as $item => $values) { 
                                        echo '<div class="cartProduct flex items-center hover:shadow-md p-2 my-2 hover:border border-gray-200">';
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['data']->get_id() ), 'single-post-thumbnail' );
                                            echo '<a class="cartImage mr-3" href="' . get_the_permalink($values['data']->get_id()) . '"><img src="' . $image[0] . '"></a>';
                                            echo '<div class="cartProductInfo flex justify-between items-center w-full">';
                                                $_product =  wc_get_product( $values['data']->get_id()); 
                                                echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle font-bold text-sm w-full">' . $_product->get_title() .'</a>';
                                                echo '<div class="productPricing flex justify-end">';
                                                    echo '<div class="cartProductQuantity text-sm mr-2 w-8 text-right">' .$values['quantity']. ' x</div>'; 
                                                    $price = get_post_meta($values['product_id'] , '_price', true) * $values['quantity'];
                                                    echo '<div class="cartProductPrice text-sm w-16 text-right">€ ' . $price . '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                            <div class="cartButtons grid grid-cols-2 gap-1">
                                <a href="/checkout" class="cartButton text-center text-sm bg-green-600 hover:bg-green-700 text-white py-4 rounded-sm hover:shadow-lg duration-300">Afrekenen</a>
                                <a href="/winkelwagen" class="cartButton text-center text-sm bg-gray-500 hover:bg-gray-700 text-white py-4 rounded-sm hover:shadow-lg duration-300">Winkelmand</a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>