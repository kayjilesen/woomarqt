<?php
/**
 *	Functions
 */ 

// Add Menu's
function woomarqt_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Register Custom Blank Navigation
function register_custom_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'Hoofdmenu'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'Hoofdmenu'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'Hoofdmenu')
    ));
}

add_action('init', 'register_custom_menu'); // Add HTML5 Blank Menu

// Tutorial Page
function woomarqt_register_tutorials_menu_page() {
    add_menu_page(
        __( 'Tutorials', 'woodmart' ),
        'Tutorials',
        'edit_posts',
        'tutorials',
        '',
        'dashicons-video-alt3',
        99
    );
}
add_action( 'admin_menu', 'woomarqt_register_tutorials_menu_page' );

// Advanced Custom Fields Options Page
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=>  'WooMarqt',
		'menu_title'	=>  'WooMarqt',
		'menu_slug' 	=>  'woomarqt-settings',
		'capability'	=>  'edit_posts',
        'redirect'		=>  false,
        'icon_url'		=>  'dashicons-menu-alt',
		'position'		=>  3
    ));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Bedrijfsgegevens',
		'menu_title'	=> 'Bedrijfsgegevens',
		'parent_slug'	=> 'woomarqt-settings',
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'woomarqt-settings',
    ));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Shoppagina',
		'menu_title'	=> 'Shoppagina',
		'parent_slug'	=> 'woomarqt-settings',
    ));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Productpagina',
		'menu_title'	=> 'Productpagina',
		'parent_slug'	=> 'woomarqt-settings',
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'woomarqt-settings',
	));
}

// Custom Post Types
$custom_post_types = get_field('custom_post_types', 'option');

if ( $custom_post_types['faqs'] ) {
    function woomarqt_faqs() {
        register_post_type('woomarqt_faqs',
            array(
                'labels'    =>  array(
                    'name'              =>      __('FAQ\'s', 'woomarqt'),
                    'singular_name'     =>      __('FAQ', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe FAQ', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-welcome-learn-more',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_faqs');
}

if ( $custom_post_types['looks'] ) {
    function woomarqt_looks() {
        register_post_type('woomarqt_looks',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Looks', 'woomarqt'),
                    'singular_name'     =>      __('Look', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe look', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-heart',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_looks');
}

if ( $custom_post_types['vacatures'] ) {
    function woomarqt_vacatures() {
        register_post_type('woomarqt_vacatures',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Vacatures', 'woomarqt'),
                    'singular_name'     =>      __('Vacature', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe vacature', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-groups',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_vacatures');
}

// Load Custom WooMarqt Styles 
function custom_woomarqt_styles() {    

    if(!is_admin()){
        wp_register_style('menu', get_template_directory_uri() . '/assets/css/menu.min.css', array(),  filemtime(get_theme_file_path('/assets/css/menu.min.css')), 'all');
        wp_enqueue_style('menu'); // Menu

        wp_register_style('input', get_template_directory_uri() . '/assets/css/input.min.css', array(),  filemtime(get_theme_file_path('/assets/css/input.min.css')), 'all');
        wp_enqueue_style('input'); // Menu
    }

    if(is_admin()){
        wp_register_style( 'admin-css', get_template_directory_uri() . '/admin/css/admin.min.css', array(), filemtime(get_theme_file_path('/admin/css/admin.min.css')), 'all' );
        wp_enqueue_style( 'admin-css' );
    }
}

add_action('init', 'custom_woomarqt_styles'); // Add Stylesheets

include 'blocks/icons.php';