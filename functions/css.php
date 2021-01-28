<?php

function get_css_content(){

    $huisstijl = get_field('huisstijl', 'option');
    $header = get_field('head', 'option');
    $topbar = get_field('topbar', 'option');
    $subbar = get_field('subbar', 'option');
    $uspbar = get_field('usp', 'option');
    $breadcrumbs = get_field('breadcrumbs', 'option');
    $shop = get_field('shop', 'option');
    $productblock = get_field('productblock', 'option');
    
    $productSettings = get_field('settings', 'option');
    $productStyling = get_field('product_styling', 'option');
    $productSpecificaties = get_field('specificaties', 'option');
    $productVoordelen = get_field('voordelen', 'option');

    $filePath = TEMPLATEPATH . '/assets/css/';

    // Footer Variables
    $footer_settings            =   get_field('footer_settings', 'option');
    $footer_usps                =   get_field('footer_usps', 'option');
    $footer_widgets             =   get_field('footer_widgets', 'option');
    $footer_copyright           =   get_field('footer_copyright', 'option');
    $footer_payment_methods     =   get_field('footer_payment_methods', 'option');
    $footer_carriers            =   get_field('footer_carriers', 'option');

    $content = '/* Generated CSS file based on Theme Settings */';

    // General
    $content .= 'h1,h2,h3,h4,h5,h6{font-family:"' . $huisstijl['heading_font'] . '", "' . $huisstijl['body_font'] . '", sans-serif;}';
    $content .= 'p, li, button{font-family:"' . $huisstijl['body_font'] . '", "' . $huisstijl['heading_font'] . '", sans-serif;}';
    $content .= '.greenText{color:' . $huisstijl['green_color'] . ';font-weight:700;}';

    // Notifications 
    $content .= 'body .woocommerce-info {border-top: 0px;}';
    $content .= 'body .woocommerce-info::before {color: ' . $huisstijl['secondary_color'] . ';}';
    $content .= 'body .woocommerce-info a{color:' . $huisstijl['primary_color'] . ';}';

    // Header CSS
    $content .= (!empty($huisstijl['primary_color']) ? '.priBackgroundColor{background-color:' . $huisstijl['primary_color'] . ';}.priTextColor{color:' . $huisstijl['primary_color'] . ';}' : '');
    $content .= (!empty($huisstijl['secondary_color']) ? '.secBackgroundColor{background-color:' . $huisstijl['secondary_color'] . ';}.secTextColor{color:' . $huisstijl['secondary_color'] . ';}' : '');
    $content .= (!empty($huisstijl['light_color']) ? '.lightBackgroundColor{background-color:' . $huisstijl['light_color'] . ';}.lightTextColor{color:' . $huisstijl['light_color'] . ';}' : '');
    $content .= '#head{background-color:' . $header['styling']['background_color'] . ';color:' . $header['styling']['text_color'] . ';}';
    $content .= 'header .openDropdown{color:' . $huisstijl['primary_color'] . ';}';
    $content .= '@media (min-width:993px){';
        $content .= ($header['custom_volgorde'] === 'lmsi' ? '#head.lmsi .logoCol{order: 1;}#head.lmsi  .menuCol{order: 2;}#head.lmsi .searchCol{order: 3;}' : ($header['custom_volgorde'] === 'lsmi' ? '#head.lsmi .logoCol{order: 1;}#head.lsmi .menuCol{order: 3;}#head.lsmi .searchCol{order: 2;}' : '' ));
    $content .= '}';
    if($topbar['show_topbar']) $content .= '#top{background-color:' . $topbar['styling']['background_color'] . ';color:' . $topbar['styling']['text_color'] . ';}#top svg{color: ' . $topbar['styling']['text_color'] . ';}';
    if($uspbar['show_usps']) $content .= '#usp{background-color:' . $uspbar['styling']['background_color'] . ';color:' . $uspbar['styling']['text_color'] . '}#usp svg{color: ' . $uspbar['icon_color'] . ';}';

    // Subbar
    if($subbar['show_subbar']){
        $content .= '#sub .nav-item h3{color:' . $subbar['styling']['text_color'] . ';font-weight:400;}';
        $content .= '#sub{background-color:' . $subbar['styling']['background_color'] . ';box-shadow: 0px 6px 30px rgba(0,0,0, ' . ((float)$subbar['styling']['show_shadow'] / 100) . ');}';
        if($subbar['show_icons'] && !empty($subbar['styling']['icon_color'])) $content .= '#sub .menuIcon{color:' . $subbar['styling']['icon_color'] . ';transition:.3s;}#sub .nav-item:hover .menuIcon{color:' . $huisstijl['primary_color'] . ';}';
    }
    // BreadCrumbs
    if($breadcrumbs['show_breadcrumbs']) {
        $content .= '#breadcrumbContainer {background-color:' . $breadcrumbs['styling']['background_color'] . ';margin-bottom:' . $breadcrumbs['styling']['margin_bottom'] . 'px;}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb {margin-bottom:0px;color:' . $breadcrumbs['styling']['text_color'] . ';font-weight:400;font-weight:500;display:flex;flex-direction:row;align-items:center;flex-wrap:wrap; font-size:0.9em}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb a{margin:0px ' . $breadcrumbs['seperator_margin_x'] . 'px; color: ' . $breadcrumbs['styling']['link_color'] . ';}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb .lastItem{margin-left:' . $breadcrumbs['seperator_margin_x'] . 'px;}';
    }

    // Shoppage
    $content .= '.archive.woocommerce h1.page-title{font-size:' . $shop['title_size'] . 'em;margin:' . ($shop['title_size'] / 2) . 'em 0em;}';
    if($shop['products_pagination'] === 'paginate'){
        $pagination = get_field('pagination', 'option');
        $content .= '#primary ul.page-numbers{border:0px;}';
        $content .= '#primary ul.page-numbers span.page-numbers.current{background-color:' . $pagination['primary_color'] . ';color:' . $pagination['sub_color'] . ';}';
        $content .= '#primary ul.page-numbers span.page-numbers{color:' . $pagination['primary_color'] . ';width:100%;height:100%;display:flex;justify-content:center;align-items: center;}';
        $content .= '#primary ul.page-numbers li, #primary ul.page-numbers li a {border:0px;width:36px;height:36px;color:' . $pagination['primary_color'] . ';border-radius:3px;display:flex;justify-content:center;align-items: center;}';
        $content .= 'nav.woocommerce-pagination{margin:' . $pagination['margin_y'] . 'px 0px;justify-content:' . $pagination['align'] . '}';
    }

    // Productcategory
    $content .= 'body.woocommerce ul.products{display:grid;grid-auto-flow:row;grid-template-columns:repeat(' . $shop['product_columns'] . ', minmax(0, 1fr));gap:' . $productblock['styling']['margin'] . 'rem;}';
    $content .= 'body.woocommerce ul.products::after,body.woocommerce ul.products::before{content:unset;}';
    $content .= '@media (max-width:992px){';
        $content .= 'ul.products .productBlock .imageWrapper{width: calc(100% - (' . $productblock['styling']['image_padding'] . 'rem / 2)) !important;padding-bottom:calc(100% - (' . $productblock['styling']['image_padding'] . 'rem) / 2) !important;margin:0 auto ' . $productblock['styling']['image_padding'] / 2 . 'rem auto !important;}';
        $content .= 'ul.products .productBlock {padding:' . $productblock['styling']['padding_y'] / 2 . 'em ' . $productblock['styling']['padding_x'] / 2 . 'em !important;}';
        $content .= 'body.woocommerce ul.products{grid-template-columns:repeat(' . $shop['product_columns_on_mobile'] . ', minmax(0, 1fr));gap:' . $productblock['styling']['margin'] / 2 . 'rem;}';
    $content .= '}';

    // Productblock
    $content .= 'ul.products .productBlock{padding:' . $productblock['styling']['padding_y'] . 'em ' . $productblock['styling']['padding_x'] . 'em;box-shadow: 0px 6px 30px rgba(0,0,0, ' . ((float)$productblock['styling']['shadow'] / 100) . ');border-radius:' . $productblock['styling']['border_radius'] . 'px;display:flex;flex-direction:column;justify-content:space-between;height:100%;width:100%;}';
    $content .= 'ul.products .productBlock .imageWrapper{width: calc(100% - (0.5 * ' . $productblock['styling']['image_padding'] . 'rem));padding:0 ' . $productblock['styling']['image_padding'] / 4 . 'rem 100% ' . $productblock['styling']['image_padding'] / 4 . 'rem ;margin:0 auto ' . $productblock['styling']['image_padding'] / 4 . 'rem auto;}';
    $content .= 'ul.products .productBlock:hover .imageWrapper img{transform: scale(1.04) translate(-48%, -48%);}';
    $content .= 'ul.products .productBlock .imageWrapper img{transition:.3s;}';
    $content .= 'ul.products .productBlock .add_to_cart_button{padding:16px;margin-top:12px;color:' . $productblock['styling']['knop_text_kleur'] . ';background-color:' . $productblock['styling']['knop_kleur'] . ';transition:.3s;border-radius:' . $productblock['styling']['knop_border_radius'] . 'px;font-weight:' . $productblock['styling']['font_weight'] . ';font-size:1em;text-align:center;}';
    $content .= 'ul.products .productBlock .add_to_cart_button:hover{color:' . $productblock['styling']['knop_text_kleur_hover'] . ';background-color:' . $productblock['styling']['knop_kleur_hover'] . ';transition:.3s;}';
    // -- Specificaties
    $content .= 'body.single-product th.woocommerce-product-attributes-item__label{text-align:' . $productSpecificaties['title_align'] . ';font-weight:' . $productSpecificaties['title_font_weight'] . ';color:' . $productSpecificaties['title_color'] . ';min-width:200px;}';
    $content .= 'body.single-product td.woocommerce-product-attributes-item__value{text-align:' . $productSpecificaties['value_align'] . ';font-weight:' . $productSpecificaties['value_font_weight'] . ';color:' . $productSpecificaties['value_color'] . ';}';
    // -- Voordelen

    // Custom Categorieën
    //$content .= 'section.custom h3{color:' . $huisstijl['primary_color'] . ';font-weight:bold;margin-bottom:24px;}';
    $content .= '.button{background-color:' . $huisstijl['primary_color'] . ';color:' . $header['styling']['text_color'] . ';padding: 12px 18px;border:1px solid ' . $huisstijl['primary_color'] . ';border-radius:' . $productblock['styling']['knop_border_radius'] . 'px;font-weight:' . $productblock['styling']['font_weight'] . ';margin-top: 24px;transition:.3s;}';
    $content .= '.button:hover{background-color:' . $huisstijl['light_color'] . ';color:' . $huisstijl['primary_color'] . ';}';

    // Productpage
    $content .= '.product.type-product{align-items:' . $productSettings['product_info_align'] . ';}';
    $content .= 'body.single-product .summary{display:flex;flex-direction:column;}';
    $content .= '.summary h1{font-size:' . $productStyling['product_title_size'] . 'em;line-height:' . $productStyling['product_title_size'] / 2 . 'em;margin-bottom:' . $productStyling['product_title_size'] / 2 . 'rem;font-weight:500;order:1;}';
    $content .= 'body.single-product #main .single_add_to_cart_button{color:' . $productblock['styling']['knop_text_kleur'] . ';background-color:' . $productblock['styling']['knop_kleur'] . ';transition:.3s;border-radius:' . $productblock['styling']['knop_border_radius'] . 'px;font-weight:' . $productblock['styling']['font_weight'] . ';}';
    $content .= 'body.single-product #main .single_add_to_cart_button:hover{color:' . $productblock['styling']['knop_text_kleur_hover'] . ';background-color:' . $productblock['styling']['knop_kleur_hover'] . ';transition:.3s;}';
    $content .= 'body.single-product h2:not(.woocommerce-loop-product__title){font-size:' . $productStyling['subtitle_size'] . 'em;font-weight:500;margin-bottom:' . $productStyling['subtitle_size'] / 2 . 'rem;}';
    $content .= 'body.single-product section.related.products{margin:5rem 0;}';
    $content .= 'body.single-product div.product div.images img {padding:50px;}';
    if($productSettings['show_advantages']) {
        $content .= '.productInfo{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;}';
        $content .= '.woocommerce-tabs, .voordelenWrapper{width:45%;}';
        $content .= '.voordelenWrapper{order:2;}';
        $content .= '.upsells, .related{order:3;}';
        $content .= '.voordeelIcon{background-color:' . $productVoordelen['circle_background_color'] . ';color:' . $productVoordelen['circle_icon_color'] . ';border-radius:50%;height:100%;}';
    }
    if(!$productSettings['show_tabs']) $content .= 'ul.tabs.wc-tabs{display:none;}';

    // Cart
    $content .= '#cart .woocommerce a.button.alt{background-color:' . $huisstijl['green_color'] . ';}';
    $content .= '#cart .woocommerce a.button.alt:hover{background-color:#019303;}';
    $content .= '#cart h1{font-size:1.8em;font-weight:500;margin-bottom:.6em;color:' . $huisstijl['primary_color'] . ';}';

    // Checkout 
    $content .= '#checkout .woocommerce button.button.alt{background-color:' . $huisstijl['green_color'] . ';}';
    $content .= '#checkout .woocommerce button.button.alt:hover{background-color:#019303;}';

    // Footer CSS
    $content .= '#footer-usps{ background-color: ' . $footer_usps['styling']['background_color'] . '; color: ' . $footer_usps['styling']['text_color'] . ';}';
    $content .= '#footer-widgets{ background-color: ' . $footer_widgets['styling']['background_color'] . '; color: ' . $footer_widgets['styling']['text_color'] . ';}';
    $content .= '#footer-copyright{ background-color: ' . $footer_copyright['styling']['background_color'] . '; color: ' . $footer_copyright['styling']['text_color'] . ';}';

    // Fonts
    $content .= 'h1, h2, h3, h4, h5, h6 { font-family: ' . $huisstijl['heading_font'] . ', "Arial";}';
    $content .= 'p, ul, ul li, ol, ol li { font-family: ' . $huisstijl['body_font'] . ', "Arial";}';
    $content .= 'main p a, main li a, #footer-copyright a { color: ' . $huisstijl['primary_color'] . '; font-weight: 500;}';

    // Settings
    if($header['winkelwagen'] === 'side') $content .= file_get_contents($filePath . 'menu-side-cart.min.css');
    
    // Custom CSS
    $content .= file_get_contents($filePath . 'custom.min.css');
    
    return $content;
}