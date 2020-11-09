<?php

function getCSSContent(){
    $huisstijl = get_field('huisstijl', 'option');
    $header = get_field('head', 'option');
    $topbar = get_field('topbar', 'option');
    $subbar = get_field('topbar', 'option');
    $uspbar = get_field('usp', 'option');

    $content = '/*Generated CSS file based on Theme Settings*/';
    // Header CSS
    $content .= (!empty($huisstijl['primary_color']) ? '.priBackgroundColor{background-color:' . $huisstijl['primary_color'] . ';}.priTextColor{color:' . $huisstijl['primary_color'] . ';}' : '');
    $content .= (!empty($huisstijl['secondary_color']) ? '.secBackgroundColor{background-color:' . $huisstijl['secondary_color'] . ';}.secTextColor{color:' . $huisstijl['secondary_color'] . ';}' : '');
    $content .= '#head{background-color:' . $header['styling']['background_color'] . ';color:' . $header['styling']['text_color'] . ';}';
    //$content .= ($header['menu_volgorde'] === 'lsmi' ? '.logoCol{order: 1;}.menuCol {order: 3;}.searchCol{order: 2;}')
    if($topbar['show_topbar']) $content .= '#top{background-color:' . $topbar['styling']['background_color'] . ';color:' . $topbar['styling']['text_color'] . ';}#top svg{color: ' . $topbar['styling']['text_color'] . ';}';
    if($uspbar['show_usps']) $content .= '#usp{background-color:' . $uspbar['styling']['background_color'] . ';color:' . $uspbar['styling']['text_color'] . '}#usp svg{color: ' . $uspbar['icon_color'] . ';}';
    // Footer CSS
    $content .= '#footer{background-color:' . get_field('achtergrondkleur', 'option') . ';}';
    return $content;
}