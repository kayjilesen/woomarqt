<?php

function get_css_content(){

    $huisstijl = get_field('huisstijl', 'option');
    $header = get_field('head', 'option');
    $topbar = get_field('topbar', 'option');
    $subbar = get_field('subbar', 'option');
    $uspbar = get_field('usp', 'option');
    $breadcrumbs = get_field('breadcrumbs', 'option');

    // Footer Variables
    $footer_settings            =   get_field('footer_settings', 'option');
    $footer_usps                =   get_field('footer_usps', 'option');
    $footer_widgets             =   get_field('footer_widgets', 'option');
    $footer_copyright           =   get_field('footer_copyright', 'option');
    $footer_payment_methods     =   get_field('footer_payment_methods', 'option');
    $footer_carriers            =   get_field('footer_carriers', 'option');

    $content = '/* Generated CSS file based on Theme Settings */';

    // Header CSS
    $content .= (!empty($huisstijl['primary_color']) ? '.priBackgroundColor{background-color:' . $huisstijl['primary_color'] . ';}.priTextColor{color:' . $huisstijl['primary_color'] . ';}' : '');
    $content .= (!empty($huisstijl['secondary_color']) ? '.secBackgroundColor{background-color:' . $huisstijl['secondary_color'] . ';}.secTextColor{color:' . $huisstijl['secondary_color'] . ';}' : '');
    $content .= (!empty($huisstijl['light_color']) ? '.lightBackgroundColor{background-color:' . $huisstijl['light_color'] . ';}.lightTextColor{color:' . $huisstijl['light_color'] . ';}' : '');
    $content .= '#head{background-color:' . $header['styling']['background_color'] . ';color:' . $header['styling']['text_color'] . ';}';
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
        $content .= '#breadcrumbContainer {background-color:' . $breadcrumbs['styling']['background_color'] . ';margin-bottom:' . $breadcrumbs['seperator_margin_x'] . 'px;}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb {margin-bottom:0px;color:' . $breadcrumbs['styling']['text_color'] . ';font-weight:400;font-weight:500;display:flex;flex-direction:row;align-items:center;flex-wrap:wrap; font-size:0.9em}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb a{margin:0px ' . $breadcrumbs['seperator_margin_x'] . 'px; color: ' . $breadcrumbs['styling']['link_color'] . ';}';
        $content .= '#breadcrumbContainer .woocommerce-breadcrumb .lastItem{margin-left:' . $breadcrumbs['seperator_margin_x'] . 'px;}';
    }

    // Footer CSS
    $content .= '#footer-usps{ background-color: ' . $footer_usps['styling']['background_color'] . '; color: ' . $footer_usps['styling']['text_color'] . ';}';
    $content .= '#footer-widgets{ background-color: ' . $footer_widgets['styling']['background_color'] . '; color: ' . $footer_widgets['styling']['text_color'] . ';}';
    $content .= '#footer-copyright{ background-color: ' . $footer_copyright['styling']['background_color'] . '; color: ' . $footer_copyright['styling']['text_color'] . ';}';

    // Fonts
    $content .= 'h1, h2, h3, h4, h5, h6 { font-family: ' . $huisstijl['heading_font'] . ', "Arial";}';
    $content .= 'p, ul, ul li, ol, ol li { font-family: ' . $huisstijl['body_font'] . ', "Arial";}';
    $content .= 'p a { color: ' . $huisstijl['primary_color'] . '; font-weight: 500;}';

    // Settings
    $filePath = TEMPLATEPATH . '/assets/css/';
    if($header['winkelwagen'] === 'side') $content .= file_get_contents($filePath . 'menu-side-cart.min.css');
    
    return $content;
}