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
$breadcrumbs = get_field('breadcrumbs', 'option');
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
    <link href="https://fonts.googleapis.com/css2?family=<?php echo $huisstijl['heading_font'] ?>:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=<?php echo $huisstijl['body_font'] ?>:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Parent Styling -->
    <?php if(!empty($post->post_parent) && $post->post_parent !== 0 && file_exists(get_template_directory() . '/assets/css/' . get_post($post->post_parent)->post_name . '.min.css')) echo '<link href="' . get_template_directory_uri() . '/assets/css/' . get_post($post->post_parent)->post_name . '.min.css?v=' . filemtime(get_theme_file_path() . '/assets/css/' . get_post($post->post_parent)->post_name . '.min.css') . '" rel="stylesheet" type="text/css">'; ?>
    <!-- Page Styling -->
    <?php if(is_cart()) echo '<link href="' . get_template_directory_uri() . '/assets/css/cart.min.css?v=' . filemtime(get_template_directory() . '/assets/css/cart.min.css')  . '" rel="stylesheet">'; ?>
    <?php if(is_checkout()) echo '<link href="' . get_template_directory_uri() . '/assets/css/checkout.min.css?v=' . filemtime(get_template_directory() . '/assets/css/checkout.min.css')  . '" rel="stylesheet">'; ?>
    
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
    </header>
    <div class="headerOverlay"></div>
    
    <?php if($header['winkelwagen'] === 'side') { include 'blocks/header/side-cart.php'; } ?>

    <?php 
        // Show Breadcrumbs when Active
        $args = array(
            'delimiter' => (strlen($breadcrumbs['seperator']) > 4 ? getIcon($breadcrumbs['seperator'], '1em') : $breadcrumbs['seperator'] )
        );
        if(!is_front_page() && $breadcrumbs['show_breadcrumbs']) {
            echo '<div id="breadcrumbContainer" class=" mx-auto ' . $menuStyling['width'] . ' w-full px-' . $breadcrumbs['styling']['padding_x'] . ' py-' . $breadcrumbs['styling']['padding_y'] . '">';
                woocommerce_breadcrumb( $args );
            echo '</div>';
        }
    ?>