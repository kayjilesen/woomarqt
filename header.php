<?php
/**
 *	Header
 */

 $topbar = get_field('topbar', 'option');
 $subbar = get_field('subbar', 'option');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

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
