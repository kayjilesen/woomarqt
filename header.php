<?php
/**
 *	Header
 */

// Menu
$menuOrder = get_field('menu_order', 'option');
$menuStyling = get_field('menu_styling', 'option');
$topbar = get_field('topbar', 'option');
$topbarOptions = get_field('topbar_options', 'option');
$header = get_field('head', 'option');
$subbar = get_field('subbar', 'option');
$uspbar = get_field('usp', 'option');
// Labels
$labels = get_field('labels', 'option');

$huisstijl = get_field('huisstijl', 'option');

$menu = wp_get_nav_menu_object( get_nav_menu_locations()[ 'header-menu' ] );
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

global $woocommerce;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <title><?php echo get_the_title(); ?></title>

    <!-- Load Tailwind CSS CDN -->
    <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Load Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Heading Font -->
    <link href="https://fonts.googleapis.com/css2?family=<?php echo $huisstijl['heading_font'] ?>&display=swap" rel="stylesheet">
    <!-- Body Font -->
    <link href="https://fonts.googleapis.com/css2?family=<?php echo $huisstijl['body_font'] ?>&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <?php
            // Show USP's - When First
            if($menuOrder === 'uths' && $uspbar['show_usps']) include 'blocks/header/usp.php';
            // Show Topbar when Active
            if($topbar['show_topbar']) include 'blocks/header/top.php';
            // Show Head - Default = Active
            include 'blocks/header/head.php';
            // Show Subbar when Active
            if($subbar['show_subbar']) include 'blocks/header/sub.php';
            // Show USP's - Default = Active - When First
            if($menuOrder === 'thsu' && $uspbar['show_usps']) include 'blocks/header/usp.php';
        ?>
        <div class="headerOverlay"></div>
    </header>
