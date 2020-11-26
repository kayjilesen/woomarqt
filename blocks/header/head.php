<?php 

    $firstParent = true;
    $firstChild = true;

?>

<div id="head" class="navigation-bar <?php if($header['sticky_head']) echo 'stick '; ?><?php echo $header['custom_volgorde']; ?> items-center flex flex-row w-full relative">

    <div class="navbar-nav sm:px-3 mx-auto sm:px-6m <?php echo $menuStyling['width']; ?> w-full">
        <div class="flex flex-wrap justify-between py-2 lg:py-0 px-4 lg:px-<?php echo $header['styling']['padding_x']; ?> md:space-x-10">
            <div class="md:flex items-center justify-start space-x-8 logoCol">
                <?php  if(!empty($huisstijl['logo'])) echo '<a href="' . home_url() . '">' . ($header['kleur_logo'] ? '<img src="' . $huisstijl['logo']['url'] . '" alt="' . $huisstijl['logo']['alt'] . '">' : '<img src="' . $huisstijl['logo_light']['url'] . '" alt="' . $huisstijl['logo_light']['alt'] . '">' ) . '</a>'; ?>
            </div>
            <div class="md:flex mobileNavContainer space-x-8">
                <nav class="hidden md:flex space-x-3 menuCol justify-center">
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
                <div class="md:flex items-center justify-end space-x-8 md:flex-1 searchCol relative">
                    <?php if($header['show_searchbar']) {
                            echo '<form id="searchForm" action="' . get_permalink() . '" method="GET"><input type="text" class="focus:outline-none" name="search" placeholder="' . $labels['placeholder_search'] . '" value=""><button type="submit" class="searchSubmit flex items-center justify-center">' . getIcon('search', '1em') . '</button></form>'; 
                            echo '<div id="searchProducts" class="bg-white bottom-0 right-0 absolute duration-300 origin-top shadow-lg"></div>';
                            echo '<div id="searchOverlay"></div>';
                        }
                    ?>
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
                <div class="icon account flex items-center px-2">
                    <a href="/mijn-account"><?php echo getIcon($labels['account_icon_menu'], '1.6em'); ?></a>
                </div>
                <div class="icon cart flex items-center dropdown px-2">
                    <a href="/winkelwagen"><?php echo getIcon($labels['cart_icon_menu'], '1.3em'); ?></a>
                    <div class="cartItemsCount absolute bg-green-600 text-white font-bold rounded-full top-0 right-0 w-5 h-5 flex items-center justify-center"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
                    <div class="cartDropdown shadow-lg rounded">
                        <div class="cartContentWrapper bg-white border text-black p-4">
                            <span class="text-xl font-bold mt-6 mb-8 pl-2"><?php echo $labels['cart_name']; ?></span>
                            <div id="cartProducts">
                                <?php
                                    global $woocommerce;
                                    $items = $woocommerce->cart->get_cart();
                                    foreach($items as $item => $values) { 
                                        $_product =  wc_get_product( $values['data']->get_id()); 
                                        $price = wc_price( wc_get_price_to_display( $_product, array( 'price' => $_product->get_regular_price() * $values['quantity'] ) ) );
                                        echo '<div class="cartProduct flex items-center hover:shadow-md p-5 hover:border border-gray-200">';
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['data']->get_id() ), 'single-post-thumbnail' );
                                            echo '<a class="cartImage mr-3" href="' . get_the_permalink($values['data']->get_id()) . '"><img src="' . $image[0] . '"></a>';
                                            echo '<div class="cartProductInfo flex justify-between items-center w-full">';
                                                echo '<a href="' . get_the_permalink($values['data']->get_id()) . '" class="cartProductTitle font-bold text-sm w-full">' . $_product->get_title() .'</a>';
                                                echo '<div class="productPricing flex justify-end">';
                                                    echo '<div class="cartProductQuantity text-sm mr-2 w-8 text-right">' .$values['quantity']. ' x</div>'; 
                                                    //$price = get_post_meta($values['product_id'] , '_price', true) * $values['quantity'];
                                                    echo '<div class="cartProductPrice text-sm w-20 text-right">' . $price . '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                            <div class="cartButtons grid grid-cols-2 gap-1">
                                <a href="/winkelwagen" class="cartButton text-center text-sm bg-gray-500 hover:bg-gray-700 text-white py-4 rounded hover:shadow-lg duration-300 flex items-center justify-center"><?php echo getIcon($labels['cart_icon_menu'], '1.3em'); ?><span class="pl-2">Winkelmand</span></a>
                                <a href="/checkout" class="cartButton text-center text-sm bg-green-600 hover:bg-green-700 text-white py-4 rounded hover:shadow-lg duration-300 flex items-center justify-center"><span class="pr-2">Afrekenen</span><?php echo getIcon('chevron-right', '1.3em'); ?></a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>