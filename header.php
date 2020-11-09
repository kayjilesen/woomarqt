<?php
/**
 *	Header
 */

//  Define Variables
$topbar = get_field('topbar', 'option');
$header = get_field('head', 'option');
$subbar = get_field('subbar', 'option');
$uspbar = get_field('usp', 'option');

$huisstijl = get_field('huisstijl', 'option');

$menu = wp_get_nav_menu_object( get_nav_menu_locations()[ 'header-menu' ] );
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Load Heading Font -->
    <link href="https://fonts.googleapis.com/css2?family=<?php get_field('heading-font', 'option') ?>&display=swap" rel="stylesheet">
    <!-- Load Body Font -->
    <link href="https://fonts.googleapis.com/css2?family=<?php get_field('body-font', 'option') ?>&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS CDN -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <?php

            // Show Topbar when Active
            if($topbar['show_topbar']) include 'blocks/header/top.php';
            // Show Head - Default = Active
            include 'blocks/header/head.php';
            // Show Subbar when Active
            if($subbar['show_subbar']) include 'blocks/header/top.php';
            // Show USP's - Default = Active
            include 'blocks/header/usp.php';

        ?>
    </header>
