<?php

function get_css_content(){
    $huisstijl = get_field('huisstijl', 'option');
    $header = get_field('head', 'option');
    $topbar = get_field('topbar', 'option');
    $subbar = get_field('topbar', 'option');
    $uspbar = get_field('usp', 'option');

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
    $content .= '#head{background-color:' . $header['styling']['background_color'] . ';color:' . $header['styling']['text_color'] . ';}';
    $content .= ($header['custom_volgorde'] === 'lmsi' ? '#head.lmsi .logoCol{order: 1;}#head.lmsi  .menuCol{order: 2;}#head.lmsi .searchCol{order: 3;}' : ($header['custom_volgorde'] === 'lsmi' ? '#head.lsmi .logoCol{order: 1;}#head.lsmi .menuCol{order: 3;}#head.lsmi .searchCol{order: 2;}' : '' ));
    if($topbar['show_topbar']) $content .= '#top{background-color:' . $topbar['styling']['background_color'] . ';color:' . $topbar['styling']['text_color'] . ';}#top svg{color: ' . $topbar['styling']['text_color'] . ';}';
    if($uspbar['show_usps']) $content .= '#usp{background-color:' . $uspbar['styling']['background_color'] . ';color:' . $uspbar['styling']['text_color'] . '}#usp svg{color: ' . $uspbar['icon_color'] . ';}';

    // Footer CSS
    $content .= '#footer-usps{ background-color: ' . $footer_usps['background_color'] . ';}';
    $content .= '#footer-widgets{ background-color: ' . $footer_widgets['background_color'] . ';}';
    $content .= '#footer-copyright{ background-color: ' . $footer_copyright['background_color'] . ';}';
    
    return $content;
}